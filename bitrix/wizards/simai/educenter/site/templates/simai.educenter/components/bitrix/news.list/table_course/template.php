<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<table class="table">
    <thead>
      <tr>
        <th><?=getMessage("COURSE")?></th>
        <th><?=getMessage("EDUCATION_FORMS")?></th>
   		<th><?=getMessage("NUMBER_HOURS")?></th>
		<th><?=getMessage("DURATION")?></th>
		<th><?=getMessage("COST_LESSON")?></th>
		<th><?=getMessage("COST_COURSE")?></th>
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
		  
          <td><?=$subProps["SUB_VALUES"]["NAME_FORM"]["VALUE"]?></td>
		  <td><?=$subProps["SUB_VALUES"]["DATE_FORM"]["VALUE"]?></td>
		  <td><?=$subProps["SUB_VALUES"]["HOUR_FORM"]["VALUE"]?></td>
		  <td><?=$subProps["SUB_VALUES"]["DURING_FORM"]["VALUE"]?></td>
		  <td><?=$subProps["SUB_VALUES"]["COST_LESSON_FORM"]["VALUE"]?></td>
		  <td><?=$subProps["SUB_VALUES"]["COST_COURSE_FORM"]["VALUE"]?></td>
		<?endforeach;?>
		
  	 </tr>	
<?endforeach;?>

    </tbody>
  </table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>


