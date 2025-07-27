<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(is_array($arResult["DETAIL_PICTURE"]))
{
    $arFileTmp = CFile::ResizeImageGet(
        $arResult["DETAIL_PICTURE"],
        array("width" => 450, "height" => 450),
        BX_RESIZE_IMAGE_EXACT,
        false
    );
    $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
    $arResult["PREVIEW_IMG"]= array(
        "SRC" => $arFileTmp["src"],
        "WIDTH" => IntVal($arSize[0]),
        "HEIGHT" => IntVal($arSize[1])
    );
}
elseif(is_array($arResult["PICTURE"]))
{
    $arFileTmp = CFile::ResizeImageGet(
        $arResult["PICTURE"],
        array("width" => 450, "height" => 450),
        BX_RESIZE_IMAGE_EXACT,
        false
    );
    $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
    $arResult["PREVIEW_IMG"]= array(
        "SRC" => $arFileTmp["src"],
        "WIDTH" => IntVal($arSize[0]),
        "HEIGHT" => IntVal($arSize[1])
    );
}
$arResult["SECTIONS"]=array();
$arResult["SECT_ITEMS"]=array();
foreach($arResult["ITEMS"] as $key => $arElement)
{
    if($arElement["IBLOCK_SECTION_ID"])
    {
        $arResult["SECT_ITEMS"][$arElement["~IBLOCK_SECTION_ID"]][]=$arElement;
        unset($arResult["ITEMS"][$key]);
    }
}
$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC","NAME"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "SECTION_ID"=>$arResult["ID"],"ACTIVE"=>"Y"),false, Array("UF_*"));
while($res=$ar_result->GetNext())
{
    $arRes=CIBlockSection::GetList(Array("SORT"=>"ASC","NAME"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "SECTION_ID"=>$res["ID"],"ACTIVE"=>"Y"),false, Array("UF_*"));
    while($resS=$arRes->GetNext())
    {
        $res["SECTIONS"][]=$resS;
    }
    $arResult["SECTIONS"][]=$res;
}