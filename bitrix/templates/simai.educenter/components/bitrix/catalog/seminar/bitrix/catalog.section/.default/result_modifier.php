<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
            if(is_array($arItem["PREVIEW_PICTURE"]))
			{
				$arFileTmp = CFile::ResizeImageGet(
					$arItem["PREVIEW_PICTURE"],
					array("width" => 1170, "height" => 400),
					BX_RESIZE_IMAGE_EXACT,
					false
				);
				$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
				$arResult["ITEMS"][$key]["PREVIEW_IMG"]= array(
					"SRC" => $arFileTmp["src"],
					"WIDTH" => IntVal($arSize[0]),
					"HEIGHT" => IntVal($arSize[1]),
					"OLD_LINK" => $arItem["PREVIEW_PICTURE"]["SRC"]
				);
			}
			elseif(is_array($arItem["DETAIL_PICTURE"]))
			{
				$arFileTmp = CFile::ResizeImageGet(
					$arItem["DETAIL_PICTURE"],
					array("width" => 1170, "height" => 400),
					BX_RESIZE_IMAGE_EXACT,
					false
				);
				$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
				$arResult["ITEMS"][$key]["PREVIEW_IMG"]= array(
					"SRC" => $arFileTmp["src"],
					"WIDTH" => IntVal($arSize[0]),
					"HEIGHT" => IntVal($arSize[1]),
					"OLD_LINK" => $arItem["DETAIL_PICTURE"]["SRC"]
				);
			}
    if($arItem["DISPLAY_PROPERTIES"]["FILE"])
    {
        $info=substr($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"], strrpos($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"], '.') + 1);
        $arResult["ITEMS"][$key]["TYPE"]=$info;
        $doc=array("pdf"=>"pdf","doc"=>"word","docx"=>"word","xls"=>"excel","xml"=>"excel","jpg" => "image","jpeg" => "image","png" => "image","bmp" => "image","gif" => "image","zip" => "archive","rar" => "archive");
        if(array_key_exists($info,$doc))$arResult["ITEMS"][$key]["ICON"]="file-".$doc[$info]."-o";
        else $arResult["ITEMS"][$key]["ICON"]="file";
        $arResult["ITEMS"][$key]["DOC_SRC"]=$arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"];
        $arResult["ITEMS"][$key]["DOC_SIZE"]=number_format(intVal($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["FILE_SIZE"])/1000, 0, '.', '');
    }
}