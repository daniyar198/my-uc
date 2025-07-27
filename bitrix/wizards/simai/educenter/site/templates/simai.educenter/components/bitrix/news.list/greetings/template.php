<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="row mt-15" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="col-md-3">
		  <strong><?=$arItem["~NAME"]?></strong><br>
			<?if(isset($arItem["DISPLAY_PROPERTIES"]["DATE"]["DISPLAY_VALUE"])):?>
		      <i class="fa fa-calendar" aria-hidden="true"></i> <?=$arItem["DISPLAY_PROPERTIES"]["DATE"]["DISPLAY_VALUE"]?>
            <?endif;?>
		</div>
		<div class="col-md-9">
		<?=$arItem["~PREVIEW_TEXT"]?>
		</div>
	</div>	
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
