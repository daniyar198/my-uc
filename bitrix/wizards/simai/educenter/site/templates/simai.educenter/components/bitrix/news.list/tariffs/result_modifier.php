<?
$arSectionId=array();
$arItems=array();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
    if($arItem["IBLOCK_SECTION_ID"])
    {
        if(!is_array($arItems[$arItem["IBLOCK_SECTION_ID"]]))$arItems[$arItem["IBLOCK_SECTION_ID"]]=array();
        $arItems[$arItem["IBLOCK_SECTION_ID"]][]=$arItem;
        $arSectionId[]=$arItem["IBLOCK_SECTION_ID"];
    }
}
if(!empty($arSectionId))
{
    $arSectionId = array_unique($arSectionId);
    $arResult["SECTIONS"] = array();
    $db_list = CIBlockSection::GetList(Array("sort" => "asc"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arSectionId), false, array("UF_LIST"));
    while ($ar_result = $db_list->GetNext())
    {
        $arResult["SECTIONS"][$ar_result["ID"]] = $ar_result;
    }
}
foreach($arResult["SECTIONS"] as $cell=>$arSection)
{
    if(is_array($arItems[$cell]))$arResult["SECTIONS"][$cell]["ITEMS"]=$arItems[$cell];
}