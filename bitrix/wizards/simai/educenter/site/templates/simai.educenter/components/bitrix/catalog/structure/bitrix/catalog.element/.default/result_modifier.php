<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
if(is_array($arResult["DETAIL_PICTURE"]))
{
				$arFileTmp = CFile::ResizeImageGet(
					$arResult["DETAIL_PICTURE"],
					array("width" => 1170, "height" => 1063),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					false
				);
				$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
				$arResult["PREVIEW_IMG"]= array(
					"SRC" => $arFileTmp["src"],
					"WIDTH" => IntVal($arSize[0]),
					"HEIGHT" => IntVal($arSize[1]),
					"OLD_LINK" => $arResult["DETAIL_PICTURE"]["SRC"],
					"DESCRIPTION" => $arResult["DETAIL_PICTURE"]["DESCRIPTION"]
				);
}
elseif(is_array($arResult["PREVIEW_PICTURE"]))
{
				$arFileTmp = CFile::ResizeImageGet(
					$arResult["PREVIEW_PICTURE"],
					array("width" => 1170, "height" => 1063),
                    BX_RESIZE_IMAGE_EXACT,
					false
				);
				$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
				$arResult["PREVIEW_IMG"]= array(
					"SRC" => $arFileTmp["src"],
					"WIDTH" => IntVal($arSize[0]),
					"HEIGHT" => IntVal($arSize[1]),
					"OLD_LINK" => $arResult["PREVIEW_PICTURE"]["SRC"],
					"DESCRIPTION" => $arResult["PREVIEW_PICTURE"]["DESCRIPTION"]
				);
}
$arResult["MORE_PHOTO"]=array();
if(is_array($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]))
{
	if(is_array($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"][0]))
	{
		foreach($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"] as $key=>$arItem)
		{
					$arFileTmp = CFile::ResizeImageGet(
					$arItem,
					array("width" => 720, "height" => 463),
					BX_RESIZE_IMAGE_EXACT,
					false
				);
				$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
				$arResult["MORE_PHOTO"][$key]= array(
					"SRC" => $arFileTmp["src"],
					"WIDTH" => IntVal($arSize[0]),
					"HEIGHT" => IntVal($arSize[1]),
					"DESCRIPTION" => $arItem["DESCRIPTION"],
					"OLD_LINK" => $arItem["SRC"],
				);
		}
	}
	else
	{
		$arFileTmp = CFile::ResizeImageGet(
		$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"],
		array("width" => 720, "height" => 463),
		BX_RESIZE_IMAGE_EXACT,
		false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
		$arResult["MORE_PHOTO"][0]= array(
			"SRC" => $arFileTmp["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
			"DESCRIPTION" => $arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["DESCRIPTION"],
			"OLD_LINK" => $arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["SRC"],
		);
	}
}

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
	
	$arResult["DISPLAY_PROGRAM"] = array();
	
	if(is_array($arResult["PROPERTIES"]["PROGRAM"]["VALUE"])){


		foreach($arResult["PROPERTIES"]["PROGRAM"]["VALUE"] as $val){
			$arResult["DISPLAY_PROGRAM"][] = $arResult["PROGRAM"][$val];
		}
	}

    $arResult["DISPLAY_PROGRAM"] = implode(", ", $arResult["DISPLAY_PROGRAM"]);



$arResult["CATEGORY"]=array();
$db_old_groups = CIBlockElement::GetElementGroups($arResult["ID"], true);
while($ar_group = $db_old_groups->Fetch()){
    $ar_new_groups[] = $ar_group["ID"];
}
if(!empty($ar_new_groups)){
    $ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ID"=>$ar_new_groups),false, Array("ID","NAME","SECTION_PAGE_URL"));
    while($res=$ar_result->GetNext()){$arResult["CATEGORY"][]=$res;}

}
$arResult["REVIEWS"]=array();
if($arParams["IBLOCK_REVIEWS_ID"])
{
     $arSelect = Array("ID","PREVIEW_TEXT","DETAIL_PAGE_URL");
     $arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_REVIEWS_ID"],"PROPERTY_CLIENT"=>$arResult["ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
     $res = CIBlockElement::GetList(Array(), $arFilter, false,false,$arSelect);
     while($ob = $res->GetNext())
     {
        $arResult["REVIEWS"][]=$ob;
     }
}
$res = CIBlockElement::GetList(array($arParams["ELEMENT_SORT_FIELD"] => $arParams["ELEMENT_SORT_ORDER"],$arParams["ELEMENT_SORT_FIELD2"] => $arParams["ELEMENT_SORT_ORDER2"]), array('IBLOCK_ID' => $arParams["IBLOCK_ID"],'ACTIVE' => 'Y','SECTION_GLOBAL_ACTIVE' => 'Y'),false, array('nPageSize' => 1, 'nElementID' => $arResult["ID"]), array('ID', 'DETAIL_PAGE_URL'));
while($ar_Fields = $res->GetNextElement())
{
    $arItem = $ar_Fields->GetFields();
    $arResult["NAVIGATION"][]=$arItem;
}


$arResult["FILIAL"]=array();
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_ID_BRANCHES"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arResult["FILIAL"][$arFields["ID"]]=$arFields["NAME"];
}

$arResult["DISCIPLINE"]=array();
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_DISCIPLINE"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arResult["DISCIPLINE"][$arFields["ID"]]=$arFields["NAME"];
}

?>
