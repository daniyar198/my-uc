<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks = Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch()):
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];
endwhile;
	
$arCIBlocks = Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["CATALOG_IBLOCK_TYPE"]!="-"?$arCurrentValues["CATALOG_IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch()):
	$arCIBlocks[$arRes["ID"]] = $arRes["NAME"];
endwhile;

$arPrices = array();

if(CModule::IncludeModule("catalog")):
	$res = CCatalogGroup::GetList($v1="sort", $v2="asc");
	while($arr = $res->Fetch()):
		$arPrices["price_".$arr["NAME"]] = GetMessage("SB_O_PAR_PRICE")."[".$arr["NAME"]."] ".$arr["NAME_LANG"];
	endwhile;
endif;

$res = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>(isset($arCurrentValues["CATALOG_IBLOCK_ID"])?$arCurrentValues["CATALOG_IBLOCK_ID"]:$arCurrentValues["ID"])));
while ($arr = $res->Fetch()):
	if ($arr["MULTIPLE"] != "Y" && ($arr["PROPERTY_TYPE"] == "S" || $arr["PROPERTY_TYPE"] == "N")):
		$arPrices["prop_".($arr["CODE"] != "" ? $arr["CODE"] : $arr["ID"])] = GetMessage("SB_O_PAR_PROP")."[".$arr["CODE"]."] ".$arr["NAME"];
	endif;
endwhile;

$arFields2User = Array();
$arFields2User["USERNAME"] = GetMessage("SB_O_PAR_USERNAME");
$arFields2User["PHONE"] = GetMessage("SB_O_PAR_PHONE");
$arFields2User["CITY"] = GetMessage("SB_O_PAR_CITY");
$arFields2User["ZIP"] = GetMessage("SB_O_PAR_ZIP");
$arFields2User["ADR"] = GetMessage("SB_O_PAR_ADR");
$arFields2User["EMAIL"] = GetMessage("SB_O_PAR_EMAIL");

$arComponentParameters = array(
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_IBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"CATALOG_IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_CATALOG_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"CATALOG_IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_CATALOG_IBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arCIBlocks,
			"DEFAULT" => '',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),	
		"CATALOG_IBLOCK_ID_2" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_CATALOG_IBLOCK_ID")."(2)",
			"TYPE" => "LIST",
			"VALUES" => $arCIBlocks,
			"DEFAULT" => '',
			"ADDITIONAL_VALUES" => "Y",
		),
		"COUPON_IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("COUPON_IBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arCIBlocks,
			"DEFAULT" => '',
			"ADDITIONAL_VALUES" => "Y",
		),
		"CATALOG_PRICE_PROPERTY" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_CATALOG_PRICE_PROPERTY"),
			"TYPE" => "LIST",
			"VALUES" => $arPrices,
			"ADDITIONAL_VALUES" => "Y",
		),
		"FIELDS_2_USER" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_FIELDS_2_USER"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arFields2User,
			"DEFAULT" => Array("USERNAME","PHONE","CITY","ZIP","ADR","EMAIL"),
		),
		"FIELDS_2_USER_REQ" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_FIELDS_2_USER_REQ"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arFields2User,
			"DEFAULT" => Array("USERNAME","PHONE","CITY","ZIP","ADR"),
		),
		"EMAIL_TO" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_EMAIL"),
			"TYPE" => "STRING",
		),
		"EMAIL_SUBJ" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_EMAIL_SUBJ"),
			"TYPE" => "STRING",
		),
		"ITEMS_LINKS" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_ITEMS_LINKS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y"
		),
		"DISPLAY_CENTS" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_DISPLAY_CENTS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y"
		),
		"CONT_SESSION" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_CONT_SESSION"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y"
		),
	)
);

?>