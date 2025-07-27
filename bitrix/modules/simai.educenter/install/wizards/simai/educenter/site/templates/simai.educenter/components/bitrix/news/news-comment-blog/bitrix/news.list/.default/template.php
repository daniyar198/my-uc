<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="row mb-20" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if(is_array($arItem["PREVIEW_IMG"])):?>
			<div class="col-md-4 col-sm-4 mb-20">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="img-responsive" alt="<?=$arItem["NAME"]?>" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>"></a>
			</div>

		<?endif?>
		<div class="col-md-<?=($arItem["PREVIEW_IMG"] <> "" ? 8 : 12)?> col-sm-<?=($arItem["PREVIEW_IMG"] <> "" ? 8 : 12)?>">
			<h5><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></h5>
			<?if (($arParams["DISPLAY_DATE"]=="Y")&&($arItem["ACTIVE_FROM"])):?>
				<div class="date mt-10 mb-10 grey-500">
					<i class="fa fa-calendar"></i> <?echo $arItem["DISPLAY_ACTIVE_FROM"]?>
					<?if($arParams["NOT_SHOW_SECTION"]!="Y"):?>
						<?if(is_array($arResult["CURRENT_SECTION"])):?>
							<span class="bl pl-10 ml-10"><a class="grey-500 text-dashed" href="<?=$arResult["CURRENT_SECTION"]["SECTION_PAGE_URL"]?>"><?=$arResult["CURRENT_SECTION"]["NAME"]?></a></span>
						<?elseif(is_array($arResult["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]])):?>
							<span class="bl pl-10 ml-10"><a class="grey-500 text-dashed" href="<?=$arResult["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]]["SECTION_PAGE_URL"]?>"><?=$arResult["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]]["NAME"]?></a></span>
						<?endif?>
					<?endif?>	
					
					<?if(isset($arItem["DISPLAY_PROPERTIES"]["ADDRESSEE"]["VALUE"])):?>
						<span class="bl pl-10 ml-10"><?=$arItem["DISPLAY_PROPERTIES"]["ADDRESSEE"]["VALUE"]?></span>
					<?endif?>
				</div>
			<?endif;?>
			<p>
				<?if($arItem["PREVIEW_TEXT"]):?>
					<?=truncateText(strip_tags($arItem["~PREVIEW_TEXT"]),520)?></a>
				<?else:?>
					<?=truncateText(strip_tags($arItem["~DETAIL_TEXT"]),520)?>
				<?endif;?>
			</p>			
		</div>
    </div>

<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

