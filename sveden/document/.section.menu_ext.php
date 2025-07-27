<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if (!function_exists("GetTreeRecursive")) 
{
$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
    "IS_SEF" => "Y", 
    "SEF_BASE_URL" => "/sveden/document/", 
    "SECTION_PAGE_URL" => "#SECTION_CODE#/", 
	"IBLOCK_ID" => "10",
	"DEPTH_LEVEL" => "2",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000"
	),
	false,
	Array('HIDE_ICONS' => 'Y')
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}