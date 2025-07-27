<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
	$arResult["FILIAL"]=array();
	
	
	$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=> $arParams["IBLOCK_ID"], "CODE" => "PROGRAM"));
	if ($prop_fields = $properties->GetNext())
	{
	  $IBLOCK_ID = $prop_fields["LINK_IBLOCK_ID"];
	}
	
	
	$arSelect = Array("ID", "NAME");
	$arFilter = Array("IBLOCK_ID"=> $IBLOCK_ID, "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
	while($ob = $res->GetNextElement())
	{
	 $arFields = $ob->GetFields();
	 $arResult["FILIAL"][$arFields["ID"]]=$arFields["NAME"];
	}