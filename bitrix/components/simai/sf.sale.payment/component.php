<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return false;

   if(!isset($_REQUEST["id"])) die();


    $arResult["ID"] = intval($_REQUEST["id"]);

		
	$arSelect = Array("ID", "NAME","IBLOCK_ID","PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ID" => $arResult["ID"]);

	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	if($ob = $res->GetNextElement()):
				
				
		$arFields = $ob->GetFields();
		$arItem = array();
		$arResult["NAME"] = $arFields["NAME"];
		$arProps = $ob->GetProperties();
		
		$arItem["PROPERTIES"] = $arProps;
		
		$arResult["NUMBER"] = $arProps["NOMER"]["VALUE"];
		$arResult["FIO"] = $arProps["FIO"]["VALUE"];
		$arResult["HASH"] = $arProps["HASH"]["VALUE"];
		$arResult["SUM"] = $arProps["SUM"]["VALUE"];
		$arResult["PRODUCT"] = array();
		
		
		$res1 = CIBlockElement::GetByID($arProps["METHOD"]["VALUE"]);
		if($ar_res = $res1->GetNext())
		  $arResult["METHOD"] = $ar_res['CODE'];

		
		foreach($arProps["PRODUCT"]["VALUE"] as $product){
		  	
			$arProduct = array();
			$arProduct["ID"] = $product["SUB_VALUES"]["PRODUCT_LINK"]["VALUE"];
			$arProduct["NAME"] = $product["SUB_VALUES"]["PRODUCT_FORM"]["VALUE"];
			$arProduct["COUNT"] = $product["SUB_VALUES"]["PRODUCT_COUNT"]["VALUE"];
			$arProduct["SUM"] = $product["SUB_VALUES"]["PRODUCT_SUM"]["VALUE"];
			$arResult["PRODUCT"][]=$arProduct;
		}
		
		$arResult["REQUISITE"] = array();

		foreach($arProps["ADDITIONAL"]["VALUE"] as $requisite){
			  $arResult["REQUISITE"][$requisite["SUB_VALUES"]["CODE_REQUISITE"]["VALUE"]]= $requisite["SUB_VALUES"]["VALUE_REQUISITE"]["VALUE"];
		}
		
				 
	endif;
	

$this->IncludeComponentTemplate();


?>
