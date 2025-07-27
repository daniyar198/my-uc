<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if (!function_exists("GetTreeRecursive")) 
{
$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IBLOCK_ID" => "#AD#",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000"
	),
	false,
	Array('HIDE_ICONS' => 'Y')
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}