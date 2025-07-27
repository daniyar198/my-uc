<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
if(is_array($arResult["DISPLAY_PROPERTIES"]["YOUTUBE"]))
{
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $arResult["DISPLAY_PROPERTIES"]["YOUTUBE"]["VALUE"], $match)) {
        $arResult["YOUTUBE_IDENTIFIER"] = $match[1];
    }
}
if(is_array($arResult["DETAIL_PICTURE"]))
{
				$arFileTmp = CFile::ResizeImageGet(
					$arResult["DETAIL_PICTURE"],
					array("width" => 1170, "height" => 900),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					false
				);
				$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
				$arResult["PREVIEW_IMG"]= array(
					"SRC" => $arFileTmp["src"],
					"WIDTH" => IntVal($arSize[0]),
					"HEIGHT" => IntVal($arSize[1]),
					"OLD_LINK" => $arResult["DETAIL_PICTURE"]["SRC"],
					"DESCRIPTION" => $arResult["DETAIL_PICTURE"]["DESCRIPTION"]
				);
}
elseif(is_array($arResult["PREVIEW_PICTURE"]))
{
				$arFileTmp = CFile::ResizeImageGet(
					$arResult["PREVIEW_PICTURE"],
					array("width" => 1170, "height" => 900),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					false
				);
				$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
				$arResult["PREVIEW_IMG"]= array(
					"SRC" => $arFileTmp["src"],
					"WIDTH" => IntVal($arSize[0]),
					"HEIGHT" => IntVal($arSize[1]),
					"OLD_LINK" => $arResult["PREVIEW_PICTURE"]["SRC"],
					"DESCRIPTION" => $arResult["PREVIEW_PICTURE"]["DESCRIPTION"]
				);
}
$arResult["MORE_PHOTO"]=array();
if(is_array($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]))
{
	if(is_array($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"][0]))
	{
		foreach($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"] as $key=>$arItem)
		{
					$arFileTmp = CFile::ResizeImageGet(
					$arItem,
					array("width" => 600, "height" => 600),
					BX_RESIZE_IMAGE_EXACT,
					false
				);
				$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
				$arResult["MORE_PHOTO"][$key]= array(
					"SRC" => $arFileTmp["src"],
					"WIDTH" => IntVal($arSize[0]),
					"HEIGHT" => IntVal($arSize[1]),
					"DESCRIPTION" => $arItem["DESCRIPTION"],
					"OLD_LINK" => $arItem["SRC"],
				);
		}
	}
	else
	{
		$arFileTmp = CFile::ResizeImageGet(
		$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"],
		array("width" => 600, "height" => 600),
		BX_RESIZE_IMAGE_EXACT,
		false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
		$arResult["MORE_PHOTO"][0]= array(
			"SRC" => $arFileTmp["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
			"DESCRIPTION" => $arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["DESCRIPTION"],
			"OLD_LINK" => $arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["SRC"],
		);
	}
}
$res = CIBlockElement::GetList(array('ACTIVE_FROM' => 'DESC','SORT' => 'ASC'), array('IBLOCK_ID' => $arParams["IBLOCK_ID"],'ACTIVE' => 'Y','SECTION_GLOBAL_ACTIVE' => 'Y'),false, array('nPageSize' => 1, 'nElementID' => $arResult["ID"]), array('ID', 'DETAIL_PAGE_URL'));
while($ar_Fields = $res->GetNextElement())
{
    $arItem = $ar_Fields->GetFields();
    $arResult["NAVIGATION"][]=$arItem;
}