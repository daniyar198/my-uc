<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetPageProperty("show_title", "N");
		$APPLICATION->SetPageProperty("show_breadcrumb", "N");
		$APPLICATION->SetPageProperty("show_left_column", "N");
			$APPLICATION->SetTitle("Главная");
			?><?$APPLICATION->IncludeComponent(
	"simai:banner.main", 
	".default", 
	array(
		"AUTOPLAY" => "N",
		"BLOCK_ID" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"COUNT_SLIDES" => "5",
		"DELAY_TIME" => "3000",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HEIGHT_BANNER" => "350",
		"IBLOCK_ID" => "#sf-banner-main#",
		"IBLOCK_TYPE" => "banners",
		"RESTRICT_IMAGE" => "Y",
		"SECTION_ID" => "",
		"SECTION_PATH" => "/simai/block/include/",
		"SF_BANNER_AUTOPLAY" => "Y",
		"SF_BANNER_COUNT" => "5",
		"SF_BANNER_DELAY" => "3000",
		"SF_BANNER_EFFECT" => "FADE",
		"SF_BANNER_HEIGHT" => "400",
		"SF_BANNER_MODIFIER_BUTTONS" => "",
		"SF_BANNER_MODIFIER_DESCRIPTION" => "pt-40 pb-30",
		"SF_BANNER_MODIFIER_IMAGE" => "hidden-sm hidden-xs",
		"SF_BANNER_MODIFIER_TEXT" => "mb-15",
		"SF_BANNER_MODIFIER_TITLE" => "mb-15",
		"SF_BANNER_RESTRICT" => "Y",
		"SF_BANNER_WIDTH" => "1920",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "RAND",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"WIDTH_BACK_BANNER" => "1920"
	),
	false
);?> <section class="bg-lgrey pt-30 pb-30 bb">
<div class="container">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"advantage",
	Array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"IBLOCK_ID" => "#courses#",
		"IBLOCK_TYPE" => "organization",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(0=>"",1=>"",),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"UF_ICON",1=>"",),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LINE"
	)
);?><br>
</div>
 </section> <section class="sf-main__section pt-30 bt">
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="d-flex justify-content-end mb-3">
				<div class="mr-auto align-self-center">
					<h2 class="sf-title ">Главные новости</h2>
				</div>
				<div class="d-none d-sm-block align-self-center">
 <i class="fa fa-arrow-circle-right mr-2 c-primary" aria-hidden="true"></i><a href="<?=SITE_DIR?>life/news/" class="c-text-secondary l-inherit">Все новости</a>
				</div>
			</div>
			 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"general-photo",
	Array(
		"ACTION_VARIABLE" => "action",
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "general-photo",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "active_from",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "0arNewsMainFilter",
		"IBLOCK_ID" => "#school_NEWS#",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "4",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NAME_BLOCK" => "",
		"OFFERS_LIMIT" => "0",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "4",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(0=>"YOUTUBE",1=>"",),
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PHOTO_TITLE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?>
			<div class="row mt-4">
				<div class="col-md-12">
					<div class="d-flex justify-content-end mb-3">
						<div class="mr-auto align-self-center">
							<h2 class="sf-title ">Популярные курсы</h2>
						</div>
						<div class="d-none d-sm-block align-self-center">
 <i class="fa fa-arrow-circle-right mr-2 c-primary" aria-hidden="true"></i> <a href="<?=SITE_DIR?>courses/" class="c-text-secondary l-inherit">Все курсы</a>
						</div>
					</div>
					 <?global $filterPopular;
					$filterPopular = array("!PROPERTY_POPULAR" => false);?> <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"universal.course",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_PAGE" => "",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "universal.course",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "filterPopular",
		"IBLOCK_ID" => "#courses#",
		"IBLOCK_ID_SHEDULE" => "55",
		"IBLOCK_TYPE" => "organization",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "boomerang",
		"PAGER_TITLE" => "",
		"PAGE_ELEMENT_COUNT" => "10",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(0=>"SPECIAL_OFFER",1=>"",),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_DEF" => "table",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>
				</div>
			</div>
			<div class="d-flex justify-content-end mb-3 mt-4">
				<div class="mr-auto align-self-center">
					<h2 class="sf-title ">Фотогалерея</h2>
				</div>
				<div class="d-none d-sm-block align-self-center">
 <i class="fa fa-arrow-circle-right mr-2 c-primary" aria-hidden="true"></i> <a href="<?=SITE_DIR?>life/gallery/" class="c-text-secondary l-inherit">Все фото</a>
				</div>
			</div>
			 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"photo.mp",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_PAGE" => "",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "photo.mp",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "rand",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilterPhoto",
		"IBLOCK_ID" => "#gallery#",
		"IBLOCK_TYPE" => "gallery",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "12",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NAME_BLOCK" => "Наша фотогалерея",
		"OFFERS_LIMIT" => "0",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "12",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(0=>"",1=>"REAL_PICTURE",2=>"",),
		"QUANTITY_FLOAT" => "N",
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PHOTO_TITLE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "Y",
		"USE_PRODUCT_QUANTITY" => "Y"
	)
);?>
			<div class="d-flex justify-content-end mb-3 mt-4">
				<div class="mr-auto align-self-center">
					<h2 class="sf-title ">Видеогалерея</h2>
				</div>
				<div class="d-none d-sm-block align-self-center">
 <i class="fa fa-arrow-circle-right mr-2 c-primary" aria-hidden="true"></i> <a href="<?=SITE_DIR?>life/videogallery/" class="c-text-secondary l-inherit">Все видео</a>
				</div>
			</div>
			 <?$APPLICATION->IncludeComponent(
	"simai:videogallery.list",
	".default",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FILTER_NAME" => "",
		"IBLOCK_ID" => "#video#",
		"IBLOCK_TYPE" => "gallery",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"NEWS_COUNT" => "6",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "boomerang",
		"PAGER_TITLE" => "Видео",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PROPERTY_CODE" => array(0=>"LINK",1=>"",),
		"SECTION_HEIGHT_IMAGE" => "150",
		"SET_BROWSER_TITLE" => "N",
		"SET_TITLE" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
			<div class="row">
				<div class="col-md-12">
				</div>
			</div>
			<div class="row mt-20">
				<div class="col-md-12">
					<div class="d-flex justify-content-end mb-3 mt-4">
						<div class="mr-auto align-self-center">
							<h2 class="sf-title ">Популярные семинары</h2>
						</div>
						<div class="d-none d-sm-block align-self-center">
 <i class="fa fa-arrow-circle-right mr-2 c-primary" aria-hidden="true"></i> <a href="<?=SITE_DIR?>seminar/" class="c-text-secondary l-inherit">Все семинары</a>
						</div>
					</div>
					 <?global $filterPopularSeminar;
					$filterPopularSeminar = array("!PROPERTY_POPULAR" => false,">=PROPERTY_DATE_FORM" => date("Y-m-d"));?> <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"universal.seminar", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_PAGE" => "",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "universal.seminar",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "filterPopularSeminar",
		"IBLOCK_ID" => "#seminars#",
		"IBLOCK_TYPE" => "organization",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "boomerang",
		"PAGER_TITLE" => "",
		"PAGE_ELEMENT_COUNT" => "10",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(
			0 => "SPECIAL_OFFER",
			1 => "POPULAR",
			2 => "",
		),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_DEF" => "list",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	),
	false
);?>
				</div>
			</div>
			 <?
 $GLOBALS["arFilShedule"][">PROPERTY_DATE"] = date("Y-m-d");
?>
			<div class="row mt-20">
				<div class="col-md-12">
					<div class="d-flex justify-content-end mb-3 mt-4">
						<div class="mr-auto align-self-center">
							<h2 class="sf-title ">Ближайшие курсы</h2>
						</div>
						<div class="d-none d-sm-block align-self-center">
 <i class="fa fa-arrow-circle-right mr-2 c-primary" aria-hidden="true"></i> <a href="<?=SITE_DIR?>students/schedule/" class="c-text-secondary l-inherit">Все курсы</a>
						</div>
					</div>
					 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"schedule_table_main",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "schedule_table_main",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "arFilShedule",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "#shedule#",
		"IBLOCK_TYPE" => "organization",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"DATE",1=>"PRICE",2=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "PROPERTY_DATE",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
				</div>
				<div class="col-md-12">
					<div class="d-flex justify-content-end mb-3 mt-4">
						<div class="mr-auto align-self-center">
							<h2 class="sf-title ">Ближайшие семинары</h2>
						</div>
						<div class="d-none d-sm-block align-self-center">
 <i class="fa fa-arrow-circle-right mr-2 c-primary" aria-hidden="true"></i> <a href="<?=SITE_DIR?>students/schedule/seminars/" class="c-text-secondary l-inherit">Все семинары</a>
						</div>
					</div>
					 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"schedule_table_seminar_main",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "schedule_table_seminar_main",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "arFilShedule",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "#shedule_sem#",
		"IBLOCK_TYPE" => "organization",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"DATE",1=>"PRICE",2=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "PROPERTY_DATE",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
 <section class="bg-theme-30 p-1">
			<?
								$GLOBALS["arrFilterMainMan"]["!PROPERTY_CHIEF"]=false;
								$APPLICATION->IncludeComponent(
									"bitrix:catalog.section", 
									"main-man-1", 
									array(
									"IBLOCK_TYPE" => "organization",
									"IBLOCK_ID" => "#organization#",
									"SECTION_ID" => "",
									"SECTION_CODE" => "",
									"SECTION_USER_FIELDS" => array(
									0 => "",
									1 => "",
									),
									"ELEMENT_SORT_FIELD" => "active_from",
									"ELEMENT_SORT_ORDER" => "desc",
									"ELEMENT_SORT_FIELD2" => "ID",
									"ELEMENT_SORT_ORDER2" => "asc",
									"FILTER_NAME" => "arrFilterMainMan",
									"INCLUDE_SUBSECTIONS" => "Y",
									"SHOW_ALL_WO_SECTION" => "Y",
									"PAGE_ELEMENT_COUNT" => "1",
									"LINE_ELEMENT_COUNT" => "4",
									"PROPERTY_CODE" => array(
									0 => "POSITION",
									1 => "",
									),
									"OFFERS_LIMIT" => "0",
									"TEMPLATE_THEME" => "blue",
									"MESS_BTN_BUY" => "Купить",
									"MESS_BTN_ADD_TO_BASKET" => "В корзину",
									"MESS_BTN_SUBSCRIBE" => "Подписаться",
									"MESS_BTN_DETAIL" => "Подробнее",
									"MESS_NOT_AVAILABLE" => "Нет в наличии",
									"SECTION_URL" => "",
									"DETAIL_URL" => "",
									"SECTION_ID_VARIABLE" => "SECTION_ID",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"AJAX_OPTION_HISTORY" => "N",
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "36000000",
									"CACHE_GROUPS" => "N",
									"SET_TITLE" => "N",
									"SET_BROWSER_TITLE" => "N",
									"BROWSER_TITLE" => "-",
									"SET_META_KEYWORDS" => "N",
									"META_KEYWORDS" => "-",
									"SET_META_DESCRIPTION" => "N",
									"META_DESCRIPTION" => "-",
									"ADD_SECTIONS_CHAIN" => "N",
									"SET_STATUS_404" => "N",
									"CACHE_FILTER" => "N",
									"ACTION_VARIABLE" => "action",
									"PRODUCT_ID_VARIABLE" => "id",
									"PRICE_CODE" => array(
									),
									"USE_PRICE_COUNT" => "N",
									"SHOW_PRICE_COUNT" => "1",
									"PRICE_VAT_INCLUDE" => "N",
									"BASKET_URL" => "/personal/basket.php",
									"USE_PRODUCT_QUANTITY" => "N",
									"ADD_PROPERTIES_TO_BASKET" => "N",
									"PRODUCT_PROPS_VARIABLE" => "prop",
									"PARTIAL_PRODUCT_PROPERTIES" => "N",
									"PRODUCT_PROPERTIES" => array(
									),
									"DISPLAY_COMPARE" => "N",
									"PAGER_TEMPLATE" => ".default",
									"DISPLAY_TOP_PAGER" => "N",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"PAGER_TITLE" => "Товары",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"PRODUCT_QUANTITY_VARIABLE" => "quantity"
									),
									false
									);?> </section>
			<div class="d-flex justify-content-end mb-3 mt-4">
				<div class="mr-auto align-self-center">
					<h2 class="sf-title ">Календарь</h2>
				</div>
				<div class="d-none d-sm-block align-self-center">
 <i class="fa fa-arrow-circle-right mr-2 c-primary" aria-hidden="true"></i> <a href="<?=SITE_DIR?>students/schedule/" class="c-text-secondary l-inherit">Курсы</a>
				</div>
			</div>
			 <?$APPLICATION->IncludeComponent(
	"simai:course.news.calendar",
	"main",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "course",
		"DATE_FIELD" => "PROPERTY_DATE",
		"DETAIL_URL" => "",
		"FILTER_NAME" => "arF",
		"FILTER_URL" => "#SITEDIR#students/schedule/",
		"IBLOCK_ID" => "#shedule#",
		"IBLOCK_ID_COURSE" => "#courses#",
		"IBLOCK_TYPE" => "organization",
		"IBLOCK_TYPE_COURSE" => "organization",
		"MONTH_VAR_NAME" => "month",
		"NEWS_COUNT" => "0",
		"SET_TITLE" => "N",
		"SHOW_CURRENT_DATE" => "Y",
		"SHOW_MONTH_LIST" => "Y",
		"SHOW_TIME" => "N",
		"SHOW_YEAR" => "Y",
		"TITLE_LEN" => "0",
		"TYPE" => "EVENTS",
		"USE_FILTER" => "Y",
		"WEEK_START" => "1",
		"YEAR_VAR_NAME" => "year"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?>
			<div class="d-flex justify-content-end mb-3 mt-4">
				<div class="mr-auto align-self-center">
					<h2 class="sf-title ">Контакты</h2>
				</div>
				<div class="d-none d-sm-block align-self-center">
 <i class="fa fa-arrow-circle-right mr-2 c-primary" aria-hidden="true"></i> <a href="<?=SITE_DIR?>contacts/" class="c-text-secondary l-inherit">Подробнее</a>
				</div>
			</div>
			 <?if (CModule::IncludeModule("iblock")):
					$arSelect = Array("ID", "NAME");
					            $arFilter = Array("IBLOCK_ID" => "#branches#","ACTIVE"=>"Y");
					            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
					            if($ob = $res->GetNextElement())$scale="9";
					else $scale="17";
					$MAP_DATA = "a:4:{s:10:\"yandex_lat\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lat", "").";s:10:\"yandex_lon\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lng", "").";s:12:\"yandex_scale\";i:".$scale.";s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lng", "").";s:3:\"LAT\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lat", "").";s:4:\"TEXT\";s:".count(str_split(COption::GetOptionString($GLOBALS["moduleName"], "address", ""))).":\"".COption::GetOptionString($GLOBALS["moduleName"], "address", "")."\";}}}";
					endif;
					?> <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"points",
	Array(
		"COMPONENT_TEMPLATE" => "points",
		"CONTROLS" => array(),
		"IBLOCK_ID" => "#branches#",
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => $MAP_DATA,
		"MAP_HEIGHT" => "200",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(),
		"SHOW_INFO" => "Y"
	)
);?>
			<div class="d-flex justify-content-end mb-3 mt-4">
				<div class="mr-auto align-self-center">
					<h2 class="sf-title ">Объявления</h2>
				</div>
				<div class="d-none d-sm-block align-self-center">
 <i class="fa fa-arrow-circle-right mr-2 c-primary" aria-hidden="true"></i> <a href="<?=SITE_DIR?>life/announcing/" class="c-text-secondary l-inherit">В раздел</a>
				</div>
			</div>
			 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"announcing.mp.list", 
	array(
		"ACTIVE_DATE_FORMAT" => "FULL",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "announcing.mp.list",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"IBLOCK_ID" => "#AD#",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
			<div class="mb-20">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"section.banners",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "section.banners",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "RAND",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"IBLOCK_ID" => "#banners_section#",
		"IBLOCK_TYPE" => "banners",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "7",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(0=>"LINK",1=>"PICTURE",2=>"",),
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "Y",
		"USE_PRODUCT_QUANTITY" => "Y"
	)
);?>
			</div>
			 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_RECURSIVE" => "",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"EDIT_MODE" => "",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/main_social.php"
	)
);?>
		</div>
	</div>
</div>
 </section> <section class="slice bg-lgrey mt-40">
<div class="wp-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 mp">
				<div class="d-flex justify-content-end mb-3 mt-4">
					<div class="mr-auto align-self-center">
						<h2 class="sf-title ">Нам доверяют</h2>
					</div>
				</div>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"sf-banner-swiper-4",
	Array(
		"ACTION_VARIABLE" => "action",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BLOCK_ID" => "",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "sf-banner-swiper-4",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "",
		"IBLOCK_ID" => "#simai_client#",
		"IBLOCK_TYPE" => "organization",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(0=>"LINK",1=>"PICTURE",2=>"",),
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "Y",
		"USE_PRODUCT_QUANTITY" => "Y"
	)
);?>
			</div>
		</div>
	</div>
</div>
 </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>