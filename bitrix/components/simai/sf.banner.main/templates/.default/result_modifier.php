<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!defined("SF_LIB_INCLUDED") || SF_LIB_INCLUDED !== true) require_once $_SERVER['DOCUMENT_ROOT'] . '/simai/lib/init.php';
if (!isset($arParams["SF_BANNER_HEIGHT"])) $arParams["SF_BANNER_HEIGHT"] = 350;
if (!isset($arParams["SF_BANNER_DELAY"])) $arParams["SF_BANNER_DELAY"] = 3000;
if (isset($arParams["SF_BANNER_EFFECT"])) {
	$arParams["SF_BANNER_EFFECT"] = mb_strtolower($arParams["SF_BANNER_EFFECT"]);
} 
else {
	$arParams["SF_BANNER_EFFECT"] = "fade";
}

$arResult["SWIPER_SALT"] = \SIMAI\Main\Utility::getRandomLine();

foreach($arResult["ITEMS"] as $key=>$arItem):
	$arResult["ITEMS"][$key]["SALT"] = \SIMAI\Main\Utility::getRandomLine();
endforeach;
?>