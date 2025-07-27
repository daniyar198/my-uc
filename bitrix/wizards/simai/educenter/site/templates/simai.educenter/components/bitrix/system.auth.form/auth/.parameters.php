<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"URL_BASKET" => Array(
		"NAME" => getMessage("URL_BASKET"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"URL_ORDER" => Array(
		"NAME" => getMessage("URL_ORDER"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"URL_SUBSCRIBE" => Array(
		"NAME" => getMessage("URL_SUBSCRIBE"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
    "URL_REQUEST" => Array(
        "NAME" => getMessage("URL_REQUEST"),
        "TYPE" => "STRING",
        "DEFAULT" => "",
    )
);
?>