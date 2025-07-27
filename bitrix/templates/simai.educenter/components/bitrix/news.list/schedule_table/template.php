<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?if(count($arResult["ITEMS"]) > 0):?>
  <div style="overflow-x:auto">
	<table class="table table-hover">
			<thead>
					<tr>
							<th><?=GetMessage('COURSE')?></th>
					<th><?=GetMessage('EDUCATION_FORMS')?></th>
	<th><?=GetMessage('DATE')?></th>
							<th><?=GetMessage('TIME')?></th>

							<th><?=GetMessage('PLACE')?></th>
					<th><?=GetMessage('TEACHER')?></th>
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
					<td><?=$arItem["NAME"];?></td>
					<td><?=$arItem["PROPERTIES"]["DATE"]["VALUE"]?></td>
					<td><?=$arItem["PROPERTIES"]["TIME"]["VALUE"];?></td>
					<td>
				<?=$arItem["PROPERTIES"]["PLACE"]["VALUE"]?>
				</td>
				<td>
				<?if(!empty($arItem["PROPERTIES"]["TEACHER"]["VALUE"])):?>
				<?foreach($arItem["PROPERTIES"]["TEACHER"]["VALUE"] as $teacher):?>
					<p><a target="_blank" href="<?=$arResult["TEACHER"][$teacher]["DETAIL_PAGE_URL"]?>"><?=$arResult["TEACHER"][$teacher]["NAME"]?></a></p>
				<?endforeach;?>
				<?endif;?>
				</td>
					</tr>
				<?endforeach;?>
			</tbody>
	</table>
	</div>
	<script>
		//$('.stacktable').stacktable(); 
	</script>
<?endif?>