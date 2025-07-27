<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div style="overflow-x:scroll">
<table class="table">
    <thead>
      <tr>
	    <th><?=getMessage("SEMINAR")?></th>
        <th><?=getMessage("DATA")?></th>
		<th><?=getMessage("NUMBER_HOURS")?></th>
		<th><?=getMessage("DURATION")?></th>
	    <th><?=getMessage("COST_SEMINAR")?></th>
        <th><?=getMessage("MAX_COUNT")?></th>
        <th><?=getMessage("DISCOUNT")?></th>
        <th><?=getMessage("COST_WITH_DISCOUNT")?></th>
      </tr>
    </thead>
    <tbody>
   
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	
	    <td 
		  <?if(count($arItem["PROPERTIES"]["FORM"]["VALUE"])>1):?>
		     rowspan ='<?=count($arItem["PROPERTIES"]["FORM"]["VALUE"])?>'
		  <?endif;?>>
		  <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["~NAME"]?></a>
		</td>
		<?foreach($arItem["PROPERTIES"]["FORM"]["VALUE"] as $subcode => $subProps):?>
		
          <?if($subcode!=0):?>
		      </tr><tr>
		  <?endif?>
		  <td><?=$subProps["SUB_VALUES"]["DATE_FORM"]["VALUE"]?></td>
		  <td><?=$subProps["SUB_VALUES"]["HOUR_FORM"]["VALUE"]?></td>
		  <td><?=$subProps["SUB_VALUES"]["DURING_FORM"]["VALUE"]?></td>
		  <td><?=$subProps["SUB_VALUES"]["COST_COURSE_FORM"]["VALUE"]?></td>
          <td><?=$subProps["SUB_VALUES"]["COUNT_FORM"]["VALUE"]?></td>
          <td><?=$subProps["SUB_VALUES"]["DISCOUNT_FORM"]["VALUE"]?></td>
<td><?=$subProps["SUB_VALUES"]["SALE"]["VALUE"]?></td>
		<?endforeach;?>
		
  	 </tr>	
<?endforeach;?>

    </tbody>
  </table>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>


