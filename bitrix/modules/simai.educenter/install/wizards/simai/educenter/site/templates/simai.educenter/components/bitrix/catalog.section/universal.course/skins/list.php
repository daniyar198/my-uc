<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
if($countItems>0)
{
    ?>
    <div id="ulSorList">
        <? foreach ($arResult["ITEMS"] as $cell => $arElement):
            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="row mb-20" id="<?= $this->GetEditAreaId($arElement['ID']); ?>">
                <div class="col-md-4 col-sm-4">
                            <? if (is_array($arElement["PICTURE"])):?>
                                <a href="<?= $arElement["DETAIL_PAGE_URL"] ?>"><img class="img-responsive"
                                                                                    src="<?= $arElement["PICTURE"]["src"] ?>"
                                                                                    alt="<?= $arElement["NAME"] ?>"></a>
                            <? else:?>
                                <a href="<?= $arElement["DETAIL_PAGE_URL"] ?>"><img class="img-responsive"
                                                                                    src="<?= SITE_TEMPLATE_PATH ?>/images/no_client.jpg"
                                                                                    alt="<?= $arElement["NAME"] ?>"></a>
                            <? endif?>
                </div>
				<div class="col-md-8 col-sm-8">
                        <div class="pt-10 pb-10">
                            <h4 class=""><a class="hover-wrap overlay-portfolio" href="<?= $arElement['DETAIL_PAGE_URL'] ?>"><?= $arElement["NAME"] ?></a></h4>
                          	<div class="small"><?=TruncateText(strip_tags($arElement['~PREVIEW_TEXT']),200)?></div>
                        </div>
				</div>
			</div>
        <? endforeach?>
    </div>
<?
}?>