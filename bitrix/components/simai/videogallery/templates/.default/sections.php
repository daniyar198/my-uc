<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if($arParams["~SEF_URL_TEMPLATES"]["upload"]!="" && $GLOBALS["USER"]->IsAdmin()):?>
    <a class="btn btn-base" href="<?=$arParams["[~SEF_FOLDER]"]?><?=$arParams["~SEF_URL_TEMPLATES"]["upload"]?>"><?=getMessage("UPLOAD_TEXT")?></a>
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
<?

$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "photogallery.sections",
    Array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
        "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "NUM_ELEMENTS" => $arParams["NUM_ELEMENTS"],
        "WIDTH_PREVIEW" => $arParams["WIDTH_PREVIEW"],
        "SHOW_PHOTO_TITLE" => $arParams["SHOW_PHOTO_TITLE"],
        "IMG_LIST_WIDTH" => $arParams["IMG_LIST_WIDTH"],
        "IMG_LIST_HEIGHT" => $arParams["SECTIONS_HEIGHT_IMAGE"]
    ),
    $component
);
?>
