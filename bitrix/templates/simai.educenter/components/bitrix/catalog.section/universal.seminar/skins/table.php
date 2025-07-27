<?
$countItems=count($arResult["ITEMS"]);
if($countItems>0){
?>
 <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <tr>
            <th><?=getMessage("COURSE")?></th>
            <th><?=getMessage("FORMS_LEARNING")?></th>
            <th><?=getMessage("GROUPS")?></th>
            <th><?=getMessage("PRICE")?></th>
            <th><?=getMessage("DISCOUNT")?></th>
      </tr>
   <?foreach($arResult["ITEMS"] as $cell=>$arElement):
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <tr id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                <td rowspan="<?=count($arElement["PROPERTIES"]["FORM"]["VALUE"])?>" >
				  <a class="hover-wrap overlay-portfolio" href="<?=$arElement['DETAIL_PAGE_URL']?>"><?=$arElement["NAME"]?></a>
				</td>
			<?if(count($arElement["PROPERTIES"]["FORM"]["VALUE"])>0):?>
             <?foreach($arElement["PROPERTIES"]["FORM"]["VALUE"] as $key => $arForm):?>
			   <?if($key!=0):?><tr><?endif;?>
                <td><?=$arForm["SUB_VALUES"]["NAME_FORM"]["VALUE"]?></td>			 
				<td><?=$arForm["SUB_VALUES"]["DATE_FORM"]["VALUE"]?></td>
				<td><?=$arForm["SUB_VALUES"]["COST_COURSE_FORM"]["VALUE"]?></td>
				<td><?=$arForm["SUB_VALUES"]["DISCOUNT_FORM"]["VALUE"]?></td>
				</tr>
			 <?endforeach?>
			<?else:?>
            </tr>
			<?endif;?>
        <?endforeach?>
    </table>
	</div>
<?}?>