<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
if($countItems<1 && !$arResult["DESCRIPTION"])return;
?>
<?if($arResult["DESCRIPTION"]):?>
    <p><?=$arResult["DESCRIPTION"]?></p>
<?endif?>
<?foreach($arResult["ITEMS"] as $cell=>$arItem):
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
    <div class="post-item style2" style="padding-left: 0;" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="post-content-wr">
            <?if(!is_array($arItem["DISPLAY_PROPERTIES"]["FILE"])):?>
                <div class="post-meta-top">
                    <div class="post-image">
                        <?if(is_array($arItem["PREVIEW_IMG"])):?>
                            <a class="theater" href="<?=$arItem["PREVIEW_IMG"]["OLD_LINK"]?>"><img alt="<?=$arItem["NAME"]?>" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>"></a>
                        <?endif?>
                    </div>
                    <h2 class="post-title">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"<?=$arItem["NAME"]?></a>
                    </h2>
                    <hr/>
                </div>
            <?else:?>
                <div class="post-meta-top">
                    <div class="post-image">
                        <?if(is_array($arItem["PREVIEW_IMG"])):?>
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img alt="<?=$arItem["NAME"]?>" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>"></a>
                        <?endif?>
                    </div>
                    <h2 class="post-title">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                    </h2>
                </div>
                <div class="post-content clearfix">
                    <?if(is_array($arItem["DISPLAY_PROPERTIES"]["FILE"]))
                    {
                        ?>
                        <a class="download-link" target="_blank" href="<?= $arItem["DOC_SRC"] ?>"><i
                                class="fa fa-download"></i> <?= getMessage("DOWNLOAD") ?>

                            <? if ($arItem["DOC_SIZE"]):?>
                                (<?= getMessage("SIZE") ?> <?= $arItem["DOC_SIZE"] ?> Kb)
                            <? endif?>
                        </a>
                    <?
                    }
                    ?>
                    <div class="post-desc">
                        <p>
                            <?=truncateText(strip_tags($arItem["PREVIEW_TEXT"]),520)?>
                        </p>
                    </div>
                </div>
                <div class="post-meta-bot clearfix">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="btn btn-sm btn-base"><?=getMessage("VIEW_IMG");?></a>
                </div>
            <?endif;?>
        </div>
    </div>
<?endforeach?>
<?=$arResult["NAV_STRING"]?>