<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"PAGE_CALENDAR" => Array(
		"NAME" => getMessage("PAGE_CALENDAR"),
		"TYPE" => "STRING"
	),
    "IBLOCK_ID_HOLIDAYS" => Array(
		"NAME" => getMessage("IBLOCK_ID_HOLIDAYS"),
		"TYPE" => "STRING"
	),
    "IBLOCK_ID_ORDER" => Array(
		"NAME" => getMessage("IBLOCK_ID_ORDER"),
		"TYPE" => "STRING"
	),
    "TODAY_DATE" => Array(
		"NAME" => getMessage("TODAY_DATE"),
		"TYPE" => "STRING"
	)
);