<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"NUM_ELEMENTS" => Array(
		"NAME" => GetMessage("NUM_ELEMENTS"),
		"TYPE" => "STRING",
		"DEFAULT" => "5",
	),
	"SIZE_PREVIEW" => Array(
		"NAME" => GetMessage("SIZE_PREVIEW"),
		"TYPE" => "STRING",
		"DEFAULT" => "100",
	),
	"IMG_LIST_HEIGHT" => Array(
		"NAME" => GetMessage("IMG_LIST_HEIGHT"),
		"TYPE" => "STRING",
		"DEFAULT" => "400",
	),
	"IMG_LIST_WIDTH" => Array(
		"NAME" => GetMessage("IMG_LIST_WIDTH"),
		"TYPE" => "STRING",
		"DEFAULT" => "400",
	),
    "AJAX_PAGE" => Array(
        "NAME" => GetMessage("VARIABLE_AJAX"),
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ),
	"SHOW_PHOTO_TITLE" => Array(
		"NAME" => getMessage("SHOW_PHOTO_TITLE"),
		"TYPE" => "STRING",
		"DEFAULT" => "Y",
	),
	"LINK_UPLOAD" => Array(
		"NAME" => getMessage("LINK_UPLOAD"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	)
);
?>
