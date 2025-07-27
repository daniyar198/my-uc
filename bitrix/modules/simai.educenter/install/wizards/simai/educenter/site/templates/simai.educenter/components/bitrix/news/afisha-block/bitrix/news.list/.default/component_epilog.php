<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
if(!empty($arResult["SECTION"]["PATH"]))
{
    $arName=array_pop($arResult["SECTION"]["PATH"]);
    $GLOBALS["APPLICATION"]->SetTitle($arName["NAME"]);
}