<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="tabs-framed">
<ul class="tabs clearfix">
  <li class="active"><a data-toggle="tab" href="#about"><?=getMessage("DESCRIPTION")?></a></li>
  <li><a data-toggle="tab" href="#program"><?=getMessage("PROGRAM")?></a></li>
  <li><a data-toggle="tab" href="#teachers"><?=getMessage("TEACHER")?></a></li>
  <li><a data-toggle="tab" href="#reviews"><?=getMessage("REVIEWS")?></a></li>
  <li><a data-toggle="tab" href="#price"><?=getMessage("PRICE_COST")?></a></li>
</ul>

<div class="tab-content">
  <div id="about" class="tab-pane fade in active">

<?if($arBXCSiteSettings["PREVIEW_TEXT"]):?>
    <div class="row mt-20">
        <div class="col-md-12">	
            <?=$arBXCSiteSettings["~PREVIEW_TEXT"]?>
		</div>
	</div>
<?endif?>

<?if(!empty($arBXCSiteSettings["FOR_WHOM"]["VALUE"])):?>
<section class="slice light-gray">
    <div class="container">
		<?
		global $filterWaitFor;
		$filterWaitFor["ID"]=$arBXCSiteSettings["FOR_WHOM"]["VALUE"];?>
		  <?
				$APPLICATION->IncludeComponent(
			"bitrix:catalog.section", 
			"benefits.list.icon", 
			array(
				"AJAX_MODE" => "N",
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" =>$arBXCSiteSettings["FOR_WHOM"]["LINK_IBLOCK_ID"],
				"SECTION_ID" => "",
				"SECTION_CODE" => "",
				"SECTION_USER_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"ELEMENT_SORT_FIELD" => "rand",
				"ELEMENT_SORT_ORDER" => "asc",
				"FILTER_NAME" => "filterWaitFor",
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
				"PAGE_ELEMENT_COUNT" => "12",
				"LINE_ELEMENT_COUNT" => "3",
				"PROPERTY_CODE" => array(
					0 => "ICON",
					1 => "",
				),
				"PRICE_CODE" => array(
				),
				"USE_PRICE_COUNT" => "Y",
				"SHOW_PRICE_COUNT" => "1",
				"PRICE_VAT_INCLUDE" => "Y",
				"PRODUCT_PROPERTIES" => array(
				),
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
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "Y",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CONVERT_CURRENCY" => "Y",
				"CURRENCY_ID" => "RUB",
				"ELEMENT_SORT_FIELD2" => "id",
				"ELEMENT_SORT_ORDER2" => "desc",
				"HIDE_NOT_AVAILABLE" => "N",
				"OFFERS_LIMIT" => "5",
				"SET_BROWSER_TITLE" => "Y",
				"SET_META_KEYWORDS" => "Y",
				"SET_META_DESCRIPTION" => "Y",
				"ADD_PROPERTIES_TO_BASKET" => "Y",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"COMPONENT_TEMPLATE" => "benefits.list.icon",
				"BACKGROUND_IMAGE" => "-",
				"SEF_MODE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"SHOW_404" => "N",
				"MESSAGE_404" => "",
				"BLOCK_ID" => "",
				"ACTIVE_DATE_FORMAT" => "d.m.Y"
			),
			$component
		);?>
	    </div>
     </section>
	<?endif;?>
	
	 </div>
  <div id="program" class="tab-pane fade">
	
 <?if($arBXCSiteSettings["PROGRAM"]):?>
    <div class="post-item mt-20">
		<?=$arBXCSiteSettings["PROGRAM"]?>
    </div>
 <?endif;?>
 
 
 </div>
  
  <div id="teachers" class="tab-pane fade">
 <?if(!empty($arBXCSiteSettings["TEACHERS"]["VALUE"])):?>
<?

    $GLOBALS["filterSpecialist"] = array("ID" => $arBXCSiteSettings["TEACHERS"]["VALUE"]);

  
   $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"about_specialist", 
	array(
		"COMPONENT_TEMPLATE" => "about_specialist",
		"IBLOCK_TYPE" => "organization",
		"IBLOCK_ID" =>$arBXCSiteSettings["TEACHERS"]["LINK_IBLOCK_ID"],
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
		"PAGER_TITLE" => "Новости",
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
<?endif;?>

</div>
   <div id="reviews" class="tab-pane fade">
  <div id="REVIEWS mt-20"> 
 <?
 $GLOBALS["filterReview"]["ID"]=$arBXCSiteSettings["REVIEWS"]["VALUE"];
 $APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"reviews_slide", 
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => $arBXCSiteSettings["REVIEWS"]["LINK_IBLOCK_ID"],
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
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
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
		"PAGER_TITLE" => "Товары",
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

</div>
   <div id="price" class="tab-pane fade">
 
<?if($arBXCSiteSettings["FORM"]):?>
    <div class="row mt-20">
        <div class="col-md-12">			
				<table class="table table-hover stacktable large-only">
					<thead>
						<tr>
							
							<th><?=GetMessage('DATE_START')?></th>
							<th><?=GetMessage('HOURS')?></th>
							<th><?=GetMessage('DURING')?></th>
							<th><?=GetMessage('COST_COURSE')?></th>
							<th><?=GetMessage('DISCOUNT')?></th>
							<th><?=GetMessage('COUNT_FORMS')?></th>
							<th><?=GetMessage('PRICE_WITH_DISCOUNT')?></th>
						</tr>
					</thead>
					<tbody>

					   <?foreach($arBXCSiteSettings["FORM"] as $arForm):?>
						<tr>
						 
						  <td><?=$arForm["SUB_VALUES"]["DATE_FORM"]["~VALUE"]?></td>
						  <td><?=$arForm["SUB_VALUES"]["HOUR_FORM"]["~VALUE"]?></td>
						  <td><?=$arForm["SUB_VALUES"]["DURING_FORM"]["~VALUE"]?></td>
						  <td><?=$arForm["SUB_VALUES"]["COST_COURSE_FORM"]["~VALUE"]?></td>
						  <td><?=$arForm["SUB_VALUES"]["DISCOUNT_FORM"]["~VALUE"]?></td>
						  <td><?=$arForm["SUB_VALUES"]["COUNT_FORM"]["~VALUE"]?></td>
						  <td>
						     <?if(is_numeric($arForm["SUB_VALUES"]["COST_COURSE_FORM"]["VALUE"])&&is_numeric($arForm["SUB_VALUES"]["DISCOUNT_FORM"]["VALUE"])):?>
						    <?=($arForm["SUB_VALUES"]["COST_COURSE_FORM"]["VALUE"]*((100 - $arForm["SUB_VALUES"]["DISCOUNT_FORM"]["~VALUE"])/100))?>
						   <?endif;?>
						  </td>
						
						</tr>
					  <?endforeach;?>
					  
					 
					</tbody>
				</table>	
				
		</div>
	</div>
<?endif;?>

	</div>