<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$curPage=$this->GetFolder();
require_once ($_SERVER["DOCUMENT_ROOT"] .$curPage . "/library.php");
$arBXCSiteSettings=$arResult["arBXCSiteSettings"];
if($arBXCSiteSettings["ACTIVE_FROM"])
{
    $stmp = MakeTimeStamp($arBXCSiteSettings["EVENT_DATE"], FORMAT_DATETIME);
    if($stmp<time())
    {
        $arBXCSiteSettings["ACTIVE"]="N";
    }
}
if(!isset($arBXCSiteSettings["ACTIVE"]))$arBXCSiteSettings["ACTIVE"]="Y";
$APPLICATION->SetPageProperty("show_title", "N");
$APPLICATION->SetPageProperty("show_breadcrumb", "N");
?> 
<?
?>
<?$APPLICATION->AddChainItem($APPLICATION->GetTitle(),$arResult["FOLDER"]);?>
<style>
 #titlepage{display:none;}
 section.slice.bb {display: none }
</style>
<script type="text/javascript"> 
   $(".content .col-md-<?=$GLOBALS["main_column_width"]?>").removeClass("col-md-<?=$GLOBALS["main_column_width"]?>").addClass("col-md-12");
   $(".left-column").hide();
    $(document).ready(function(){
    	$(".fancybox").fancybox({
            'openEffect'    : 'none',
            'closeEffect'   : 'none',
            'showNavArrows': true,
            'showCloseButton': false
        });
    })
</script>
<?$APPLICATION->AddChainItem($arBXCSiteSettings["NAME"], "");?>
<?$APPLICATION->SetTitle($arBXCSiteSettings["NAME"]);?>

</div></div></section>
<section class="slice relative" style="background-image: url('<?=$arResult["arBXCSiteSettings"]["CAPTURE"]["src"]?>'); background-size: cover; ">
	<div class=" mask bg-dark-60"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1 class="mt-40 c-white">
					<?=$arResult["arBXCSiteSettings"]["NAME"]?>
				</h1>
				<div class="lead c-white hidden-sm hidden-xs">
					<?=$arResult["arBXCSiteSettings"]["SHORT_DESCRIPTION"]["TEXT"] ?>
				</div>
			</div>
			<div class="col-md-6 light-back">
				<?$APPLICATION->IncludeComponent(
					"simai:feedback.all.string",
					"main-banner",
					Array(
						"IBLOCK_TYPE" => "forms",
						"IBLOCK_ID" => $arParams["IBLOCK_ID_FEEDBACK"],
						"EMAIL" => COption::GetOptionString($GLOBALS["moduleName"],"email",""),
						"EMAIL_SUBJ" => getMessage("ORDER_NOW"),
						"OK_MSG" => getMessage("ORDER_SUBMIT"),
						"USE_GOOGLE_CAPTCHA" => COption::GetOptionString($GLOBALS["moduleName"],"use_google_captcha",""),
		                "PUBLIC_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"public_key",""),
		                "PRIVATE_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"private_key",""),
					)
				);?>
			</div>
		</div>
	</div>
</section>

<?if(!empty($arBXCSiteSettings["MORE_PHOTO"])):?>
	<section class="bg-lgrey pt-40 pb-40">
		<div class="container">
			<div class="row mb-0">
                <div class="col-md-12">
                	<? $qq = 0;?>
                	<?php foreach ($arResult["arBXCSiteSettings"]["MORE_PHOTO"] as $arPhoto): ?>
                		<?if ($qq == 0) echo "<div class='slider-viewport'>
							<div class='control prev'>
								<i class='fa fa-angle-left'></i>
							</div>
							<div class='control next'>
								<i class='fa fa-angle-right'></i>
							</div>
                		<div class='slider-container clearfix'>" ?>
            				<a class="fancybox sli-pic" data-big="<?=$arPhoto["SRC_BIG"]?>" rel="group" href="<?=$arPhoto["OLD_LINK"]?>">
            					<img src="<?=$arPhoto["SRC"]?>" alt="<?=$arResult["NAME"]?>">
            				</a>
                		<? $qq++;?>
                	<?php endforeach ?>

                	<?php if ($qq != 0) echo "</div></div>"?>
                </div>
			</div>
		</div>
	</section>
<?endif?>

<section class="slice">
<div class="wp-section">
<div class="container">	
	
<?if($arBXCSiteSettings["DESCRIPTION"]):?>
    <div class="row">
        <div class="col-md-12">	
		<div class="section-title-wr mp">
				<h2 class="section-title"><span><?=getMessage("DESCRIPTION")?></span></h2>
		</div>		
            <?=$arBXCSiteSettings["DESCRIPTION"]["TEXT"]?>
		</div>
	</div>
<?endif?>
	

<?if($arBXCSiteSettings["TESTIMONY"]):?>
    <div class="row">
        <div class="col-md-12">
			<div class="section-title-wr mp">
				<h2 class="section-title" id="TESTIMONY"><span><?=getMessage("TESTIMONY")?></span></h2>
			</div>			
			<?=$arBXCSiteSettings["TESTIMONY"]["TEXT"]?>
		</div>
	</div>
<?endif?>
	
<?if($arBXCSiteSettings["ADVANTAGES"]):?>
    <div class="row">
        <div class="col-md-12">
			<div class="section-title-wr mp">
				<h2 class="section-title" id="ADVANTAGES"><span><?=getMessage("ADVANTAGES")?></span></h2>
			</div>			
			<?=$arBXCSiteSettings["ADVANTAGES"]["TEXT"]?>
		</div>
	</div>
<?endif?>	

<?if($arBXCSiteSettings["CONTRAINDICATIONS"]):?>
    <div class="row">
        <div class="col-md-12">
			<div class="section-title-wr mp">
				<h2 class="section-title" id="CONTRAINDICATIONS"><span><?=getMessage("CONTRAINDICATIONS")?></span></h2>
			</div>			
			<?=$arBXCSiteSettings["CONTRAINDICATIONS"]["TEXT"]?>
		</div>
	</div>
<?endif?>

<?if($arBXCSiteSettings["SPECIALISTS"]):?>
	<div id="SPECIALISTS">   
	<?$GLOBALS["filterSpecialist"]["ID"]=$arBXCSiteSettings["SPECIALISTS"];?>
    <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"about_specialist", 
	array(
		"COMPONENT_TEMPLATE" => "about_specialist",
		"IBLOCK_TYPE" => "organization",
		"IBLOCK_ID" => $arParams["IBLOCK_ID_SPECIALISTS"],
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "filterSpecialist",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "POSITION",
			1 => "TYPE",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
		$component
	);?>
</div>
<?endif?>


<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"for-meta",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"FIELD_CODE" => array("", "PREVIEW_TEXT", "PREVIEW_PICTURE", ""),
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => "for-meta",
		"PAGER_TITLE" => "",
		"PROPERTY_CODE" => array("DESCRIPTION", "BANNER_DESCRIPTION", "SHORT_DESCRIPTION", ""),
		"SET_BROWSER_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N"
	),
    $component
);?>


<?if($arBXCSiteSettings["REVIEWS"]):?>
</div>
</div>
</section>
<div id="REVIEWS"> 
 <?
 $GLOBALS["filterReview"]["ID"]=$arBXCSiteSettings["REVIEWS"];
 $APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"reviews_slide", 
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => $arParams["IBLOCK_ID_REVIEWS"],
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "filterReview",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "N",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "NAME",
			1 => "REVIEW",
			2 => "",
		),
		"OFFERS_LIMIT" => "5",
		"TEMPLATE_THEME" => "blue",
		"MESS_BTN_BUY" => "",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"COMPONENT_TEMPLATE" => "reviews_slide",
		"BG_URL" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y"
	),
		$component
);?>	   
</div>
<section class="slice">
<div class="wp-section">
<div class="container">	
<?endif?>


<?if($arBXCSiteSettings["PRICE"]):?>
    <div class="row">
        <div class="col-md-12">
			<div class="section-title-wr mp">
				<h2 class="section-title" id="PRICE"><span><?=getMessage("PRICE")?></span></h2>
			</div>			
			 <?
			 $GLOBALS["filterPrice"]["ID"]=$arBXCSiteSettings["PRICE"];
			 $APPLICATION->IncludeComponent(
				"bitrix:news.list", 
				"table_price", 
				array(
					"COMPONENT_TEMPLATE" => "table_price",
					"IBLOCK_TYPE" => "services",
					"IBLOCK_ID" => $arParams["IBLOCK_ID_PRICE_LIST"],
					"NEWS_COUNT" => "20",
					"SORT_BY1" => "ACTIVE_FROM",
					"SORT_ORDER1" => "DESC",
					"SORT_BY2" => "SORT",
					"SORT_ORDER2" => "ASC",
					"FILTER_NAME" => "filterPrice",
					"FIELD_CODE" => array(
						0 => "",
						1 => "",
					),
					"PROPERTY_CODE" => array(
						0 => "PRICE",
						1 => "",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_BROWSER_TITLE" => "N",
					"SET_META_KEYWORDS" => "Y",
					"SET_META_DESCRIPTION" => "N",
					"SET_LAST_MODIFIED" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"PAGER_TEMPLATE" => ".default",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"SET_STATUS_404" => "N",
					"SHOW_404" => "N",
					"MESSAGE_404" => ""
				),
					$component
			);?>
		</div>
	</div>
<?endif;?>

<div class="row">
<div class="col-md-6">
	<div class="section-title-wr mp">
		<h2 class="section-title" id="ORDER"><span><?=getMessage("BUY")?></span></h2>
	</div>
	<div class="ba">	
		<?$APPLICATION->IncludeComponent(
		"simai:feedback.all.string",
		"main",
		Array(
			"IBLOCK_TYPE" => "forms",
			"IBLOCK_ID" => $arParams["IBLOCK_ID_FEEDBACK"],
			"EMAIL" =>  COption::GetOptionString($GLOBALS["moduleName"],"email",""),
			"EMAIL_SUBJ" => getMessage("ORDER_NOW"),
			"OK_MSG" => getMessage("ORDER_SUBMIT"),
			"USE_GOOGLE_CAPTCHA" => COption::GetOptionString($GLOBALS["moduleName"],"use_google_captcha",""),
		    "PUBLIC_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"public_key",""),
		    "PRIVATE_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"private_key",""),
		)
		);?>
	</div>
</div>
<div class="col-md-6">
	<div class="section-title-wr mp">
		<h2 class="section-title" id="CONTACTS"><span><?=getMessage("OUR_CONTACTS")?></span></h2>
	</div>
   <?
	if (CModule::IncludeModule("iblock")):
			$arSelect = Array("ID", "NAME");
			            $arFilter = Array("IBLOCK_ID" => $arParams["IBLOCK_ID_FILIAL"],"ACTIVE"=>"Y");
			            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
			            if($ob = $res->GetNextElement())$scale="8";
			else $scale="17";
			$MAP_DATA = "a:4:{s:10:\"yandex_lat\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lat", "").";s:10:\"yandex_lon\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lng", "").";s:12:\"yandex_scale\";i:".$scale.";s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lng", "").";s:3:\"LAT\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lat", "").";s:4:\"TEXT\";s:".count(str_split(COption::GetOptionString($GLOBALS["moduleName"], "address", ""))).":\"".COption::GetOptionString($GLOBALS["moduleName"], "address", "")."\";}}}";
	endif;
			?>
<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	"points", 
	array(
		"COMPONENT_TEMPLATE" => "points",
		"CONTROLS" => array(
		),
		"IBLOCK_ID" => $arParams["IBLOCK_ID_FILIAL"],
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => $MAP_DATA,
		"MAP_HEIGHT" => "200",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(
		),
		"SHOW_INFO" => "Y"
	),
	false
);?>



<script>
 $("textarea").val("<?=getMessage("ORDER")?> <?=$arBXCSiteSettings["NAME"]?>");
</script>
<script>
	$(document).ready(function(){
		var step = 250,
		widthCont = 0,
		left = 0,
		heightSl,
		view,
		cont,
		stop;

		function inicial(){
			stop = 0;
			cont = 0;
			view = 0;
			widthCont = 0;
			heightSl = $('.slider-viewport .slider-container .sli-pic').outerHeight();
			$('.slider-viewport').height(heightSl);

			$('.slider-viewport .slider-container .sli-pic').each(function(indx){
				widthCont+=$(this).outerWidth();
				widthCont+=parseInt($(this).css('margin-right'), 10);
			});
			$('.slider-viewport .slider-container').width(widthCont+1);
			view = $('.slider-viewport').width();
			cont = $('.slider-container').width();
			stop = cont - view;
		}
		$(window).on( "resize", inicial );
		inicial();
		nextSlide(0);

		$('.control.next').click(function(){
			if ((left + step >= stop)||(left + step*1.3 >= stop)){
				left = stop;
				nextSlide(left);
			}else if (left + step < stop){
				left +=step;
				nextSlide(left);
			} 
		})
		$('.control.prev').click(function(){
			if ((left - step <= 0)||(left - step*1.3 <= 0)){
				left = 0;
				nextSlide(left);
			}else if (left - step > 0){
				left -=step;
				nextSlide(left);
			}
		})
		function nextSlide(left){
			left*=-1;
			$('.slider-container').css("left", left);
		}

		$('.slider-viewport').on('mouseover', function(){
			$('.slider-viewport').addClass('sl-hover');
		})
		$('.slider-viewport').on('mouseout', function(){
			$('.slider-viewport').removeClass('sl-hover');
		})

	})
</script>

