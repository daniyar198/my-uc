<?
foreach($arResult["ITEMS"] as $key=>$arItem){
	if(is_array($arItem["DISPLAY_PROPERTIES"]["REAL_PICTURE"])){
		$arFileTmp = CFile::ResizeImageGet(
            $arItem["DISPLAY_PROPERTIES"]["REAL_PICTURE"]["FILE_VALUE"],
			array("width" => 100, "height" => 100),
			BX_RESIZE_IMAGE_EXACT ,
			false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
		$arResult["ITEMS"][$key]["PREVIEW_IMG"]= array(
			"SRC" => $arFileTmp["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
			"OLD_SRC" => $arItem["DISPLAY_PROPERTIES"]["REAL_PICTURE"]["FILE_VALUE"]["SRC"],
		);
		}
        elseif(is_array($arItem["PREVIEW_PICTURE"])){
		$arFileTmp = CFile::ResizeImageGet(
			$arItem["PREVIEW_PICTURE"],
			array("width" => 100, "height" => 100),
			BX_RESIZE_IMAGE_EXACT ,
			false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
		$arResult["ITEMS"][$key]["PREVIEW_IMG"]= array(
			"SRC" => $arFileTmp["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
			"OLD_SRC" => $arItem["PREVIEW_PICTURE"]["SRC"],
		);
		}
		elseif(is_array($arItem["DETAIL_PICTURE"])){
			$arFileTmp = CFile::ResizeImageGet(
			$arItem["DETAIL_PICTURE"],
			array("width" => 100, "height" => 100),
			BX_RESIZE_IMAGE_EXACT ,
			false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
		$arResult["ITEMS"][$key]["PREVIEW_IMG"]= array(
			"SRC" => $arFileTmp["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
			"OLD_SRC" => $arItem["DETAIL_PICTURE"]["SRC"],
		);
		}
}
?>