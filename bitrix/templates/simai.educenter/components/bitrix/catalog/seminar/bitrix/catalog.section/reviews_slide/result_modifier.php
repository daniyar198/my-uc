<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
			if($arItem["DATE_ACTIVE_FROM"])
			{
				$arParams["ACTIVE_DATE_FORMAT"]=($arParams["ACTIVE_DATE_FORMAT"]?$arParams["ACTIVE_DATE_FORMAT"]:"j F Y, l");
				$arResult["ITEMS"][$key]["DISPLAY_ACTIVE_FROM"]=FormatDate($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arItem["DATE_ACTIVE_FROM"]));
			}
}