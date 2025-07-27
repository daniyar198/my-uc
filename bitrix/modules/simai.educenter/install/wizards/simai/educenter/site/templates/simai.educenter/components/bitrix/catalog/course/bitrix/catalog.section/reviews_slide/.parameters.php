<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(CModule::IncludeModule("iblock"))
{
    $arTemplateParameters = array(
        "BG_URL" => Array(
            "NAME" => getMessage("BG_URL"),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "ACTIVE_DATE_FORMAT" => CIBlockParameters::GetDateFormat(GetMessage("T_IBLOCK_DESC_ACTIVE_DATE_FORMAT"), "ADDITIONAL_SETTINGS")
    );
}