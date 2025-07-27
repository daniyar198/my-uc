<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters['IBLOCK_ID'] = array(
	'PARENT' => 'BASE',
	'NAME' => GetMessage("CP_BCC_TPL_IBLOCK_ID"),
	'TYPE' => 'STRING'
);
$arTemplateParameters['SHOW_INFO'] = array(
	'PARENT' => 'BASE',
	'NAME' => GetMessage("CP_BCC_TPL_SHOW_INFO"),
	'TYPE' => 'CHECKBOX'
);