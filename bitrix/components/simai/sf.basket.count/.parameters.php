<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"PARAMETERS" => array(
		"BASKET_PATH" => array(
			"PARENT" => "PARAMS",
			"NAME" => GetMessage("SB_C_PAR_BASKET_PATH"),
			"TYPE" => "STRING",
		),
		"CONT_SESSION" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SB_C_PAR_CONT_SESSION"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y"
		),
	)
);
?>
