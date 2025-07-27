<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"CURRENT_SECTION" => Array(
		"NAME" => "Текущий раздел",
		"TYPE" => "STRING",
		"DEFAULT" => $_REQUEST["SECTION_ID"],
	),
);
?>
