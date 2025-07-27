<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
if($countItems>0)
{?>
    <div class="section-title-wr mt-20">
        <h3 class="section-title left">
            <span><?=getMessage("ORDER_TITLE")?></span></h3></div>
    <table class="table table-striped table-bordered">
        <tr>
            <th><?=getMessage("DATE")?></th>
            <th><?=getMessage("FIO")?></th>
            <th><?=getMessage("PHONE")?></th>
        </tr>
   <?foreach($arResult["ITEMS"] as $cell=>$arElement):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <tr id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                <td>
                    <?if(!empty($arElement["DISPLAY_PROPERTIES"]["DATE"])):?>
                        <?=$arElement["DISPLAY_PROPERTIES"]["DATE"]["VALUE"]?>
                        <?if(!empty($arElement["DISPLAY_PROPERTIES"]["TIME"])):?>
                            (<?=$arElement["DISPLAY_PROPERTIES"]["TIME"]["VALUE"]?>)
                        <?endif?>
                    <?endif?>
                </td>
                <td>
                    <?if(!empty($arElement['DISPLAY_PROPERTIES']['FIO'])):?>
                        <?=$arElement['DISPLAY_PROPERTIES']['FIO']['DISPLAY_VALUE']?>
                    <?endif?>
                </td>
                <td>
                    <?if(!empty($arElement['DISPLAY_PROPERTIES']['PHONE'])):?>
                        <?=$arElement['DISPLAY_PROPERTIES']['PHONE']['DISPLAY_VALUE']?>
                    <?endif?>
                </td>
            </tr>
        <?endforeach?>
    </table>
<?=$arResult["NAV_STRING"];?>
<?
}?>