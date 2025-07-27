<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME"        => GetMessage("SIMAI_COMPONENT_NAME"),
	"DESCRIPTION" => "",
	"ICON"        => "/images/icon.gif",
	"SORT"        => 60,
	"CACHE_PATH"  => "Y",
	"PATH"        => array(
		"ID"    => "simai",
		"NAME"  => GetMessage("SIMAI_COMPONENTS_NAME"),
		"CHILD" => array(
			"ID"   => "simai_panel",
			"NAME" => GetMessage("SIMAI_SECTION_NAME"),
			"SORT" => 10,
		),
	),
);
?>