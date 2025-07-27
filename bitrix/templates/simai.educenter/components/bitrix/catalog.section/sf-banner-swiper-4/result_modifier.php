<?
if($arParams["MAX_WIDTH"]) 
	$maxWidth = $arParams["MAX_WIDTH"];
else
	$maxWidth = 570;

if($arParams["MAX_HEIGHT"]) 
	$maxHeight = $arParams["MAX_HEIGHT"];
else
	$maxHeight = 400;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
	if($arItem["~PREVIEW_PICTURE"]){
		$arFileTmp = CFile::ResizeImageGet(
            $arItem["~PREVIEW_PICTURE"],
			array("width" => $maxWidth, "height" => $maxHeight),
			BX_RESIZE_IMAGE_EXACT,
			false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
		$arResult["ITEMS"][$key]["PREVIEW_IMG"]= array(
			"SRC" => $arFileTmp["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
		);
	}
}
?>