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
    if(!empty($arElement['DISPLAY_PROPERTIES']['EDUCATION']) && !isset($arResult["EDUCATION_COLUMN"]))$arResult["EDUCATION_COLUMN"]="Y";
    if(!empty($arElement['DISPLAY_PROPERTIES']['SERTIFICATE']) && !isset($arResult["SERTIFICATE_COLUMN"]))$arResult["SERTIFICATE_COLUMN"]="Y";
    if(!empty($arElement['DISPLAY_PROPERTIES']['SPECIALTY']) && !isset($arResult["SPECIALTY_COLUMN"]))$arResult["SPECIALTY_COLUMN"]="Y";
	$fid = $arElement["PREVIEW_PICTURE"]?$arElement["PREVIEW_PICTURE"]:$arElement["DETAIL_PICTURE"];
	if ($fid > 0):
		$file = CFile::ResizeImageGet($fid, array('width'=>40, 'height'=>51), BX_RESIZE_IMAGE_EXACT);
		$arResult["ITEMS"][$cell]["PICTURE"] = $file;
	endif;	
endforeach;





    $properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=> $arParams["IBLOCK_ID"], "CODE" => "PROGRAM"));
	if ($prop_fields = $properties->GetNext())
	{
	  $IBLOCK_ID = $prop_fields["LINK_IBLOCK_ID"];
	}
	
	$arResult["PROGRAM"]=array();
	
	if(intval($IBLOCK_ID)){
		
		$arSelect = Array("ID", "NAME");
		$arFilter = Array("IBLOCK_ID"=> $IBLOCK_ID, "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
		while($ob = $res->GetNextElement())
		{
		 $arFields = $ob->GetFields();
		 $arResult["PROGRAM"][$arFields["ID"]]=$arFields["NAME"];
		}
		
	}
/*
$arResult["DISCIPLINE"]=array();
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_DISCIPLINE"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arResult["DISCIPLINE"][$arFields["ID"]]=$arFields["NAME"];
}
*/


?> 