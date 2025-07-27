<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
    if($arItem["DISPLAY_ACTIVE_FROM"])
    {
        $arResult["ITEMS"][$key]["DATE_TWO"]=explode(" ",$arItem["DISPLAY_ACTIVE_FROM"]);
    }
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
    if($arItem["IBLOCK_SECTION_ID"] && empty($arResult["SECTION"]))$arSectionId[]=$arItem["IBLOCK_SECTION_ID"];
}
    $arColor=array();
if(!empty($arSectionId))
{

    $arSectionId = array_unique($arSectionId);
    $arResult["SECTIONS"] = array();
    $db_list = CIBlockSection::GetList(Array("sort" => "asc"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arSectionId), false, array("UF_LIST"));
    while ($ar_result = $db_list->GetNext())
    {
        $arResult["SECTIONS"][$ar_result["ID"]] = $ar_result;
        if($ar_result["UF_LIST"])$arColor[]=$ar_result["UF_LIST"];
    }
}
$arColor = array_unique($arColor);
$rsColor = CUserFieldEnum::GetList(array(), array(
    "ID" => $arColor,
));
while($arCol = $rsColor->GetNext())
{
    $arResult["COLOR"][$arCol["ID"]]=$arCol["XML_ID"];
}
?>