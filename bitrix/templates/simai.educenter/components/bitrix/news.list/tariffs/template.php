<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
        <?
        foreach($arResult["SECTIONS"] as $cell=>$arSection):
            ?>
            <h4><?=$arSection["NAME"]?></h4>
           <div style="overflow:auto">
            <table class="table table-bordered table-striped">
			  <th><?=getMessage("TITLE_PRICE")?></th>
			  <th><?=getMessage("PERIOD")?></th>
			  <th><?=getMessage("COST")?></th>
                <?
                foreach($arSection["ITEMS"] as $arItem):
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
                    ?>
                        <tr id="<?=$this->GetEditAreaId($arItem['ID'])?>">
                            <td style="width: 85%;">
                                <?=$arItem["NAME"]?>
                            </td>
							<td class="text-center">
                               <?=$arItem["PROPERTIES"]["PERIOD"]["VALUE"]?> 
                            </td>
                            <td class="text-center">
                                <nobr><?=number_format($arItem["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"], 0, "."," ")?> <?=getMessage("RUB")?></nobr>
                            </td>
                        </tr>
                <?endforeach?>
                </table>
             </div>
        <?endforeach?>
