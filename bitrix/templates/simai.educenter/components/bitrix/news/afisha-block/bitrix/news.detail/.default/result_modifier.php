<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
if(is_array($arResult["DISPLAY_PROPERTIES"]["YOUTUBE"]))
{
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $arResult["DISPLAY_PROPERTIES"]["YOUTUBE"]["VALUE"], $match)) {
        $arResult["YOUTUBE_IDENTIFIER"] = $match[1];
    }
}
$arResult["MORE_PHOTO"]=array();
if(is_array($arResult["DETAIL_PICTURE"]))
{
				$arFileTmp = CFile::ResizeImageGet(
					$arResult["DETAIL_PICTURE"],
					array("width" => 1170, "height" => 900),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					false
				);
                $arFileTmp1 = CFile::ResizeImageGet(
					$arResult["DETAIL_PICTURE"],
					array("width" => 780, "height" => 600),
					BX_RESIZE_IMAGE_EXACT,
					false
				);
				$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
                $arResult["MORE_PHOTO"][0] = array(
					"SRC_BIG" => $arFileTmp["src"],
					"SRC" => $arFileTmp1["src"],
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
					array("width" => 1170, "height" => 900),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					false
				);
                $arFileTmp1 = CFile::ResizeImageGet(
					$arResult["PREVIEW_PICTURE"],
					array("width" => 780, "height" => 600),
                    BX_RESIZE_IMAGE_EXACT,
					false
				);
				$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
                $arResult["MORE_PHOTO"][0] = array(
					"SRC_BIG" => $arFileTmp["src"],
					"SRC" => $arFileTmp1["src"],
					"WIDTH" => IntVal($arSize[0]),
					"HEIGHT" => IntVal($arSize[1]),
					"OLD_LINK" => $arResult["PREVIEW_PICTURE"]["SRC"],
					"DESCRIPTION" => $arResult["PREVIEW_PICTURE"]["DESCRIPTION"]
				);
}

	/*echo "<pre>";
	print_r($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]);
	echo "</pre>";*/

if(is_array($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]))
{
	if(is_array($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"][0]))
	{
		foreach($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"] as $key=>$arItem)
		{
					$arFileTmp = CFile::ResizeImageGet(
					$arItem,
					array("width" => 780, "height" => 600),
					BX_RESIZE_IMAGE_EXACT,
					false
				);
            $arFileTmp1 = CFile::ResizeImageGet(
					$arItem,
					array("width" => 1170, "height" => 900),
                BX_RESIZE_IMAGE_PROPORTIONAL,
					false
				);
				$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
				$arResult["MORE_PHOTO"][]= array(
					"SRC" => $arFileTmp["src"],
					"SRC_BIG" => $arFileTmp1["src"],
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
		array("width" => 780, "height" => 600),
		BX_RESIZE_IMAGE_EXACT,
		false
		);
        $arFileTmp1 = CFile::ResizeImageGet(
		$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"],
		array("width" => 1170, "height" => 900),
            BX_RESIZE_IMAGE_PROPORTIONAL,
		false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
		$arResult["MORE_PHOTO"][]= array(
			"SRC" => $arFileTmp["src"],
			"SRC_BIG" => $arFileTmp1["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
			"DESCRIPTION" => $arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["DESCRIPTION"],
			"OLD_LINK" => $arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["SRC"],
		);
	}
}
$res = CIBlockElement::GetList(array('ACTIVE_FROM' => 'DESC','SORT' => 'ASC'), array('IBLOCK_ID' => $arParams["IBLOCK_ID"],'ACTIVE' => 'Y','SECTION_GLOBAL_ACTIVE' => 'Y'),false, array('nPageSize' => 1, 'nElementID' => $arResult["ID"]), array('ID', 'DETAIL_PAGE_URL'));
while($ar_Fields = $res->GetNextElement())
{
    $arItem = $ar_Fields->GetFields();
    $arResult["NAVIGATION"][]=$arItem;
}
if(is_array($arResult["DISPLAY_PROPERTIES"]["FILE"]["VALUE"])){
	$arResult["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"] = array();
	foreach($arResult["DISPLAY_PROPERTIES"]["FILE"]["VALUE"] as $key=>$fid)
	{
                $arItem=CFile::GetFileArray($fid);
				$arResult["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"][$key] = $arItem;
				$info=substr($arItem["SRC"], strrpos($arItem["SRC"], '.') + 1);
				$arResult["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"][$key]["TYPE"]=$info;
				$doc=array("pdf"=>"pdf","doc"=>"word","docx"=>"word","xls"=>"excel","xml"=>"excel","jpg" => "image","jpeg" => "image","png" => "image","bmp" => "image","gif" => "image","zip" => "archive","rar" => "archive");
				if(array_key_exists($info,$doc))$arResult["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"][$key]["ICON"]="file-".$doc[$info]."-o";
				else $arResult["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"][$key]["ICON"]="file";
				$arResult["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"][$key]["DOC_SIZE"]=number_format(intVal($arItem["FILE_SIZE"])/1000, 0, '.', '');

	}
	
}
$this->__component->SetResultCacheKeys(array(
    "NAME",
    "PREVIEW_TEXT",
    "PREVIEW_PICTURE"
));
