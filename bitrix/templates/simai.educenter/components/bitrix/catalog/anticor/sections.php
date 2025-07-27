<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
    <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"map.section", 
	array(
		"IBLOCK_TYPE" => "organization",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arParams["SECTION_ID"],
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => "N",
		"COMPONENT_TEMPLATE" => "map.section",
		"SECTION_CODE" => $arParams["SECTION_CODE"],
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "2",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_URL" => ""
	),
	false
);?>
