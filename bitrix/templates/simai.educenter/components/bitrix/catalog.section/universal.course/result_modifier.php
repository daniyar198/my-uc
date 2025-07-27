<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


$arCourse = array();
foreach($arResult["ITEMS"] as $cell=>$arElement):
  $arCourse[] = $arElement["ID"];
	$fid = $arElement["PREVIEW_PICTURE"]?$arElement["PREVIEW_PICTURE"]:$arElement["DETAIL_PICTURE"];
	if ($fid > 0):
		$file = CFile::ResizeImageGet($fid, array('width'=>400, 'height'=>400), BX_RESIZE_IMAGE_EXACT);
		$arResult["ITEMS"][$cell]["PICTURE"] = $file;
	endif;	
endforeach;



$arResult["DATE"]= array();
$arSelect = Array("ID", "NAME", "IBLOCK_ID","PROPERTY_DATE","PROPERTY_COURSE");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_ID_SHEDULE"], ">PROPERTY_DATE"=> date("Y-m-d"),"PROPERTY_COURSE" => $arCourse);
$res = CIBlockElement::GetList(Array("PROPERTY_DATE" => "asc"), $arFilter, false, Array("nPageSize"=>100), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 

 if(!isset($arResult["DATE"][$arFields["NAME"]]))
	 $arResult["DATE"][$arFields["NAME"]] = array();
	 
 if(!isset($arResult["DATE"] [$arFields["NAME"]][$arFields["PROPERTY_COURSE_VALUE"]]))
   $arResult["DATE"][$arFields["NAME"]][$arFields["PROPERTY_COURSE_VALUE"]] = $arFields["PROPERTY_DATE_VALUE"];
}


?>




