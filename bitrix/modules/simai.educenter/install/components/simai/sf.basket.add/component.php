<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return false;
if(!CModule::IncludeModule("simai.basket"))
	return false;

$arParams["ITEM_ID"] = IntVal($arParams["ITEM_ID"]);

if ($arParams["ITEM_ID"] > 0):
	$this->IncludeComponentTemplate();
else:
	return false;
endif;
?>