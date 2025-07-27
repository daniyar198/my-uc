<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
    if(is_array($arItem["PREVIEW_PICTURE"]))
    {
        $arFileTmp = CFile::ResizeImageGet(
            $arItem["PREVIEW_PICTURE"],
            array("width" => 720, "height" => 463),
            BX_RESIZE_IMAGE_EXACT,
            false
        );
        $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
        $arResult["ITEMS"][$key]["PREVIEW_IMG"]= array(
            "SRC" => $arFileTmp["src"],
            "WIDTH" => IntVal($arSize[0]),
            "HEIGHT" => IntVal($arSize[1]),
            "OLD_LINK" => $arItem["PREVIEW_PICTURE"]["SRC"]
        );
    }
    elseif(is_array($arItem["DETAIL_PICTURE"]))
    {
        $arFileTmp = CFile::ResizeImageGet(
            $arItem["DETAIL_PICTURE"],
            array("width" => 720, "height" => 463),
            BX_RESIZE_IMAGE_EXACT,
            false
        );
        $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
        $arResult["ITEMS"][$key]["PREVIEW_IMG"]= array(
            "SRC" => $arFileTmp["src"],
            "WIDTH" => IntVal($arSize[0]),
            "HEIGHT" => IntVal($arSize[1]),
            "OLD_LINK" => $arItem["DETAIL_PICTURE"]["SRC"]
        );
    }
    if(is_array($arItem["DISPLAY_PROPERTIES"]["MORE_PRODUCTS"]))
    {
        $arFilter = Array("IBLOCK_ID" => $arItem["DISPLAY_PROPERTIES"]["MORE_PRODUCTS"]["LINK_IBLOCK_ID"], "SECTION_ID" => $arItem["DISPLAY_PROPERTIES"]["MORE_PRODUCTS"]["VALUE"],"!PROPERTY_REQUIRED"=>false, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, array());
        $countRes=$res->SelectedRowsCount();
        if($countRes>0)$arResult["ITEMS"][$key]["PRICE_FROM"]=1;
    }
}
if($arResult["ID"])
{
    $arItem=array();
    $ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "SECTION_ID"=>$arResult["ID"]),false, Array());
    while($res=$ar_result->GetNext())
    {
        $arItem=array();
        $arItem["ID"]=$res["ID"];
        $arItem["NAME"]=$res["NAME"];
        $arItem["DETAIL_PAGE_URL"]=$res["SECTION_PAGE_URL"];
        $arItem["PREVIEW_TEXT"]=$res["DESCRIPTION"];
        if($res["PICTURE"])
        {
               $arFileTmp = CFile::ResizeImageGet(
                   $res["PICTURE"],
                   array("width" => 720, "height" => 463),
                   BX_RESIZE_IMAGE_EXACT,
                   false
               );
               $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
               $arItem["PREVIEW_IMG"]= array(
                   "SRC" => $arFileTmp["src"],
                   "WIDTH" => IntVal($arSize[0]),
                   "HEIGHT" => IntVal($arSize[1]),
                   "OLD_LINK" => $arItem["DETAIL_PICTURE"]["SRC"]
               );
        }
        $arResult["ITEMS"][]=$arItem;
    }
}