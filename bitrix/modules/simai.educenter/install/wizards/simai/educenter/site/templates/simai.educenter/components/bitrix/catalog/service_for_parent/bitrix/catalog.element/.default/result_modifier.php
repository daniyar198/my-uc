<?
if(is_array($arResult["DETAIL_PICTURE"])){
	$arFileTmp = CFile::ResizeImageGet(
		$arResult["PREVIEW_PICTURE"],
		array("width" => 200, "height" => 200),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
		$arResult["PREVIEW_IMG"]= array(
			"SRC" => $arFileTmp["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
			"DESCRIPTION" => $arResult["DETAIL_PICTURE"]["DESCRIPTION"],
			"OLD_LINK" => $arResult["DETAIL_PICTURE"]["SRC"],
		);
}
if($arResult["DISPLAY_PROPERTIES"]["FILE"])
{
    $info=substr($arResult["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"], strrpos($arResult["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"], '.') + 1);
    $arResult["TYPE"]=$info;
    $doc=array("pdf"=>"pdf","doc"=>"word","docx"=>"word","xls"=>"excel","xml"=>"excel","jpg" => "image","jpeg" => "image","png" => "image","bmp" => "image","gif" => "image","zip" => "archive","rar" => "archive");
    if(array_key_exists($info,$doc))$arResult["ICON"]="file-".$doc[$info]."-o";
    else $arResult["ICON"]="file";
    $arResult["DOC_SRC"]=$arResult["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"];

}
$arResult["DOC_SIZE"]=number_format(intVal($arResult["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["FILE_SIZE"])/1000, 0, '.', '');
$res = CIBlockElement::GetList(array('SORT' => 'ASC','ID' => 'DESC'), array('IBLOCK_ID' => $arParams["IBLOCK_ID"],'ACTIVE' => 'Y'),false, array('nPageSize' => 1, 'nElementID' => $arResult["ID"]), array('ID', 'DETAIL_PAGE_URL'));
while($ar_Fields = $res->GetNext())
{
    $arResult["NAVIGATION"][]=$ar_Fields;
}