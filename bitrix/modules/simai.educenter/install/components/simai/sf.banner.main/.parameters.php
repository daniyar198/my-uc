<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
if (!defined("SF_LIB_INCLUDED") || SF_LIB_INCLUDED !== true) 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/simai/lib/init.php';

if (!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(array(
	"-" => " "
));

$arIBlocks = array();
$db_iblock = CIBlock::GetList(array(
	"SORT" => "ASC"
), array(
	"SITE_ID" => $_REQUEST["site"],
	"TYPE" => ($arCurrentValues["IBLOCK_TYPE"] != "-" ? $arCurrentValues["IBLOCK_TYPE"] : "")
));
while ($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$arSorts      = array(
	"ASC" => GetMessage("SF_IBLOCK_DESC_ASC"),
	"DESC" => GetMessage("SF_IBLOCK_DESC_DESC")
);
$arEffect     = array(
	"SLIDE" => GetMessage("SF_BANNER_EFFECT_SLIDE"),
	"FADE" => GetMessage("SF_BANNER_EFFECT_FADE"),
	"CUBE" => GetMessage("SF_BANNER_EFFECT_CUBE"),
	"COVERFLOW" => GetMessage("SF_BANNER_EFFECT_COVERFLOW"),
	"FLIP" => GetMessage("SF_BANNER_EFFECT_FLIP")
);
$arSortFields = array(
	"ID" => GetMessage("SF_IBLOCK_DESC_FID"),
	"NAME" => GetMessage("SF_IBLOCK_DESC_FNAME"),
	"ACTIVE_FROM" => GetMessage("SF_IBLOCK_DESC_FACT"),
	"SORT" => GetMessage("SF_IBLOCK_DESC_FSORT"),
	"TIMESTAMP_X" => GetMessage("SF_IBLOCK_DESC_FTSAMP")
);

$arProperty_LNS = array();
$rsProp         = CIBlockProperty::GetList(array(
	"sort" => "asc",
	"name" => "asc"
), array(
	"ACTIVE" => "Y",
	"IBLOCK_ID" => (isset($arCurrentValues["IBLOCK_ID"]) ? $arCurrentValues["IBLOCK_ID"] : $arCurrentValues["ID"])
));
while ($arr = $rsProp->Fetch()) {
	$arProperty[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
	if (in_array($arr["PROPERTY_TYPE"], array(
		"L",
		"N",
		"S"
	))) {
		$arProperty_LNS[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
	}
}

$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SF_IBLOCK_DESC_LIST_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y"
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SF_IBLOCK_DESC_LIST_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '={$_REQUEST["ID"]}',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y"
		),
		"SF_BANNER_COUNT" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SF_BANNER_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => ""
		),
		"SF_BANNER_HEIGHT" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SF_BANNER_HEIGHT"),
			"TYPE" => "STRING",
			"DEFAULT" => "350"
		),
		"SF_BANNER_WIDTH" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SF_BANNER_WIDTH"),
			"TYPE" => "STRING",
			"DEFAULT" => "1920"
		),
		"SF_BANNER_RESTRICT" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SF_BANNER_RESTRICT"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y"
		),
		"SF_BANNER_AUTOPLAY" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SF_BANNER_AUTOPLAY"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"REFRESH" => "Y"
		),
		"SORT_BY1" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("SF_IBLOCK_DESC_IBORD1"),
			"TYPE" => "LIST",
			"DEFAULT" => "ACTIVE_FROM",
			"VALUES" => $arSortFields,
			"ADDITIONAL_VALUES" => "Y"
		),
		"SORT_ORDER1" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("SF_IBLOCK_DESC_IBBY1"),
			"TYPE" => "LIST",
			"DEFAULT" => "DESC",
			"VALUES" => $arSorts,
			"ADDITIONAL_VALUES" => "Y"
		),
		"SORT_BY2" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("SF_IBLOCK_DESC_IBORD2"),
			"TYPE" => "LIST",
			"DEFAULT" => "SORT",
			"VALUES" => $arSortFields,
			"ADDITIONAL_VALUES" => "Y"
		),
		"SORT_ORDER2" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("SF_IBLOCK_DESC_IBBY2"),
			"TYPE" => "LIST",
			"DEFAULT" => "ASC",
			"VALUES" => $arSorts,
			"ADDITIONAL_VALUES" => "Y"
		),
		"FILTER_NAME" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("SF_IBLOCK_FILTER"),
			"TYPE" => "STRING",
			"DEFAULT" => ""
		),
		"CACHE_TIME" => array(
			"DEFAULT" => 3600
		),
		"CACHE_FILTER" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("SF_IBLOCK_CACHE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N"
		),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("SF_IBLOCK_USE_ACCESS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y"
		)
	)
);
if ($arCurrentValues["SF_BANNER_AUTOPLAY"] == "Y") {
	$arComponentParameters["PARAMETERS"]["SF_BANNER_DELAY"] = array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("SF_BANNER_DELAY"),
		"TYPE" => "STRING",
		"DEFAULT" => "3000",
		"ADDITIONAL_VALUES" => "Y"
	);
}
$arComponentParameters["PARAMETERS"]["SF_BANNER_EFFECT"] = array(
	"PARENT" => "BASE",
	"NAME" => GetMessage("SF_BANNER_EFFECT"),
	"TYPE" => "LIST",
	"DEFAULT" => "FADE",
	"VALUES" => $arEffect
);

$arComponentParameters["PARAMETERS"]["SF_BANNER_MODIFIER_DESCRIPTION"] = array(
	"PARENT" => "BASE",
	"NAME" => GetMessage("SF_BANNER_MODIFIER_DESCRIPTION"),
	"TYPE" => "STRING",
	"DEFAULT" => "py-4",
);

$arComponentParameters["PARAMETERS"]["SF_BANNER_MODIFIER_TITLE"] = array(
	"PARENT" => "BASE",
	"NAME" => GetMessage("SF_BANNER_MODIFIER_TITLE"),
	"TYPE" => "STRING",
	"DEFAULT" => "mb-3 t-light",
);

$arComponentParameters["PARAMETERS"]["SF_BANNER_MODIFIER_TEXT"] = array(
	"PARENT" => "BASE",
	"NAME" => GetMessage("SF_BANNER_MODIFIER_TEXT"),
	"TYPE" => "STRING",
	"DEFAULT" => "mb-3",
);

$arComponentParameters["PARAMETERS"]["SF_BANNER_MODIFIER_BUTTONS"] = array(
	"PARENT" => "BASE",
	"NAME" => GetMessage("SF_BANNER_MODIFIER_BUTTONS"),
	"TYPE" => "STRING",
	"DEFAULT" => "",
);

$arComponentParameters["PARAMETERS"]["SF_BANNER_MODIFIER_IMAGE"] = array(
	"PARENT" => "BASE",
	"NAME" => GetMessage("SF_BANNER_MODIFIER_IMAGE"),
	"TYPE" => "STRING",
	"DEFAULT" => "hidden-md-down",
);