<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>


<table class="table table-hover stacktable large-only">
    <thead>
        <tr>

            <th><?=GetMessage('COURSE_SEMINAR')?></th>
            <th><?=GetMessage('TIME')?></th>
            <th><?=GetMessage('DATE')?></th>
            <th><?=GetMessage('PLACE')?></th>
        </tr>
    </thead>
    <tbody>
	  <?foreach($arResult["ITEMS"] as $arItem):?>
	  <?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	  ?>
        <tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		   
		    <td><a target="_blank" href="<?=$arResult["COURSES"][$arItem["PROPERTIES"]["COURSE"]["VALUE"]]["DETAIL_PAGE_URL"]?>"><?=$arResult["COURSES"][$arItem["PROPERTIES"]["COURSE"]["VALUE"]]["NAME"]?></a></td>
		    <td><?=$arItem["PROPERTIES"]["TIME"]["VALUE"];?></td>
		    <td><?=$arItem["PROPERTIES"]["DATE"]["VALUE"]?></td>
		    <td>
			<?=$arItem["PROPERTIES"]["PLACE"]["VALUE"]?>
			</td>
        </tr>
      <?endforeach;?>
    </tbody>
</table>
<script>
  $('.stacktable').stacktable(); 
</script>