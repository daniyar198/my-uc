<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arParams["NUM_ELEMENTS"]=(intVal($arParams["NUM_ELEMENTS"])?intVal($arParams["NUM_ELEMENTS"]):5);
$arParams["SIZE_PREVIEW"]=(intVal($arParams["SIZE_PREVIEW"])?intVal($arParams["SIZE_PREVIEW"]):400);
$arParams["IMG_LIST_HEIGHT"]=(intVal($arParams["IMG_LIST_HEIGHT"])?intVal($arParams["IMG_LIST_HEIGHT"]):360);
$arParams["IMG_LIST_WIDTH"]=intVal(($arParams["IMG_LIST_HEIGHT"]*4)/3);

$arParams["ELEMENT_SORT_FIELD"]=(intVal($arParams["ELEMENT_SORT_FIELD"])?intVal($arParams["ELEMENT_SORT_FIELD"]):"sort");
$arParams["ELEMENT_SORT_ORDER"]=(intVal($arParams["ELEMENT_SORT_ORDER"])?intVal($arParams["ELEMENT_SORT_ORDER"]):"asc");


$arResult["SECTIONS"] = Array();

/*
$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"SECTION_ID"=>$arResult["ID"], "GLOBAL_ACTIVE"=>"Y","ACTIVE"=>"Y");
$res = CIBlockSection::GetList(Array("left_margin"=>"asc"), $arFilter);
while($arr = $res->GetNext()):
	if($arParams["INCLUDE_SUBSECTIONS"]=="N"):
	$arSelect = Array("ID","NAME","PREVIEW_PICTURE");
    $arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","SECTION_ID"=>$arr["ID"],"INCLUDE_SUBSECTIONS"=>"N");
    $resEl = CIBlockElement::GetList(Array($arParams["ELEMENT_SORT_FIELD"]=>$arParams["ELEMENT_SORT_ORDER"]),$arFilter, false,array("nTopCount" =>$arParams["NUM_ELEMENTS"]),$arSelect);
    while($ob = $resEl->GetNext())
    {
        if($ob["PREVIEW_PICTURE"]){
            $arFileTmp = CFile::ResizeImageGet(
                $ob["PREVIEW_PICTURE"],
                array("width" => $arParams["IMG_LIST_WIDTH"], "height" => $arParams["IMG_LIST_HEIGHT"]),
                BX_RESIZE_IMAGE_PROPORTIONAL,
                false
            );
            $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
            $ob["PREVIEW_IMG"]= array(
                "SRC" => $arFileTmp["src"],
                "WIDTH" => IntVal($arSize[0]),
                "HEIGHT" => IntVal($arSize[1]),
                "REAL_FILE_SRC" => CFile::GetPath($ob["PREVIEW_PICTURE"])
            );
            $arr["ITEMS"][]=$ob;
        }

    }
	endif;
	$arResult["SECTIONS"][] = $arr;
endwhile;
*/
foreach($arResult["ITEMS"] as $cell=>$arElement):
	$fid = $arElement["PREVIEW_PICTURE"];
    if ($fid > 0):
		$file = CFile::ResizeImageGet($fid, array("width" => $arParams["IMG_LIST_WIDTH"], "height" => $arParams["IMG_LIST_HEIGHT"]), BX_RESIZE_IMAGE_EXACT);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$file["src"]);
		$file = array(
			"SRC" => $file["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
			"REAL_FILE_SRC" => $fid["SRC"]
			);
		$arResult["ITEMS"][$cell]["PREVIEW_PICTURE"] = $file;
		//$arResult["ITEMS"][$cell]["PICTURE"]["old_src"] = $fid["SRC"];
    else:
        unset($arResult["ITEMS"][$cell]);
	endif;	
endforeach;



?>