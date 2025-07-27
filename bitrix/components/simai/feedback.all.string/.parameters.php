<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks = Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch()):
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];
endwhile;

$arEvents = Array();
$db_events = CIBlock::GetList(Array("LID"=>LANGUAGE_ID));
while($arRes = $db_events->Fetch()):
	$arIBlocks[$arRes["TYPE_ID"]] = $arRes["NAME"];
endwhile;
	
$arComponentParameters = array(

    "GROUPS" => array(
		"CAPTCHA_SETTINGS" => array(
			"NAME" => GetMessage("SIMAI_CAPTCHA_SETTINGS"),
		),
		"POST_SETTINGS" => array(
			"NAME" => GetMessage("SIMAI_POST_SETTINGS"),
		),
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => getMessage("SIMAI_FORM_INFOBLOK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => getMessage("SIMAI_FORM_INFOBLOK_NAME"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"ADD_ACTIVE" => Array(
			"PARENT" => "BASE",
			"NAME" => getMessage("SIMAI_FORM_ADD_ACTIVE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'Y',
		),
		"OK_MSG" => Array(
			"PARENT" => "BASE",
			"NAME" => getMessage("SIMAI_FORM_SUCCESS_MESSAGE"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		),		
		"EMAIL" => Array(
			"PARENT" => "POST_SETTINGS",
			"NAME" => getMessage("SIMAI_FORM_TO_EMAIL"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		),
		"EMAIL_SUBJ" => Array(
			"PARENT" => "POST_SETTINGS",
			"NAME" => getMessage("SIMAI_FORM_MESSAGE_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		),
		"THEME_SENDER" => Array(
			"PARENT" => "POST_SETTINGS",
			"NAME" => getMessage("SIMAI_FORM_THEME_SENDER"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		),
		"MESSAGE_SENDER" => Array(
			"PARENT" => "POST_SETTINGS",
			"NAME" => getMessage("SIMAI_FORM_MESSAGE_SENDER"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		),
		"USE_GOOGLE_CAPTCHA" => Array(
			"PARENT" => "CAPTCHA_SETTINGS",
			"NAME" => getMessage("SIMAI_USE_GOOGLE_CAPTCHA"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'N',
			"REFRESH" => "Y",
		),
	)
);
	if($arCurrentValues["USE_GOOGLE_CAPTCHA"] == "Y"){
		
		$arComponentParameters["PARAMETERS"]["PUBLIC_KEY"] = Array(
			"PARENT" => "CAPTCHA_SETTINGS",
			"NAME" => getMessage("SIMAI_GOOGLE_PUBLIC_KEY"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		);
		
	    $arComponentParameters["PARAMETERS"]["PRIVATE_KEY"] = Array(
			"PARENT" => "CAPTCHA_SETTINGS",
			"NAME" => getMessage("SIMAI_GOOGLE_PRIVATE_KEY"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		);
	}

?>