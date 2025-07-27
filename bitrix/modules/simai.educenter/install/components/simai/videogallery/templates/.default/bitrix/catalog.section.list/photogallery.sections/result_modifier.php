<?
$arParams["NUM_ELEMENTS"]=(intVal($arParams["NUM_ELEMENTS"])?intVal($arParams["NUM_ELEMENTS"]):9);
$arParams["IMG_LIST_HEIGHT"]=(intVal($arParams["IMG_LIST_HEIGHT"])?intVal($arParams["IMG_LIST_HEIGHT"]):360);
$arParams["IMG_LIST_WIDTH"]=intVal(($arParams["IMG_LIST_HEIGHT"]*4)/3);
$arParams["ELEMENT_SORT_FIELD"]=(intVal($arParams["ELEMENT_SORT_FIELD"])?intVal($arParams["ELEMENT_SORT_FIELD"]):"sort");
$arParams["ELEMENT_SORT_ORDER"]=(intVal($arParams["ELEMENT_SORT_ORDER"])?intVal($arParams["ELEMENT_SORT_ORDER"]):"asc");
$MAX_DEPTH=$arResult["SECTIONS"][0]["DEPTH_LEVEL"];
$CURRENT_DEPTH=$arResult["SECTIONS"][0]["DEPTH_LEVEL"];
$arKey=0;
foreach($arResult["SECTIONS"] as $key=>$arSection)
{
     if($arSection["DEPTH_LEVEL"]>=$CURRENT_DEPTH && $arSection["DEPTH_LEVEL"]>$MAX_DEPTH)
     {
         if(!$arKey)$arKey=$key-1;
         $arResult["SECTIONS"][$arKey]["SECTIONS"][]=$arSection;
         $CURRENT_DEPTH=$arSection["DEPTH_LEVEL"];
         unset($arResult["SECTIONS"][$key]);
     }
     elseif($arSection["DEPTH_LEVEL"]<$CURRENT_DEPTH)
     {
          $arKey=0;
          $CURRENT_DEPTH=$arSection["DEPTH_LEVEL"];
     }
}
foreach($arResult["SECTIONS"] as $key=>$arSection){
	$arSelect = Array("ID","NAME","PREVIEW_PICTURE","DATE_ACTIVE_FROM","PROPERTY_LINK","IBLOCK_ID");
    $arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "SECTION_ACTIVE"=>"Y", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","SECTION_ID"=>$arSection["ID"],"INCLUDE_SUBSECTIONS"=>"Y");
    $res = CIBlockElement::GetList(Array($arParams["ELEMENT_SORT_FIELD"]=>$arParams["ELEMENT_SORT_ORDER"]),$arFilter, false,array("nTopCount" =>$arParams["NUM_ELEMENTS"]),$arSelect);
    while($ob = $res->GetNext())
    {
		

        if($ob["PREVIEW_PICTURE"]){
            $arFileTmp = CFile::ResizeImageGet(
                $ob["PREVIEW_PICTURE"],
                array("width" => $arParams["IMG_LIST_WIDTH"], "height" => $arParams["IMG_LIST_HEIGHT"]),
                BX_RESIZE_IMAGE_EXACT,
                false
            );
            $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
            $ob["PREVIEW_IMG"]= array(
                "SRC" => $arFileTmp["src"],
                "WIDTH" => IntVal($arSize[0]),
                "HEIGHT" => IntVal($arSize[1]),
                "REAL_FILE_SRC" => CFile::GetPath($ob["PREVIEW_PICTURE"])
            );
			
			$arButtons = CIBlock::GetPanelButtons(
			 $ob["IBLOCK_ID"],
			 $ob["ID"],
			 0,
			 array("SECTION_BUTTONS"=>false, "SESSID"=>false)
			 );
			 $ob["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
			 $ob["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
            $arResult["SECTIONS"][$key]["ITEMS"][]=$ob;
        }

    }
}
		/*echo "<pre>";
		print_r($arResult);
		echo "</pre>";*/






?>