<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
	$arResult["FILIAL"]=array();
	$arSelect = Array("ID", "NAME");
	$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_AREA"], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
	while($ob = $res->GetNextElement())
	{
	 $arFields = $ob->GetFields();
	 $arResult["FILIAL"][$arFields["ID"]]=$arFields["NAME"];
	}
?>