<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return false;


$arResult["COUNT_ITEMS"] = 0;
$arResult["COUNT_COMMON"] = 0;

if (isset($_SESSION['simai_basket_items']) && is_array($_SESSION['simai_basket_items']) && count($_SESSION['simai_basket_items']) > 0):
	foreach($_SESSION['simai_basket_items'] as $item_id=>$item_count):
		if ($item_id > 0):
			$arResult["ITEMS_IDS"][] = $item_id;
			$arResult["COUNT_ITEMS"]++;
			$arResult["COUNT_COMMON"] = $arResult["COUNT_COMMON"] + $item_count["COUNT"];
		endif;
	endforeach;
endif;

$this->IncludeComponentTemplate();

CAjax::Init();
?>