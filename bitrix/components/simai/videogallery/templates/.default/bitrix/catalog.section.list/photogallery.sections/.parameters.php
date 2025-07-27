<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"NUM_ELEMENTS" => Array(
		"NAME" => GetMessage("NUM_ELEMENTS"),
		"TYPE" => "STRING",
		"DEFAULT" => "5",
	),
	"WIDTH_PREVIEW" => Array(
		"NAME" => GetMessage("WIDTH_PREVIEW"),
		"TYPE" => "STRING",
		"DEFAULT" => "100",
	),
    "HEIGHT_PREVIEW" => Array(
		"NAME" => GetMessage("HEIGHT_PREVIEW"),
		"TYPE" => "STRING",
		"DEFAULT" => "100",
	),
	"SHOW_TITLE" => Array(
		"NAME" => getMessage("SHOW_TITLE"),
		"TYPE" => "STRING",
		"DEFAULT" => "Y",
	)
);
?>
