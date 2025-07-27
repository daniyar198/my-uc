<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>


<div style="overflow-x:scroll">
<table class="table table-bordered">
   <thead>
   <tr>
	<th><?=getMessage("TITLE_PRICE")?></th>
    <th><?=getMessage("SERVICE")?></th>
   	<th><?=getMessage("COST")?></th>
	   </tr>
	</thead>
  <?foreach($arResult["ITEMS"] as $cell=>$arItem):?>
   <?if(!is_array($arItem["PROPERTIES"]["FORM"]["VALUE"])) continue;?>
    <tr>
        <td rowspan="<?=count($arItem["PROPERTIES"]["FORM"]["VALUE"])?>"
		 ><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></td>
		 
	   <?foreach($arItem["PROPERTIES"]["FORM"]["VALUE"] as $kform => $form):?>	
	     <?if($kform!=0):?></tr><tr><?endif;?>
	      <td class="text-center"><?=$form["SUB_VALUES"]["NAME_FORM"]["VALUE"]?></td>
          <td class="text-center"><?=$form["SUB_VALUES"]["COST_FORM"]["VALUE"]?></td>
		<?endforeach?>
		
   </tr>
            
  <?endforeach?>

 </table>
</div>
