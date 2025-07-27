<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["ITEMS"] as $key=>$arItem)
{
        if($arItem["DISPLAY_PROPERTIES"]["FILE"])
        {
            $info=substr($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"], strrpos($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"], '.') + 1);
            $arResult["ITEMS"][$key]["TYPE"]=$info;
            $doc=array(
                "pdf"=>array("icon"=>"pdf","color"=>"#FF9800"),
                "doc"=>array("icon"=>"word","color"=>"#3F51B5"),
                "docx"=>array("icon"=>"word","color"=>"#3F51B5"),
                "rtf"=>array("icon"=>"word","color"=>"#3F51B5"),
                "xls"=>array("icon"=>"excel","color"=>"#4CAF50"),
                "xml"=>array("icon"=>"excel","color"=>"#4CAF50"),
                "jpg" => array("icon"=>"image","color"=>"#E91E63"),
                "jpeg" => array("icon"=>"image","color"=>"#E91E63"),
                "png" => array("icon"=>"image","color"=>"#E91E63"),
                "bmp" => array("icon"=>"image","color"=>"#E91E63"),
                "gif" => array("icon"=>"image","color"=>"#E91E63"),
                "zip" => array("icon"=>"archive","color"=>"#3F51B5"),
                "rar" => array("icon"=>"archive","color"=>"#3F51B5"));
            if(array_key_exists($info,$doc)){
				$arResult["ITEMS"][$key]["ICON"]["TYPE"]="file-".$doc[$info]["icon"]."-o";
				$arResult["ITEMS"][$key]["ICON"]["COLOR"] = $doc[$info]["color"];
			}
            else{
				$arResult["ITEMS"][$key]["ICON"]["TYPE"]="file";
				$arResult["ITEMS"][$key]["ICON"]["COLOR"]="#607D8B";
			}
            $arResult["ITEMS"][$key]["DOC_SRC"]=$arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"];
            $arResult["ITEMS"][$key]["DOC_SIZE"]=number_format(intVal($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["FILE_SIZE"])/1000, 0, '.', '');
        }
}
?>