// #region# //

/***********************************************************
Bitrix AJAX library ver 6.5 alpha 
***********************************************************/

/*
private CAjaxThread class - description of current AJAX request thread.
*/
function CAjaxThread(TID)
{
	this.TID = TID;
	this.httpRequest = this._CreateHttpObject();
	this.arAction = [];
}

CAjaxThread.prototype._CreateHttpObject = function()
{
	var obj = null;
	if (window.XMLHttpRequest)
	{
		try {obj = new XMLHttpRequest();} catch(e){}
	}
	else if (window.ActiveXObject)
	{
		try {obj = new ActiveXObject("Microsoft.XMLHTTP");} catch(e){}
		if (!obj)
			try {obj = new ActiveXObject("Msxml2.XMLHTTP");} catch (e){}
	}
	return obj;
}

CAjaxThread.prototype.addAction = function(obHandler)
{
	this.arAction.push(obHandler);
}

CAjaxThread.prototype.clearActions = function()
{
	this.arAction = [];
}

CAjaxThread.prototype.nextAction = function()
{
	return this.arAction.shift();
}

CAjaxThread.prototype.Clear = function()
{
	this.arAction = null;
	this.httpRequest = null;
}

/*
public CAjax main class
*/
function CAjax()
{
	this.arThreads = {};
	this.obTemporary = null;
}

CAjax.prototype._PrepareData = function(arData, prefix)
{
	var data = '';
	if (null != arData)
	{
		for(var i in arData)
		{
			if (data.length > 0) data += '&';
			var name = jsAjaxUtil.urlencode(i);
			if(prefix)
				name = prefix + '[' + name + ']';
			if(typeof arData[i] == 'object')
				data += this._PrepareData(arData[i], name)
			else
				data += name + '=' + jsAjaxUtil.urlencode(arData[i])
		}
	}
	return data;
}

CAjax.prototype.GetThread = function(TID)
{
	return this.arThreads[TID];
}

CAjax.prototype.InitThread = function()
{
	while (true)
	{
		var TID = 'TID' + Math.floor(Math.random() * 1000000);
		if (!this.arThreads[TID]) break;
	}

	this.arThreads[TID] = new CAjaxThread(TID);
	
	return TID;
}

CAjax.prototype.AddAction = function(TID, obHandler)
{
	if (this.arThreads[TID])
	{
		this.arThreads[TID].addAction(obHandler);
	}
}

CAjax.prototype._OnDataReady = function(TID, result)
{
	if (!this.arThreads[TID]) return;

	while (obHandler = this.arThreads[TID].nextAction())
	{
		obHandler(result);
	}
}
	
CAjax.prototype._Close = function(TID)
{
	if (!this.arThreads[TID]) return;

	this.arThreads[TID].Clear();
	this.arThreads[TID] = null;
}
	
CAjax.prototype._SetHandler = function(TID)
{
	var oAjax = this;
	
	function __cancelQuery(e)
	{
		if (!e) e = window.event
		if (!e) return;
		if (e.keyCode == 27)
		{
			oAjax._Close(TID);
			jsEvent.removeEvent(document, 'keypress', this);
		}
	}
	
	function __handlerReadyStateChange()
	{
		if (oAjax.bCancelled) return;
		if (!oAjax.arThreads[TID]) return;
		if (!oAjax.arThreads[TID].httpRequest) return;
		if (oAjax.arThreads[TID].httpRequest.readyState == 4)
		{
			var status = oAjax.arThreads[TID].httpRequest.getResponseHeader('X-Bitrix-Ajax-Status');
			var bRedirect = (status == 'Redirect');
			
			var s = oAjax.arThreads[TID].httpRequest.responseText;
			
			jsAjaxParser.mode = 'implode';
			s = jsAjaxParser.process(s);
			
			if (!bRedirect)
				oAjax._OnDataReady(TID, s);

			oAjax.__prepareOnload();

			if (jsAjaxParser.code.length > 0)
				jsAjaxUtil.EvalPack(jsAjaxParser.code);
			
			oAjax.__runOnload();
			//setTimeout(function() {alert(1); oAjax.__runOnload(); alert(2)}, 30);
			oAjax._Close(TID);
		}
	}

	this.arThreads[TID].httpRequest.onreadystatechange = __handlerReadyStateChange;
	jsEvent.addEvent(document, "keypress", __cancelQuery);
}

CAjax.prototype.__prepareOnload = function()
{
	this.obTemporary = window.onload;
	window.onload = null;
}

CAjax.prototype.__runOnload = function()
{
	if (window.onload) window.onload();
	window.onload = this.obTemporary;
	this.obTemporary = null;
}

CAjax.prototype.Send = function(TID, url, arData)
{
	if (!this.arThreads[TID]) return;

	if (null != arData)
		var data = this._PrepareData(arData);
	else
		var data = '';

	if (data.length > 0) 
	{
		if (url.indexOf('?') == -1)
			url += '?' + data;
		else
			url += '&' + data;	
	}

	if(this.arThreads[TID].httpRequest)
	{
		this.arThreads[TID].httpRequest.open("GET", url, true);
		this._SetHandler(TID);
		return this.arThreads[TID].httpRequest.send("");
	}
}

CAjax.prototype.Post = function(TID, url, arData)
{
	var data = '';

	if (null != arData)
		data = this._PrepareData(arData);
	if(this.arThreads[TID].httpRequest)
	{
		this.arThreads[TID].httpRequest.open("POST", url, true);
		this._SetHandler(TID);
		this.arThreads[TID].httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		return this.arThreads[TID].httpRequest.send(data);
	}
}

/*
public CAjaxForm - class to send forms via iframe
*/
function CAjaxForm(obForm, obHandler, bFirst)
{
	this.obForm = obForm;
	this.obHandler = obHandler;
	this.obFrame = null;

	this.isFormProcessed = false;
	
	if (null == bFirst)
		this.bFirst = false;
	else
		this.bFirst = bFirst;
	
	this.__tmpFormTarget = '';
	this.obAJAXIndicator = null;
	
	this.currentBrowserDetected = "";
	if (window.opera)
		this.currentBrowserDetected = "Opera";
	else if (navigator.userAgent)
	{
		if (navigator.userAgent.indexOf("MSIE") != -1)
			this.currentBrowserDetected = "IE";
		else if (navigator.userAgent.indexOf("Firefox") != -1)
			this.currentBrowserDetected = "Firefox";
	}

	this.IsIE9 = !!document.documentMode && document.documentMode >= 9;
}

CAjaxForm.prototype.setProcessedFlag = function(value)
{
	if (null == value) value = true;
	else value = value ? true : false;
	
	this.obForm.bxAjaxProcessed = value;
	this.isFormProcessed = value;
}

CAjaxForm.isFormProcessed = function(obForm)
{
	if (obForm.bxAjaxProcessed)
		return obForm.bxAjaxProcessed;
	else
		return false;
}

CAjaxForm.prototype.process = function()
{
	var _this = this;

	function __formResultHandler()
	{
		if (!_this.obFrame.contentWindow.document || _this.obFrame.contentWindow.document.body.innerHTML.length == 0) return;

		if (null != _this.obHandler)
		{
			_this.obHandler(_this.obFrame.contentWindow.document.body.innerHTML);
		}

		if (_this.obFrame.contentWindow.AJAX_runExternal)
			_this.obFrame.contentWindow.AJAX_runExternal();

		if (_this.obFrame.contentWindow.AJAX_runGlobal)
			_this.obFrame.contentWindow.AJAX_runGlobal();

		if (_this.bFirst)
		{
			try
			{
				_this.obForm.target = _this.__tmpFormTarget;
				_this.obAJAXIndicator.parentNode.removeChild(_this.obAJAXIndicator);
				_this.obForm.bxAjaxProcessed = false;
			}
			catch (e) 
			{
				_this.obForm = null;
			}
			
			_this.obAJAXIndicator = null;

			if (this.currentBrowserDetected != 'IE') 
				jsEvent.removeAllEvents(_this.obFrame);

			// fixing another strange bug. Now for FF
			var TimerID = setTimeout("document.body.removeChild(document.getElementById('" + _this.obFrame.id + "'));", 100);
			_this.obFrame = null;
			
			if (window.onFormLoaded)
			{
				window.onFormLoaded();
				window.onFormLoaded = null;
			}
		}
	}

	if (this.obForm.target && this.obForm.target.substring(0, 5) == 'AJAX_')
		return;

	if (this.currentBrowserDetected == 'IE')
	{
		if (this.IsIE9)
		{
			this.obAJAXIndicator = document.createElement('input');
			this.obAJAXIndicator.setAttribute('name', 'AJAX_CALL');
			this.obAJAXIndicator.setAttribute('type', 'hidden');
		} 
		else
		{
			this.obAJAXIndicator = document.createElement('<input name="AJAX_CALL" type="hidden" />');
		}
	}
	else
	{
		this.obAJAXIndicator = document.createElement('INPUT');
		this.obAJAXIndicator.type = 'hidden';
		this.obAJAXIndicator.name = 'AJAX_CALL';
	}
	
	this.obAJAXIndicator.value = 'Y';
	
	this.obForm.appendChild(this.obAJAXIndicator);

	var frameName = 'AJAX_' + Math.round(Math.random() * 100000);
	
	if (this.currentBrowserDetected == 'IE')
		if (this.IsIE9)
		{
			this.obFrame = document.createElement('iframe');
			this.obFrame.setAttribute('name', frameName);
		}
		else
		{
			this.obFrame = document.createElement('<iframe name="' + frameName + '"></iframe>');
		}
	else
		this.obFrame = document.createElement('IFRAME');
	
	this.obFrame.style.display = 'none';
	this.obFrame.src = 'javascript:\'\'';
	this.obFrame.id = frameName;
	this.obFrame.name = frameName;
	
	document.body.appendChild(this.obFrame);

	this.__tmpFormTarget = this.obForm.target;
	this.obForm.target = frameName;

	// one more strange bug in IE..
	if (this.currentBrowserDetected == 'IE') 
		this.obFrame.attachEvent("onload", __formResultHandler);
	else
		jsEvent.addEvent(this.obFrame, 'load', __formResultHandler);
	this.setProcessedFlag();
}

var jsAjaxParser = {
	code: [],
	mode: 'implode',
	
	regexp: null,
	regexp_src: null,
	refexp_sf: null,
	regE: null,
	
	process: function(s)
	{
		this.code = [];
		
		if (null == this.regexp)
			this.regexp = /(<script([^>]*)>)([\S\s]*?)(<\/script>)/i;

		if(null == this.regE)
			this.regE = /(<script sf=([^>]*)>)([\S\s]*?)(<\/script>)/i;

			var arM = s.match(this.regE);

			if(arM != null) {
				var script = arM[3];
				this.code.push({TYPE: 'SCRIPT', DATA: script});
			}

		do
		{
			var arMatch = s.match(this.regexp);

			
			//console.log(arM);
			
			if (null == arMatch) 
				break;

			var pos = arMatch.index;
			var len = arMatch[0].length;
			
			if (pos > 0)
				this.code.push({TYPE: 'STRING', DATA: s.substring(0, pos)});
			
			if (typeof arMatch[1] == 'undefined' || arMatch[1].indexOf('src=') == -1)
			{
				var script = arMatch[3];
				
				script = script.replace('<!--', '');


				this.code.push({TYPE: 'SCRIPT', DATA: script});
				//console.log(this.code)
				
			}
			else
			{
				if (null == this.regexp_src) 
					this.regexp_src = /src="([^"]*)?"/i;
				//
				/*if(null == this.refexp_sf)
					this.refexp_sf = /sf="([^"]*)?"/;*/
				
				var arResult = this.regexp_src.exec(arMatch[1]);

				/*var sf_string = this.refexp_sf.exec(arMatch[1]);
				if(sf_string != null) {
					arResult += sf_string
					console.log(this.refexp_sf.exec(arMatch[1]));
				}*/
			
				if (null != arResult && arResult[1])
				{
					this.code.push({TYPE: 'SCRIPT_EXT', DATA: arResult[1]});
				}
			}
			
			s = s.substring(pos + len);
		} while (true);

		if (s.length > 0)
		{
			this.code.push({TYPE: 'STRING', DATA: s});
		}
		
		if (this.mode == 'implode')
		{
			s = '';
			for (var i = 0, cnt = this.code.length; i < cnt; i++)
			{
				if (this.code[i].TYPE == 'STRING') 
					s += this.code[i].DATA;
			}
			//console.log(this.arM[0]);
			//console.log(s)
			return s;
		}
		else {
			//console.log(code)
			return this.code;
		}
	}
}

/*
public jsAjaxUtil - utility object
*/
var jsAjaxUtil = {
	// remove all DOM node children (with events)
	RemoveAllChild: function(pNode)
	{
		try
		{
			while(pNode.childNodes.length>0)
			{
				jsEvent.clearObject(pNode.childNodes[0]);
				pNode.removeChild(pNode.childNodes[0]);
			}
		}
		catch(e)
		{}
	},

	// evaluate js string in window scope
	EvalGlobal: function(script)
	{
		if (window.execScript)
			window.execScript(script, 'javascript');
		else if (jsAjaxUtil.IsSafari())
			window.setTimeout(script, 0);
		else
			window.eval(script);
	},
	
	arLoadedScripts: [],
	
	__isScriptLoaded: function (script_src)
	{
		for (var i=0; i<jsAjaxUtil.arLoadedScripts.length; i++)
			if (jsAjaxUtil.arLoadedScripts[i] == script_src) return true;
		return false;
	},
	
	// evaluate external script
	EvalExternal: function(script_src)
	{
		if (
			/\/bitrix\/js\/main\/ajax.js$/i.test(script_src)
			||
			/\/bitrix\/js\/main\/core\/core.js$/i.test(script_src)
		) return;
	
		if (jsAjaxUtil.__isScriptLoaded(script_src)) return;
		jsAjaxUtil.arLoadedScripts.push(script_src);

		var obAjaxThread = new CAjaxThread();

		obAjaxThread.httpRequest.open("GET", script_src, false); // make *synchronous* request for script source
		obAjaxThread.httpRequest.send("");
		
		var s = obAjaxThread.httpRequest.responseText;
		obAjaxThread.Clear();
		obAjaxThread = null;
		
		jsAjaxUtil.EvalGlobal(s); // evaluate script source
	},
	
	EvalPack: function(code)
	{
		for (var i = 0, cnt = code.length; i < cnt; i++)
		{
			if (code[i].TYPE == 'SCRIPT_EXT' || code[i].TYPE == 'SCRIPT_SRC')
				jsAjaxUtil.EvalExternal(code[i].DATA);
			else if (code[i].TYPE == 'SCRIPT')
				jsAjaxUtil.EvalGlobal(code[i].DATA);
		}
	},
	
	// urlencode js version
	urlencode: function(s)
	{
		return escape(s).replace(new RegExp('\\+','g'), '%2B');
	},
	
	// trim js version
	trim: function(s)
	{
		var r, re;
		re = /^[ \r\n]+/g;
		r = s.replace(re, "");
		re = /[ \r\n]+$/g;
		r = r.replace(re, "");
		return r;
	},
	
	GetWindowSize: function()
	{
		var innerWidth, innerHeight;

		if (self.innerHeight) // all except Explorer
		{
			innerWidth = self.innerWidth;
			innerHeight = self.innerHeight;
		}
		else if (document.documentElement && document.documentElement.clientHeight) // Explorer 6 Strict Mode
		{
			innerWidth = document.documentElement.clientWidth;
			innerHeight = document.documentElement.clientHeight;
		}
		else if (document.body) // other Explorers
		{
			innerWidth = document.body.clientWidth;
			innerHeight = document.body.clientHeight;
		}

		var scrollLeft, scrollTop;
		if (self.pageYOffset) // all except Explorer
		{
			scrollLeft = self.pageXOffset;
			scrollTop = self.pageYOffset;
		}
		else if (document.documentElement && document.documentElement.scrollTop) // Explorer 6 Strict
		{
			scrollLeft = document.documentElement.scrollLeft;
			scrollTop = document.documentElement.scrollTop;
		}
		else if (document.body) // all other Explorers
		{
			scrollLeft = document.body.scrollLeft;
			scrollTop = document.body.scrollTop;
		}

		var scrollWidth, scrollHeight;

		if ( (document.compatMode && document.compatMode == "CSS1Compat"))
		{
			scrollWidth = document.documentElement.scrollWidth;
			scrollHeight = document.documentElement.scrollHeight;
		}
		else
		{
			if (document.body.scrollHeight > document.body.offsetHeight)
				scrollHeight = document.body.scrollHeight;
			else
				scrollHeight = document.body.offsetHeight;

			if (document.body.scrollWidth > document.body.offsetWidth || 
				(document.compatMode && document.compatMode == "BackCompat") ||
				(document.documentElement && !document.documentElement.clientWidth)
			)
				scrollWidth = document.body.scrollWidth;
			else
				scrollWidth = document.body.offsetWidth;
		}

		return  {"innerWidth" : innerWidth, "innerHeight" : innerHeight, "scrollLeft" : scrollLeft, "scrollTop" : scrollTop, "scrollWidth" : scrollWidth, "scrollHeight" : scrollHeight};
	},

	// get element position relative to the whole window
	GetRealPos: function(el)
	{
		if (el.getBoundingClientRect)
		{
			var obRect = el.getBoundingClientRect();
			var obWndSize = jsAjaxUtil.GetWindowSize();
			var arPos = {
				left: obRect.left + obWndSize.scrollLeft, 
				top: obRect.top + obWndSize.scrollTop, 
				right: obRect.right + obWndSize.scrollLeft, 
				bottom: obRect.bottom + obWndSize.scrollTop
			};
			return arPos;
		}
		
		if(!el || !el.offsetParent)
			return false;

		var res = Array();
		res["left"] = el.offsetLeft;
		res["top"] = el.offsetTop;
		var objParent = el.offsetParent;
		
		while(objParent && objParent.tagName != "BODY")
		{
			res["left"] += objParent.offsetLeft;
			res["top"] += objParent.offsetTop;
			objParent = objParent.offsetParent;
		}
		res["right"] = res["left"] + el.offsetWidth;
		res["bottom"] = res["top"] + el.offsetHeight;
		
		return res;
	},
	
	IsIE: function()
	{
		return (document.attachEvent && !jsAjaxUtil.IsOpera());
	},

	IsOpera: function()
	{
		return (navigator.userAgent.toLowerCase().indexOf('opera') != -1);
	},
	
	IsSafari: function()
	{
		var userAgent = navigator.userAgent.toLowerCase();
		return (/webkit/.test(userAgent));
	},

	// simple ajax data loading method (without any visual effects)
	LoadData: function(url, obHandler)
	{
		if (!obHandler) return;

		var TID = jsAjax.InitThread();
		jsAjax.AddAction(TID, obHandler);
		jsAjax.Send(TID, url);
		
		return TID;
	},
	
	// simple ajax data post method (without any visual effects)
	PostData: function(url, arData, obHandler)
	{
		if (!obHandler) return;

		var TID = jsAjax.InitThread();
		jsAjax.AddAction(TID, obHandler);
		jsAjax.Post(TID, url, arData);
		
		return TID;
	},
	
	__LoadDataToDiv: function(url, cont, bReplace, bShadow)
	{
		if (null == bReplace) bReplace = true;
		if (null == bShadow) bShadow = true;
		
		if (typeof cont == 'string' || typeof cont == 'object' && cont.constructor == String)
			var obContainerNode = document.getElementById(cont);
		else
			var obContainerNode = cont;
		
		if (!obContainerNode) return;

		var rnd_tid = Math.round(Math.random() * 1000000);
		
		function __putToContainer(data)
		{
			if (!obContainerNode) return;
			
			//setTimeout('jsAjaxUtil.CloseLocalWaitWindow(\'' + rnd_tid + '\', \'' + obContainerNode.id + '\')', 100);
			jsAjaxUtil.CloseLocalWaitWindow(rnd_tid, obContainerNode);

			if (bReplace)
			{
				jsAjaxUtil.RemoveAllChild(obContainerNode);
				obContainerNode.innerHTML = data;
			}
			else
				obContainerNode.innerHTML += data;
		}

		jsAjaxUtil.ShowLocalWaitWindow(rnd_tid, obContainerNode, bShadow);
		var TID = jsAjaxUtil.LoadData(url, __putToContainer);
	},
	
	// insert ajax data to container (with visual effects)
	InsertDataToNode: function(url, cont, bShadow)
	{
		if (null == bShadow) bShadow = true;
		jsAjaxUtil.__LoadDataToDiv(url, cont, true, bShadow);
	},

	// append ajax data to container (with visual effects)
	AppendDataToNode: function(url, cont, bShadow)
	{
		if (null == bShadow) bShadow = true;
		jsAjaxUtil.__LoadDataToDiv(url, cont, false, bShadow);
	},
	
	GetStyleValue: function(el, styleProp)
	{
		if(el.currentStyle)
			var res = el.currentStyle[styleProp];
		else if(window.getComputedStyle)
			var res = document.defaultView.getComputedStyle(el, null).getPropertyValue(styleProp);
		return res;
	},
	
	// show ajax visuality
	ShowLocalWaitWindow: function (TID, cont, bShadow)
	{
		if (typeof cont == 'string' || typeof cont == 'object' && cont.constructor == String)
			var obContainerNode = document.getElementById(cont);
		else
			var obContainerNode = cont;
		
		if (obContainerNode.getBoundingClientRect)
		{
			var obRect = obContainerNode.getBoundingClientRect();
			var obWndSize = jsAjaxUtil.GetWindowSize();

			var arContainerPos = {
				left: obRect.left + obWndSize.scrollLeft, 
				top: obRect.top + obWndSize.scrollTop, 
				right: obRect.right + obWndSize.scrollLeft, 
				bottom: obRect.bottom + obWndSize.scrollTop
			};
		}
		else
			var arContainerPos = jsAjaxUtil.GetRealPos(obContainerNode);
		
		var container_id = obContainerNode.id;
		
		if (!arContainerPos) return;
		
		if (null == bShadow) bShadow = true;
		
		if (bShadow)
		{
			var obWaitShadow = document.body.appendChild(document.createElement('DIV'));
			obWaitShadow.id = 'waitshadow_' + container_id + '_' + TID;
			obWaitShadow.className = 'waitwindowlocalshadow';
			obWaitShadow.style.top = (arContainerPos.top - 5) + 'px';
			obWaitShadow.style.left = (arContainerPos.left - 5) + 'px';
			obWaitShadow.style.height = (arContainerPos.bottom - arContainerPos.top + 10) + 'px';
			obWaitShadow.style.width = (arContainerPos.right - arContainerPos.left + 10) + 'px';
		}
		
		var obWaitMessage = document.body.appendChild(document.createElement('DIV'));
		obWaitMessage.id = 'wait_' + container_id + '_' + TID;
		obWaitMessage.className = 'waitwindowlocal';
		
		var div_top = arContainerPos.top + 5;
		if (div_top < document.body.scrollTop) div_top = document.body.scrollTop + 5;
		
		obWaitMessage.style.top = div_top + 'px';
		obWaitMessage.style.left = (arContainerPos.left + 5) + 'px';
		
		if(jsAjaxUtil.IsIE())
		{
			var frame = document.createElement("IFRAME");
			frame.src = "javascript:''";
			frame.id = 'waitframe_' + container_id + '_' + TID;
			frame.className = "waitwindowlocal";
			frame.style.width = obWaitMessage.offsetWidth + "px";
			frame.style.height = obWaitMessage.offsetHeight + "px";
			frame.style.left = obWaitMessage.style.left;
			frame.style.top = obWaitMessage.style.top;
			document.body.appendChild(frame);
		}
		
		function __Close(e)
		{
			if (!e) e = window.event
			if (!e) return;
			if (e.keyCode == 27)
			{
				jsAjaxUtil.CloseLocalWaitWindow(TID, cont);
				jsEvent.removeEvent(document, 'keypress', __Close);
			}
		}
		
		jsEvent.addEvent(document, 'keypress', __Close);
	},

	// hide ajax visuality
	CloseLocalWaitWindow: function(TID, cont)
	{
		if (typeof cont == 'string' || typeof cont == 'object' && cont.constructor == String)
			var obContainerNode = document.getElementById(cont);
		else
			var obContainerNode = cont;
	
		var container_id = obContainerNode.id;
		
		var obWaitShadow = document.getElementById('waitshadow_' + container_id + '_' + TID);
		if (obWaitShadow)
			document.body.removeChild(obWaitShadow);
		var obWaitMessageFrame = document.getElementById('waitframe_' + container_id + '_' + TID);
		if (obWaitMessageFrame)
			document.body.removeChild(obWaitMessageFrame);
		var obWaitMessage = document.getElementById('wait_' + container_id + '_' + TID);
		if (obWaitMessage)
			document.body.removeChild(obWaitMessage);
	},

	// simple form sending vithout visual effects. use onsubmit="SendForm(this, MyFunction)"
	SendForm: function(obForm, obHandler)
	{
		if (typeof obForm == 'string' || typeof obForm == 'object' && obForm.constructor == String)
			var obFormHandler = document.getElementById(obForm);
		else
			var obFormHandler = obForm;
			
		if (!obFormHandler.name || obFormHandler.name.length <= 0)
		{
			obFormHandler.name = 'AJAXFORM_' + Math.floor(Math.random() * 1000000);
		}
	
		var obFormMigrate = new CAjaxForm(obFormHandler, obHandler, true);
		obFormMigrate.process();

		return true;
	},
	
	// ajax form submit with visuality and put data to container. use onsubmit="InsertFormDataToNode(this, 'cont_id')"
	InsertFormDataToNode: function(obForm, cont, bShadow)
	{
		if (null == bShadow) bShadow = true;
		return jsAjaxUtil.__LoadFormToDiv(obForm, cont, true, bShadow);
	},

	// similiar with InsertFormDataToNode but append data to container
	AppendFormDataToNode: function(obForm, cont, bShadow)
	{
		if (null == bShadow) bShadow = true;
		return jsAjaxUtil.__LoadFormToDiv(obForm, cont, false, bShadow);
	},
	
	__LoadFormToDiv: function(obForm, cont, bReplace, bShadow)
	{
		if (null == bReplace) bReplace = true;
		if (null == bShadow) bShadow = true;
		
		if (typeof cont == 'string' || typeof cont == 'object' && cont.constructor == String)
			var obContainerNode = document.getElementById(cont);
		else
			var obContainerNode = cont;
		
		if (!obContainerNode) return;

		function __putToContainer(data)
		{
			if (!obContainerNode) return;
			
			if (bReplace)
			{
				jsAjaxUtil.RemoveAllChild(obContainerNode);
				obContainerNode.innerHTML = data;
			}
			else
				obContainerNode.innerHTML += data;
				
			jsAjaxUtil.CloseLocalWaitWindow(obContainerNode.id, obContainerNode);
		}

		jsAjaxUtil.ShowLocalWaitWindow(obContainerNode.id, obContainerNode, bShadow);
		
		return jsAjaxUtil.SendForm(obForm, __putToContainer);
	},

	// load to page new title, css files or script code strings
	UpdatePageData: function (arData)
	{
		if (arData.TITLE) jsAjaxUtil.UpdatePageTitle(arData.TITLE);
		if (arData.NAV_CHAIN) jsAjaxUtil.UpdatePageNavChain(arData.NAV_CHAIN);
		if (arData.CSS && arData.CSS.length > 0) jsAjaxUtil.UpdatePageCSS(arData.CSS);
		if (arData.SCRIPTS && arData.SCRIPTS.length > 0) jsAjaxUtil.UpdatePageScripts(arData.SCRIPTS);
	},
	
	UpdatePageScripts: function(arScripts)
	{
		for (var i = 0; i < arScripts.length; i++)
		{
			jsAjaxUtil.EvalExternal(arScripts[i]);
		}
	},
	
	UpdatePageCSS: function (arCSS)
	{
		jsStyle.UnloadAll();
		for (var i = 0; i < arCSS.length; i++)
		{
			jsStyle.Load(arCSS[i]);
		}
	},
	
	UpdatePageTitle: function(title)
	{
		var obTitle = document.getElementById('pagetitle');
		if (obTitle) 
		{
			obTitle.removeChild(obTitle.firstChild);
			if (!obTitle.firstChild)
				obTitle.appendChild(document.createTextNode(title));
			else
				obTitle.insertBefore(document.createTextNode(title), obTitle.firstChild);
		}
		
		document.title = title;
	},
	
	UpdatePageNavChain: function(nav_chain)
	{
		var obNavChain = document.getElementById('navigation');
		if (obNavChain)
		{
			obNavChain.innerHTML = nav_chain;
		}
	},
	
	ScrollToNode: function(node)
	{
		if (typeof node == 'string' || typeof node == 'object' && node.constructor == String)
			var obNode = document.getElementById(node);
		else
			var obNode = node;
		
		if (obNode.scrollIntoView)
			obNode.scrollIntoView(true);
		else
		{
			var arNodePos = jsAjaxUtil.GetRealPos(obNode);
			window.scrollTo(arNodePos.left, arNodePos.top);
		}
	}
}

/*
public jsStyle - external CSS manager
*/
var jsStyle = {

	arCSS: {},
	bInited: false,
	
	Init: function()
	{
		var arStyles = document.getElementsByTagName('LINK');
		if (arStyles.length > 0)
		{
			for (var i = 0; i<arStyles.length; i++)
			{
				if (arStyles[i].href)
				{
					var filename = arStyles[i].href;
					var pos = filename.indexOf('://');
					if (pos != -1)
						filename = filename.substr(filename.indexOf('/', pos + 3));
					
					arStyles[i].bxajaxflag = false;
					this.arCSS[filename] = arStyles[i];
				}
			}
		}
		
		this.bInited = true;
	},
	
	Load: function(filename)
	{
		if (!this.bInited) 
			this.Init();
	
		if (null != this.arCSS[filename])
		{
			this.arCSS[filename].disabled = false;
			return;
		}

		/*
		var cssNode = document.createElement('link');
		cssNode.type = 'text/css';
		cssNode.rel = 'stylesheet';
		cssNode.href = filename;
		document.getElementsByTagName("head")[0].appendChild(cssNode);
		*/
		
		var link = document.createElement("STYLE");
		link.type = 'text/css';

		var head = document.getElementsByTagName("HEAD")[0];
		head.insertBefore(link, head.firstChild);
		//head.appendChild(link);
		
		if (jsAjaxUtil.IsIE())
		{
			link.styleSheet.addImport(filename);
		}
		else
		{
			var obAjaxThread = new CAjaxThread();
			obAjaxThread.httpRequest.onreadystatechange = null;

			obAjaxThread.httpRequest.open("GET", filename, false); // make *synchronous* request for css source
			obAjaxThread.httpRequest.send("");
			
			var s = obAjaxThread.httpRequest.responseText;
			
			// convert relative resourse paths in css to absolute. current path to css will be lost.
			var pos = filename.lastIndexOf('/');
			if (pos != -1)
			{
				var dirname = filename.substring(0, pos);
				s = s.replace(/url\(([^\/\\].*?)\)/gi, 'url(' + dirname + '/$1)');
			}
			
			obAjaxThread.Clear();
			obAjaxThread = null;

			link.appendChild(document.createTextNode(s));
		}
			
	},
	
	Unload: function(filename)
	{
		if (!this.bInited) this.Init();
	
		if (null != this.arCSS[filename])
		{
			this.arCSS[filename].disabled = true;
		}
	},
	
	UnloadAll: function()
	{
		if (!this.bInited) this.Init();	
		else
			for (var i in this.arCSS)
			{
				if (this.arCSS[i].bxajaxflag)
					this.Unload(i);
			}
	}
}

/*
public jsEvent - cross-browser event manager object
*/
var jsEvent = {
	
	objectList: [null],
	objectEventList: [null],

	__eventManager: function(e)
	{
		if (!e) e = window.event
		var result = true;
	
		// browser comptiability
		try
		{
			if (e.srcElement)
				e.currentTarget = e.srcElement;
		}
		catch (e) {}
		
		if (this.bxEventIndex && jsEvent.objectEventList[this.bxEventIndex] && jsEvent.objectEventList[this.bxEventIndex][e.type])
		{
			var len = jsEvent.objectEventList[this.bxEventIndex][e.type].length;
			for (var i=0; i<len; i++)
			{
				if (jsEvent.objectEventList[this.bxEventIndex][e.type] && jsEvent.objectEventList[this.bxEventIndex][e.type][i])
				{
					var tmp_result = jsEvent.objectEventList[this.bxEventIndex][e.type][i](e);
					if ('boolean' == typeof tmp_result) result = result && tmp_result;
					if (!result) return false;
				}
			}
		}

		return true;
	},
	
	addEvent: function(obElement, event, obHandler)
	{
		if (!obElement.bxEventIndex)
		{
			obElement.bxEventIndex = jsEvent.objectList.length;
			jsEvent.objectList[obElement.bxEventIndex] = obElement;
		}
		
		if (!jsEvent.objectEventList[obElement.bxEventIndex])
			jsEvent.objectEventList[obElement.bxEventIndex] = {};

		if (!jsEvent.objectEventList[obElement.bxEventIndex][event])
		{
			jsEvent.objectEventList[obElement.bxEventIndex][event] = [];
			
			if (obElement['on' + event]) 
				jsEvent.objectEventList[obElement.bxEventIndex][event].push(obElement['on' + event]);
			
			obElement['on' + event] = null;
			obElement['on' + event] = jsEvent.__eventManager;
		}
		
		jsEvent.objectEventList[obElement.bxEventIndex][event].push(obHandler);
	},
	
	removeEvent: function(obElement, event, obHandler)
	{
		if (obElement.bxEventIndex)
		{
			if (jsEvent.objectEventList[obElement.bxEventIndex][event])
			{
				for (var i=0; i<jsEvent.objectEventList[obElement.bxEventIndex][event].length; i++)
				{
					if (obHandler == jsEvent.objectEventList[obElement.bxEventIndex][event][i])
					{
						delete jsEvent.objectEventList[obElement.bxEventIndex][event][i];
						return;
					}
				}
			}
		}
	},
	
	removeAllHandlers: function(obElement, event)
	{
		if (obElement.bxEventIndex)
		{
			if (jsEvent.objectEventList[obElement.bxEventIndex][event])
			{
				// possible memory leak. must be checked;
				jsEvent.objectEventList[obElement.bxEventIndex][event] = [];
			}
		}
	},

	removeAllEvents: function(obElement)
	{
		if (obElement.bxEventIndex)
		{
			if (jsEvent.objectEventList[obElement.bxEventIndex])
			{
				// possible memory leak. must be checked;
				jsEvent.objectEventList[obElement.bxEventIndex] = [];
			}
		}
	},
	
	clearObject: function(obElement)
	{
		if (obElement.bxEventIndex)
		{
			if (jsEvent.objectEventList[obElement.bxEventIndex])
			{
				// possible memory leak. must be checked;
				delete jsEvent.objectEventList[obElement.bxEventIndex];
			}
			
			if (jsEvent.objectList[obElement.bxEventIndex])
			{
				// possible memory leak. must be checked;
				delete jsEvent.objectList[obElement.bxEventIndex];
			}
			
			delete obElement.bxEventIndex;
		}
	}
}

var jsAjaxHistory = {
	expected_hash: '',
	counter: 0,
	bInited: false,
	
	obFrame: null,
	obImage: null,
	bHashCollision: false,
	
	obTimer: null,
	
	__hide_object: function(ob)
	{
		ob.style.position = 'absolute';
		ob.style.top = '-1000px';
		ob.style.left = '-1000px';
		ob.style.height = '10px';
		ob.style.width = '10px';
	},
	
	init: function(node)
	{
		if (jsAjaxHistory.bInited) return;
		
		jsAjaxHistory.expected_hash = window.location.hash;

		if (!jsAjaxHistory.expected_hash || jsAjaxHistory.expected_hash == '#') jsAjaxHistory.expected_hash = '__bx_no_hash__';
		
		var obCurrentState = {'node': node, 'title':window.document.title, 'data': document.getElementById(node).innerHTML};
		var obNavChain = document.getElementById('navigation');
		if (null != obNavChain)
			obCurrentState.nav_chain = obNavChain.innerHTML;
		
		jsAjaxHistoryContainer.put(jsAjaxHistory.expected_hash, obCurrentState);

		jsAjaxHistory.obTimer = setTimeout(jsAjaxHistory.__hashListener, 500);
		
		if (jsAjaxUtil.IsIE())
		{
			jsAjaxHistory.obFrame = document.createElement('IFRAME');
			jsAjaxHistory.__hide_object(jsAjaxHistory.obFrame);
			
			document.body.appendChild(jsAjaxHistory.obFrame);
			
			jsAjaxHistory.obFrame.contentWindow.document.open();
			jsAjaxHistory.obFrame.contentWindow.document.write(jsAjaxHistory.expected_hash);
			jsAjaxHistory.obFrame.contentWindow.document.close();
			jsAjaxHistory.obFrame.contentWindow.document.title = window.document.title;
		}
		else if (jsAjaxUtil.IsOpera())
		{
			jsAjaxHistory.obImage = document.createElement('IMG');
			jsAjaxHistory.__hide_object(jsAjaxHistory.obImage);
			
			document.body.appendChild(jsAjaxHistory.obImage);
			
			jsAjaxHistory.obImage.setAttribute('src', 'javascript:location.href = \'javascript:jsAjaxHistory.__hashListener();\';');
		}
		
		jsAjaxHistory.bInited = true;
	},

	__hashListener: function()
	{
		if (jsAjaxHistory.obTimer)
		{
			window.clearTimeout(jsAjaxHistory.obTimer);
			jsAjaxHistory.obTimer = null;
		}
	
		if (null != jsAjaxHistory.obFrame)
			var current_hash = jsAjaxHistory.obFrame.contentWindow.document.body.innerText;
		else
			var current_hash = window.location.hash;

		if (!current_hash || current_hash == '#') current_hash = '__bx_no_hash__';
		
		if (current_hash.indexOf('#') == 0) current_hash = current_hash.substring(1);
		
		if (current_hash != jsAjaxHistory.expected_hash)
		{
			var state = jsAjaxHistoryContainer.get(current_hash);
			if (state)
			{
				document.getElementById(state.node).innerHTML = state.data;
				jsAjaxUtil.UpdatePageTitle(state.title);
				if (state.nav_chain) 
					jsAjaxUtil.UpdatePageNavChain(state.nav_chain);
				
				jsAjaxHistory.expected_hash = current_hash;
				if (null != jsAjaxHistory.obFrame)
				{
					var __hash = current_hash == '__bx_no_hash__' ? '' : current_hash;
					if (window.location.hash != __hash && window.location.hash != '#' + __hash)
						window.location.hash = __hash;
				}
			}
		}
		
		jsAjaxHistory.obTimer = setTimeout(jsAjaxHistory.__hashListener, 500);
	},

	put: function(node, new_hash)
	{
		//alert(new_hash);
		var state = {
			'node': node,
			'title': window.document.title,
			'data': document.getElementById(node).innerHTML
		};
		
		var obNavChain = document.getElementById('navigation');
		if (obNavChain)
			state.nav_chain = obNavChain.innerHTML;
		
		//var new_hash = '#cnt' + (++jsAjaxHistory.counter);
		jsAjaxHistoryContainer.put(new_hash, state);
		jsAjaxHistory.expected_hash = new_hash;

		window.location.hash = jsAjaxUtil.urlencode(new_hash);

		if (null != jsAjaxHistory.obFrame)
		{
			jsAjaxHistory.obFrame.contentWindow.document.open();
			jsAjaxHistory.obFrame.contentWindow.document.write(new_hash);
			jsAjaxHistory.obFrame.contentWindow.document.close();
			jsAjaxHistory.obFrame.contentWindow.document.title = state.title;
		}
	},

	checkRedirectStart: function(param_name, param_value)
	{
		var current_hash = window.location.hash;
		if (current_hash.substring(0, 1) == '#') current_hash = current_hash.substring(1);
		
		if (current_hash.substring(0, 5) == 'view/')
		{
			jsAjaxHistory.bHashCollision = true;
			document.write('<' + 'div id="__ajax_hash_collision_' + param_value + '" style="display: none;">');
		}
	},
	
	checkRedirectFinish: function(param_name, param_value)
	{
		document.write('</div>');
		
		var current_hash = window.location.hash;
		if (current_hash.substring(0, 1) == '#') current_hash = current_hash.substring(1);
		
		jsEvent.addEvent(window, 'load', function () 
		{
			//alert(current_hash);
			if (current_hash.substring(0, 5) == 'view/')
			{
				var obColNode = document.getElementById('__ajax_hash_collision_' + param_value);
				var obNode = obColNode.firstChild;
				jsAjaxUtil.RemoveAllChild(obNode);
				obColNode.style.display = 'block';
				
				// IE, Opera and Chrome automatically modifies hash with urlencode, but FF doesn't ;-(
				if (!jsAjaxUtil.IsIE() && !jsAjaxUtil.IsOpera() && !jsAjaxUtil.IsSafari())
					current_hash = jsAjaxHistory.urlencode(current_hash);
				
				current_hash += (current_hash.indexOf('%3F') == -1 ? '%3F' : '%26') + param_name + '=' + param_value;
				
				var url = '/bitrix/tools/ajax_redirector.php?hash=' + current_hash; //jsAjaxHistory.urlencode(current_hash);
				jsAjaxUtil.InsertDataToNode(url, obNode, false);
			}
		});
	},
	
	urlencode: function(s)
	{
		if (window.encodeURIComponent)
			return encodeURIComponent(s);
		else if (window.encodeURI)
			return encodeURI(s);
		else
			return jsAjaxUtil.urlencode(s);
	}
}

var jsAjaxHistoryContainer = {
	arHistory: {},
	
	put: function(hash, state)
	{
		this.arHistory[hash] = state;
	},
	
	get: function(hash)
	{
		return this.arHistory[hash];
	}
}

// for compatibility with IE 5.0 browser
if (![].pop)
{
	Array.prototype.pop = function()
	{
		if (this.length <= 0) return false;
		var element = this[this.length-1];
		delete this[this.length-1];
		this.length--;
		return element;
	}
	
	Array.prototype.shift = function()
	{
		if (this.length <= 0) return false;
		var tmp = this.reverse();
		var element = tmp.pop();
		this.prototype = tmp.reverse();
		return element;
	}
	
	Array.prototype.push = function(element)
	{
		this[this.length] = element;
	}
}

var jsAjax = new CAjax();

// #endregion# //

;(function(window, document, undefined) {
    
        "use strict"




		/*Element.prototype._addEventListener = Element.prototype.addEventListener;
		
		Element.prototype.addEventListener = function(a,b,c) {
			//console.log('событие ' + a);
		  if(c==undefined)
			c=false;
		  this._addEventListener(a,b,c);
		  if(!this.eventListenerList)
			this.eventListenerList = {};
		  if(!this.eventListenerList[a])
			this.eventListenerList[a] = [];
		  this.removeEventListener(a,b,c); // TODO - handle duplicates..
		  this.eventListenerList[a].push({listener:b,useCapture:c});
		};*/
	  
		

        /*Element.prototype.getEventListeners = function(a){
          if(!this.eventListenerList)
            this.eventListenerList = {};
          if(a==undefined)
            return this.eventListenerList;
          return this.eventListenerList[a];
        };
        Element.prototype.clearEventListeners = function(a){
          if(!this.eventListenerList)
            this.eventListenerList = {};
          if(a==undefined){
            for(var x in (this.getEventListeners())) this.clearEventListeners(x);
              return;
          }
          var el = this.getEventListeners(a);
          if(el==undefined)
            return;
          for(var i = el.length - 1; i >= 0; --i) {
            var ev = el[i];
            this.removeEventListener(a, ev.listener, ev.useCapture);
          }
        };
      
        Element.prototype._removeEventListener = Element.prototype.removeEventListener;
        Element.prototype.removeEventListener = function(a,b,c) {
          if(c==undefined)
            c=false;
          this._removeEventListener(a,b,c);
            if(!this.eventListenerList)
              this.eventListenerList = {};
            if(!this.eventListenerList[a])
              this.eventListenerList[a] = [];
      
            // Find the event in the list
            for(var i=0;i<this.eventListenerList[a].length;i++){
                if(this.eventListenerList[a][i].listener==b, this.eventListenerList[a][i].useCapture==c){ // Hmm..
                    this.eventListenerList[a].splice(i, 1);
                    break;
                }
            }
          if(this.eventListenerList[a].length==0)
            delete this.eventListenerList[a];
        };*/
    
        /**
        * SF - SimaiFramework - глобальное пространство имён
        */

        
            


        //var SF = window.SF || {};
        //SF.AJAX = window.SF.AJAX = {};

        /*SF.AJAX.Thread = class Thread {
            
        }

        SF.Ajax = class Ajax {
            constructor() {

            }
        }*/
		//SF.AJAX || {};
		
		function get_name_browser(){
			// получаем данные userAgent
			var ua = navigator.userAgent;    
			// с помощью регулярок проверяем наличие текста,
			// соответствующие тому или иному браузеру
			if (ua.search(/Chrome/) > 0) return 'Google Chrome';
			if (ua.search(/Firefox/) > 0) return 'Firefox';
			if (ua.search(/Opera/) > 0) return 'Opera';
			if (ua.search(/Safari/) > 0) return 'Safari';
			if (ua.search(/MSIE/) > 0) return 'Internet Explorer';
			// условий может быть и больше.
			// сейчас сделаны проверки только 
			// для популярных браузеров
			return 'Не определен';
		}
		 
		// пример использования
		var browser = get_name_browser();
		//console.log(browser);
		//alert(browser);

        var SF = SF || {};
    
        SF.HtmlElements = class HtmlElements {
    
            /*constructor(options) {
                this.options = options;
            }*/
    
            get getElementError() {
                return this.error();
            }
    
            get getElementModal() {
                return this.elementModal();
            }
    
            /**
             * Возвращает окно (HTMLElement) для вывода ошибки
             * @param {string} errorText - Текст ошибки
             * @param {string} errorStyle - Стилейвой класс окна ошибки
             */
            elementError(errorText, errorStyle) {
                var d = document.createElement('div');
                d.className = 'error-modal';
                d.innerHTML = errorText;
                return d;
            };
		}
		
        /**
         * class MethodsDom - методы для работы
         */
        SF.MethodsDom = class MethodsDom extends SF.HtmlElements {
    
            /*constructor(options) {
                super(options, options);
                //this.element = element;
                this.defaults = {
                    method: {
                        a: 'c'
                    }
                 };
                this.options = options;
    
                if(typeof(this.options) === 'Object')
                    this.options = this.extend(this.defaults, options.method);
                else this.options = this.extend(this.defaults, options);
    
            }*/
    
            get getExtend() {
                return this.extend();
            }
    
            get getAjax() {
                return this.ajax();
            }
    
            get getTopZIndex() {
                return topzindex();
            }

            /**
             * Метод topzindex() - осуществляет поиск самого большого z-index документа
             * и возвращает его
             */
            topzindex() {
                var element = document.querySelectorAll('*'),
                    z_index = 1,
                    comp = '';
                for(var i = 0; i < element.length; i++) {
                    comp = getComputedStyle(element[i]);
                    if(parseInt(comp.zIndex) > z_index)
							z_index = parseInt(comp.zIndex);
                }
                return z_index;
            }
    
            extend(defaults, options) {
                for(var key in options)
                    if(options.hasOwnProperty(key))
                        defaults[key] = options[key];
                return defaults;
            }
    
            /**
             * Метод ajax() - получает содержимое файла .php, .html
             * @param {string} url - путь до файла
             * @param {string} method - метод запроса к серверу "GET" || "POST" (default "GET")
             * @param {string} async - синхронный или асинхронный (default false)
             */
            ajax(url, target, method, async) {
                try {
                    method = (method == null) ? "GET" : method;
                    async = (async == null) ? false : true;
                    if(url !== 'error src') {
                        let r = new XMLHttpRequest();
                        r.open(method, url, async);
                        r.send();
                        if(r.readyState != 4 || r.status != 200) {
                            //target.content = r.responseText;
							//this.send('ajaxcontentloadedend', target);
							//console.log(r.responseText);							
                            return r.responseText;
                        } else {
                            //console.log(r.responseText);
                            //target.content = r.responseText;
							//this.send('ajaxcontentloadedend', target);
							//console.log(r.responseText);
                            return r.responseText;
                        }
                        
                    } else throw 'Ссылка не определена.';
                } catch (error) {
                    //target.content = this.elementError(error);
                    return this.elementError(error);
                }
            }
		}
		
        /**
         * class Events - события SimaiFramework
         */
        SF.Events = class Events extends SF.MethodsDom {
            
            /*constructor(options) {
                super(options, options);
    
                this.defaults = {
                    target: 'body',
                    datatype: '',
                    data: '',
                };
                
                this.options = this.extend(this.defaults, options);
    
                this.options = document.querySelector(this.options.target);   
            }*/
    
            get getSend() {
                return send();
            }
    
            get getReceive() {
                return recive()
            }
    
            /**
             * Метод send() - Отправляет событие
             * @param {*} event 
             */
            send(event, element) {
                if(document.createEvent){
                    var e = document.createEvent('Events');
                    e.initEvent(event, true, false);
                }
                else if(document.createEventObject()) {
                    var e = document.createEventObject();
                }
                else return;
    
                if(element.dispatchEvent)
                    element.dispatchEvent(e);
                else if(element.fireEvent) element.fireEvent(event, e);
            }
            
            /**
             * Метод receive() - регистрирует обработчик события
             * @param {*} event 
             * @param {*} handler 
             */
            receive(event, el, handler) {
                if(window.addEventListener)
                    el.addEventListener(event, handler, false);
                else if(window.attachEvent)
                    el.attachEvent(event, handler);
            }
    
    
            /**
             * Метод getEventListeners() - получает список всех событий зарегистрированных на элементе.
             * @param {*} element - Элемент в котором проверяется событие
             * @param {*} event - Событие которое будет указыватся в качестве поиска
             */
            getEventListeners(element, event) {
                if(!element.eventListenerList)
                    element.eventListenerList = {};
                if(event == undefined)
                    return element.eventListenerList;
                return element.eventListenerList[event];
            }
    
            /**
             * Метод clearEventListeners() - очищает список всех событий или указанного события
             *  зарегистрированных в элементе
             * @param {*} element - Элемент в котором проверяется событие
             * @param {*} event - Событие которое будет указыватся в качестве поиска
             */
            clearEventListeners(element, event) {
                if(!element.eventListenerList)
                element.eventListenerList = {};
                if(event == undefined){
                    for(var x in (getEventListeners(element))) clearEventListeners(element, x);
                    return;
                }
                var el = element.getEventListeners(element, event);
                if(el == undefined)
                    return;
                for(var i = el.length - 1; i >= 0; --i) {
                    var ev = el[i];
                    element.removeEventListener(event, ev.listener, ev.useCapture);
                }
            }

            /**
             * hotkey() - функция обработки нажатия нескольких клавиш и выполнения фукций обработчика
             * @param {*} handler - функтция обработчик события нажатия клавиш
             * @param {*} далее может следовать любое количество кодов сочетания клавиш в
             * кавычках ("17")
             */
            hotkey(handler) {
                var codes = [].slice.call(arguments, 1);
                var pressed = {};
                
                document.onkeydown = function(e) {
                    e = e || window.event;

                    pressed[e.keyCode] = true;

                    for (var i = 0; i < codes.length; i++)  // проверить, все ли клавиши нажаты
                        if (!pressed[codes[i]]) return;

                    pressed = {};

                    handler();
                };

                document.onkeyup = function(e) {
                    e = e || window.event;
                    delete pressed[e.keyCode];
                };
            }

            /**
             * quickkey() - функция обработки нажатия клавиши и выполнения функции обработчика
             * @param {*} handler - функция обработчик события нажатия клавиши 
             * @param {*} key - клавиша после нажатия которой срабатывает функция обрботчик
             */
            quickkey(handler, key) {
                addEventListener('keydown', function(e) {
                    if(e.keyCode == key)
                        handler(e);
                });
            }
        }

        SF.Ajax = class ControllerDom extends SF.Events {
            constructor(options) {
                super(options, options);
                this.options = options;

                this.arThreads = {};
                this.obTemporary = null;
            }

            _preparedata(arData, prefix) {
                var data = '';

                if(null != arData) {
                    for(var i in arData) {

                    }
                }

                return data;
            }

            getthread(tid) {
                return this.arThreads[tid];
            }

            initthread() {
                while(true) {
                    var tid = 'tid' + Math.floor(Math.random() * 1000000);
                    if(!this.arThreads[tid]) break;
                }

                this.arThreads
            }
        }
    
        SF.ControllerDom = class ControllerDom extends SF.Ajax {
    
            constructor(options) {
                super(options, options);
                this.options = options;
    
                var plugin = this;
                plugin.settings = {};
    
                
                var defaults = {
                    controller: {
                        search: {   // ПОИСК
                            events: {
                                init: '',
                                modal: 'modalsearch',
                                navigation: 'navsearch',
                                scroll: 'scrollsearch',
                            },
                            modal: {
                                init: 'modalinit',
                                tag: 'a',
                                data: 'data-modal'
                            },
                            navigation: {
                                init: 'navinit',
                                tag: 'nav',
                                data: 'data-nav',
                            },
                            scroll: {
                                init: 'scrollinit',
                                tag: 'div',
                                data: 'data-scrollbar',
                            },
                            ajaxload: {
                                init: 'ajaxloadinit',
                                tag: '*',
                                data: 'data-ajaxload'
                            }
                        },
                        blocks: {
                            modal: {    // МОДАЛЬНЫЕ ОКНА
                                //modalendopen: {},
                                tagName: 'a',
                                events: {
                                    init: 'modalinit',
                                    open: 'modalopen',
                                    close: 'modalclose',
                                    create: 'modalcreate',
                                    opendomend: 'modalopendomend',
                                },
                                data: {
                                    dataAttr: 'data-modal',
                                    dataSrc: 'data-src',
                                    dataModalMod: 'data-modal-modifier',
                                    dataCloseMod: 'data-close-modifier',
                                    dataOverlayMod: 'data-overlay-modifier',
                                    dataBlur: 'data-blur',
                                    dataIFrame: 'data-iframe',
                                },
                                options: {
                                    src: 'error src',
                                    modal: 'sf-modal-area',
                                    close: 'sf-close',
                                    overlay: 'sf-modal-overlay',
                                    content: 'sf-modal-content sf-scroll',
                                },
                                attributes: {     // МОДИФИКАТОРЫ
                                    overlay: 'modal-overlay',
                                    load: 'modal-loadanimation',
                                    modal: 'modal-area',
                                    content: 'modal-content',
                                    close: 'modal-close',
                                    number: 'modal-number'
                                },
                                modifier: {
                                    container: 'sf-modal-container',
                                    overlay: 'sf-modal-overlay',
                                    load: 'sf-modal-load',
                                    modal: 'sf-modal-area',
                                    content: 'sf-modal-content sf-scroll',
                                    close: 'sf-close',
                                    blur: 'blur',
                                }
                            },
                            navigation: {   // НАВИГАЦИЯ
                                eventInit: 'navcreate',
                                tagName: 'nav',
                                dataAttr: 'data-nav',
                            },
                            scroll: {

                            },
                            ajaxload: {     // AJAX ЗАГРУЗКА
                                tagName: '*',
                                events: {
                                    init: 'ajaxloadinit',
                                    start: 'ajaxloadstart',
                                    visible: 'ajaxloadvisible',
                                    hidden: 'ajaxloadhidden',
                                    search: 'ajaxloadsearch',
                                },
                                data: {
                                    dataAttr: 'data-ajaxload',
                                    dataSrc: 'data-src'
                                },
                                options: {
                                    src: 'error src'
                                }
                            }
                        }
                    }
                };
    
                plugin.options = this.extend(defaults, this.options);
    
                this.receive('modalinit', window, function(e) {
                    plugin.send('modalcreate', e.target);
                });
    
                this.receive('ajaxloadinit', window, function(e) {
                    plugin.options.controller.blocks.ajaxload.options = plugin.extend(plugin.options.controller.blocks.ajaxload.options,
                        plugin.getoptionsajax(e.target));
                    plugin.send('ajaxloadstart', e.target);
                });
    
                this.receive('navinit', window, function(e) {
                    plugin.send('navcreate', e.target);
                });
    
                window.addEventListener('DOMContentLoaded', function() {
                    plugin.options = plugin.extend(defaults, plugin.options);
                    plugin.send('modalsearch', window);
                    plugin.send('ajaxloadsearch', window);
                });
    
                //window.onload = function() {
                    //plugin.options = plugin.extend(defaults, plugin.options);
                    //plugin.send('modalsearch', window);
                    //plugin.send('ajaxloadsearch', window);
                //}
            }

            get getUpdateOptionsModal() {
                return updateoptionsmodal();
            }
    
    
            getOptionsModal(element) {
                let plugin = this.options.controller.blocks.modal.modifier;

                if(element.hasAttribute('data-modal'))
                    element = element;
                else element = element.parentNode;
                
                let defaults = {
                    src: element.hasAttribute('data-src') ?
                        element.getAttribute('data-src') : "error src",

                    modal: element.hasAttribute('data-modal-modifier') ?
                            plugin.modal + ' ' + element.getAttribute('data-modal-modifier') :
                            plugin.modal,

                    close: element.hasAttribute('data-close-modifier') ?
                            plugin.close + ' ' + element.getAttribute('data-close-modifier'):
                            plugin.close, 
                   
                    overlay: element.hasAttribute('data-overlay-modifier') ?
                            plugin.overlay + ' ' + element.getAttribute('data-overlay-modifier'):
                            plugin.overlay,
                    content: element.hasAttribute('data-content-modifier') ?
                            plugin.content + ' ' + element.getAttribute('data-content-modifier') :
                            plugin.content,
                };
                return defaults;
            }

            updateoptionsmodal(element) {
                this.options.controller.blocks.modal.options = this.extend(this.options.controller.blocks.modal.options,
                    this.getOptionsModal(element));
            }
    
            getoptionsajax(e) {
                var defaults = {
                    src: e.hasAttribute('data-src') ?
                        e.getAttribute('data-src') : 'error src',
                };
                return defaults;
            }
        }
    
        SF.ControllerDom.SearchDom = class SearchDom extends SF.ControllerDom {
    
            constructor(options) {
                super(options, options);
    
                var plugin = this;
				plugin.settings = {};
				
					//console.log('Загрузка окна браузера прошла успешно.');
					// Режим ожидания начала поиска модального окна
					this.receive('modalsearch', window, function(e) {
						plugin.settings = plugin.options.controller.search.modal;
						plugin.searchStart();
					});
		
					// Режим ожидания начала поиска Ajax загрузки
					this.receive('ajaxloadsearch', window, function(e) {
						//console.log('Начат поиск AjaxLoad');
						plugin.settings = plugin.options.controller.search.ajaxload;
						plugin.searchStart();
					});
		
					// Режим ожидания начала поиска навигационного меню. Режим ожидания приказа
					this.receive('navsearch', window, function(e) {
						plugin.settings = plugin.options.controller.search.navigation;
						plugin.searchStart();
					});
            }
    
            get getSearchStart() {
                return searchStart();
            }
    
            /**
             * Метод searchStart() - осуществляет поиск проинициализированных объектов
             */
            searchStart() {
                let allElem = document.body.querySelectorAll(this.settings.tag);
                for(let j = 0; j < allElem.length; j++)
                    if(allElem[j].hasAttribute(this.settings.data))
						this.send(this.settings.init, allElem[j]);
            }
        }

        SF.ControllerDom.ProviderDom = class ProviderDom extends SF.ControllerDom.SearchDom {
            constructor(options) {
                super(options, options);
            }

            get getModal() {
                return modal();
            }
            
            /**
             * Метод modal() - создает модальное окно
             * @param {*} content - содержимое моального окна
             */
            modal(objectEvent) {
                var overlay = {
                    load: {},
                    area: {
                        content: {},
                        close: {},
                    },
                },
                plugin = this.options.controller.blocks.modal,
                _this = this,
                page = document.body.querySelector('.sf-pagewrap-area');

                overlay = document.createElement('div');
                overlay.load = document.createElement('div');
                overlay.load.innerHTML = '<div class="sf-progress"><div class="sf-progress-animation"></div></div>';
                overlay.area = document.createElement('div');
                overlay.area.content = document.createElement('div');
                overlay.area.close = document.createElement('button');
                overlay.load.setAttribute(plugin.attributes.load, '');
                overlay.load.className = plugin.modifier.load;
                overlay.load.style.position = 'fixed';
                overlay.load.style.top = '0';
                overlay.load.style.left = '0';
                overlay.load.style.width = '100%';
                overlay.setAttribute(plugin.attributes.overlay, '');
                overlay.addEventListener('click', function(e) {
                    if(e.target.hasAttribute(plugin.attributes.overlay)) {
                        overlay.remove();
                        document.body.style.overflow = 'auto';
                        if(objectEvent.hasAttribute(plugin.data.dataBlur))
                            if(page !== null && page !== undefined)
                                page.classList.remove('blur');
                    }
                });
                overlay.classList = plugin.options.overlay;
                overlay.setAttribute(plugin.data.dataSrc, plugin.options.src);
                overlay.style.zIndex = this.topzindex() + 1;
                overlay.area.setAttribute(plugin.attributes.modal, '')
                overlay.area.className = plugin.options.modal;
                overlay.area.content.setAttribute(plugin.attributes.content, '')
                overlay.area.content.className = plugin.options.content;
                overlay.area.style.opacity = '0';
                // ДОБАВИТЬ КОНТЕНТ
                //overlay.area.content.innerHTML = content;
                overlay.area.appendChild(overlay.area.content);
                // КНОПКА ЗАКРЫТЬ
                overlay.area.close.addEventListener('click', function() {
                    overlay.remove();
                    document.body.style.overflowY = 'auto';
                    if(objectEvent.hasAttribute(plugin.data.dataBlur)) {
                        if(page !== null && page !== undefined)
                            page.classList.remove('blur');
                    }
                });
                overlay.area.close.setAttribute(plugin.attributes.close, '');
                overlay.area.close.className = plugin.options.close;
                overlay.area.appendChild(overlay.area.close);
                overlay.appendChild(overlay.load);
                overlay.appendChild(overlay.area);
                // 
                this.receive('modalopen', objectEvent || window, function(e) {
                    overlay.style.display = 'flex';
                    document.body.style.overflow = 'hidden';

                    if(objectEvent.hasAttribute(plugin.data.dataBlur)) {
                        if(page !== null && page !== undefined)
                            page.classList.add('blur');
                    }
                });
                //
                this.receive('modalclose', objectEvent || window, function(e) {
                    overlay.remove();
                    document.body.style.overflow = 'hidden';
                    if(objectEvent.hasAttribute(plugin.data.dataBlur)) {
                        if(page !== null && page !== undefined)
                            page.classList.remove('blur');
                    }
                });

                if(objectEvent.hasAttribute(plugin.data.dataBlur)) {
                    if(page !== null && page !== undefined)
                        page.classList.add('blur');
                }

                this.send('modalopen', objectEvent);
                return overlay;
            }


            iframe(target) {
                var overlay = {
                    load: {},
                    area: {
                        content: {},
                        close: {},
                    },
                },
                plugin = this.options.controller.blocks.modal,
                _this = this,
                page = document.body.querySelector('.sf-pagewrap-area');


                overlay = document.createElement('div');
                overlay.load = document.createElement('div');
                overlay.load.innerHTML = '<div class="sf-progress"><div class="sf-progress-animation"></div></div>';
                overlay.area = document.createElement('div');
                overlay.area.content = document.createElement('iframe');
                overlay.area.close = document.createElement('button');
                overlay.load.setAttribute(plugin.attributes.load, '');
                overlay.load.className = plugin.modifier.load;
                overlay.load.style.position = 'fixed';
                overlay.load.style.top = '0';
                overlay.load.style.left = '0';
                overlay.load.style.width = '100%';
                overlay.setAttribute(plugin.attributes.overlay, '');
                overlay.addEventListener('click', function(e) {
                    if(e.target.hasAttribute(plugin.attributes.overlay)) {
                        overlay.remove();
                        document.body.style.overflow = 'auto';
                        if(target.hasAttribute(plugin.data.dataBlur))
                            if(page !== null && page !== undefined)
                                page.classList.remove('blur');
                    }
                });
                overlay.classList = plugin.options.overlay;
                overlay.setAttribute(plugin.data.dataSrc, plugin.options.src);
                overlay.style.zIndex = this.topzindex() + 1;
                overlay.area.setAttribute(plugin.attributes.modal, '')
                overlay.area.className = plugin.options.modal;
                overlay.area.content.setAttribute(plugin.attributes.content, '')
                overlay.area.content.className = plugin.options.content;
                overlay.area.style.opacity = '0';
                // ДОБАВИТЬ КОНТЕНТ
                //overlay.area.content.innerHTML = content;
                overlay.area.appendChild(overlay.area.content);
                // КНОПКА ЗАКРЫТЬ
                overlay.area.close.addEventListener('click', function() {
                    overlay.remove();
                    document.body.style.overflowY = 'auto';
                    if(target.hasAttribute(plugin.data.dataBlur)) {
                        if(page !== null && page !== undefined)
                            page.classList.remove('blur');
                    }
                });
                overlay.area.close.setAttribute(plugin.attributes.close, '');
                overlay.area.close.className = plugin.options.close;
                overlay.area.appendChild(overlay.area.close);
                overlay.appendChild(overlay.load);
                overlay.appendChild(overlay.area);
                // 
                this.receive('modalopen', target || window, function(e) {
                    overlay.style.opacity = '1';
                    document.body.style.overflow = 'hidden';
                    overlay.style.display = 'flex';

                    if(target.hasAttribute(plugin.data.dataBlur)) {
                        if(page !== null && page !== undefined)
                            page.classList.add('blur');
                    }
                });
                //
                this.receive('modalclose', target || window, function(e) {
                    overlay.remove();
                    document.body.style.overflow = 'hidden';
                    if(target.hasAttribute(plugin.data.dataBlur)) {
                        if(page !== null && page !== undefined)
                            page.classList.remove('blur');
                    }
                });

                if(target.hasAttribute(plugin.data.dataBlur)) {
                    if(page !== null && page !== undefined)
                        page.classList.add('blur');
                }

                this.send('modalopen', target);
                return overlay;
            }
        }
    
        SF.ControllerDom.Blocks = class Blocks extends SF.ControllerDom.ProviderDom {
            constructor(options) {
                super(options, options);
    
                var plugin = this;
        
                this.receive('modalcreate', window, function(e) {
                    plugin.send('modalcreatestart', e.target);
                });
    
                this.receive('ajaxloadstart', window, function(e) {
                    plugin.send('ajaxloadcontent', e.target);
                });
            }
        }
    
        SF.ControllerDom.Blocks.Modal = class Modal extends SF.ControllerDom.Blocks {
    
            constructor(options) {
                super(options, options);
                
				var plugin = this;
				
                this.receive('modalcreatestart', window, function(e) {
					e.target.onclick = function(e) {
						e.preventDefault();
                        plugin.opencreate(e);
					}
                });

                window.addEventListener('click', function(e) {
					var click = e.target.onclick;
                    if(click === null) {
                        if(e.target.hasAttribute('data-modal')) {
                            e.preventDefault();
							plugin.opencreate(e);
                        }
                    }             
                });

                this.escmodalclose();   // Закрытие окна по нажатию Esc

            }
    
            get getOpen() {
                return open();
            }
    
            get getCreateModal() {
                return createModal();
            }
    
            get getClose() {
                return close();
            }
    
            get getSearchModalOpen() {
                return searchModalOpen();
            }
    
            get getCreateOverlay() {
                return createoverlay();
            }
            /**
             * Метод searchmodalopen() - возвращает последнее открытое модальное окно
             * используется в методе escmodalclose()
             */
            searchmodalopen() {
                var modal = [],
                    plugin = this.options.controller.blocks.modal,
                    container = document.body.querySelector('.sf-modal-container'),                    
                    zindex = 0,
                    closemodal = false,
                    elements = container.querySelectorAll('div'),
                    page = document.body.querySelector('.sf-pagewrap-area');

                for(let i = 0; i < elements.length; i++)
                    if(elements[i].hasAttribute('modal-overlay'))
                        modal.push(elements[i]);
                if(modal.length != 0) {
                    for(var i = 0; i < modal.length; i++) {
                        if(modal[i].hasAttribute(plugin.data.dataSrc)) {
                            if(getComputedStyle(modal[i]).display !== 'none') {
                                if(getComputedStyle(modal[i]).zIndex > zindex)
                                    closemodal = modal[i];
                                if(modal.length === 1) {
                                    document.body.style.overflow = 'auto';  
                                            page.classList.remove('blur');
                                }                              
                            }
                        }
                    }
                }
                return closemodal;
            }
            
            /**
             * Метод escmodalclose() - закрывает последнее открытое модальное окно
             */
            escmodalclose() {
                var _this = this;
                this.quickkey(function(e) {
                    var modal = _this.searchmodalopen();
                    if(modal)
                        modal.remove();
                }, '27');
            }

    
            /**
             * Метод create() - создаёт новое модальное окно
             */
            create(e) {
                this.updateoptionsmodal(e.target);  // Обновление настроек модального окна

                var plugin = this.options.controller.blocks.modal,
                    service = document.body.querySelector('.sf-service-bottom-area'),
                    container = service.querySelector('.sf-modal-container'),
                    _this = this;

                if(container == null) {
                    container = document.createElement('section');
                    container.setAttribute('modal-container', '');
                    container.className = plugin.modifier.container;//'sf-modal-container';
                }

                var modal;

                if(e.target.tagName == "I") {
                    if(e.target.parentNode.hasAttribute(plugin.data.dataIFrame))
                        modal = this.iframe(e.target.parentNode);
                    else modal = this.modal(e.target.parentNode);
                } else {
                    if(e.target.hasAttribute(plugin.data.dataIFrame))
                        modal = this.iframe(e.target);
                    else modal = this.modal(e.target);
                }
                

                container.appendChild(modal);
                service.appendChild(container);

                this.receive('modalopendomend', e.target, function(e) {
                    
                        setTimeout(function() {
                            jsAjaxUtil.LoadData(plugin.options.src, function(data) { 
						   
						   if(e.target.tagName == "I") {	// ==========
							
                                if(e.target.parentNode.hasAttribute(plugin.data.dataIFrame)) {

                                    modal.area.content.contentWindow.document.body.innerHTML = data;//e.target.content;
                                    modal.load.style.display = 'none';
                                    modal.area.style.opacity = '1';
								} 
								else {
                                    modal.area.content.innerHTML = data;//e.target.content;
                                    modal.load.style.display = 'none';
                                    modal.area.style.opacity = '1';
								}
								
						   } else {		// ==================
							
                                if(e.target.hasAttribute(plugin.data.dataIFrame)) {
                                    modal.area.content.contentWindow.document.body.innerHTML = data;//e.target.content;
                                    modal.load.style.display = 'none';
                                    modal.area.style.opacity = '1';
                                } else {
                                    modal.area.content.innerHTML = data;//e.target.content;
                                    modal.load.style.display = 'none';
                                    modal.area.style.opacity = '1';
								}
								
							}
							
                        }, 1000);
                    });
                });
            }
    
            /**
             * Метод searchModalOpen() - осуществляет поиск открытых ранее модальных окон
             */
            searchModalOpen() {
                let o = this.options.controller.blocks.modal.options;
                let modal = document.body.getElementsByClassName(o.class);
                if(modal.length > 0)
                    for(var i = 0; i < modal.length; i++)
                        if(modal[i].getAttribute('data-src') === o.src)
                            return modal[i];
                return false;
            }
    
            opencreate(e) {
                let element = this.searchModalOpen();
                if(typeof element === 'object') {
                    this.send('modalopen', element);
                    this.send('modalopendomend', e.target);
                }
                else {
                    element = this.create(e);
                    this.send('modalopendomend', e.target);                    
                }
                return element;
            }
        };


        SF.ControllerDom.Blocks.ScrollBar = class ScrollBar extends SF.ControllerDom.Blocks.Modal {
            constructor(options) {
                super(options, options);
                this.options = options;
            }
        }
    
        SF.ControllerDom.Blocks.AjaxLoad = class AjaxLoad extends SF.ControllerDom.Blocks.ScrollBar {
            constructor(options) {
                super(options, options);
				var _this = this,
					listObjTrack = [];
				// ==================
                this.receive('ajaxloadcontent', window, function(e) {
                    var interval = setInterval(_this.checklayer, 1000, e, _this);
                    _this.receive('ajaxloadcanceltrack', e.target, function(e) {
                        clearInterval(interval);
                    });
				});
				
            }
    
            get getCheckLayer() {
                return checklayer();
            }
    
            /**
             * checklayer() - функция отслеживания состояния (видимый/невидимый) слоя
             */
            checklayer(e, _this) {
                var comp = getComputedStyle(e.target),
                    elem = e.target;
                
                if((elem.getAttribute('data-ajaxload') !== 'loaded') && (comp.display !== 'none')) {
					elem.setAttribute('data-ajaxload', 'loaded');
					jsAjaxUtil.LoadData(elem.getAttribute('data-src'), function(data) {
						elem.innerHTML = data;					
					});
                } else elem.setAttribute('data-ajaxload', '');
                
                if(elem.hasAttribute('data-canceltrack') && elem.getAttribute('data-ajaxload') === 'loaded')
                    _this.send('ajaxloadcanceltrack', elem);
            }
        }
    
        SF.ControllerDom.Blocks.NavigationDom = class NavigationDom extends SF.ControllerDom.Blocks.AjaxLoad {
            constructor(options) {
                super(options, options);
                this.options = options;
            }
        }
    
        SF.Call = class Call extends SF.ControllerDom.Blocks.NavigationDom {
            constructor(options) {
                super(options, options);
                this.options = options;
            }
        }
    
        new SF.Call();
    
    
    }) (window, document);