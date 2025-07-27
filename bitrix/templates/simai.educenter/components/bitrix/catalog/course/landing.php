<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>





   <?if($arBXCSiteSettings["PREVIEW_TEXT"]):?>
    <div class="row mt-20">
        <div class="col-md-12">	
          <div class="section-title-wr mp">
				<h2 class="section-title"><span><?=getMessage("DESCRIPTION")?></span></h2>
		</div>			
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
					"PAGER_TITLE" => "??????",
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

		
		
		
  <?if($arBXCSiteSettings["PROGRAM"]):?>

    <div class="post-item mt-20">
	 <div class="section-title-wr mp">
				<h2 class="section-title"><span><?=getMessage("PROGRAM")?></span></h2>
		</div>
		<?=$arBXCSiteSettings["PROGRAM"]?>
    </div>
 <?endif;?>

 
 
   <?if(!empty($arBXCSiteSettings["TEACHERS"]["VALUE"])):?>
   
   <div class="section-title-wr mp mt-20">
				<h2 class="section-title"><span><?=getMessage("TEACHER")?></span></h2>
		</div>
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
		"PAGER_TITLE" => "???????",
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



  <div id="REVIEWS mt-20" class="mt-10"> 
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
		"MESS_BTN_BUY" => "??????",
		"MESS_BTN_ADD_TO_BASKET" => "? ???????",
		"MESS_BTN_SUBSCRIBE" => "???????????",
		"MESS_BTN_DETAIL" => "?????????",
		"MESS_NOT_AVAILABLE" => "??? ? ???????",
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
		"PAGER_TITLE" => "??????",
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



 <div class="section-title-wr mp mt-20">
				<h2 class="section-title hei"><span><?=getMessage("PRICE_COST")?></span></h2>
		</div>

  <?if($arBXCSiteSettings["FORM"]):?>
  
  <?/*
    echo "<pre>";
	print_r($arBXCSiteSettings["FORM"]);
	echo "</pre>";
  */
  ?>
    <div class="row mt-20">
        <div class="col-md-12">
				<table class="table table-hover stacktable large-only">
					<thead>
						<tr>
							<th><?=GetMessage('EDUCATION_FORMS')?></th>
							<th><?=GetMessage('DURING')?></th>
							<th><?=GetMessage('DATE_START')?></th>
							<th><?=GetMessage('COST_LESSON')?></th>
							<th><?=GetMessage('DISCOUNT')?></th>
							<th><?=GetMessage('PRICE_WITH_DISCOUNT')?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>

					   <?foreach($arBXCSiteSettings["FORM"] as $keyForm=> $arForm):?>
						<tr>
						  <td><?=$arForm["SUB_VALUES"]["NAME_FORM"]["~VALUE"]?> (<?=$arForm["SUB_VALUES"]["TYPE_FORM"]["~VALUE"]?>)</td>
						  <td><?=$arForm["SUB_VALUES"]["DURING_FORM"]["~VALUE"]?></td>
						  <td><?=$arForm["SUB_VALUES"]["DATE_FORM"]["~VALUE"]?></td>
						  <td><?=$arForm["SUB_VALUES"]["COST_FORM"]["~VALUE"]?></td>
						 <td><?=$arForm["SUB_VALUES"]["DISCOUNT_FORM"]["~VALUE"]?></td>
						  <td>
						    <?if(is_numeric($arForm["SUB_VALUES"]["COST_FORM"]["VALUE"])&&is_numeric($arForm["SUB_VALUES"]["DISCOUNT_FORM"]["VALUE"])):?>
						    <?=($arForm["SUB_VALUES"]["COST_FORM"]["VALUE"]*((100 - $arForm["SUB_VALUES"]["DISCOUNT_FORM"]["~VALUE"])/100))?>
						   <?endif;?>
						  </td>
						  <td><a href="#" onclick="SimaiAdd2Basket(<?=$arBXCSiteSettings["ID"]?>,<?=$keyForm?>)"
							class="btn btn-success btn-outline waves-effect waves-light" data-toggle="modal" data-target="#myModal"><?=getMessage("BUY")?></a></td>
						</tr>
					  <?endforeach;?>
					  
					 
					</tbody>
				</table>	
				
		</div>
	</div>
<?endif;?>

<?if(!empty($arResult["SHEDULE"])):?>
 <div class="section-title-wr mp mt-20">
				<h2 class="section-title"><span><?=getMessage("SHEDULE")?></span></h2>
		</div>

 <table class="table table-hover stacktable large-only">
    <thead>
        <tr>
		    <th><?=GetMessage('EDUCATION_FORMS')?></th>
            <th><?=GetMessage('DATE')?></th>
            <th><?=GetMessage('TIME')?></th>

            <th><?=GetMessage('PLACE')?></th>
		    <th><?=GetMessage('TEACHER')?></th>
        </tr>
    </thead>
    <tbody>
	  <?foreach($arResult["SHEDULE"] as $arItem):?>
	  <?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	  ?>
        <tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <td><?=$arItem["NAME"];?></td>
		    <td><?=$arItem["PROPERTIES"]["DATE"]["VALUE"]?></td>
		    <td><?=$arItem["PROPERTIES"]["TIME"]["VALUE"];?></td>
		    <td>
			 <?=$arItem["PROPERTIES"]["PLACE"]["VALUE"]?>
			</td>
			 <td>
			<?if(!empty($arItem["PROPERTIES"]["TEACHER"]["VALUE"])):?>
			 <?foreach($arItem["PROPERTIES"]["TEACHER"]["VALUE"] as $teacher):?>
			  <p><a target="_blank" href="<?=$arResult["TEACHER"][$teacher]["DETAIL_PAGE_URL"]?>"><?=$arResult["TEACHER"][$teacher]["NAME"]?></a></p>
			 <?endforeach;?>
			<?endif;?>
			</td>
        </tr>
      <?endforeach;?>
    </tbody>
</table>
<?endif;?>

<div class="row mt-15">
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
			"THEME_SENDER" => $arParams["THEME_SENDER"],
		    "MESSAGE_SENDER" => $arParams["MESSAGE_SENDER"],
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=getMessage("COURSE_ADD")?></h4>
      </div>
      <div class="modal-body">
	   <table>
	    <tr>
		 <td>
		   <?if($arBXCSiteSettings["PREVIEW_PICTURE"]):?>
			 <img src="<?=CFile::GetPath($arBXCSiteSettings["PREVIEW_PICTURE"])?>"  style="width:100px; margin-right:15px">
		   <?endif;?>
         </td>	
         <td>		 
	       <span style="font-size:16px; font-weight:600;"><?=$arBXCSiteSettings["NAME"]?></span>
		</td>
		</tr>
	  </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><?=getMessage("CONTINUE")?></button>
        <a href="/order/" class="btn btn-primary"><?=getMessage("IN_BASKET")?></a>
      </div>
    </div>
  </div>
</div>
<style>
.modal {
  text-align: center;
}

@media screen and (min-width: 768px) { 
  .modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
  width:auto !important;
}
</style>

<?/*echo "<pre>";
 print_r($arBXCSiteSettings);
 echo "</pre>";*/?>
	
