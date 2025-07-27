<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


 if(!empty($arResult["ITEMS"])):
 
	$arCourses=array();
	$arPlace=array();
	$arTeachers=array();
	$IBLOCK_COURSE = $arResult["ITEMS"][0]["PROPERTIES"]["COURSE"]["LINK_IBLOCK_ID"];
	$IBLOCK_PLACE = $arResult["ITEMS"][0]["PROPERTIES"]["PLACE"]["LINK_IBLOCK_ID"];
	$IBLOCK_TEACHER = $arResult["ITEMS"][0]["PROPERTIES"]["TEACHER"]["LINK_IBLOCK_ID"];
	foreach($arResult["ITEMS"] as $arItem){
		
		if($arItem["PROPERTIES"]["COURSE"]["VALUE"]!="")
		  $arCourses[$arItem["PROPERTIES"]["COURSE"]["VALUE"]] = $arItem["PROPERTIES"]["COURSE"]["VALUE"];

		/* if($arItem["PROPERTIES"]["PLACE"]["VALUE"]!="")
$arPlace[$arItem["PROPERTIES"]["PLACE"]["VALUE"]] = $arItem["PROPERTIES"]["PLACE"]["VALUE"];*/
	  
		
	  	foreach($arItem["PROPERTIES"]["TEACHER"]["VALUE"] as $teacher):
		
		 if($teacher!="")
		   $arTeachers[$teacher] = $teacher;
	   
	    endforeach;

	}
	
	if (CModule::IncludeModule("iblock")):
	
	
	    $arResult["COURSES"]=array();
		if(!empty($arCourses)){
			
			$arSelect = Array("ID", "NAME","IBLOCK_ID","DETAIL_PAGE_URL");
			$arFilter = Array("IBLOCK_ID"=>IntVal($IBLOCK_COURSE), "ACTIVE"=>"Y","ID" => $arCourses);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1000), $arSelect);
			while($ob = $res->GetNextElement())
			{
			  $arFields = $ob->GetFields();
			  $arResult["COURSES"][$arFields["ID"]] = array("NAME" => $arFields["NAME"], "DETAIL_PAGE_URL" => $arFields["DETAIL_PAGE_URL"]);
			}
			
		}
		
		
/*  $arResult["PLACE"]=array();
		if(!empty($arPlace)){
			
			$arSelect = Array("ID", "NAME","IBLOCK_ID","DETAIL_PAGE_URL");
			$arFilter = Array("IBLOCK_ID"=>IntVal($IBLOCK_PLACE), "ACTIVE"=>"Y","ID" => $arPlace);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1000), $arSelect);
			while($ob = $res->GetNextElement())
			{
			  $arFields = $ob->GetFields();
			  $arResult["PLACE"][$arFields["ID"]] = array("NAME" => $arFields["NAME"], "DETAIL_PAGE_URL" => $arFields["DETAIL_PAGE_URL"]);
			}
			
		}*/
		
	    $arResult["TEACHER"]=array();
		if(!empty($arTeachers)){
			
			$arSelect = Array("ID", "NAME","IBLOCK_ID","DETAIL_PAGE_URL");
			$arFilter = Array("IBLOCK_ID"=>IntVal($IBLOCK_TEACHER), "ACTIVE"=>"Y","ID" => $arTeachers);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1000), $arSelect);
			while($ob = $res->GetNextElement())
			{
			  $arFields = $ob->GetFields();
			  $arResult["TEACHER"][$arFields["ID"]] = array("NAME" => $arFields["NAME"], "DETAIL_PAGE_URL" => $arFields["DETAIL_PAGE_URL"]);
			}
			
		}
	endif;
	
	
	
endif;	
/*
echo "<pre>";
print_r($arResult);
echo "</pre>";*/

?>




