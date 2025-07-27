<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Контакты учреждения");
	?><?
if (CModule::IncludeModule("iblock")):
				$arSelect = Array("ID", "NAME");
				       $arFilter = Array("IBLOCK_ID" => "22","ACTIVE"=>"Y");
				       $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
				       if($ob = $res->GetNextElement())$scale="12";
				else $scale="17";
				$MAP_DATA="a:4:{s:10:\"yandex_lat\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lat", "").";s:10:\"yandex_lon\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lng", "").";s:12:\"yandex_scale\";i:15;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lng", "").";s:3:\"LAT\";d:".COption::GetOptionString($GLOBALS["moduleName"], "lat", "").";s:4:\"TEXT\";s:".count(str_split(COption::GetOptionString($GLOBALS["moduleName"], "address", ""))).":\"".COption::GetOptionString($GLOBALS["moduleName"], "address", "")."\";}}}";
				endif;
?> <?if($scale=='12'):?>
<div class="tabs-framed">
	<ul class="tabs clearfix">
		<li class="active"><a href="#tab2-1" data-toggle="tab">Основное подразделение</a></li>
		<li><a href="#tab2-2" data-toggle="tab">Филиалы</a></li>
	</ul>
	<div class="tab-content tab-content-inverse">
		<div class="tab-pane active" id="tab2-1">
			 <?endif;?> 

			<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"contacts",
	Array(
		"COMPONENT_TEMPLATE" => "contacts",
		"CONTROLS" => array(0=>"ZOOM",1=>"SMALLZOOM",),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => $MAP_DATA,
		"MAP_HEIGHT" => "300",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(0=>"ENABLE_DBLCLICK_ZOOM",1=>"ENABLE_DRAGGING",),
		"SHOW_INFO" => "N"
	)
);?>
			<div class="mp section-title-wr mt-20">
				<h3 class="section-title">
				Контакты </h3>
			</div>
			<div class="contact-info">
				<ul class="list-check mb-10 mt-10 ml-0 mr-0">
					<?if(COption::GetOptionString($GLOBALS["moduleName"], "address", "")!=""):?>
					<li> <i class="fa fa-building"></i>
					<?=COption::GetOptionString($GLOBALS["moduleName"], "address", "")?> </li>
					 <?endif?> 
<?if(COption::GetOptionString($GLOBALS["moduleName"], "phone", "")!=""):?>
					<li> <i class="fa fa-phone"></i>
					<?=COption::GetOptionString($GLOBALS["moduleName"], "phone", "")?> </li>
					 <?endif?> 
					<?/*if(COption::GetOptionString($GLOBALS["moduleName"], "email", "")!=""):?>
					<li> <i class="fa fa-globe"></i> <a href="mailto:<?=$arElement[">" data-bx-app-ex-href="mailto:<?=$arElement["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"]?>
					"&gt;<?=COption::GetOptionString($GLOBALS["moduleName"], "email", "")?></a> </li>
<?endif*/?>

					<?if(COption::GetOptionString($GLOBALS["moduleName"], "email", "")!=""):?>
					<li>
						<i class="fa fa-globe"></i>
						<a href="mailto:<?=$arElement["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"]?>"><?=COption::GetOptionString($GLOBALS["moduleName"], "email", "")?></a>
					</li>
					<?endif?>
				</ul>
			</div>
			<div class="mp section-title-wr mb-10">
				<h3 class="section-title">
				Обратная связь </h3>
			</div>
						<?$APPLICATION->IncludeComponent(
	"simai:feedback.all.string",
	"feedback",
	Array(
		"ADD_ACTIVE" => "Y",
		"COMPONENT_TEMPLATE" => "feedback",
		"EMAIL" => COption::GetOptionString($GLOBALS["moduleName"],"email",""),
		"EMAIL_SUBJ" => "Новое сообщение с обратной связи",
		"IBLOCK_ID" => "13",
		"IBLOCK_TYPE" => "forms",
		"MESSAGE_SENDER" => "Ваше сообщение принято к рассмотрению",
		"OK_MSG" => "Успешно отправлено",
		"PRIVATE_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"private_key",""),
		"PUBLIC_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"public_key",""),
		"THEME_SENDER" => "Принято сообщение",
		"USE_GOOGLE_CAPTCHA" => COption::GetOptionString($GLOBALS["moduleName"],"use_google_captcha","")
	)
);?> <?if($scale=='12'):?>
		</div>
		<div class="tab-pane" id="tab2-2">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"contacts",
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
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "contacts",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
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
		"IBLOCK_ID" => "22",
		"IBLOCK_TYPE" => "organization",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "9",
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
		"PROPERTY_CODE" => array(0=>"ADDRESS",1=>"PHONE",2=>"EMAIL",3=>"MAP",4=>"",),
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
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>
		</div>
	</div>
</div>
<?endif;?><?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>