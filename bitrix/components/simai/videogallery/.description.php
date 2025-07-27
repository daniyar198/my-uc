<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("NAME"),
	"DESCRIPTION" => GetMessage("DESCRIPTION"),
	"COMPLEX" => "Y",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "SIMAI Framework",
		"CHILD" => array(
			"ID" => "videogallery",
			"NAME" => GetMessage("DESC_VIDEO"),
			"SORT" => 30,
		)
	)
);
?>