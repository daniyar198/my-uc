<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arParams["NUM_ELEMENTS"]=(intVal($arParams["NUM_ELEMENTS"])?intVal($arParams["NUM_ELEMENTS"]):5);
$arParams["SIZE_PREVIEW"]=(intVal($arParams["SIZE_PREVIEW"])?intVal($arParams["SIZE_PREVIEW"]):400);
$arParams["IMG_LIST_WIDTH"]=(intVal($arParams["IMG_LIST_WIDTH"])?intVal($arParams["IMG_LIST_WIDTH"]):400);
$arParams["IMG_LIST_HEIGHT"]=(intVal($arParams["IMG_LIST_HEIGHT"])?intVal($arParams["IMG_LIST_HEIGHT"]):400);
$arParams["ELEMENT_SORT_FIELD"]=(intVal($arParams["ELEMENT_SORT_FIELD"])?intVal($arParams["ELEMENT_SORT_FIELD"]):"sort");
$arParams["ELEMENT_SORT_ORDER"]=(intVal($arParams["ELEMENT_SORT_ORDER"])?intVal($arParams["ELEMENT_SORT_ORDER"]):"asc");
foreach($arResult["ITEMS"] as $cell=>$arElement):
	$fid = is_array($arElement["DISPLAY_PROPERTIES"]["REAL_PICTURE"])?$arElement["DISPLAY_PROPERTIES"]["REAL_PICTURE"]["FILE_VALUE"]:($arElement["PREVIEW_PICTURE"]?$arElement["PREVIEW_PICTURE"]:$arElement["DETAIL_PICTURE"]);
    if ($fid > 0):
		$file = CFile::ResizeImageGet($fid, array("width" => "400", "height" => "300"), BX_RESIZE_IMAGE_EXACT);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$file["src"]);
		$file = array(
			"SRC" => $file["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
			"REAL_FILE_SRC" => $fid["SRC"]
			);
		$arResult["ITEMS"][$cell]["PICTURE"] = $file;
		$arResult["ITEMS"][$cell]["PICTURE"]["old_src"] = $fid["SRC"];
    else:
        unset($arResult["ITEMS"][$cell]);
	endif;	
endforeach;
?>