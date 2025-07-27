<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult["ITEMS"])
foreach($arResult["ITEMS"] as &$arItem)
{
    if (is_array($arItem['PREVIEW_PICTURE']))
	{
	    $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>286, 'height'=>234), BX_RESIZE_IMAGE_EXACT, true);                
	   	
		$arItem['PREVIEW_PICTURE']['SRC'] = $file['src'];
	    $arItem['PREVIEW_PICTURE']['WIDTH'] = $file['width'];
	    $arItem['PREVIEW_PICTURE']['HEIGHT'] = $file['height'];
	}
    else
    {
        $arItem['PREVIEW_PICTURE']['SRC'] = SITE_TEMPLATE_PATH."/images/no_client.jpg";
    }
}

