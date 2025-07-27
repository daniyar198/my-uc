<?
if(is_array($arResult["DETAIL_PICTURE"])){
	$arFileTmp = CFile::ResizeImageGet(
		$arResult["DETAIL_PICTURE"],
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
$res = CIBlockElement::GetList(array('SORT' => 'ASC','ID' => 'DESC'), array('IBLOCK_ID' => $arParams["IBLOCK_ID"],'ACTIVE' => 'Y'),false, array('nPageSize' => 1, 'nElementID' => $arResult["ID"]), array('ID', 'DETAIL_PAGE_URL'));
while($ar_Fields = $res->GetNext())
{
    $arResult["NAVIGATION"][]=$ar_Fields;
}