<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	$this->setFrameMode(true);?>
<div class="contact-info">
	<?foreach($arResult["ITEMS"] as $arElement):?>
	<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCST_ELEMENT_DELETE_CONFIRM')));
		?>
	<h2 class="mt-30"><?=$arElement['NAME']?></h2>
	<?
		if(isset($arElement["DISPLAY_PROPERTIES"]["MAP"]["DISPLAY_VALUE"])):
		  $lat=substr($arElement["DISPLAY_PROPERTIES"]["MAP"]["VALUE"], 0,strpos($arElement["DISPLAY_PROPERTIES"]["MAP"]["VALUE"],","));
		  $lng=str_replace($lat.",", "", $arElement["DISPLAY_PROPERTIES"]["MAP"]["VALUE"]);
		$scale="17";
		$MAP_DATA="a:4:{s:10:\"yandex_lat\";d:".$lat.";s:10:\"yandex_lon\";d:".$lng.";s:12:\"yandex_scale\";i:".$scale.";s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:".$lng.";s:3:\"LAT\";d:".$lat.";s:4:\"TEXT\";s:".count(str_split($arElement["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"])).":\"".$arElement["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"]."\";}}}";
		$APPLICATION->IncludeComponent(
			"bitrix:map.yandex.view", 
			"contacts", 
			array(
				"COMPONENT_TEMPLATE" => "contacts",
				"CONTROLS" => array(
					0 => "ZOOM",
					1 => "SMALLZOOM",
				),
				"INIT_MAP_TYPE" => "MAP",
				"MAP_DATA" => $MAP_DATA,
				"MAP_HEIGHT" => "300",
				"MAP_ID" => "",
				"MAP_WIDTH" => "100%",
				"OPTIONS" => array(
					0 => "ENABLE_DBLCLICK_ZOOM",
					1 => "ENABLE_DRAGGING",
				),
				"SHOW_INFO" => "N"
			),
			false
		);
		endif;
			
		?>
	<div class="mp section-title-wr mt-20">
		<h3 class="section-title">
			<span><?=getMessage("CONTACT")?></span>
		</h3>
	</div>
	<ul class="list-check mb-10 mt-10 ml-0 mr-0" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<?if(is_array($arElement["DISPLAY_PROPERTIES"]["ADDRESS"])):?>
		<li>
			<i class="fa fa-building"></i>
			<?=$arElement["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"]?>
		</li>
		<?endif?>
		<?if(is_array($arElement["DISPLAY_PROPERTIES"]["PHONE"])):?>
		<li>
			<i class="fa fa-phone"></i>
			<?=$arElement["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"]?>
		</li>
		<?endif?>
		<?if(is_array($arElement["DISPLAY_PROPERTIES"]["EMAIL"])):?>
		<li>
			<i class="fa fa-globe"></i>
			<a href="mailto:<?=$arElement["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"]?>"><?=$arElement["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"]?></a>
		</li>
		<?endif?>
	</ul>
	<?
		endforeach;?>
</div>