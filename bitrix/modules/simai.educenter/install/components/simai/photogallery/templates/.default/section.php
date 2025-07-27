<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if($arParams["~SEF_URL_TEMPLATES"]["upload"]!="" && $GLOBALS["USER"]->IsAdmin()):?>
<form class="inline-block" action="<?=$arParams["~SEF_FOLDER"]?><?=$arParams["~SEF_URL_TEMPLATES"]["upload"]?>" method="POST">
  <input type="hidden" name="SECTION_CODE" value="<?=$arResult["VARIABLES"]["SECTION_CODE"]?>">
  <input class="btn btn-base" type="submit" value="<?=getMessage("UPLOAD_TEXT")?>">
 </form>
  <div class="clearfix mb-20" id="line_button"></div>
<?endif?>
<script>
	$(document).ready(function() {
		$(".theater").fancybox({
			openEffect	: 'none',
			closeEffect	: 'none'
		});
	});
</script>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "photogallery.sections",
    Array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
        "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "NUM_ELEMENTS" => $arParams["NUM_ELEMENTS"],
        "WIDTH_PREVIEW" => $arParams["WIDTH_PREVIEW"],
        "ADD_SECTIONS_CHAIN" => "N",
        "SHOW_PHOTO_TITLE" => $arParams["SHOW_PHOTO_TITLE"],
        "IMG_LIST_WIDTH" => $arParams["IMG_LIST_WIDTH"],
        "IMG_LIST_HEIGHT" => $arParams["SECTIONS_HEIGHT_IMAGE"]
    ),
    $component
);
?>
<?if($arParams["AJAX_PAGE"]=="Y")$GLOBALS['APPLICATION']->RestartBuffer();?>
<?$SECTION_ID=$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"photogallery.list",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
		"INCLUDE_SUBSECTIONS" => "N",
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
		"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"NUM_ELEMENTS"=> $arParams["NUM_ELEMENTS"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		"QUANTITY_FLOAT" => $arParams["QUANTITY_FLOAT"],
		"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
		"IMG_LIST_WIDTH" => $arParams["IMG_LIST_WIDTH"],
		"IMG_LIST_HEIGHT" => $arParams["SECTION_HEIGHT_IMAGE"],
		"SIZE_PREVIEW" => $arParams["SIZE_PREVIEW"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"SHOW_PHOTO_TITLE" => $arParams["SHOW_PHOTO_TITLE"],
		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
		"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
        "AJAX_PAGE" =>$arParams["AJAX_PAGE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		"COUNT_ELEMENT_ON_LINE" => $arParams['COUNT_ELEMENT_ON_LINE'],
		"SHOW_ALL_WO_SECTION" => "N",
	),
	$component
);?>
<?
if($SECTION_ID) {
    $ITEMS = array();
    $nav = CIBlockSection::GetNavChain(false, $SECTION_ID);
    while ($arItem = $nav->Fetch())
    {
        $ITEMS[] = $arItem;
    }
    $countSections=count($ITEMS);
    if ($countSections>1)
    {
        $button["SECTION_PAGE_URL"]=CComponentEngine::MakePathFromTemplate($ITEMS[$countSections-2]["SECTION_PAGE_URL"],array("SECTION_CODE" => $ITEMS[$countSections-2]["CODE"]));
    }
	else
	{
		$button["SECTION_PAGE_URL"]=$arParams["SEF_FOLDER"];
	}
}
if(is_string($button["SECTION_PAGE_URL"])):
?>
    <a href="<?=$button["SECTION_PAGE_URL"]?>" id="button_up" class="btn btn-base pull-right"><i class="fa fa-chevron-up"></i><span><?=getMessage("UP")?></span></a>
    <script type="text/javascript">
        $("#button_up").insertBefore("#line_button");
        $("#line_button").html("<br>");
    </script>
<?endif?>