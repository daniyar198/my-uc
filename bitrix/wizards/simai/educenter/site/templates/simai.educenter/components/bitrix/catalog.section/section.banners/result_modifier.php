<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
	if(is_array($arItem["DISPLAY_PROPERTIES"]["PICTURE"])){
		$arFileTmp = CFile::ResizeImageGet(
            $arItem["DISPLAY_PROPERTIES"]["PICTURE"]["FILE_VALUE"],
			array("width" => 720, "height" => 463),
			BX_RESIZE_IMAGE_PROPORTIONAL,
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