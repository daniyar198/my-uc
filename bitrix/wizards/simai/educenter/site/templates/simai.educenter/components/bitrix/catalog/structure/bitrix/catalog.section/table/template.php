<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
if($countItems>0){?>
	<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th><?=getMessage("FIO")?></th>
            <th><?=getMessage("POSITION")?></th>
            <th><?=getMessage("CONTACT_PHONE")?></th>
            <?if(isset($arResult["EDUCATION_COLUMN"])):?>
                <th><?=getMessage("EDUCATION")?></th>
            <?endif?>
            <?if(isset($arResult["SERTIFICATE_COLUMN"])):?>
                <th><?=getMessage("SERTIFICATE")?></th>
            <?endif?>
            <?if(isset($arResult["PROGRAM"])):?>
                <th><?=getMessage("PROGRAM")?></th>
            <?endif?>
        </tr>
   <?foreach($arResult["ITEMS"] as $cell=>$arElement):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <tr id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                <td><a class="hover-wrap overlay-portfolio" href="<?=$arElement['DETAIL_PAGE_URL']?>"><?=$arElement["NAME"]?></a>
				<?if(isset($arResult["SCHEDULE"][$arElement['ID']])):?>
						<a class="btn btn-base btn-sm mt-10"  href="<?= $arElement['DETAIL_PAGE_URL'] ?>"><?=GetMessage("SIGN")?></a>
					<? endif?>
				
				</td>
                	
				<td>
                    <?if(is_array($arElement['DISPLAY_PROPERTIES']['POSITION'])):?>
                        <small><?=$arElement['DISPLAY_PROPERTIES']['POSITION']['DISPLAY_VALUE']?></small>
                    <?endif?>
                </td>
                <td>
                    <?if(is_array($arElement['DISPLAY_PROPERTIES']['PHONE'])):?>
                        <small><?=$arElement['DISPLAY_PROPERTIES']['PHONE']['DISPLAY_VALUE']?></small>
                    <?endif?>
                </td>
                <?if(isset($arResult["EDUCATION_COLUMN"])):?>
                <td>
                    <?if(is_array($arElement['DISPLAY_PROPERTIES']['EDUCATION'])):?>
                        <small><?=$arElement['DISPLAY_PROPERTIES']['EDUCATION']['DISPLAY_VALUE']?></small>
                    <?endif?>
                </td>
                <?endif?>
                <?if(isset($arResult["SERTIFICATE_COLUMN"])):?>
                <td>
                    <?if(is_array($arElement['DISPLAY_PROPERTIES']['SERTIFICATE'])):?>
                        <?foreach($arElement['DISPLAY_PROPERTIES']['SERTIFICATE']["VALUE"] as $key => $arValue):?>
                            <?if($key):?><hr/><?endif?><small><?=$arValue?> - <?=$arElement['DISPLAY_PROPERTIES']['SERTIFICATE']['DESCRIPTION'][$key]?></small>
                        <?endforeach?>
                    <?endif?>
                </td>
                <?endif?>
                <?if(isset($arResult["PROGRAM"])):?>
                <td>
                    <?if(is_array($arElement['PROPERTIES']['PROGRAM']["VALUE"])):?>
					
					    <?foreach($arElement['PROPERTIES']['PROGRAM']["VALUE"] as $val):?>
                           <div><small><?=$arResult['PROGRAM'][$val]?></small></div><br>
						<?endforeach?> 
                    <?endif?>
                </td>
                <?endif?>
				
            </tr>
        <?endforeach?>
    </table>
	</div>
<?=$arResult["NAV_STRING"];?>
<?}?>