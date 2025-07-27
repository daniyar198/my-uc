<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


foreach($arResult["ITEMS"] as $cell=>$arElement):
	$fid = $arElement["PREVIEW_PICTURE"]?$arElement["PREVIEW_PICTURE"]:$arElement["DETAIL_PICTURE"];
	if ($fid > 0):
		$file = CFile::ResizeImageGet($fid, array('width'=>400, 'height'=>400), BX_RESIZE_IMAGE_EXACT);
		$arResult["ITEMS"][$cell]["PICTURE"] = $file;
	endif;	
endforeach;

?>




