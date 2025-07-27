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
		"IBLOCK_ID_PAYMENT" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_IBLOCK_ID_PAYMENT"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '',
			"ADDITIONAL_VALUES" => "Y",
		),
		"LINKS" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_O_PAR_PAYMENT_LINKS"),
			"TYPE" => "STRING",
			"DEFAULT" => '/order/payment/',
		),
	)
);

?>