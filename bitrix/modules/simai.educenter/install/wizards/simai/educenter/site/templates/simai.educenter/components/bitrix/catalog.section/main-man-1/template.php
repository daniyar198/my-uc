<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(!empty($arResult["ITEMS"]))
{
    foreach ($arResult["ITEMS"] as $key => $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>


<section class="sf-chief-area">
	<div class="t-center bg-theme-30 p-3 d-flex align-items-center" style="background-color:transparent">
		<div class="w-100">
			<a href="<?=$arItem["DETAIL_PAGE_URL"] ?>" class="d-flex align-items-center justify-content-center">
                <img alt="<?= $arItem["NAME"] ?>"
                    src="<?= $arItem["PREVIEW_IMG"]["SRC"] ?>"
                    class="img-fluid circle" style="height:auto;max-width:100%;">
			</a>
			<p class="t--1 t-bold c-text-secondary t-uppercase mt-3 mb-2">
            <?= $arItem["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"] ?>
            </p>
			<h3 class="t-1 mt-2 mb-3 c-text-primary l-inherit l-hover-primary l-hover-underline-none ">
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="l-inherit">
                <?echo truncateText($arItem["NAME"], 75)?>        
            </a>
            </h3>
			<a href="#" class="btn btn-primary" data-modal data-blur data-src="/include/main_speech.php"><?=getMessage("TEMPLATE_GRID_SIDEBAR_CHIEF__APPEAL")?></a>
            
		</div>
	</div>
</section>



		
    <?endforeach;
}?>