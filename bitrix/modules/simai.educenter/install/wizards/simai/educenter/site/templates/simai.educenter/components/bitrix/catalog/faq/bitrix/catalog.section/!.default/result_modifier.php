<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if($arParams["NOT_SHOW_SECTION"]!="Y"):
    $arResult["SECTIONS"] = Array();
    $arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "GLOBAL_ACTIVE"=>"Y","ACTIVE"=>"Y");
    $res = CIBlockSection::GetList(Array("left_margin"=>"asc"), $arFilter);
    while($arr = $res->GetNext()):
        $arResult["SECTIONS"][$arr["ID"]]["NAME"] = $arr["NAME"];
        $arResult["SECTIONS"][$arr["ID"]]["SECTION_PAGE_URL"] = $arr["SECTION_PAGE_URL"];
    endwhile;
endif;
foreach($arResult["ITEMS"] as $key=>$arItem)
{
    $rsUser = CUser::GetByID($arItem["CREATED_BY"]);
    $arUser = $rsUser->Fetch();
    $arResult["ITEMS"][$key]["AUTHOR"]["NAME"]=($arUser["NAME"]?$arUser["NAME"].($arUser["LAST_NAME"]?" ".$arUser["LAST_NAME"]:""):"");
    $arResult["ITEMS"][$key]["AUTHOR"]["LOGIN"]=$USER->GetLogin();
}