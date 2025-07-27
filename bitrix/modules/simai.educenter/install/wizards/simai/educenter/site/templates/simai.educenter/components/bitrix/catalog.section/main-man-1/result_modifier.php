<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$arSectionId=array();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
			if(is_array($arItem["PREVIEW_PICTURE"]))
			{
				$arFileTmp = CFile::ResizeImageGet(
					$arItem["PREVIEW_PICTURE"],
					array("width" => 570, "height" => 600),
					BX_RESIZE_IMAGE_PROPORTIONAL,
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
					array("width" => 570, "height" => 600),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
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
}
