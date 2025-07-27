<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach($arResult["SECTIONS"] as $key => $arItem)
{
    if (is_array($arItem["PICTURE"]))
    {
        $arFileTmp = CFile::ResizeImageGet($arItem["PICTURE"],   array("width" => 720, "height" => 463),
            BX_RESIZE_IMAGE_EXACT,
            false);
        $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"] . $arFileTmp["src"]);
        $arResult["SECTIONS"][$key]["PREVIEW_IMG"] = array(
            "SRC" => $arFileTmp["src"],
            "WIDTH" => IntVal($arSize[0]) ,
            "HEIGHT" => IntVal($arSize[1]) ,
            "OLD_LINK" => $arItem["PICTURE"]["SRC"]
        );
    }
    elseif (is_array($arItem["DETAIL_PICTURE"]))
    {
        $arFileTmp = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"],   array("width" => 720, "height" => 463),
            BX_RESIZE_IMAGE_EXACT,
            false);
        $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"] . $arFileTmp["src"]);
        $arResult["SECTIONS"][$key]["PREVIEW_IMG"] = array(
            "SRC" => $arFileTmp["src"],
            "WIDTH" => IntVal($arSize[0]) ,
            "HEIGHT" => IntVal($arSize[1]) ,
            "OLD_LINK" => $arItem["DETAIL_PICTURE"]["SRC"]
        );
    }
}