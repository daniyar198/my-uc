<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?$arDays=array(GetMessage("Mon")=>GetMessage("Monday"),GetMessage("Tue")=>GetMessage("Tuesday"),GetMessage("Wed")=>GetMessage("Wednesday"),GetMessage("Thu")=>GetMessage("Thursday"),GetMessage("Fri")=>GetMessage("Friday"),GetMessage("Sat")=>GetMessage("Saturday"));?>
<div class="news-list">
<?foreach($arResult["SHEDULE"] as $key =>$shedule):?>
<?if(count($shedule)>0):?>
<h2 style="margin-top:20px;"><?=$arDays[$key]?></h2>
<table class="table table-striped table-bordered">
<thead>
        <tr>
          <th><?=GetMessage("LESSON")?></th>
		  <th><?=GetMessage("TIME")?></th>
          <th><?=GetMessage("SUBJECT")?></th>
		  <th><?=GetMessage("ROOM")?></th>
          <th><?=GetMessage("CLASS")?></th>
        </tr>
      </thead>

 <?$count=1;
 foreach($shedule as $arItem):?>
<tr>
	<td>
     	<?=$count?> 
	</td>
	<td>
       <?=$arItem["TIME"]["VALUE"]?>
	</td>
	
	<td>
		<?=$arItem["NAME"]?>
	</td>
	<td>
		<a href="<?=$arItem["ROOM"]["VALUE"]["DETAIL_PAGE_URL"]?>"><?=$arItem["ROOM"]["VALUE"]["NAME"]?></a>
	</td>
	<td>
	    <a href="<?=$arItem["CLASS"]["VALUE"]["DETAIL_PAGE_URL"]?>"><?=$arItem["CLASS"]["VALUE"]["NAME"]?></a>
	</td>
</tr>
<?$count++;
endforeach;?>
</table>
<?endif;?>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
