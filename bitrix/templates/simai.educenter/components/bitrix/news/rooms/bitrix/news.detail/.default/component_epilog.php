<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
SIMAIMeta::opengraph(
 "http://".SITE_SERVER_NAME.$APPLICATION->GetCurPage(),
 "article",
 $arResult["NAME"],
 strip_tags(TruncateText($arResult["~PREVIEW_TEXT"],100)),
 "http://".SITE_SERVER_NAME.$arResult["PREVIEW_PICTURE"]["SRC"]
 );
?>