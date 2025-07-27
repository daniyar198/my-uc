<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SF_IBLOCK_DESC_LIST"),
	"DESCRIPTION" => GetMessage("SF_IBLOCK_DESC_LIST_DESC"),
	"SORT" => 20,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "simai",
		"CHILD" => array(
			"ID" => "banners",
			"NAME" => GetMessage("SF_IBLOCK_DESC_ITEMS"),
			"SORT" => 10,
			"CHILD" => array(
				"ID" => "banner_main",
			),
		),
	),
);

?>