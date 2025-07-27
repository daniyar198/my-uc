<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?
foreach($arResult["ITEMS"] as $key=>$arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

<div class="row" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="overflow-x: auto">
        <div class="col-md-12">
            <div class="wp-block article list">
                    <?if(is_array($arItem["PREVIEW_IMG"])):?>
                <div class="article-image hidden-xs">
                    <?if(is_array($arItem["PREVIEW_IMG"])):?>
                        <img alt="<?=$arItem["NAME"]?>" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>" class="img-responsive">
                    <?endif?>
                </div>
                <div class="wp-block-body">
                    <?endif?>
                    <h3 class="title">
                        <?echo $arItem["NAME"]?>
                    </h3>
                    <?if(is_array($arItem["DISPLAY_PROPERTIES"]["SITE"])):?>
                        <p>
                            <a target="_blank" href="<?=$arItem["DISPLAY_PROPERTIES"]["SITE"]["VALUE"]?>"><i class="fa fa-paper-plane-o"></i> <?=GetMessage("GO_PARTNER_SITE")?></a>
                        </p>
                    <?endif?>
                    <?if(is_array($arItem["DISPLAY_PROPERTIES"]["PHONE"])):?>
                        <p>
                            <i class="fa fa-phone"></i> <?=$arItem["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"]?>
                        </p>
                    <?endif?>
                    <?if($arItem["PREVIEW_TEXT"]):?>
                            <?=$arItem["PREVIEW_TEXT"]?>
					<?elseif($arItem["DETAIL_TEXT"]):?>
                            <?=$arItem["DETAIL_TEXT"]?>
                    <?endif;?>
                <?if(is_array($arItem["PREVIEW_IMG"])):?>
                    </div>
                <?endif;?>
                <hr/>
            </div>
        </div>
    </div>
<?
endforeach;?>