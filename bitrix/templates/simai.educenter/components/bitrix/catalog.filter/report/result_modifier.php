<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
    if(is_string($arItem["INPUT_NAME"]))
    {
        $pattern = '/\[([\S]+)\]/';
        preg_match($pattern, $arItem["INPUT_NAME"], $matches);
        if(is_string(getMessage($matches[1])))$arResult["ITEMS"][$key]["NAME"]=getMessage($matches[1]);
    }
}