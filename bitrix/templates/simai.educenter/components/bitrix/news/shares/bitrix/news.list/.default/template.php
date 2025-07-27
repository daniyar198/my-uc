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
    <div class="mb-15" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
       <h5><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></h5>
		<?if($arItem["PROPERTIES"]["DATE_FROM"]["VALUE"]!=""&&$arItem["ACTIVE_TO"]!=""):?>
		   <p><i class="fa fa-calendar"></i> <?=$arItem["PROPERTIES"]["DATE_FROM"]["VALUE"]?> - <?=$arItem["ACTIVE_TO"]?></p>
		<?endif;?>
        <p><?=truncateText(strip_tags($arItem["~PREVIEW_TEXT"]),200)?></p>
    </div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

<?/*
 echo "<pre>";
 print_r($arResult["ITEMS"][0]);
 echo "</pre>";
*/
?>

