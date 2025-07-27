<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?
foreach($arResult["ITEMS"] as $key=>$arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>   
	<div class="wp-block article grid <?=(count($arResult["ITEMS"]) == ($key+1) ? 'no-margin' : 'bb')?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<h4 class="article-title">
				<?echo truncateText($arItem["DISPLAY_PROPERTIES"]["NAME"]["VALUE"],75)?>
		</h4>
		<p>
            <?=$arItem["DISPLAY_PROPERTIES"]["REVIEW"]["DISPLAY_VALUE"]?>
		</p>
	</div>
<?endforeach;?>