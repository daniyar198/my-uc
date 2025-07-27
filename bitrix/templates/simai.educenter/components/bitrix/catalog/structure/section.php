<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<script>
 $(function(){
            $("select[name='section'] option[value='<?=$arResult["VARIABLES"]["SECTION_CODE"]?>']").attr("selected","");
        })
</script>
<div class="row">
    <div class="col-md-9">
 <?
  $APPLICATION->IncludeComponent(
  	"bitrix:catalog.section.list",
  	"select",
  	Array(
  		"AJAX_MODE" => "N",
  		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
  		"SECTION_ID" => "",
  		"SECTION_CODE" => "",
  		"SECTION_USER_FIELDS" => array(),
  		"ELEMENT_SORT_FIELD" => "sort",
  		"ELEMENT_SORT_ORDER" => "asc",
  		"FILTER_NAME" => "arrFilter",
  		"INCLUDE_SUBSECTIONS" => "Y",
  		"SHOW_ALL_WO_SECTION" => "Y",
  		"SECTION_URL" => "",
  		"DETAIL_URL" => "",
  		"BASKET_URL" => "/personal/basket.php",
  		"ACTION_VARIABLE" => "action",
  		"PRODUCT_ID_VARIABLE" => "id",
  		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
  		"PRODUCT_PROPS_VARIABLE" => "prop",
  		"SECTION_ID_VARIABLE" => "SECTION_ID",
  		"META_KEYWORDS" => "-",
  		"META_DESCRIPTION" => "-",
  		"BROWSER_TITLE" => "-",
  		"ADD_SECTIONS_CHAIN" => "N",
  		"DISPLAY_COMPARE" => "N",
  		"SET_TITLE" => "N",
  		"SET_STATUS_404" => "N",
  		"PAGE_ELEMENT_COUNT" => "30",
  		"LINE_ELEMENT_COUNT" => "3",
  		"PROPERTY_CODE" => array(),
  		"PRICE_CODE" => array(),
  		"USE_PRICE_COUNT" => "Y",
  		"SHOW_PRICE_COUNT" => "1",
  		"PRICE_VAT_INCLUDE" => "Y",
  		"PRODUCT_PROPERTIES" => array(),
  		"USE_PRODUCT_QUANTITY" => "Y",
  		"CACHE_TYPE" => "A",
  		"CACHE_TIME" => "36000000",
  		"CACHE_FILTER" => "Y",
  		"CACHE_GROUPS" => "Y",
  		"DISPLAY_TOP_PAGER" => "N",
  		"DISPLAY_BOTTOM_PAGER" => "Y",
  		"PAGER_TITLE" => "Товары",
  		"PAGER_SHOW_ALWAYS" => "Y",
  		"PAGER_TEMPLATE" => "",
  		"PAGER_DESC_NUMBERING" => "N",
		"TOP_DEPTH" => "4",
  		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
  		"PAGER_SHOW_ALL" => "Y",
  		"AJAX_OPTION_JUMP" => "N",
  		"AJAX_OPTION_STYLE" => "Y",
  		"AJAX_OPTION_HISTORY" => "N",
  		"CONVERT_CURRENCY" => "Y",
  		"CURRENCY_ID" => "RUB",
		"SEF_FOLDER" =>$arParams["SEF_FOLDER"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
  	),
            $component
  );?>
    </div>
    <?
    if($_REQUEST["type"]=="cards")
    {
        $_SESSION["type_list"]=".default";
    }
    elseif($_REQUEST["type"]=="list")
    {
        $_SESSION["type_list"]="list";
    }
    elseif($_REQUEST["type"]=="table")
    {
        $_SESSION["type_list"]="table";
    }
    if($_SESSION["type_list"])$template=$_SESSION["type_list"];else $template=$arParams["TEMPLATE_DEF"];
    ?>
          <div class="col-md-3 view-switcher text-right mb-20">
            <a title="<?=getMessage("TYPE_LIST")?>" class="ml-10 <?if($_SESSION["type_list"]=="list"||((!$_SESSION["type_list"])&&$arParams["TEMPLATE_DEF"]=="list")):?>active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("type=list",array("type"))?>"><i class="fa fa-list fa-2x"></i></a>
            <a title="<?=getMessage("TYPE_CARDS")?>" class="ml-10 <?if($_SESSION["type_list"]==".default"||((!$_SESSION["type_list"])&&$arParams["TEMPLATE_DEF"]==".default")):?>active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("type=cards",array("type"))?>"><i class="fa fa-th-large fa-2x"></i></a>
            <a title="<?=getMessage("TYPE_TABLE")?>" class="ml-10 <?if($_SESSION["type_list"]=="table" ||((!$_SESSION["type_list"])&&$arParams["TEMPLATE_DEF"]=="table")):?>active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("type=table",array("type"))?>"><i class="fa fa-table fa-2x"></i></a>
        </div>
</div>

<?if($arParams["AJAX_PAGE"]=="Y")$GLOBALS['APPLICATION']->RestartBuffer();?>
<?
if($_REQUEST["specialty"]||$_REQUEST["filial"])
{?>
    <script type="text/javascript">
        $(function(){
            $("select[name='specialty'] option[value='<?=$_REQUEST["specialty"]?>']").attr("selected","");
			$("select[name='filial'] option[value='<?=$_REQUEST["filial"]?>']").attr("selected","");
        })
    </script>
    <?
    if(!$arParams["FILTER_NAME"])$arParams["FILTER_NAME"]="arrFilterSpec";
    $GLOBALS[$arParams["FILTER_NAME"]]["PROPERTY_SPECIALTY"]=$_REQUEST["specialty"];
	$GLOBALS[$arParams["FILTER_NAME"]]["PROPERTY_FILIAL"]=$_REQUEST["filial"];
}
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "$template",
    Array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_AREA" => $arParams["IBLOCK_ID_AREA"],
		"IBLOCK_SCHEDULE"=>$arParams["IBLOCK_ID_SCHEDULE"],
        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
        "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
        "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
        "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
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
        "SHOW_ALL_WO_SECTION"=>"Y",
        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
        "QUANTITY_FLOAT" => $arParams["QUANTITY_FLOAT"],
        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
        "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
        "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
        "AJAX_PAGE" =>$arParams["AJAX_PAGE"],
        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
    ),
    $component
);
?>