<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arResult["SECTIONS"] = Array();
$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "GLOBAL_ACTIVE"=>"Y","ACTIVE"=>"Y");
$res = CIBlockSection::GetList(Array("left_margin"=>"asc"), $arFilter);
while($arr = $res->GetNext()):
	$arResult["SECTIONS"][$arr["ID"]] = $arr["NAME"];
endwhile;

foreach($arResult["ITEMS"] as $cell=>$arElement):
	$fid = $arElement["PREVIEW_PICTURE"]?$arElement["PREVIEW_PICTURE"]:$arElement["DETAIL_PICTURE"];
	if ($fid > 0):
		$file = CFile::ResizeImageGet($fid, array('width'=>570, 'height'=>400), BX_RESIZE_IMAGE_EXACT);
		$arResult["ITEMS"][$cell]["PICTURE"] = $file;
	endif;	
endforeach;
?>