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

$arSection = Array();
$db_section = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => ($arCurrentValues["IBLOCK_ID"]!="-"?$arCurrentValues["IBLOCK_ID"]:"")));
while($arRes = $db_section->Fetch()):
	$arSection[$arRes["ID"]] = $arRes["NAME"];
endwhile;
	
$arComponentParameters = array(
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => getMessage("SIMAI_FORM_INFOBLOK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "",
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
		"SECTION_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => getMessage("SIMAI_FORM_INFOBLOK_SECTION"),
			"TYPE" => "LIST",
			"VALUES" => $arSection,
			"DEFAULT" => '',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"MAX_WIDTH" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MAX_WIDTH"),
			"TYPE" => "STRING",
			"DEFAULT" => "1000",
		),
		"MAX_HEIGHT" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MAX_HEIGHT"),
			"TYPE" => "STRING",
			"DEFAULT" => "1000",
		),
		"DIRECTORY" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("DIRECTORY"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
	)
);

?>