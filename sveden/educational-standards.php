<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Образовательные стандарты");
?><p style="text-align: justify;">
	 Федеральные государственные образовательные стандарты (ФГОС) представляют собой совокупность требований, обязательных при реализации основных образовательных программ начального общего, основного общего, среднего (полного) общего, начального профессионального, среднего профессионального и высшего профессионального образования образовательными учреждениями, имеющими государственную аккредитацию.
</p>
<p style="text-align: justify;">
	 Федеральные государственные образовательные стандарты должны обеспечивать:<br>
</p>
<ol style="text-align: justify;">
	<li>единство образовательного пространства Российской Федерации;</li>
	<li>преемственность основных образовательных программ начального общего, основного общего, среднего (полного) общего, начального профессионального, среднего профессионального и высшего профессионального образования.</li>
</ol>
 Федеральным законом&nbsp;от 1 декабря 2007 года N 309-ФЗ&nbsp;была утверждена новая структура государственного образовательного стандарта. Теперь ФГОС должны включать&nbsp;3 вида требований:<br>
<p>
</p>
<div style="text-align: justify;">
	<ol style="text-align: justify;">
		<li>требования к структуре основных образовательных программ, в том числе требования к соотношению частей основной образовательной программы и их объёму, а также к соотношению обязательной части основной образовательной программы и части, формируемой участниками образовательного процесса;</li>
		<li>требования к условиям реализации основных образовательных программ, в том числе кадровым, финансовым, материально-техническим и иным условиям;</li>
		<li>требования к результатам освоения основных образовательных программ.</li>
	</ol>
</div>
<p style="text-align: justify;">
	 Ещё в 2010-2011 учебном году мы перешли на новые стандарты обучения в первых&nbsp;классах. ФГОС предполагает введение внеурочной деятельности учащихся по нескольким направлениям: общекультурное, общее интеллектульное, спортивно-оздоровительное, социальное, духовно-нравственное.
</p>
<p>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"documents",
	Array(
		"ACTION_VARIABLE" => "action",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_PICT_PROP" => "-",
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
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"IBLOCK_ID" => "21",
		"IBLOCK_TYPE" => "organization",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
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
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PROPERTY_CODE" => array("","FILE",""),
		"SECTION_CODE" => "standarts",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?><br>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>