<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
   "bitrix:menu.sections",
   "",
   Array(
      "IBLOCK_ID" => "26",
      "SECTION_URL" => "", 
      "DEPTH_LEVEL" => "2",
      "CACHE_TIME" => "3600" 
   )
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);


?>