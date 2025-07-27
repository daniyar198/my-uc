<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
			$this->__component->arResult["IDS"][] = $arItem["ID"];
			if($arItem["DATE_ACTIVE_FROM"])
			{
				$arParams["ACTIVE_DATE_FORMAT"]=($arParams["ACTIVE_DATE_FORMAT"]?$arParams["ACTIVE_DATE_FORMAT"]:"j F Y, l");
				$arResult["ITEMS"][$key]["DISPLAY_ACTIVE_FROM"]=FormatDate($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arItem["DATE_ACTIVE_FROM"]));
			}
			if(is_array($arItem["PREVIEW_PICTURE"]))
			{
                $width=720;
                $height=463;
                if($arItem["PREVIEW_PICTURE"]["WIDTH"]<$width || $arItem["PREVIEW_PICTURE"]["WIDTH"]<$height)
                {
                    if($arItem["PREVIEW_PICTURE"]["WIDTH"]>=$arItem["PREVIEW_PICTURE"]["HEIGHT"])
                    {
                        $height=$arItem["PREVIEW_PICTURE"]["HEIGHT"];
                        $width=floor($height*1.5);
                    }
                    else
                    {
                        $width=$arItem["PREVIEW_PICTURE"]["WIDTH"];
                        $height=floor($width/1.5);
                    }
                }
                $arFileTmp = CFile::ResizeImageGet(
					$arItem["PREVIEW_PICTURE"],
					array("width" => $width, "height" => $height),
                    BX_RESIZE_IMAGE_EXACT,
					false,
                    "",
                    "",
                    "70"
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
                $width=720;
                $height=463;
                if($arItem["DETAIL_PICTURE"]["WIDTH"]<$width || $arItem["DETAIL_PICTURE"]["WIDTH"]<$height)
                {
                    if($arItem["DETAIL_PICTURE"]["WIDTH"]>=$arItem["DETAIL_PICTURE"]["HEIGHT"])
                    {
                        $height=$arItem["DETAIL_PICTURE"]["HEIGHT"];
                        $width=floor($height*1.5);
                    }
                    else
                    {
                        $width=$arItem["DETAIL_PICTURE"]["WIDTH"];
                        $height=floor($width/1.5);
                    }
                }
                $arFileTmp = CFile::ResizeImageGet(
                    $arItem["DETAIL_PICTURE"],
                    array("width" => $width, "height" => $height),
                    BX_RESIZE_IMAGE_EXACT,
                    false,
                    "",
                    "",
                    "70"
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