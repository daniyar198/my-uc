<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
/*
echo "<pre>";
print_r($arResult["ITEMS"][0]["DISPLAY_PROPERTIES"]["DISCIPLINE"]);
echo "</pre>";*/
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
                            <ul class="small clear">
								<? if (is_array($arElement['DISPLAY_PROPERTIES']['POSITION'])):?>
									<li><b><?= $arElement['DISPLAY_PROPERTIES']['POSITION']['NAME'] ?>
											:</b> <?= $arElement['DISPLAY_PROPERTIES']['POSITION']['DISPLAY_VALUE'] ?>
									</li>
								<? endif?>
								<? if (is_array($arElement['DISPLAY_PROPERTIES']['SPECIALTY'])):?>
									<li><b><?= $arElement['DISPLAY_PROPERTIES']['SPECIALTY']['NAME'] ?>
											:</b><a href="<?=$arParams['~SECTION_URL']?>?specialty=<?=$arElement['PROPERTIES']['SPECIALTY']['VALUE']?>"> <?=strip_tags($arElement['DISPLAY_PROPERTIES']['SPECIALTY']['DISPLAY_VALUE'])?></a>
									</li>
								<? endif?>
								<?if(is_array($arElement['DISPLAY_PROPERTIES']['PHONE'])):?>
									<li><b><?=$arElement['DISPLAY_PROPERTIES']['PHONE']['NAME']?>
											:</b> <?=$arElement['DISPLAY_PROPERTIES']['PHONE']['DISPLAY_VALUE']?>
									</li>
								<? endif?>
				                <?if(is_array($arElement["DISPLAY_PROPERTIES"]["DISCIPLINE"])):?>
                                    <li><b><?=$arElement["DISPLAY_PROPERTIES"]["DISCIPLINE"]["NAME"]?>:</b>
									 <ul>
				                     <?foreach($arElement['DISPLAY_PROPERTIES']['DISCIPLINE']['VALUE'] as $discipline):?>
                                      <li><?=$arElement['DISPLAY_PROPERTIES']['DISCIPLINE']["LINK_ELEMENT_VALUE"][$discipline]["~NAME"]?></li>
                                     <?endforeach?>
									  </ul>
			                        </li>
                                <?endif?>
								<? if (is_array($arElement['DISPLAY_PROPERTIES']['FILIAL'])):?>
									<li><b><?= $arElement['DISPLAY_PROPERTIES']['FILIAL']['NAME'] ?>
											:</b>  <?=$arResult["FILIAL"][$arElement['DISPLAY_PROPERTIES']['FILIAL']['VALUE']]?>
									</li>
								<? endif?>
							</ul>							
							<?if(isset($arResult["SCHEDULE"][$arElement['ID']])):?>
							  <a class="btn btn-base btn-sm mt-10"  href="<?= $arElement['DETAIL_PAGE_URL'] ?>"><?=GetMessage("SIGN")?></a>
							<? endif?>
                        </div>
				</div>
			</div>
        <? endforeach?>
        <?= $arResult["NAV_STRING"] ?>
    </div>
<?
}?>