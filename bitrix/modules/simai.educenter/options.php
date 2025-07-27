<?$module="simai.educenter";?>
<?require $_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/'.$module.'/classes/general/main.php';?>
<?require $_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/'.$module.'/include/settings.php';?>

<link href="/bitrix/js/simai/css/switcher.css" type="text/css" data-template-style="true" rel="stylesheet">
<link href="/bitrix/templates/<?=$module?>/framework/include/04_template/bg.css" type="text/css" data-template-style="true" rel="stylesheet">
<link href="/bitrix/js/simai/css/farbtastic.css" type="text/css" data-template-style="true" rel="stylesheet">
<link href="/bitrix/js/simai/css/app.min.2.css" type="text/css" data-template-style="true" rel="stylesheet">
<script type="text/javascript" src="/bitrix/js/simai/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/bitrix/js/simai/js/farbtastic.min.js"></script>
<script type="text/javascript" src="/bitrix/js/simai/js/run.js"></script>
<script src="https://api-maps.yandex.ru/1.1/index.xml" type="text/javascript"></script>
<script src="//api-maps.yandex.ru/2.0/?lang=ru-RU&load=package.full" type="text/javascript"></script>
<script type="text/javascript">
var settings=<?echo json_encode($settings["colors"]);?>;
  var background="<?=COption::GetOptionString($module, "background", "");?>";
  if(background=="")background="body-bg-11";
  
  var header="<?=COption::GetOptionString($module, "header", "");?>";
  if(header=="")header="header-bg-11";
  
  var footer="<?=COption::GetOptionString($module, "footer", "");?>";
  if(footer=="")footer="footer-bg-11";
  
 $(function () {
  
 $("."+background).addClass("active");
 $("."+header).addClass("active");
 $("."+footer).addClass("active");
 
 });

 
 function Default()
 {
 }
 
		 $(function () {
			 $(".ttip").click(function(){
			$(".ttip").removeClass("active");
			$(this).addClass("active");
			background=$(this).attr('data-body');
			return false;
		});

		$(".colorsheme").click(function(){
			$(".colorsheme").removeClass("active");
			$("#typepicker").val($(this).text());
		
			$(this).addClass("active");
			return false;
		});
		
		$(".altsheme").click(function(){
			$(".altsheme").removeClass("active");
			$("#pastepicker").val($(this).text());
			$(this).addClass("active");
			return false;
		});
		
		$('span a.ttip').click(function(){
			$("#background").val($(this).data("body"));
			return false;
		});
		
		

			 $(".ttipheader").click(function(){
			$(".ttipheader").removeClass("active");
			$(this).addClass("active");
			return false;
		});

		
		$('span a.ttipheader').click(function(){
			$("#header").val($(this).data("header"));
			return false;
		});
		
		
		
	
			 $(".ttipfooter").click(function(){
			$(".ttipfooter").removeClass("active");
			$(this).addClass("active");
			return false;
		});

		
		$('span a.ttipfooter').click(function(){
			$("#footer").val($(this).data("footer"));
			return false;
		});
		
		

 $("input[name='backgroundMode']").click(function(){
	   if($('input:radio[name=backgroundMode]:checked').val() == "Y") {
		   
		   $(".set_back").hide();
		   $(".defined_back").show();
		   
	   }else{
		   $(".defined_back").hide();
		   $(".set_back").show();
	   }		   
	   
   });
   
    $("input[name='headerMode']").click(function(){
	   if($('input:radio[name=headerMode]:checked').val() == "Y") {
		   
		   $(".set_head").hide();
		   $(".defined_head").show();
		   
	   }else if($('input:radio[name=headerMode]:checked').val() == "N"){
		   $(".defined_head").hide();
		   $(".set_head").show();
	   }else{
		    $(".defined_head").hide();
		   $(".set_head").hide();
	   }		   
	   
   });
   
   $("input[name='footerMode']").click(function(){
	   if($('input:radio[name=footerMode]:checked').val() == "Y") {
		   
		   $(".set_footer").hide();
		   $(".defined_footer").show();
		   
	   }else{
		   $(".defined_footer").hide();
		   $(".set_footer").show();
	   }		   
	   
   });
   
   
   $("input[name='colorMode']").click(function(){
	   if($('input:radio[name=colorMode]:checked').val() == "Y") {
		   
		   $(".colorhand").hide();
		   $(".colorauto").show();
		   
	   }else{
		   $(".colorauto").hide();
		   $(".colorhand").show();
	   }		   
	   
   });
	 
 });
 
 
</script>

<?
if(!$USER->IsAdmin())
	return;

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/options.php");
IncludeModuleLangFile(__FILE__);

/*
if (CModule::IncludeModule('highloadblock')) {
   $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(3)->fetch();
   $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
   $strEntityDataClass = $obEntity->getDataClass();
}
if (CModule::IncludeModule('highloadblock')) {
   $rsData = $strEntityDataClass::getList(array(
      'select' => array("ID","UF_CODE","UF_NAME","UF_ISO"),
      'order' => array('ID' => 'ASC'),
      'limit' => '50',
   ));
   while ($arItem = $rsData->Fetch()) {
      $currency[$arItem["UF_CODE"]] = $arItem["UF_NAME"];
   }
}*/

$aTabs = array(
	array(
	"DIV" => "edit1", 
	"TAB" => GetMessage("MAIN_TAB_SET"),
	"ICON" => "ib_settings", 
	"TITLE" => GetMessage("MAIN_TAB_TITLE_SET"),
	"OPTIONS" => Array(
         array("boxed",GetMessage("WIDTH"),true,array("selectbox",array(true => GetMessage("BOXED"),false => GetMessage("UNBOXED"),),),),
	     array("left_column",GetMessage("LEFT_COLUMN"),4,array("selectbox",array(1 => "1",2 => "2",3 => "3",4 => "4",5 => "5",6 => "6",),),),
       	 array("right_column",GetMessage("RIGHT_COLUMN"),4,array("selectbox",array(1 => "1",2 => "2",3 => "3",4 => "4",5 => "5",6 => "6",),),),
		 array("main_style",GetMessage("THEME"),"red",array("color_box",array("red" => GetMessage("RED"),"violet" => GetMessage("VIOLET"),"blue" => GetMessage("BLUE"),"green" => GetMessage("GREEN"),"yellow" => GetMessage("YELLOW"),"orange" => GetMessage("ORANGE"),),),),
         array("typepicker", GetMessage("USER_STYLE"), "#fba40d", array("typepicker", 20)),
		 array("pastepicker", GetMessage("USER_ALTSTYLE"), "#2c2c2c", array("typepicker", 20)),
		 array("backgroundMode", GetMessage("SET_BACK_OPTIONS"), "N", array("radio", "Y")),
	     array("background",GetMessage("BACKGROUND"),"",array("patterns",array(),),),
		 array("backcolorpicker", GetMessage("BACK_COLOR"), "#2c2c2c", array("typepicker", 20)),
	     array("path",GetMessage("PATH_IMAGE"),"",array("pathimage",20),),
         array("layout",GetMessage("TYPE_PLACE"),"repeat",array("selectbox",array("repeat" => GetMessage("CONTENT"),"no-repeat" => GetMessage("COVER"),),),),
	     array("colorMode", GetMessage("SET_BACK_OPTIONS"), "N", array("radio", "Y")),
		 
		 array("headerMode", GetMessage("SET_BACK_OPTIONS"), "N", array("radio", "Y")),
	     array("header",GetMessage("BACKGROUND"),"",array("patterns",array(),),),
		 array("headercolorpicker", GetMessage("BACK_COLOR"), "#2c2c2c", array("typepicker", 20)),
	     array("headerpath",GetMessage("PATH_IMAGE"),"",array("pathimage",20),),
         array("headerlayout",GetMessage("TYPE_PLACE"),"repeat",array("selectbox",array("repeat" => GetMessage("CONTENT"),"no-repeat" => GetMessage("COVER"),),),),
	     
		 array("footerMode", GetMessage("SET_BACK_OPTIONS"), "N", array("radio", "Y")),
	     array("footer",GetMessage("BACKGROUND"),"",array("patterns",array(),),),
		 array("footercolorpicker", GetMessage("BACK_COLOR"), "#2c2c2c", array("typepicker", 20)),
	     array("footerpath",GetMessage("PATH_IMAGE"),"",array("pathimage",20),),
         array("footerlayout",GetMessage("TYPE_PLACE"),"repeat",array("selectbox",array("repeat" => GetMessage("CONTENT"),"no-repeat" => GetMessage("COVER"),),),),
	    
	)),
	array(
	"DIV" => "edit2", 
	"TAB" => GetMessage("PROPERTY_SITE"),
	"ICON" => "ib_settings", 
	"TITLE" => "",
	"OPTIONS" => Array(
	       array("organization",GetMessage("ORGANIZATION"),"",array("text",80),),
		   array("copyright",GetMessage("COPYRIGHT"),"",array("text",40),),
		   array("address",GetMessage("ADDRESS"),"",array("text",40),),
		   array("phone",GetMessage("TELEPHONE"),"",array("text",40),),
		   array("email",GetMessage("EMAIL"),"",array("text",40),),
		   array("logo",GetMessage("LOGO"),"",array("pathimage",20),),
	       array("lat","","",array("hidden",40),),
	       array("lng","","",array("hidden",40),),
		   array("map",GetMessage("MAP"),"",array("text",40),),
		   array("use_settings", GetMessage("USE_REKVIZITES"), "N", array("checkbox", "Y")),
	)),
	
	array(
	"DIV" => "edit3", 
	"TAB" => GetMessage("SOCIAL_NETS"),
	"ICON" => "ib_settings", 
	"TITLE" => "",
	"OPTIONS" => Array(
	       array("vk_address",GetMessage("VK_ADDRESS"),"",array("text",40),),
		   array("vk_id",GetMessage("VK_ID"),"",array("text",40),),
	       array("fb_address",GetMessage("FB_ADDRESS"),"",array("text",40),),
	       array("ok_address",GetMessage("OK_ADDRESS"),"",array("text",40),),
		   array("ok_id",GetMessage("OK_ID"),"",array("text",40),),
		   array("tw_address",GetMessage("TW_ADDRESS"),"",array("text",40),),
		   array("ins_address",GetMessage("INS_ADDRESS"),"",array("text",40),),
		   array("vk_widget", GetMessage("VK"), "N", array("checkbox", "Y")),
		   array("fb_widget", GetMessage("FB"), "N", array("checkbox", "Y")),
		   array("ok_widget", GetMessage("OK"), "N", array("checkbox", "Y")),
		   array("tw_widget", GetMessage("TW"), "N", array("checkbox", "Y")),

	)),
	
	
   array(
	"DIV" => "edit4", 
	"TAB" => GetMessage("SCRIPTS"),
	"ICON" => "ib_settings", 
	"TITLE" => GetMessage("PROPERTY_ADDSCRIPT"),
	"OPTIONS" => Array(
	     array("top",GetMessage("TOP_SCRIPT"),"",array("textarea",20,60),),
	     array("bottom",GetMessage("BOTTOM_SCRIPT"),"",array("textarea",20,60),),
	)),
	
   array(
	"DIV" => "edit5", 
	"TAB" => GetMessage("FORMS"),
	"ICON" => "ib_settings", 
	"TITLE" => GetMessage("PROPERTY_FORMS"),
	"OPTIONS" => Array(
	     array("use_google_captcha", GetMessage("USE_GOOGLE_CAPTCHA"), "N", array("checkbox", "Y")),
	     array("public_key",GetMessage("PUBLIC_KEY"),"",array("text",40),),
		 array("private_key",GetMessage("PRIVATE_KEY"),"",array("text",40),),
	)),
	
   array(
	"DIV" => "edit6", 
	"TAB" => GetMessage("PROPERTY_PAID"),
	"ICON" => "ib_settings", 
	"TITLE" => "",
	"OPTIONS" => Array(
	       array("recipient",GetMessage("RECIPIENT"),"",array("text",80),),
		   array("bank",GetMessage("BANK"),"",array("text",80),),
	       array("bik",GetMessage("BIK"),"",array("text",80),),
		   array("ks",GetMessage("KS"),"",array("text",80),),
		   array("inn",GetMessage("INN"),"",array("text",80),),
		   array("kpp",GetMessage("KPP"),"",array("text",80),),
		   array("bill",GetMessage("BILL"),"",array("text",80),),
		   array("provider_post",GetMessage("PROVIDER_POST"),"",array("text",80),),
		   array("provider_sign",GetMessage("PROVIDER_SIGN"),"",array("pathimage",20),),
		   array("provider_sign_trans",GetMessage("PROVIDER_SIGN_TRANSCRIPT"),"",array("text",80),),
		   array("booker_sign",GetMessage("BOOKER_SIGN"),"",array("pathimage",20),),
		   array("booker_sign_trans",GetMessage("BOOKER_SIGN_TRANSCRIPT"),"",array("text",80),), 
		   array("stamp",GetMessage("STAMP"),"",array("pathimage",20),), 
		   array("mode_sber", GetMessage("SBER_MODE"), "Y", array("checkbox", "Y")),
		   array("merchant_sber",GetMessage("MERCHANT_SBER"),"",array("text",80),),
		   array("pass_sber",GetMessage("SBER_PASS"),"",array("text",80),),
		   array("order_status",GetMessage("RESULT_ORDER_STATUS"),true,array("selectbox",array("paid" => GetMessage("PAID"),"not_paid" => GetMessage("NOT_PAID"),),),),
		  // array("currency",GetMessage("CC_HEAD_CURRENCY"),"","selectbox",$currency),
	)),
   
		 

);


$arAllOptions = array();


if(CModule::IncludeModule("iblock"))
{
	$res = CIBlock::GetList(Array(),Array('ACTIVE'=>'Y',"CODE"=>'branches'), true);
	$iblock = $res->Fetch();
	$LINK='/bitrix/admin/iblock_list_admin.php?IBLOCK_ID='.$iblock['ID'].'&type='.$iblock['IBLOCK_TYPE_ID'];
	

}

$tabControl = new CAdminTabControl("tabControl", $aTabs);

if($REQUEST_METHOD=="POST" && strlen($Update.$Apply.$RestoreDefaults)>0 && check_bitrix_sessid())
{
    SIMAIMain::editStyle($_POST["typepicker"],$_POST["pastepicker"]);
	
	if(strlen($RestoreDefaults)>0)
	{
		COption::RemoveOption($module);
	}
	else
	{
		foreach($aTabs as $i => $aTab)
			{
				foreach($aTab["OPTIONS"] as $name => $arOption)
				{
					$name=$arOption[0];
					$val=$_REQUEST[$name];
					if($arOption[2][0]=="checkbox" && $val!="Y")
						$val="N";
					COption::SetOptionString($module, $name, $val, $arOption[1]);
					if($name=="organization")
					{
						$countString=strlen($val);
						if($countString<22)$font="32px";
						else if($countString<65)$font="26px";
						else if($countString<115)$font="16px";
						else $font="14px";
						COption::SetOptionString($module, "font-size", $font, "32px");
					}
				}
		}
		if($_REQUEST["use_settings"]=="Y")
		{
			COption::SetOptionString("main", "site_name", $_REQUEST["organization"], "");
			COption::SetOptionString("main", "server_name", $_SERVER["SERVER_NAME"], "");
			COption::SetOptionString("main", "email_from", $_REQUEST["email"], "");
			COption::SetOptionString("main", "all_bcc", $_REQUEST["email"], "");
			$rsSites = CSite::GetList($by="sort", $order="desc", Array("DEFAULT"=>"Y"));
			if ($arSite = $rsSites->Fetch())
			{
			$arFields = Array(
			  "ACTIVE"           => $arSite["ACTIVE"],
			  "SORT"             => $arSite["SORT"],
			  "DEF"              => $arSite["DEF"],
			  "NAME"             => $_REQUEST["organization"],
			  "DIR"              => $arSite["DIR"],
			  "FORMAT_DATE"      => $arSite["FORMAT_DATE"],
			  "FORMAT_DATETIME"  => $arSite["FORMAT_DATETIME"],
			  "CHARSET"          => $arSite["CHARSET"],
			  "SITE_NAME"        => $arSite["SITE_NAME"],
			  "SERVER_NAME"      => $_SERVER["SERVER_NAME"],
			  "EMAIL"            => $_REQUEST["email"],
			  "LANGUAGE_ID"      => $arSite["LANGUAGE_ID"],
			  "DOC_ROOT"         => $arSite["DOC_ROOT"],
			  "DOMAINS"          => $_SERVER["SERVER_NAME"]
			  );
			$obSite = new CSite;
			$obSite->Update($arSite["ID"], $arFields);
			}

		}
	}
	if(strlen($Update)>0 && strlen($_REQUEST["back_url_settings"])>0)
		LocalRedirect($_REQUEST["back_url_settings"]);
	else
		LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($mid)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());
}

$tabControl->Begin();
?>
<form method="post" name="form1" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?echo LANGUAGE_ID?>">
<?$tabControl->BeginNextTab();?>
	 <?if(isset($GLOBALS["DEMODAYS"])):?> <tr class="heading"><td colspan="2"><?=getMessage("DEMO")?><?=$GLOBALS["DEMODAYS"]?> <?=getMessage("DAYS")?></td></tr><?endif;?>
  
   <tr class="heading"><td colspan="2"><?=getMessage("MODE_VISION")?></td></tr>
  <?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][0][0], $aTabs[0]["OPTIONS"][0][2]);?>
    <tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][0][0])?>"><?echo $aTabs[0]["OPTIONS"][0][1]?>:</label>
		<td width="60%">
			<select name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][0][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][0][0])?>">
			           <?foreach($aTabs[0]["OPTIONS"][0][3][1] as $key => $value):?>
					        <option value="<?echo htmlspecialcharsbx($key)?>"<?if($key==$val) echo ' selected="selected"'?>><?echo htmlspecialcharsEx($value)?></option>
						<?endforeach;?>
			</select>
        </td>
	</tr>
	<tr class="heading"><td colspan="2"><?=getMessage("WIDTH_COLUMN")?></td></tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][1][0], $aTabs[0]["OPTIONS"][1][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][1][0])?>"><?echo $aTabs[0]["OPTIONS"][1][1]?>:</label>
		<td width="60%">
			<select name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][1][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][1][0])?>">
			           <?foreach($aTabs[0]["OPTIONS"][1][3][1] as $key => $value):?>
					        <option value="<?echo htmlspecialcharsbx($key)?>"<?if($key==$val) echo ' selected="selected"'?>><?echo htmlspecialcharsEx($value)?></option>
						<?endforeach;?>
			</select>
        </td>
	</tr>
	

	<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][2][0], $aTabs[0]["OPTIONS"][2][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][2][0])?>"><?echo $aTabs[0]["OPTIONS"][2][1]?>:</label>
		<td width="60%">
			<select name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][2][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][2][0])?>">
			           <?foreach($aTabs[0]["OPTIONS"][2][3][1] as $key => $value):?>
					        <option value="<?echo htmlspecialcharsbx($key)?>"<?if($key==$val) echo ' selected="selected"'?>><?echo htmlspecialcharsEx($value)?></option>
						<?endforeach;?>
			</select>
        </td>
	</tr>
	
	
	

	
    <tr><td colspan="2" align="center"><div class="adm-info-message-wrap" align="center"><div class="adm-info-message"><?=getMessage("ABOUT_COLUMN")?></div></div></td></tr>
	
    <tr class="heading"><td colspan="2"><?=getMessage("MODE_COLOR")?></td></tr>
	
	<?
	  $val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][11][0], $aTabs[0]["OPTIONS"][11][2]);
	  $modecol=$val;
	?>
	<tr>
		<td colspan="2" style="text-align: -webkit-center;"  align="center" >
			<div class="input-type-selector">
				<label><input type="radio" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][11][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][11][0])?>" value="Y"<?if($val=="Y")echo" checked";?>><?=getMessage("CHOOSE_FROM")?></label><br>
				<label><input type="radio" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][11][0])?>" value=""<?if($val!="Y")echo" checked";?>><?=getMessage("HAND_SETTINGS")?></label>
			</div>
		</td>
	</tr>
	
	<tr class="colorauto" <?if(!$modecol):?>style="display:none"<?endif;?>>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][3][0])?>"><?echo $aTabs[0]["OPTIONS"][3][1]?>:</label>
		<td width="60%">
		    <span class="color-switch">
			  <div>
			  <?$count=0;
			  foreach($settings['colors'] as $key => $val):?>
                <a href="#" class="colorsheme <?=$key?>" style="background: <?=$val?>;"><?=$val?></a>
				<?$count++;
				if($count&&$count%6==0)echo "</div><div>";?>
				<?endforeach;?>
				</div>
            </span> 
	    </td>
	</tr>
	
	<tr class="colorauto" <?if(!$modecol):?>style="display:none"<?endif;?>>
		<td width="40%" nowrap>
			<label><?=GetMessage("USER_ALTSTYLE")?>:</label>
		<td width="60%">
		    <span class="color-switch">
			  <div>
			  <?$count=0;
			  foreach($settings['colors'] as $key => $val):?>
                <a href="#" class="altsheme <?=$key?>" style="background: <?=$val?>;"><?=$val?></a>
				<?$count++;
				if($count&&$count%6==0)echo "</div><div>";?>
				<?endforeach;?>
				</div>
            </span> 
	    </td>
	</tr>
	
	
	
	
	
	<tr class="colorhand" <?if($modecol):?>style="display:none"<?endif;?>>
	<td colspan="2" style="text-align: -webkit-center;"  align="center" >
		<table cellspacing="10">
			<tr>
		<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][4][0], $aTabs[0]["OPTIONS"][4][2]);?>
		<td width="50%" class="cp-area">
		   <div class="cp-container">
			 <div class="input-group form-group">
			  <span class="input-group-addon"><i class="zmdi zmdi-invert-colors"></i></span>
			   <div class="fg-line dropdown">
				 <label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][4][0])?>"><?echo $aTabs[0]["OPTIONS"][4][1]?>:</label>
				 <input type="text" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][4][0])?>" value="<?echo htmlspecialcharsbx($val)?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][4][0])?>" class="form-control cp-value" data-toggle="dropdown" size="6">
			   <div class="dropdown-menu">
				<div class="color-picker" data-cp-default="#03A9F4"></div>
			   </div>
			   <i class="cp-value"></i>
			   </div>
			  </div>
			</div>					
		</td>
		<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][5][0], $aTabs[0]["OPTIONS"][5][2]);?>
		<td width="50%" class="cp-area">
		   <div class="cp-container">
			 <div class="input-group form-group">
			  <span class="input-group-addon"><i class="zmdi zmdi-invert-colors"></i></span>
			   <div class="fg-line dropdown">
				 <label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][5][0])?>"><?echo $aTabs[0]["OPTIONS"][5][1]?>:</label>
				 <input type="text" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][5][0])?>" value="<?echo htmlspecialcharsbx($val)?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][5][0])?>" class="form-control cp-value" data-toggle="dropdown" size="6">
			   <div class="dropdown-menu">
				<div class="color-picker" data-cp-default="#03A9F4"></div>
			   </div>
			   <i class="cp-value"></i>
			   </div>
			  </div>
			</div>				
		</td>
		</tr>
		</table>
		<td>
	</tr>

	<tr class="heading"><td colspan="2"><?=getMessage("MODE_BACKGROUND")?></td></tr>
	
	<?
	  $val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][6][0], $aTabs[0]["OPTIONS"][6][2]);
	  $modeback=$val;
	?>
	<tr>
		<td colspan="2" style="text-align: -webkit-center;"  align="center" >
			<div class="input-type-selector">
				<label><input type="radio" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][6][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][6][0])?>" value="Y"<?if($val=="Y")echo" checked";?>><?=getMessage("CHOOSE_FROM")?></label><br>
				<label><input type="radio" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][6][0])?>" value=""<?if($val!="Y")echo" checked";?>><?=getMessage("HAND_SETTINGS")?></label>
			</div>
		</td>
	</tr>
	
	
	<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][7][0], $aTabs[0]["OPTIONS"][7][2]);?>
	<tr class="defined_back" <?if(!$modeback):?>style="display:none"<?endif;?>>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][7][0])?>"><?echo $aTabs[0]["OPTIONS"][7][1]?>:</label>
		<td width="60%">
             <span id="cmbBodyBg" class="color-switch">
			    <a href="#" data-body="body-bg-11" class="body-bg-11 ttip"></a>
                <a href="#" data-body="body-bg-12" class="body-bg-12 ttip"></a>
                <a href="#" data-body="body-bg-13" class="body-bg-13 ttip"></a>
                <a href="#" data-body="body-bg-14" class="body-bg-14 ttip"></a>
                <a href="#" data-body="body-bg-15" class="body-bg-15 ttip"></a>
                <a href="#" data-body="body-bg-16" class="body-bg-16 ttip"></a>
				
				

                <div>
                <a href="#" data-body="body-bg-21" class="body-bg-21 ttip"></a>
                <a href="#" data-body="body-bg-22" class="body-bg-22 ttip"></a>
                <a href="#" data-body="body-bg-23" class="body-bg-23 ttip"></a>
                <a href="#" data-body="body-bg-24" class="body-bg-24 ttip"></a>
                <a href="#" data-body="body-bg-25" class="body-bg-25 ttip"></a>
                <a href="#" data-body="body-bg-26" class="body-bg-26 ttip"></a>
                </div>	

                <div>
                <a href="#" data-body="body-bg-31" class="body-bg-31 ttip"></a>
                <a href="#" data-body="body-bg-32" class="body-bg-32 ttip"></a>
                <a href="#" data-body="body-bg-33" class="body-bg-33 ttip"></a>
                <a href="#" data-body="body-bg-34" class="body-bg-34 ttip"></a>
                <a href="#" data-body="body-bg-35" class="body-bg-35 ttip"></a>
                <a href="#" data-body="body-bg-36" class="body-bg-36 ttip"></a>
                </div>	
				 <div>
			    <a href="#" id="cmdBodyBg41" data-body="body-bg-41" class="body-bg-41 ttip" data-toggle="bottom"></a>
                <a href="#" id="cmdBodyBg42" data-body="body-bg-42" class="body-bg-42 ttip" data-toggle="bottom"></a>
                <a href="#" id="cmdBodyBg43" data-body="body-bg-43" class="body-bg-43 ttip" data-toggle="bottom"></a>
                <a href="#" id="cmdBodyBg44" data-body="body-bg-44" class="body-bg-44 ttip" data-toggle="bottom"></a>
                <a href="#" id="cmdBodyBg45" data-body="body-bg-45" class="body-bg-45 ttip" data-toggle="bottom"></a>
                <a href="#" id="cmdBodyBg46" data-body="body-bg-46" class="body-bg-46 ttip" data-toggle="bottom"></a>
				</div>
				<div>
				<a href="#" id="cmdBodyBg51" data-body="body-bg-51" class="body-bg-51 ttip minibg" data-toggle="bottom"></a>
				<a href="#" id="cmdBodyBg52" data-body="body-bg-52" class="body-bg-52 ttip minibg" data-toggle="bottom"></a>
				<a href="#" id="cmdBodyBg53" data-body="body-bg-53" class="body-bg-53 ttip minibg" data-toggle="bottom"></a>
				<a href="#" id="cmdBodyBg54" data-body="body-bg-54" class="body-bg-54 ttip minibg" data-toggle="bottom"></a>
				<a href="#" id="cmdBodyBg55" data-body="body-bg-55" class="body-bg-55 ttip minibg" data-toggle="bottom"></a>
				<a href="#" id="cmdBodyBg56" data-body="body-bg-56" class="body-bg-56 ttip minibg" data-toggle="bottom"></a>
				</div>
				</span>
				 <input type="hidden" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][7][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][7][0])?>">
	    </td>
	</tr>
	
	
		<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][8][0], $aTabs[0]["OPTIONS"][8][2]);?>
   	<tr class="set_back" <?if($modeback):?>style="display:none"<?endif;?>>
	<td colspan="2" style="text-align: -webkit-center;"  align="center" >
		<table cellspacing="10">
			<tr>		
				<td  class="cp-area">
				   <div class="cp-container">
					 <div class="input-group form-group">
					  <span class="input-group-addon"><i class="zmdi zmdi-invert-colors"></i></span>
					   <div class="fg-line dropdown">
						 <label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][8][0])?>"><?echo $aTabs[0]["OPTIONS"][8][1]?>:</label>
						 <input type="text" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][8][0])?>" value="<?echo htmlspecialcharsbx($val)?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][8][0])?>" class="form-control cp-value" data-toggle="dropdown" size="6">
					   <div class="dropdown-menu">
						<div class="color-picker" data-cp-default="#03A9F4"></div>
					   </div>
					   <i class="cp-value"></i>
					   </div>
					  </div>
					</div>
				</td>
			</tr>
		</table>
	</td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][9][0], $aTabs[0]["OPTIONS"][9][2]);?>
	<tr class="set_back" <?if($modeback):?>style="display:none"<?endif;?>>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][9][0])?>"><?echo $aTabs[0]["OPTIONS"][9][1]?>:</label>
		<td width="60%">
		 <input type="text" size="<?echo $aTabs[0]["OPTIONS"][9][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][9][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][9][0])?>">
         <input type="button" value="<?=GetMessage("CHOOSE_FILE")?>" OnClick="BtnClick<?=$aTabs[0]["OPTIONS"][9][0]?>()">
		 <?
			CAdminFileDialog::ShowScript
			(
				Array(
					"event" => "BtnClick".$aTabs[0]["OPTIONS"][9][0],
					"arResultDest" => array("FORM_NAME" => "form1", "FORM_ELEMENT_NAME" => $aTabs[0]["OPTIONS"][9][0]),
					"arPath" => array("SITE" => SITE_ID, "PATH" =>"/images/bg/site/"),
					"select" => 'F',
					"operation" => 'O',
					"showUploadTab" => true,
					"showAddToMenuTab" => false,
					"fileFilter" => '',
					"allowAllFiles" => true,
					"SaveConfig" => false,
				)
			);
			?> 
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][10][0], $aTabs[0]["OPTIONS"][10][2]);?>
	<tr class="set_back" <?if($modeback):?>style="display:none"<?endif;?>>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][10][0])?>"><?echo $aTabs[0]["OPTIONS"][10][1]?>:</label>
		<td width="60%">
		   <select name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][10][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][10][0])?>">
			           <?foreach($aTabs[0]["OPTIONS"][10][3][1] as $key => $value):?>
					        <option value="<?echo htmlspecialcharsbx($key)?>"<?if($key==$val) echo ' selected="selected"'?>><?echo htmlspecialcharsEx($value)?></option>
						<?endforeach;?>
			</select>
	    </td>
	</tr>
	

	
	
		<tr class="heading"><td colspan="2"><?=getMessage("HEADER_BACK")?></td></tr>
		
		
		
	<?
	  $val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][12][0], $aTabs[0]["OPTIONS"][12][2]);
	  $modehead=$val;
	?>
	<tr>
		<td colspan="2" style="text-align: -webkit-center;"  align="center" >
			<div class="input-type-selector">
			    <label><input type="radio" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][12][0])?>" value="EMPTY"<?if($val=="EMPTY")echo" checked";?>><?=getMessage("WITHOUT_BACKGROUND")?></label><br>
				<label><input type="radio" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][12][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][12][0])?>" value="Y"<?if($val=="Y")echo" checked";?>><?=getMessage("CHOOSE_FROM")?></label><br>
				<label><input type="radio" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][12][0])?>" value="N"<?if($val=="N")echo" checked";?>><?=getMessage("HAND_SETTINGS")?></label>
			</div>
		</td>
	</tr>
	
	
	<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][13][0], $aTabs[0]["OPTIONS"][13][2]);?>
	<tr class="defined_head" <?if($modehead!="Y"):?>style="display:none"<?endif;?>>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][13][0])?>"><?echo $aTabs[0]["OPTIONS"][13][1]?>:</label>
		<td width="60%">
             <span id="cmbBodyBg" class="color-switch">
			    <a href="#" data-header="header-bg-11" class="header-bg-11 ttipheader"></a>
                <a href="#" data-header="header-bg-12" class="header-bg-12 ttipheader"></a>
                <a href="#" data-header="header-bg-13" class="header-bg-13 ttipheader"></a>
                <a href="#" data-header="header-bg-14" class="header-bg-14 ttipheader"></a>
                <a href="#" data-header="header-bg-15" class="header-bg-15 ttipheader"></a>
                <a href="#" data-header="header-bg-16" class="header-bg-16 ttipheader"></a>
				
				

                <div>
                <a href="#" data-header="header-bg-21" class="header-bg-21 ttipheader"></a>
                <a href="#" data-header="header-bg-22" class="header-bg-22 ttipheader"></a>
                <a href="#" data-header="header-bg-23" class="header-bg-23 ttipheader"></a>
                <a href="#" data-header="header-bg-24" class="header-bg-24 ttipheader"></a>
                <a href="#" data-header="header-bg-25" class="header-bg-25 ttipheader"></a>
                <a href="#" data-header="header-bg-26" class="header-bg-26 ttipheader"></a>
                </div>	

                <div>
                <a href="#" data-header="header-bg-31" class="header-bg-31 ttipheader"></a>
                <a href="#" data-header="header-bg-32" class="header-bg-32 ttipheader"></a>
                <a href="#" data-header="header-bg-33" class="header-bg-33 ttipheader"></a>
                <a href="#" data-header="header-bg-34" class="header-bg-34 ttipheader"></a>
                <a href="#" data-header="header-bg-35" class="header-bg-35 ttipheader"></a>
                <a href="#" data-header="header-bg-36" class="header-bg-36 ttipheader"></a>
                </div>	
				 <div>
			    <a href="#" id="cmdheaderBg41" data-header="header-bg-41" class="header-bg-41 ttipheader" data-toggle="bottom"></a>
                <a href="#" id="cmdheaderBg42" data-header="header-bg-42" class="header-bg-42 ttipheader" data-toggle="bottom"></a>
                <a href="#" id="cmdheaderBg43" data-header="header-bg-43" class="header-bg-43 ttipheader" data-toggle="bottom"></a>
                <a href="#" id="cmdheaderBg44" data-header="header-bg-44" class="header-bg-44 ttipheader" data-toggle="bottom"></a>
                <a href="#" id="cmdheaderBg45" data-header="header-bg-45" class="header-bg-45 ttipheader" data-toggle="bottom"></a>
                <a href="#" id="cmdheaderBg46" data-header="header-bg-46" class="header-bg-46 ttipheader" data-toggle="bottom"></a>
				</div>
				<div>
				<a href="#" id="cmdheaderBg51" data-header="header-bg-51" class="header-bg-51 ttipheader minibg"></a>
				<a href="#" id="cmdheaderBg52" data-header="header-bg-52" class="header-bg-52 ttipheader minibg"></a>
				<a href="#" id="cmdheaderBg53" data-header="header-bg-53" class="header-bg-53 ttipheader minibg"></a>
				<a href="#" id="cmdheaderBg54" data-header="header-bg-54" class="header-bg-54 ttipheader minibg"></a>
				<a href="#" id="cmdheaderBg55" data-header="header-bg-55" class="header-bg-55 ttipheader minibg"></a>
				<a href="#" id="cmdheaderBg56" data-header="header-bg-56" class="header-bg-56 ttipheader minibg"></a>
				</div>
				</span>
				 <input type="hidden" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][13][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][13][0])?>">
	    </td>
	</tr>
	
	
		<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][14][0], $aTabs[0]["OPTIONS"][14][2]);?>
   	<tr class="set_head" <?if($modehead!="N"):?>style="display:none"<?endif;?>>
	<td colspan="2" style="text-align: -webkit-center;"  align="center" >
		<table cellspacing="10">
			<tr>		
				<td  class="cp-area">
				   <div class="cp-container">
					 <div class="input-group form-group">
					  <span class="input-group-addon"><i class="zmdi zmdi-invert-colors"></i></span>
					   <div class="fg-line dropdown">
						 <label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][14][0])?>"><?echo $aTabs[0]["OPTIONS"][14][1]?>:</label>
						 <input type="text" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][14][0])?>" value="<?echo htmlspecialcharsbx($val)?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][14][0])?>" class="form-control cp-value" data-toggle="dropdown" size="6">
					   <div class="dropdown-menu">
						<div class="color-picker" data-cp-default="#03A9F4"></div>
					   </div>
					   <i class="cp-value"></i>
					   </div>
					  </div>
					</div>
				</td>
			</tr>
		</table>
	</td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][15][0], $aTabs[0]["OPTIONS"][15][2]);?>
	<tr class="set_head" <?if($modehead!="N"):?>style="display:none"<?endif;?>>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][15][0])?>"><?echo $aTabs[0]["OPTIONS"][15][1]?>:</label>
		<td width="60%">
		 <input type="text" size="<?echo $aTabs[0]["OPTIONS"][15][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][15][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][15][0])?>">
         <input type="button" value="<?=GetMessage("CHOOSE_FILE")?>" OnClick="BtnClick<?=$aTabs[0]["OPTIONS"][15][0]?>()">
		 <?
			CAdminFileDialog::ShowScript
			(
				Array(
					"event" => "BtnClick".$aTabs[0]["OPTIONS"][15][0],
					"arResultDest" => array("FORM_NAME" => "form1", "FORM_ELEMENT_NAME" => $aTabs[0]["OPTIONS"][15][0]),
					"arPath" => array("SITE" => SITE_ID, "PATH" =>"/images/bg/header/"),
					"select" => 'F',
					"operation" => 'O',
					"showUploadTab" => true,
					"showAddToMenuTab" => false,
					"fileFilter" => '',
					"allowAllFiles" => true,
					"SaveConfig" => false,
				)
			);
			?> 
	    </td>
	</tr>
	
	
		<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][16][0], $aTabs[0]["OPTIONS"][16][2]);?>
	<tr class="set_head" <?if($modehead!="N"):?>style="display:none"<?endif;?>>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][16][0])?>"><?echo $aTabs[0]["OPTIONS"][16][1]?>:</label>
		<td width="60%">
		   <select name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][16][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][16][0])?>">
			           <?foreach($aTabs[0]["OPTIONS"][16][3][1] as $key => $value):?>
					        <option value="<?echo htmlspecialcharsbx($key)?>"<?if($key==$val) echo ' selected="selected"'?>><?echo htmlspecialcharsEx($value)?></option>
						<?endforeach;?>
			</select>
	    </td>
	</tr>
	

	
	
		<tr class="heading"><td colspan="2"><?=getMessage("FOOTER_BACK")?></td></tr>
		
		
		
	<?
	  $val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][17][0], $aTabs[0]["OPTIONS"][17][2]);
	  $modefooter=$val;
	?>
	<tr>
		<td colspan="2" style="text-align: -webkit-center;"  align="center" >
			<div class="input-type-selector">
				<label><input type="radio" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][17][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][17][0])?>" value="Y"<?if($val=="Y")echo" checked";?>><?=getMessage("CHOOSE_FROM")?></label><br>
				<label><input type="radio" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][17][0])?>" value=""<?if($val!="Y")echo" checked";?>><?=getMessage("HAND_SETTINGS")?></label>
			</div>
		</td>
	</tr>
	
	
	<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][18][0], $aTabs[0]["OPTIONS"][18][2]);?>
	<tr class="defined_footer" <?if(!$modefooter):?>style="display:none"<?endif;?>>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][18][0])?>"><?echo $aTabs[0]["OPTIONS"][18][1]?>:</label>
		<td width="60%">
             <span id="cmbBodyBg" class="color-switch">
			    <a href="#" data-footer="footer-bg-11" class="footer-bg-11 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-12" class="footer-bg-12 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-18" class="footer-bg-13 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-14" class="footer-bg-14 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-15" class="footer-bg-15 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-16" class="footer-bg-16 ttipfooter"></a>
				
				

                <div>
                <a href="#" data-footer="footer-bg-21" class="footer-bg-21 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-22" class="footer-bg-22 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-23" class="footer-bg-23 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-24" class="footer-bg-24 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-25" class="footer-bg-25 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-26" class="footer-bg-26 ttipfooter"></a>
                </div>	

                <div>
                <a href="#" data-footer="footer-bg-31" class="footer-bg-31 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-32" class="footer-bg-32 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-33" class="footer-bg-33 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-34" class="footer-bg-34 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-35" class="footer-bg-35 ttipfooter"></a>
                <a href="#" data-footer="footer-bg-36" class="footer-bg-36 ttipfooter"></a>
                </div>	
				 <div>
			    <a href="#" id="cmdfooterBg41" data-footer="footer-bg-41" class="footer-bg-41 ttipfooter" data-toggle="bottom"></a>
                <a href="#" id="cmdfooterBg42" data-footer="footer-bg-42" class="footer-bg-42 ttipfooter" data-toggle="bottom"></a>
                <a href="#" id="cmdfooterBg43" data-footer="footer-bg-43" class="footer-bg-43 ttipfooter" data-toggle="bottom"></a>
                <a href="#" id="cmdfooterBg44" data-footer="footer-bg-44" class="footer-bg-44 ttipfooter" data-toggle="bottom"></a>
                <a href="#" id="cmdfooterBg45" data-footer="footer-bg-45" class="footer-bg-45 ttipfooter" data-toggle="bottom"></a>
                <a href="#" id="cmdfooterBg46" data-footer="footer-bg-46" class="footer-bg-46 ttipfooter" data-toggle="bottom"></a>
				</div>
				<div>
				<a href="#" id="cmdfooterBg51" data-footer="footer-bg-51" class="footer-bg-51 ttipfooter minibg" data-toggle="bottom"></a>
				<a href="#" id="cmdfooterBg52" data-footer="footer-bg-52" class="footer-bg-52 ttipfooter minibg" data-toggle="bottom"></a>
				<a href="#" id="cmdfooterBg53" data-footer="footer-bg-53" class="footer-bg-53 ttipfooter minibg" data-toggle="bottom"></a>
				<a href="#" id="cmdfooterBg54" data-footer="footer-bg-54" class="footer-bg-54 ttipfooter minibg" data-toggle="bottom"></a>
				<a href="#" id="cmdfooterBg55" data-footer="footer-bg-55" class="footer-bg-55 ttipfooter minibg" data-toggle="bottom"></a>
				<a href="#" id="cmdfooterBg56" data-footer="footer-bg-56" class="footer-bg-56 ttipfooter minibg" data-toggle="bottom"></a>
				</div>
				</span>
				 <input type="hidden" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][18][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][18][0])?>">
	    </td>
	</tr>
	
	
    <?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][19][0], $aTabs[0]["OPTIONS"][19][2]);?>
   	<tr class="set_footer" <?if($modefooter):?>style="display:none"<?endif;?>>
	<td colspan="2" style="text-align: -webkit-center;"  align="center" >
		<table cellspacing="10">
			<tr>		
				<td  class="cp-area">
				   <div class="cp-container">
					 <div class="input-group form-group">
					  <span class="input-group-addon"><i class="zmdi zmdi-invert-colors"></i></span>
					   <div class="fg-line dropdown">
						 <label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][19][0])?>"><?echo $aTabs[0]["OPTIONS"][19][1]?>:</label>
						 <input type="text" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][19][0])?>" value="<?echo htmlspecialcharsbx($val)?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][19][0])?>" class="form-control cp-value" data-toggle="dropdown" size="6">
					   <div class="dropdown-menu">
						<div class="color-picker" data-cp-default="#03A9F4"></div>
					   </div>
					   <i class="cp-value"></i>
					   </div>
					  </div>
					</div>
				</td>
			</tr>
		</table>
	</td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][20][0], $aTabs[0]["OPTIONS"][20][2]);?>
	<tr class="set_footer" <?if($modefooter):?>style="display:none"<?endif;?>>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][20][0])?>"><?echo $aTabs[0]["OPTIONS"][20][1]?>:</label>
		<td width="60%">
		 <input type="text" size="<?echo $aTabs[0]["OPTIONS"][20][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][20][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][20][0])?>">
         <input type="button" value="<?=GetMessage("CHOOSE_FILE")?>" OnClick="BtnClick<?=$aTabs[0]["OPTIONS"][20][0]?>()">
		 <?
			CAdminFileDialog::ShowScript
			(
				Array(
					"event" => "BtnClick".$aTabs[0]["OPTIONS"][20][0],
					"arResultDest" => array("FORM_NAME" => "form1", "FORM_ELEMENT_NAME" => $aTabs[0]["OPTIONS"][20][0]),
					"arPath" => array("SITE" => SITE_ID, "PATH" =>"/images/bg/footer/"),
					"select" => 'F',
					"operation" => 'O',
					"showUploadTab" => true,
					"showAddToMenuTab" => false,
					"fileFilter" => '',
					"allowAllFiles" => true,
					"SaveConfig" => false,
				)
			);
			?> 
	    </td>
	</tr>
	
	
	
	
	
	<?$val = COption::GetOptionString($module, $aTabs[0]["OPTIONS"][21][0], $aTabs[0]["OPTIONS"][21][2]);?>
	<tr class="set_footer" <?if($modefooter):?>style="display:none"<?endif;?>>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][21][0])?>"><?echo $aTabs[0]["OPTIONS"][21][1]?>:</label>
		<td width="60%">
		   <select name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][21][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][21][0])?>">
			           <?foreach($aTabs[0]["OPTIONS"][21][3][1] as $key => $value):?>
					        <option value="<?echo htmlspecialcharsbx($key)?>"<?if($key==$val) echo ' selected="selected"'?>><?echo htmlspecialcharsEx($value)?></option>
						<?endforeach;?>
			</select>
	    </td>
	</tr>
		
		

    <?$tabControl->BeginNextTab();?>
	<?$val = COption::GetOptionString($module, $aTabs[1]["OPTIONS"][0][0], $aTabs[1]["OPTIONS"][0][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][0][0])?>"><?echo $aTabs[1]["OPTIONS"][0][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[1]["OPTIONS"][0][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][0][0])?>" id="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][0][0])?>">
	    </td>
	</tr>

	<?$val = COption::GetOptionString($module, $aTabs[1]["OPTIONS"][5][0], $aTabs[1]["OPTIONS"][5][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][5][0])?>"><?echo $aTabs[1]["OPTIONS"][5][1]?>:</label>
		<td width="60%">
		 <input type="text" size="<?echo$aTabs[1]["OPTIONS"][5][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][5][0])?>" id="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][5][0])?>">
         <input type="button" value="<?=GetMessage("CHOOSE_FILE")?>" OnClick="BtnClick<?=$aTabs[1]["OPTIONS"][5][0]?>()">
		 <?
			CAdminFileDialog::ShowScript
			(
				Array(
					"event" => "BtnClick".$aTabs[1]["OPTIONS"][5][0],
					"arResultDest" => array("FORM_NAME" => "form1", "FORM_ELEMENT_NAME" => $aTabs[1]["OPTIONS"][5][0]),
					"arPath" => array("SITE" => SITE_ID, "PATH" =>"/images/logo/"),
					"select" => 'F',
					"operation" => 'O',
					"showUploadTab" => true,
					"showAddToMenuTab" => false,
					"fileFilter" => '',
					"allowAllFiles" => true,
					"SaveConfig" => false,
				)
			);
			?> 
	    </td>
	</tr>
	
    <?$val = COption::GetOptionString($module, $aTabs[1]["OPTIONS"][1][0], $aTabs[1]["OPTIONS"][1][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][1][0])?>"><?echo $aTabs[1]["OPTIONS"][1][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[1]["OPTIONS"][1][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][1][0])?>" id="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][1][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[1]["OPTIONS"][2][0], $aTabs[1]["OPTIONS"][2][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][2][0])?>"><?echo $aTabs[1]["OPTIONS"][2][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[1]["OPTIONS"][2][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][2][0])?>" id="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][2][0])?>">
	    </td>
	</tr>
			
	<?$val = COption::GetOptionString($module, $aTabs[1]["OPTIONS"][3][0], $aTabs[1]["OPTIONS"][3][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][3][0])?>"><?echo $aTabs[1]["OPTIONS"][3][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[1]["OPTIONS"][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][3][0])?>" id="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][3][0])?>">
	    </td>
	</tr>
	
   <?$val = COption::GetOptionString($module, $aTabs[1]["OPTIONS"][4][0], $aTabs[1]["OPTIONS"][4][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][4][0])?>"><?echo $aTabs[1]["OPTIONS"][4][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[1]["OPTIONS"][4][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][4][0])?>" id="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][4][0])?>">
	    </td>
	</tr>
	

	

	

	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][8][0])?>"><?echo $aTabs[1]["OPTIONS"][8][1]?>:</label>
		<td width="60%">

	
	
	        <div id="YMapsID" style="width:600px;height:400px"></div>
	        <?$vallat = COption::GetOptionString($module, $aTabs[1]["OPTIONS"][6][0], $aTabs[1]["OPTIONS"][6][2]);?>
			<input type="hidden" size="40" value="<?echo htmlspecialcharsbx($vallat)?>" name="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][6][0])?>" id="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][6][0])?>">
            <?$vallng = COption::GetOptionString($module, $aTabs[1]["OPTIONS"][7][0], $aTabs[1]["OPTIONS"][7][2]);?>
	        <input type="hidden" size="40" value="<?echo htmlspecialcharsbx($vallng)?>" name="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][7][0])?>" id="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][7][0])?>">


    <script type="text/javascript">
        // Создает обработчик события window.onLoad
        YMaps.jQuery(function () {
			 var geoResult;

            // Создает экземпляр карты и привязывает его к созданному контейнеру
            window.map = new YMaps.Map(YMaps.jQuery("#YMapsID")[0]);
            var placemark =new YMaps.Placemark(new YMaps.GeoPoint(<?=$vallng?>,<?=$vallat?>));
			map.addOverlay(placemark);
			
			var zoom = new YMaps.Zoom({});
            map.addControl(zoom);

			//searchControl = new SearchAddress(map, $('.form-search'));
           // map.addControl(searchControl);
	                  // Поиск по нажатию Enter в поисковом поле
            YMaps.jQuery("#requestyandex").bind("keyup", function (e) {
               // if (e.keyCode == 13) {
					//console.log("dsafsf");
                    search();
              //  }
            });
            function search () {
                // Запускаем поиск
                var geocoder = new YMaps.Geocoder(YMaps.jQuery("#requestyandex").attr("value"), { 
                    prefLang : YMaps.jQuery("#lang").val()
                } );

                var listenerLoad = YMaps.Events.observe(geocoder, geocoder.Events.Load, function (geocoder) {

                    
                    if (geocoder.length()) {
                        // Отображаем первый релевантный результат геокодирования
                        geoResult = geocoder.get(0);
                        map.setBounds(geoResult.getBounds());
                    } 

                    listenerLoad.cleanup();
                });
            }

	
	
            map.setCenter(new YMaps.GeoPoint(<?=$vallng?>,<?=$vallat?>), 16);
			var myEventListener = YMaps.Events.observe(map, map.Events.Click, function (map, mEvent) {
			map.removeOverlay(placemark);
            placemark = new YMaps.Placemark(mEvent.getGeoPoint());
			$("#lat").val(mEvent.getGeoPoint()['__lat']);
			$("#lng").val(mEvent.getGeoPoint()['__lng']);
            map.addOverlay(placemark);
			
    }, this);
        });

		YMaps.jQuery("#tab_cont_edit2").bind('click', function () {
			map.redraw(); 
			return false;
		});
		
		
    </script>
	    <br><input id="requestyandex" size="40" class="b-search-input" type="text" value=""/>        
	</td>
	</tr>
	
	<tr><td colspan="2" align="center"><div class="adm-info-message-wrap" align="center"><div class="adm-info-message"><?=getMessage("FILIAL_INFO")?> <a href="<?=$LINK?>"><?=getMessage("LINK")?></a></div></div></td></tr>
	

		<?$val = COption::GetOptionString($module, $aTabs[1]["OPTIONS"][9][0], $aTabs[1]["OPTIONS"][9][2]);?>
		 <tr>
			<td width="40%" nowrap>
				<label for="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][9][0])?>"><?echo $aTabs[1]["OPTIONS"][9][1]?>:</label>
			<td width="60%">
			 <input type="checkbox" id="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][9][0])?>" name="<?echo htmlspecialcharsbx($aTabs[1]["OPTIONS"][9][0])?>" value="Y">
		    </td>
	    </tr>
		<tr><td colspan="2" align="center"><div class="adm-info-message-wrap" align="center"><div class="adm-info-message"><?=getMessage("SETTINGS_INFO")?></div></div></td></tr>
	
	
	 <?$tabControl->BeginNextTab();?>
	<?$val = COption::GetOptionString($module, $aTabs[2]["OPTIONS"][0][0], $aTabs[2]["OPTIONS"][0][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][0][0])?>"><?echo $aTabs[2]["OPTIONS"][0][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[2]["OPTIONS"][0][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][0][0])?>" id="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][0][0])?>">
	    </td>
	</tr>
	
    <?$val = COption::GetOptionString($module, $aTabs[2]["OPTIONS"][1][0], $aTabs[2]["OPTIONS"][1][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][1][0])?>"><?echo $aTabs[2]["OPTIONS"][1][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[2]["OPTIONS"][1][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][1][0])?>" id="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][1][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[2]["OPTIONS"][2][0], $aTabs[2]["OPTIONS"][2][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][2][0])?>"><?echo $aTabs[2]["OPTIONS"][2][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[2]["OPTIONS"][2][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][2][0])?>" id="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][2][0])?>">
	    </td>
	</tr>
			
	<?$val = COption::GetOptionString($module, $aTabs[2]["OPTIONS"][3][0], $aTabs[2]["OPTIONS"][3][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][3][0])?>"><?echo $aTabs[2]["OPTIONS"][3][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[2]["OPTIONS"][3][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][3][0])?>" id="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][3][0])?>">
	    </td>
	</tr>
	
   <?$val = COption::GetOptionString($module, $aTabs[2]["OPTIONS"][4][0], $aTabs[2]["OPTIONS"][4][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][4][0])?>"><?echo $aTabs[2]["OPTIONS"][4][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[2]["OPTIONS"][4][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][4][0])?>" id="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][4][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[2]["OPTIONS"][5][0], $aTabs[2]["OPTIONS"][5][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][5][0])?>"><?echo $aTabs[2]["OPTIONS"][5][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[2]["OPTIONS"][5][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][5][0])?>" id="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][5][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[2]["OPTIONS"][6][0], $aTabs[2]["OPTIONS"][6][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][6][0])?>"><?echo $aTabs[2]["OPTIONS"][6][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[2]["OPTIONS"][6][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][6][0])?>" id="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][6][0])?>">
	    </td>
	</tr>
        <tr class="heading"><td colspan="2"><?=GetMessage("WIDGET")?></td></tr>
		
		<?$val = COption::GetOptionString($module, $aTabs[2]["OPTIONS"][7][0], $aTabs[2]["OPTIONS"][7][2]);?>
		 <tr>
			<td width="40%" nowrap>
				<label for="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][7][0])?>"><?echo $aTabs[2]["OPTIONS"][7][1]?>:</label>
			<td width="60%">
			 <input type="checkbox" id="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][7][0])?>" name="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][7][0])?>" value="Y"<?if($val=="Y")echo" checked";?>>
		    </td>
	    </tr>
	
		<?/*$val = COption::GetOptionString($module, $aTabs[2]["OPTIONS"][8][0], $aTabs[2]["OPTIONS"][8][2]);?>
		 <tr>
			<td width="40%" nowrap>
				<label for="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][8][0])?>"><?echo $aTabs[2]["OPTIONS"][8][1]?>:</label>
			<td width="60%">
			 <input type="checkbox" id="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][8][0])?>" name="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][8][0])?>" value="Y"<?if($val=="Y")echo" checked";?>>
		    </td>
	    </tr>*/?>
		
		<?$val = COption::GetOptionString($module, $aTabs[2]["OPTIONS"][9][0], $aTabs[2]["OPTIONS"][9][2]);?>
		 <tr>
			<td width="40%" nowrap>
				<label for="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][9][0])?>"><?echo $aTabs[2]["OPTIONS"][9][1]?>:</label>
			<td width="60%">
			 <input type="checkbox" id="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][9][0])?>" name="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][9][0])?>" value="Y"<?if($val=="Y")echo" checked";?>>
		    </td>
	    </tr>
        
    <?$val = COption::GetOptionString($module, $aTabs[2]["OPTIONS"][10][0], $aTabs[2]["OPTIONS"][10][2]);?>
		 <tr>
			<td width="40%" nowrap>
				<label for="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][10][0])?>"><?echo $aTabs[2]["OPTIONS"][10][1]?>:</label>
			<td width="60%">
			 <input type="checkbox" id="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][10][0])?>" name="<?echo htmlspecialcharsbx($aTabs[2]["OPTIONS"][10][0])?>" value="Y" <?if($val=="Y")echo" checked";?>>
		    </td>
	    </tr>
	  <tr><td colspan="2" align="center"><div class="adm-info-message-wrap" align="center"><div class="adm-info-message"><?=getMessage("WIDGET_INFO")?></div></div></td></tr>
	
	
	
	
  <?$tabControl->BeginNextTab();?>
	<?$val = COption::GetOptionString($module, $aTabs[3]["OPTIONS"][0][0], $aTabs[3]["OPTIONS"][0][2]);?>
	<tr>
		<td width="40%" nowrap class="adm-detail-valign-top">
			<label for="<?echo htmlspecialcharsbx($aTabs[3]["OPTIONS"][0][0])?>"><?echo $aTabs[3]["OPTIONS"][0][1]?>:</label>
		<td width="60%">
	       	<textarea rows="<?echo $aTabs[3]["OPTIONS"][0][3][1]?>" cols="<?echo $aTabs[3]["OPTIONS"][0][3][2]?>" name="<?echo htmlspecialcharsbx($aTabs[3]["OPTIONS"][0][0])?>" id="<?echo htmlspecialcharsbx($aTabs[3]["OPTIONS"][0][0])?>"><?echo htmlspecialcharsbx($val)?></textarea>
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[3]["OPTIONS"][1][0], $aTabs[3]["OPTIONS"][1][2]);?>
	<tr>
		<td width="40%" nowrap class="adm-detail-valign-top">
			<label for="<?echo htmlspecialcharsbx($aTabs[3]["OPTIONS"][1][0])?>"><?echo $aTabs[3]["OPTIONS"][1][1]?>:</label>
		<td width="60%">
	          <textarea rows="<?echo $aTabs[3]["OPTIONS"][1][3][1]?>" cols="<?echo $aTabs[3]["OPTIONS"][1][3][2]?>" name="<?echo htmlspecialcharsbx($aTabs[3]["OPTIONS"][1][0])?>" id="<?echo htmlspecialcharsbx($aTabs[3]["OPTIONS"][1][0])?>"><?echo htmlspecialcharsbx($val)?></textarea>
		
	    </td>
	</tr>	
	
	
<?$tabControl->BeginNextTab();?>
	<?$val = COption::GetOptionString($module, $aTabs[4]["OPTIONS"][0][0], $aTabs[4]["OPTIONS"][0][2]);?>
	<tr>
		<td width="40%" nowrap class="adm-detail-valign-top">
			<label for="<?echo htmlspecialcharsbx($aTabs[4]["OPTIONS"][0][0])?>"><?echo $aTabs[4]["OPTIONS"][0][1]?>:</label>
		<td width="60%">
	     <input type="checkbox" id="<?echo htmlspecialcharsbx($aTabs[4]["OPTIONS"][0][0])?>" name="<?echo htmlspecialcharsbx($aTabs[4]["OPTIONS"][0][0])?>" value="Y"<?if($val=="Y")echo" checked";?>>
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[4]["OPTIONS"][1][0], $aTabs[4]["OPTIONS"][1][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[4]["OPTIONS"][1][0])?>"><?echo $aTabs[4]["OPTIONS"][1][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[4]["OPTIONS"][1][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[4]["OPTIONS"][1][0])?>" id="<?echo htmlspecialcharsbx($aTabs[4]["OPTIONS"][1][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[4]["OPTIONS"][2][0], $aTabs[4]["OPTIONS"][2][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[4]["OPTIONS"][2][0])?>"><?echo $aTabs[4]["OPTIONS"][2][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[4]["OPTIONS"][2][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[4]["OPTIONS"][2][0])?>" id="<?echo htmlspecialcharsbx($aTabs[4]["OPTIONS"][2][0])?>">
	    </td>
	</tr>
	
	
	
		
	<?$tabControl->BeginNextTab();?>
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][0][0], $aTabs[5]["OPTIONS"][0][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][0][0])?>"><?echo $aTabs[5]["OPTIONS"][0][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][0][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][0][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][0][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][1][0], $aTabs[5]["OPTIONS"][1][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][1][0])?>"><?echo $aTabs[5]["OPTIONS"][1][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][1][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][1][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][1][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][2][0], $aTabs[5]["OPTIONS"][2][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][2][0])?>"><?echo $aTabs[5]["OPTIONS"][2][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][2][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][2][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][2][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][3][0], $aTabs[5]["OPTIONS"][3][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][3][0])?>"><?echo $aTabs[5]["OPTIONS"][3][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][3][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][3][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][3][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][4][0], $aTabs[5]["OPTIONS"][4][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][4][0])?>"><?echo $aTabs[5]["OPTIONS"][4][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][4][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][4][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][4][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][5][0], $aTabs[5]["OPTIONS"][5][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][5][0])?>"><?echo $aTabs[5]["OPTIONS"][5][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][5][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][5][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][5][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][6][0], $aTabs[5]["OPTIONS"][6][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][6][0])?>"><?echo $aTabs[5]["OPTIONS"][6][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][6][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][6][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][6][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][7][0], $aTabs[5]["OPTIONS"][7][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][7][0])?>"><?echo $aTabs[5]["OPTIONS"][7][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][7][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][7][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][7][0])?>">
	    </td>
	</tr>
	
	
   <?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][8][0], $aTabs[5]["OPTIONS"][8][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][8][0])?>"><?echo $aTabs[5]["OPTIONS"][8][1]?>:</label>
		<td width="60%">
		 <input type="text" size="<?echo$aTabs[5]["OPTIONS"][8][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][8][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][8][0])?>">
         <input type="button" value="<?=GetMessage("CHOOSE_FILE")?>" OnClick="BtnClick<?=$aTabs[5]["OPTIONS"][8][0]?>()">
		 <?
			CAdminFileDialog::ShowScript
			(
				Array(
					"event" => "BtnClick".$aTabs[5]["OPTIONS"][8][0],
					"arResultDest" => array("FORM_NAME" => "form1", "FORM_ELEMENT_NAME" => $aTabs[5]["OPTIONS"][8][0]),
					"arPath" => array("SITE" => SITE_ID, "PATH" =>"/images/logo/"),
					"select" => 'F',
					"operation" => 'O',
					"showUploadTab" => true,
					"showAddToMenuTab" => false,
					"fileFilter" => '',
					"allowAllFiles" => true,
					"SaveConfig" => false,
				)
			);
			?> 
	    </td>
	</tr>
	
	
   <?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][9][0], $aTabs[5]["OPTIONS"][9][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][9][0])?>"><?echo $aTabs[5]["OPTIONS"][9][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][9][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][9][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][9][0])?>">
	    </td>
	</tr>
	
	
		
   <?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][10][0], $aTabs[5]["OPTIONS"][10][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][10][0])?>"><?echo $aTabs[5]["OPTIONS"][10][1]?>:</label>
		<td width="60%">
		 <input type="text" size="<?echo$aTabs[5]["OPTIONS"][10][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][10][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][10][0])?>">
         <input type="button" value="<?=GetMessage("CHOOSE_FILE")?>" OnClick="BtnClick<?=$aTabs[5]["OPTIONS"][10][0]?>()">
		 <?
			CAdminFileDialog::ShowScript
			(
				Array(
					"event" => "BtnClick".$aTabs[5]["OPTIONS"][10][0],
					"arResultDest" => array("FORM_NAME" => "form1", "FORM_ELEMENT_NAME" => $aTabs[5]["OPTIONS"][10][0]),
					"arPath" => array("SITE" => SITE_ID, "PATH" =>"/images/logo/"),
					"select" => 'F',
					"operation" => 'O',
					"showUploadTab" => true,
					"showAddToMenuTab" => false,
					"fileFilter" => '',
					"allowAllFiles" => true,
					"SaveConfig" => false,
				)
			);
			?> 
	    </td>
	</tr>
	
	
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][11][0], $aTabs[5]["OPTIONS"][11][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][11][0])?>"><?echo $aTabs[5]["OPTIONS"][11][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][11][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][11][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][11][0])?>">
	    </td>
	</tr>
	
	
   <?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][12][0], $aTabs[5]["OPTIONS"][12][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][12][0])?>"><?echo $aTabs[5]["OPTIONS"][12][1]?>:</label>
		<td width="60%">
		 <input type="text" size="<?echo$aTabs[5]["OPTIONS"][12][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][12][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][12][0])?>">
         <input type="button" value="<?=GetMessage("CHOOSE_FILE")?>" OnClick="BtnClick<?=$aTabs[5]["OPTIONS"][12][0]?>()">
		 <?
			CAdminFileDialog::ShowScript
			(
				Array(
					"event" => "BtnClick".$aTabs[5]["OPTIONS"][12][0],
					"arResultDest" => array("FORM_NAME" => "form1", "FORM_ELEMENT_NAME" => $aTabs[5]["OPTIONS"][12][0]),
					"arPath" => array("SITE" => SITE_ID, "PATH" =>"/images/logo/"),
					"select" => 'F',
					"operation" => 'O',
					"showUploadTab" => true,
					"showAddToMenuTab" => false,
					"fileFilter" => '',
					"allowAllFiles" => true,
					"SaveConfig" => false,
				)
			);
			?> 
	    </td>
	</tr>
	
	
	
	<tr class="heading"><td colspan="2"><?=GetMessage("SBER_EKVAIRING")?></td></tr>
	
	<tr>
		<td width="40%"  nowrap></td>
		<td width="60%">
			<input type="button" id="check-https" value="<?=GetMessage('CHECK_HTTPS')?>">
			<p id="result-check-https"></p>
		</td>
	</tr>
	
	
	<?$val = COption::GetOptionString($module,$aTabs[5]["OPTIONS"][13][0],$aTabs[5]["OPTIONS"][13][2]);?>
		 <tr>
			<td width="40%" nowrap>
				<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][13][0])?>"><?echo$aTabs[5]["OPTIONS"][13][1]?>:</label>
			<td width="60%">
			 <input type="checkbox" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][13][0])?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][13][0])?>" value="Y"<?if($val=="Y")echo" checked";?>>
		    </td>
	    </tr>
		
	
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][14][0], $aTabs[5]["OPTIONS"][14][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][14][0])?>"><?echo $aTabs[5]["OPTIONS"][14][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][14][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][14][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][14][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][15][0], $aTabs[5]["OPTIONS"][15][2]);?>
	<tr>
		<td width="20%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][15][0])?>"><?echo $aTabs[5]["OPTIONS"][15][1]?>:</label>
		<td width="80%">
	         <input type="text" size="<?echo $aTabs[5]["OPTIONS"][15][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][15][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][15][0])?>">
	    </td>
	</tr>
	
	
	<?$val = COption::GetOptionString($module, $aTabs[5]["OPTIONS"][16][0], $aTabs[5]["OPTIONS"][16][2]);?>
    <tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][16][0])?>"><?echo $aTabs[5]["OPTIONS"][16][1]?>:</label>
		<td width="60%">
			<select name="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][16][0])?>" id="<?echo htmlspecialcharsbx($aTabs[5]["OPTIONS"][16][0])?>">
			           <?foreach($aTabs[5]["OPTIONS"][16][3][1] as $key => $value):?>
					        <option value="<?echo htmlspecialcharsbx($key)?>"<?if($key==$val) echo ' selected="selected"'?>><?echo htmlspecialcharsEx($value)?></option>
						<?endforeach;?>
			</select>
        </td>
	</tr>
	
	

	
	
<?$tabControl->Buttons();?>
    <input type="submit" name="Update" id="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save" onclick="return provColor()">
	<input type="submit" name="Apply" id="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>" onclick="return provColor()">
	<?if(strlen($_REQUEST["back_url_settings"])>0):?>
		<input type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?echo htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
		<input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
	<?endif?>
	<input type="submit" name="RestoreDefaults" id="Defaults" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="return Default()" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
	
	<?=bitrix_sessid_post();?>
<?$tabControl->End();?>
</form>

<script>
 $(function () {
   <?if(array_search(COption::GetOptionString($module, "typepicker", ""),$settings["colors"])):?>
        $("a.colorsheme.<?=array_search(COption::GetOptionString($module, "typepicker", ""),$settings["colors"])?>").addClass("active"); 
   <?endif;?>	
   <?if(array_search(COption::GetOptionString($module, "pastepicker", ""),$settings["colors"])):?>   
      $("a.altsheme.<?=array_search(COption::GetOptionString($module, "pastepicker", ""),$settings["colors"])?>").addClass("active"); 
   <?endif;?>	
 });
  </script>
