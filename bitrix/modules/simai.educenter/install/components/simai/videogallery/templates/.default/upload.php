<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?$APPLICATION->IncludeComponent(
	"simai:video.loader", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"SECTION_ID" => "",
		"MAX_WIDTH" => $arParams["MAX_WIDTH"],
		"MAX_HEIGHT" => $arParams["MAX_HEIGHT"],
		"DIRECTORY" => $arParams["SEF_FOLDER"],
	),
	false
);?>