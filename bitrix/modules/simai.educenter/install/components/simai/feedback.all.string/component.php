<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if($arParams["USE_GOOGLE_CAPTCHA"] =="Y"):
?><script src='https://www.google.com/recaptcha/api.js'></script><?
endif;

if(!CModule::IncludeModule("iblock"))
	return false;

$arResult["ERRORS"] = Array();

$arParams["IBLOCK_ID"] = IntVal($arParams["IBLOCK_ID"]);
$arParams["EMAIL"] = trim($arParams["EMAIL"]);
$arParams["EMAIL_SUBJ"] = trim($arParams["EMAIL_SUBJ"]);
$arParams["OK_MSG"] = trim($arParams["OK_MSG"]);


include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");


$rsET = CEventType::GetList(Array("TYPE_ID" => "SIMAI_FEEDBACK_ALL_STRING"));
if ($rsET->Fetch()):

else:
	$et = new CEventType;
	$et->Add(array(
		"LID" => LANGUAGE_ID,
		"EVENT_NAME" => "SIMAI_FEEDBACK_ALL_STRING",
		"NAME" => getMessage("SIMAI_FORM_EVENT_NAME"),
		"DESCRIPTION" => getMessage("SIMAI_FORM_EVENT_DESCRIPTION"),
	));
	
	$arSites = array();
	$sites = CSite::GetList(($b=""), ($o=""), Array("LANGUAGE_ID"=>LANGUAGE_ID));
	while ($site = $sites->Fetch()):
		$arSites[] = $site["LID"];
	endwhile;
	
	if(count($arSites) > 0):
		$emess = new CEventMessage;
		$emess->Add(array(
			"ACTIVE" => "Y",
			"EVENT_NAME" => "SIMAI_FEEDBACK_ALL_STRING",
			"LID" => $arSites,
			"EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
			"EMAIL_TO" => "#EMAIL#",
			"SUBJECT" => "#EMAIL_SUBJ#",
			"BODY_TYPE" => "html",
			"MESSAGE" => "#MESSAGE#"
		));
		
		$emess = new CEventMessage;
		$emess->Add(array(
			"ACTIVE" => "Y",
			"EVENT_NAME" => "SIMAI_FEEDBACK_ALL_STRING",
			"LID" => $arSites,
			"EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
			"EMAIL_TO" => "#EMAIL_FROM#",
			"SUBJECT" => "#THEME_SENDER#",
			"BODY_TYPE" => "html",
			"MESSAGE" => "#MESSAGE_SENDER#"
		));
	endif;
endif;
	

$arProps = array();
$arPropsT = array();
$arPropsR = array();
$arPropsD = array();
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arParams["IBLOCK_ID"]));
while ($arr = $rsProp->Fetch()):
	if ($arr["MULTIPLE"] != "Y"):
	
		$arProps[($arr["CODE"] != "" ? $arr["CODE"] : $arr["ID"])] = array("NAME"=>$arr["NAME"],"PROPERTY_TYPE"=>$arr["PROPERTY_TYPE"]);
		if ($arr["USER_TYPE"] == "HTML" || $arr["USER_TYPE"] == "TEXT"):
			$arPropsT[($arr["CODE"] != "" ? $arr["CODE"] : $arr["ID"])] = $arr["NAME"];
		endif;
		if ($arr["IS_REQUIRED"] == "Y"):
			$arPropsR[($arr["CODE"] != "" ? $arr["CODE"] : $arr["ID"])] = $arr["NAME"];
		elseif ($arr["CODE"][0] == "_"):
			$arPropsD[($arr["CODE"] != "" ? $arr["CODE"] : $arr["ID"])] = $arr["NAME"];
		endif;
		
	
	endif;
endwhile;

if ($_POST['FB_SUBMIT'] != ''||isset($_POST['g-recaptcha-response'])):

	foreach($arPropsR as $field_code => $field_name):
		if (trim($_POST["PROP"][$field_code]) == ""):
			$arResult["ERRORS"][] = getMessage("SIMAI_FORM_ERROR_MASSAGE_BEFOR")." &laquo;".$arPropsR[$field_code]."&raquo; ".getMessage("SIMAI_FORM_ERROR_MASSAGE_AFTER");
		endif;
	endforeach;
	
	

	
	
	if($arParams["USE_GOOGLE_CAPTCHA"] =="Y"):
	
	   require "recapcha/autoload.php";
	   
	   $recaptcha = new \ReCaptcha\ReCaptcha($arParams["PRIVATE_KEY"]);
       $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
       if (!$resp->isSuccess()):
	   
	     foreach ($resp->getErrorCodes() as $code) {
                $arResult["ERRORS"][] = $code;
            }
			
	   endif;
	
	else:
	
		$cpt = new CCaptcha();
		if (!$cpt->CheckCode($_POST["CAPTCHA_WORD"], $_POST["CAPTCHA_SID"])):
				$arResult["ERRORS"][] = getMessage("SIMAI_FORM_CAPTCHA_ERROR_MASSAGE");
		endif;
		
	endif;	
		


	if (count($arResult["ERRORS"]) == 0):
		$fb_name = getMessage("SIMAI_FORM_MASSAGE_TITLE")." (".date('d.m.Y, H:i').")";
		$fb_html = "";
		foreach($arProps as $field_code => $field_name):
			if (array_key_exists($field_code,$arPropsD)):
				$fb_html = $fb_html."<br><b>".$field_name["NAME"]."</b>";		
			else:
				$fb_html = $fb_html."<br><i>".$field_name["NAME"]."</i>: ".strip_tags($_POST["PROP"][$field_code]);
			endif;
		endforeach;
		
		$props = Array();
	
		foreach ($arProps as $field => $val):
		  if($val["PROPERTY_TYPE"]=="S"){
			if (array_key_exists($field,$arPropsT)):
				$props[$field] = Array("VALUE"=>Array("TEXT"=>strip_tags(trim($_POST["PROP"][$field])),"TYPE"=>"text"));
			else:
				$props[$field] = strip_tags(trim($_POST["PROP"][$field]));
			endif;
		  }else{
			  $props[$field]=array( "name" => $_FILES["PROP"]["name"][$field],
                                    "size" => $_FILES["PROP"]["size"][$field],
                                    "tmp_name" => $_FILES["PROP"]["tmp_name"][$field],
                                    "type" => $_FILES["PROP"]["type"][$field]);
		  }
		endforeach;
		
		
		$el = new CIBlockElement;
		$arr = Array(
			"IBLOCK_SECTION" => false,
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ACTIVE" => ($arParams["ADD_ACTIVE"]=="Y"?"Y":"N"),
			"NAME" => $fb_name,
			"PROPERTY_VALUES" => $props
		);
	
		if ($ID = $el->Add($arr)):


			$db_props = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $ID, "sort", "asc", Array("CODE"=>"DOCUMENT"));
			if($ar_props = $db_props->Fetch()):
				$prop["DOCUMENT"] = $ar_props["VALUE"];
			endif;
				$fb_html .= '';
				if($prop["DOCUMENT"] != '')
					$fb_html .= '<a style="padding-top: 10px; padding-bottom:10px;" href="http://'.SITE_SERVER_NAME.CFile::GetPath($prop["DOCUMENT"]).'">FILE</a><br>';
			
			$arEventFields = array(
				"EMAIL" => $arParams["EMAIL"],
				"EMAIL_FROM" => $_POST["PROP"]["EMAIL"],
				"EMAIL_SUBJ" => $arParams["EMAIL_SUBJ"],
				"THEME_SENDER" => $arParams["THEME_SENDER"],
				"MESSAGE_SENDER" => $arParams["MESSAGE_SENDER"],
				"MESSAGE" => $fb_html
			);
			CEvent::Send("SIMAI_FEEDBACK_ALL_STRING", SITE_ID, $arEventFields);
			
			LocalRedirect($APPLICATION->GetCurPage()."?inf=ok"); die();
		else:
			$arResult["ERRORS"][] = getMessage("SIMAI_FORM_BD_ERROR");
		endif;

	endif;
endif;

$arResult["FIELDS"] = $arProps;
$arResult["FIELDS_TXT"] = $arPropsT;
$arResult["FIELDS_REQ"] = $arPropsR;
$arResult["FIELDS_DIV"] = $arPropsD;


$arResult["CAP_CODE"] = $GLOBALS["APPLICATION"]->CaptchaGetCode();


$this->IncludeComponentTemplate();
?>
