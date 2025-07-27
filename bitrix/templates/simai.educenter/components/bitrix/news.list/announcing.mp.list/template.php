<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<?
	if(isset($arParams["SEF_FOLDER"])):
	 $arItem["DETAIL_PAGE_URL"]=str_replace(SITE_DIR."announcing/",$arParams["SEF_FOLDER"],$arItem["DETAIL_PAGE_URL"]);
	endif;
	?>
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="wp-block article grid" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<p class="t--1 c-text-secondary mt-3 mb-2">
					<i class="fa fa-calendar mr-2 c-primary"></i><?=$arItem["ACTIVE_FROM"]?>
				</p>
				<h3 class="t-1 my-2 t-title ñ-text-primary l-inherit l-hover-primary l-hover-underline-none transition">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
				</h3>
				<p class="c-text-secondary"><?=truncateText(strip_tags($arItem["PREVIEW_TEXT"]),200)?></p>
			</div>
		</div>
	</div>		
<?endforeach;?>