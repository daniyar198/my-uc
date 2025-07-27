<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
        if($arItem["DISPLAY_PROPERTIES"]["FILE"])
        {
            $info=substr($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"], strrpos($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"], '.') + 1);
            $img=array("jpg","jpeg","png","bmp","gif");
            if(in_array($info,$img))
            {
                $arFileTmp = CFile::ResizeImageGet(
                    $arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"],
                    array("width" => $arParams["WIDTH_PREVIEW"], "height" => $arParams["HEIGHT_PREVIEW"]),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    false
                );
                $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"] . $arFileTmp["src"]);
                $arResult["ITEMS"][$key]["PREVIEW_IMG"] = array(
                    "SRC" => $arFileTmp["src"],
                    "WIDTH" => IntVal($arSize[0]),
                    "HEIGHT" => IntVal($arSize[1]),
                    "REAL_FILE_SRC" => $arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"]
                );
                $arResult["ITEMS"][$key]["TYPE"]="img";
            }
            else
            {
                $arResult["ITEMS"][$key]["TYPE"]=$info;
                $doc=array("pdf"=>"pdf","doc"=>"word","docx"=>"word","xls"=>"excel");
                if($info== "pdf" || $info== "doc" || $info== "docx" || $info== "xls")$arResult["ITEMS"][$key]["ICON"]="file-".$doc[$info]."-o";
                else $arResult["ITEMS"][$key]["ICON"]="file";
                $arResult["ITEMS"][$key]["DOC_SRC"]=$arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"];
            }
        }
}
?>