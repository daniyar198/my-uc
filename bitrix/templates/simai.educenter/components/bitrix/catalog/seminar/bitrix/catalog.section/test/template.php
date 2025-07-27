<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();/** @var array $arParams */
$this->setFrameMode(true);
?>
<pre><?//print_r($arResult)?></pre>
<div class="catalog-section">
<?if(true/*$arResult["DESCRIPTION"] && !$arResult["UF_BOTTOM"]*/):?>
    <div class="row">
    <?if(is_array($arResult["PREVIEW_IMG"])):?>
        <div class="col-md-4">
        <img class="img-responsive" src="<?=$arResult["PREVIEW_IMG"]["SRC"]?>" alt="<?=$arResult["NAME"]?>"/>
        </div>
        <div class="col-md-8">
    <?else:?>
        <div class="col-md-12">
    <?endif?>
    <?=$arResult["DESCRIPTION"]?>
            <div class="mt-10"></div>
            <a class="btn btn-blue order_site" data-comment="<?=getMessage("ORDER_QUESTIONS")?>: <?=$arResult["NAME"]?>" data-title="<?=getMessage("ORDER_QUESTIONS")?>" href="#callManager" style="font-weight: normal;" data-toggle="modal"><?=getMessage("ORDER_QUESTIONS")?></a>
            <button data-toggle="modal" data-target="#myModal" class="btn btn-theme"><?=getMessage("ORDER_PHONE")?></button>
    </div>
    </div>
    <div class="mt-15"></div>
<?endif;
?>
    <?if(!empty($arResult["SECTIONS"])):
        $i=0;
        ?>
    <ul class="nav nav-tabs">
        <?
        foreach($arResult["SECTIONS"] as $arSect):
            if(!empty($arResult["SECT_ITEMS"][$arSect["ID"]]) || is_array($arSect["SECTIONS"])):
            ?>
            <li <?if(!$i):?>class="active"<?endif?>><a href="#sect_<?=$arSect["ID"]?>" data-toggle="tab"><?=$arSect["NAME"]?></a></li>
            <?else:?>
                <li <?if(!$i):?>class="active"<?endif?>><a style="color: #ed5441" href="#sect_<?=$arSect["ID"]?>" data-toggle="tab"><?=$arSect["NAME"]?></a></li>
        <?
            endif;
            $i++;
        endforeach?>
    </ul>
    <?endif?>
    <div class="tab-content">
    <?
    $i=0;
    foreach($arResult["SECTIONS"] as $arSect):
        ?>
    <?if(!empty($arResult["SECT_ITEMS"][$arSect["ID"]])):?>
            <div class="tab-pane fade<?if(!$i):?> active in<?endif?>" id="sect_<?=$arSect["ID"]?>">
                    <?if($arSect["DESCRIPTION"] && !$arSect["UF_BOTTOM"]):?>
                        <?=$arSect["DESCRIPTION"]?>
                        <hr/>
                    <?endif?>
                    <table class="table table-striped" width="100%">
                        <thead>
                        <tr>
                            <td><?=GetMessage("CATALOG_TITLE")?></td>
                               <?foreach($arResult["PRICES"] as $code=>$arPrice):?>
                                <td><?=$arPrice["TITLE"]?></td>
                            <?endforeach?>
                            <?if(count($arResult["PRICES"]) > 0):?>
                                <td>&nbsp;</td>
                            <?endif?>
                        </tr>
                        </thead>
                        <?
                        foreach($arResult["SECT_ITEMS"][$arSect["ID"]] as $arElement):?>
                            <?
                            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <tr id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                                <td>
                                    <?=$arElement["NAME"]?>
                                    <?if(count($arElement["SECTION"]["PATH"])>0):?>
                                        <br />
                                        <?foreach($arElement["SECTION"]["PATH"] as $arPath):?>
                                            / <a href="<?=$arPath["SECTION_PAGE_URL"]?>"><?=$arPath["NAME"]?></a>
                                        <?endforeach?>
                                    <?endif?>
                                </td>
                                <?foreach($arResult["PRICES"] as $code=>$arPrice):?>
                                    <td>
                                        <?if($arPrice = $arElement["PRICES"][$code]):?>
                                            <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                                <s class="catalog-old-price"><?=$arPrice["PRINT_VALUE"]?></s><br /><span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
                                            <?else:?>
                                                <span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
                                            <?endif?>
                                        <?else:?>
                                            &nbsp;
                                        <?endif;?>
                                    </td>
                                <?endforeach;?>
                                <?if(count($arResult["PRICES"]) > 0):?>
                                    <td>
                                        <?if($arElement["CAN_BUY"]):?>
                                            <noindex>
                                                <a href="<?echo $arElement["BUY_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_BUY")?></a>
                                                <!--&nbsp;<a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?></a>-->
                                            </noindex>
                                        <?elseif((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"])):?>
                                            <?=GetMessage("CATALOG_NOT_AVAILABLE")?>
                                            <?$APPLICATION->IncludeComponent("bitrix:sale.notice.product", ".default", array(
                                                "NOTIFY_ID" => $arElement['ID'],
                                                "NOTIFY_URL" => htmlspecialcharsback($arElement["SUBSCRIBE_URL"]),
                                                "NOTIFY_USE_CAPTHA" => "N"
                                            ),
                                                $component
                                            );?>
                                        <?endif?>&nbsp;
                                    </td>
                                <?endif;?>
                            </tr>
                        <?
                        endforeach;?>
                    </table>
                <?if($arSect["DESCRIPTION"] && $arSect["UF_BOTTOM"]):?>
                    <?=$arSect["DESCRIPTION"]?>
                <?endif?>
            </div>
    <?        $i++;
        elseif(is_array($arSect["SECTIONS"])):?>
        <div class="tab-pane fade<?if(!$i):?> active in<?endif?>" id="sect_<?=$arSect["ID"]?>">
            <?if($arSect["DESCRIPTION"] && !$arSect["UF_BOTTOM"]):?>
                <?=$arSect["DESCRIPTION"]?>
                <hr/>
            <?endif?>
            <?
            foreach($arSect["SECTIONS"] as $arSubsect):
        ?>

                <div class="section-title-wr">
                    <h3 class="section-title left">
                        <span><?=$arSubsect["NAME"]?></span></h3>
                </div>
                <?if($arSubsect["DESCRIPTION"] && !$arSubsect["UF_BOTTOM"]):?>
                    <?=$arSubsect["DESCRIPTION"]?>
                <hr/>
                 <?endif?>
                <table class="table table-striped" width="100%">
                    <thead>
                    <tr>
                        <td><?=GetMessage("CATALOG_TITLE")?></td>
                        <?if(count($arResult["SECT_ITEMS"][$arSubsect["ID"]]) > 0):
                            foreach($arResult["SECT_ITEMS"][$arSubsect["ID"]][0]["DISPLAY_PROPERTIES"] as $arProperty):?>
                                <td><?=$arProperty["NAME"]?></td>
                            <?endforeach;
                        endif;?>
                        <?foreach($arResult["PRICES"] as $code=>$arPrice):?>
                            <td><?=$arPrice["TITLE"]?></td>
                        <?endforeach?>
                        <?if(count($arResult["PRICES"]) > 0):?>
                            <td>&nbsp;</td>
                        <?endif?>
                    </tr>
                    </thead>
                    <?
                    foreach($arResult["SECT_ITEMS"][$arSubsect["ID"]] as $arElement):?>
                        <?
                        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <tr id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                            <td>
                                <?=$arElement["NAME"]?>
                                <?if(count($arElement["SECTION"]["PATH"])>0):?>
                                    <br />
                                    <?foreach($arElement["SECTION"]["PATH"] as $arPath):?>
                                        / <a href="<?=$arPath["SECTION_PAGE_URL"]?>"><?=$arPath["NAME"]?></a>
                                    <?endforeach?>
                                <?endif?>
                            </td>
                            <?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                                <td>
                                    <?if(is_array($arProperty["DISPLAY_VALUE"]))
                                        echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                                    elseif($arProperty["DISPLAY_VALUE"] === false)
                                        echo "&nbsp;";
                                    else
                                        echo $arProperty["DISPLAY_VALUE"];?>
                                </td>
                            <?endforeach?>
                            <?foreach($arResult["PRICES"] as $code=>$arPrice):?>
                                <td>
                                    <?if($arPrice = $arElement["PRICES"][$code]):?>
                                        <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                            <s class="catalog-old-price"><?=$arPrice["PRINT_VALUE"]?></s><br /><span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
                                        <?else:?>
                                            <span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
                                        <?endif?>
                                    <?else:?>
                                        &nbsp;
                                    <?endif;?>
                                </td>
                            <?endforeach;?>
                            <?if(count($arResult["PRICES"]) > 0):?>
                                <td>
                                    <?if($arElement["CAN_BUY"]):?>
                                        <noindex>
                                            <a href="<?echo $arElement["BUY_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_BUY")?></a>
                                            <!--&nbsp;<a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?></a>-->
                                        </noindex>
                                    <?elseif((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"])):?>
                                        <?=GetMessage("CATALOG_NOT_AVAILABLE")?>
                                        <?$APPLICATION->IncludeComponent("bitrix:sale.notice.product", ".default", array(
                                            "NOTIFY_ID" => $arElement['ID'],
                                            "NOTIFY_URL" => htmlspecialcharsback($arElement["SUBSCRIBE_URL"]),
                                            "NOTIFY_USE_CAPTHA" => "N"
                                        ),
                                            $component
                                        );?>
                                    <?endif?>&nbsp;
                                </td>
                            <?endif;?>
                        </tr>
                    <?
                    endforeach;?>
                </table>
                <?if($arSubsect["DESCRIPTION"] && $arSubsect["UF_BOTTOM"]):?>
                    <?=$arSubsect["DESCRIPTION"]?>
            <?endif?>
        <?
            endforeach;?>
            <?if($arSect["DESCRIPTION"] && $arSect["UF_BOTTOM"]):?>
                <?=$arSect["DESCRIPTION"]?>
            <?endif?>
        </div>
    <?
    $i++;
    else:?>
        <div class="tab-pane fade<?if(!$i):?> active in<?endif?>" id="sect_<?=$arSect["ID"]?>">
            <?if($arSect["DESCRIPTION"] && !$arSect["UF_BOTTOM"]):?>
                <?=$arSect["DESCRIPTION"]?>
                <hr/>
            <?endif?>
            <?if($arSect["DESCRIPTION"] && $arSect["UF_BOTTOM"]):?>
                <?=$arSect["DESCRIPTION"]?>
            <?endif?>
        </div>
        <?
        $i++;
    endif;?>

            <?
    endforeach?>
        </div>
<?if($arResult["DESCRIPTION"] && $arResult["UF_BOTTOM"]):?>
        <div class="row">
            <?if(is_array($arResult["PREVIEW_IMG"])):?>
            <div class="col-md-4">
                <img class="img-responsive" src="<?=$arResult["PREVIEW_IMG"]["SRC"]?>" alt="<?=$arResult["NAME"]?>"/>
            </div>
            <div class="col-md-8">
                <?else:?>
                <div class="col-md-12">
                    <?endif?>
                    <?=$arResult["DESCRIPTION"]?>
                </div>
            </div>
<?endif;?>
</div>
