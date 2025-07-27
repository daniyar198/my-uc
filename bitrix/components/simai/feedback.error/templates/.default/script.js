		/*
		*	1 - Функция которая будет выполнена
		*	2 - код клавиши которая должна сработать
		*	3 - вторая клавиша в сочетании с первой
		*	4 - третья клавиша в сочетании с первой и второй
		*	
		*	Функция для обработки любого сочетания клавиш.
		*	Количество клавиш при нажатии которых будет выполнена функция
		*	неограничено.
		*/
		function bodyEvent(func)
		{
			var codes = [].slice.call(arguments, 1);
			var pressed = {};
			
			document.onkeydown = function(e) {
			  e = e || window.event;

			  pressed[e.keyCode] = true;

			  for (var i = 0; i < codes.length; i++) { // проверить, все ли клавиши нажаты
				if (!pressed[codes[i]]) {
				  return;
				}
			  }

			  pressed = {};

			  func();

			};

			document.onkeyup = function(e)
			{
			  e = e || window.event;

			  delete pressed[e.keyCode];
			};
		}
		
		
		function closeModalWindow()
		{
			var modalWin = document.getElementById("modal-window-home-id");
			modalWin.style.display = "none";
			//modalWin.parentNode.removeChild(modalWin);
		}
		
		
		function modalWindow()
		{
			var modalW = document.getElementsByClassName("modal-window-home").length;
			if(modalW <= 1)
			{	
				var formElem = document.getElementById('elem-form');
				var elemStr = '<textarea class="form-sm-element message-text-submit" id="text-form" name="error_desc"' +
					'placeholder="Пожалуйста, опишите ошибку"></textarea>' +
							'<input type="hidden" name="error_message" value="' + copySelectionText() + '">' +
							'<input type="hidden" name="error_url" value="' + window.location + '">' +
							'<input type="hidden" name="error_referer" value="' + document.referrer + '">' +
							'<input type="hidden" name="error_useragent" value="' + navigator.userAgent + '">';
				formElem.innerHTML = elemStr;

				var modalFormMess = document.getElementById('mess');
				var hideFormText = document.getElementById('error_message');
				var submitButton = document.getElementById('send');
				var textForm = document.getElementById('text-form');
				console.log(String(textForm));

				var hideText = copySelectionText();
				if(hideText != '') {
					var str = '';
					if(String(hideText).length >= 120)
						str = '...';
					modalFormMess.innerHTML = String(hideText).substring(0,120) + str;
					submitButton.style.display = 'block';
					textForm.style.display = 'block';
					modalFormMess.style.color = 'rgba(0,0,0,.54)';
				}
				else {
					modalFormMess.innerHTML = 'Текст с ошибкой не выделен. Пожалуйста выделите текст с ошибкой и нажмите Ctrl+Enter';
					textForm.style.display = 'none';				
					submitButton.style.display = 'none';
					modalFormMess.style.color = 'rgba(255,0,0,.87)';				
				}
				var modWindow = document.getElementById("modal-window-home-id");
				modWindow.style.display = "flex";
			}
		}
		
		
		bodyEvent(modalWindow,"17","13");
		
		/*
		*	ФУНКЦИЯ modalWindowEsc ЗАКРЫВАЮЩАЯ МОДАЛЬНОЕ ОКНО
		*	ПРИ НАЖАТИИ НА КЛАВИШУ ESC
		*
		*/
		
		function modalWindowEsc(e)
		{
			if(e.keyCode == 27)
				closeModalWindow();
		}	
		
		addEventListener("keydown", modalWindowEsc);



		function handlerEvents(e) {
			var flagObjHandler = e.target.hasAttribute('params');
			if(flagObjHandler) {
				var objHandler = e.target.getAttribute('params');
				switch(objHandler) {
					case 'close':
						closeModalWindow();
						break;
				}
			}
		}




		window.onload = function() {
			document.body.addEventListener('click',handlerEvents);
		}

		function copySelectionText()
		{
			if(window.getSelection)
				strText = window.getSelection();
			else if(document.getSelection)
				strText = document.getSelection();
			else if(document.selection)
				strText = document.CDATA_SECTION_NODE.createRange().text;
			else return;

			return strText;
		}

		function text() {
			
		}
