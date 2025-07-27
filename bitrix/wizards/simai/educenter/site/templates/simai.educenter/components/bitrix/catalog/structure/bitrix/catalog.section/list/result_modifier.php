<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if($arParams["NOT_SHOW_SECTION"]!="Y"):
    $arResult["SECTIONS"] = Array();
    $arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "GLOBAL_ACTIVE"=>"Y","ACTIVE"=>"Y");
    $res = CIBlockSection::GetList(Array("left_margin"=>"asc"), $arFilter);
    while($arr = $res->GetNext()):
        $arResult["SECTIONS"][$arr["ID"]] = $arr["NAME"];
    endwhile;
endif;
foreach($arResult["ITEMS"] as $cell=>$arElement):
	$fid = $arElement["PREVIEW_PICTURE"]?$arElement["PREVIEW_PICTURE"]:$arElement["DETAIL_PICTURE"];
	if ($fid > 0):
		$file = CFile::ResizeImageGet($fid, array('width'=>400, 'height'=>400), BX_RESIZE_IMAGE_EXACT);
		$arResult["ITEMS"][$cell]["PICTURE"] = $file;
	endif;	
endforeach;

$arResult["FILIAL"]=array();
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_AREA"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arResult["FILIAL"][$arFields["ID"]]=$arFields["NAME"];
}
$arResult["SCHEDULE"]=array();
$arSelect = Array("ID","PROPERTY_DATE_TO","PROPERTY_SPECIALIST");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_SCHEDULE"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
  if(!isset($arFields["PROPERTY_DATE_TO_VALUE"])) $arResult["SCHEDULE"][$arFields["PROPERTY_SPECIALIST_VALUE"]]=true;
   else if(strtotime($arFields["PROPERTY_DATE_TO_VALUE"])>=strtotime(date("d.m.o")))$arResult["SCHEDULE"][$arFields["PROPERTY_SPECIALIST_VALUE"]]=true;
}




