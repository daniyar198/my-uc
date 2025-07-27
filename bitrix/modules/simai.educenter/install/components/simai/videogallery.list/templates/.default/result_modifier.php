<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arParams["NUM_ELEMENTS"]=(intVal($arParams["NUM_ELEMENTS"])?intVal($arParams["NUM_ELEMENTS"]):5);
$arParams["SIZE_PREVIEW"]=(intVal($arParams["SIZE_PREVIEW"])?intVal($arParams["SIZE_PREVIEW"]):400);
$arParams["IMG_LIST_HEIGHT"]=(intVal($arParams["SECTION_HEIGHT_IMAGE"])?intVal($arParams["SECTION_HEIGHT_IMAGE"]):360);
$arParams["IMG_LIST_WIDTH"]=intVal(($arParams["IMG_LIST_HEIGHT"]*4)/3);

$arParams["ELEMENT_SORT_FIELD"]=(intVal($arParams["ELEMENT_SORT_FIELD"])?intVal($arParams["ELEMENT_SORT_FIELD"]):"sort");
$arParams["ELEMENT_SORT_ORDER"]=(intVal($arParams["ELEMENT_SORT_ORDER"])?intVal($arParams["ELEMENT_SORT_ORDER"]):"asc");


$arResult["SECTIONS"] = Array();


foreach($arResult["ITEMS"] as $cell=>$arElement):
	$fid = $arElement["PREVIEW_PICTURE"];
    if ($fid > 0):
		$file = CFile::ResizeImageGet($fid, array("width" => $arParams["IMG_LIST_WIDTH"], "height" => $arParams["IMG_LIST_HEIGHT"]), BX_RESIZE_IMAGE_EXACT);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$file["src"]);
		$file = array(
			"SRC" => $file["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
			"REAL_FILE_SRC" => $file["src"],
			);
		$arResult["ITEMS"][$cell]["PREVIEW_PICTURE"] = $file;
    else:
        unset($arResult["ITEMS"][$cell]);
	endif;	
endforeach;



?>