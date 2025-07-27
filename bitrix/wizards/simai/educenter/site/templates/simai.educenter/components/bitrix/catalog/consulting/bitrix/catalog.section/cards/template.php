<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult["ITEMS"])>0)
{
    ?>
    <div class="row">
        <?
        foreach ($arResult["ITEMS"] as $key => $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM')));
            if($key && $key%2==0)echo"</div><div class='row'>";
            ?>
            <div class="col-md-6" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="wp-block product">
                    <figure>
                        <? if (is_array($arItem["PREVIEW_IMG"])): ?>
                            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><img alt="<?= $arItem["NAME"] ?>"
                                                                             src="<?= $arItem["PREVIEW_IMG"]["SRC"] ?>"
                                                                             class="img-responsive"></a>
                        <? else: ?>
                            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><img class="img-responsive"
                                                                             src="<?= SITE_TEMPLATE_PATH ?>/images/no_photo.png"
                                                                             alt="<?= $arItem["NAME"] ?>"
                                                                             title="<?= $arItem["NAME"] ?>"/></a>
                        <?endif ?>
                    </figure>
                    <h6 style="text-align: justify;"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"];?></a></h6>
                </div>
            </div>
        <?
        endforeach;?>
    </div>
<?
}?>