<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult['ITEMS']))
{?>
<div class="row">
<?
	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
	foreach ($arResult['ITEMS'] as $key => $arItem)
	{
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
		$strMainID = $this->GetEditAreaId($arItem['ID']);?>
      
        <div class="col-xs-12 mt-15 hidden-sm hidden-xs" id="<?=$strMainID?>" data-ls="transition2d:1;timeshift:-1000;">
            <?if(is_array($arItem["PREVIEW_IMG"])):?>
                <?if(is_array($arItem["DISPLAY_PROPERTIES"]["LINK"])):?>
                    <a target="_blank" href="<?=str_replace("#SITE_DIR#", SITE_DIR, $arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"])?>"><img class="img-responsive" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>" class="ls-bg" alt="<?=$arItem["NAME"]?>"/></a>
                <?else:?>
                    <img class="img-responsive" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>" class="ls-bg" alt="<?=$arItem["NAME"]?>"/>
                <?endif?>
			<?endif?>
		</div>    
		<?
	}?>
    </div>

<?
}
?>