<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arParams["SPECIALIST_ID"])
{
    $res = CIBlockElement::GetByID($arParams["SPECIALIST_ID"]);
    if($ar_res = $res->GetNext())
        $arResult["DOCTOR_NAME"]=$ar_res["NAME"];
}