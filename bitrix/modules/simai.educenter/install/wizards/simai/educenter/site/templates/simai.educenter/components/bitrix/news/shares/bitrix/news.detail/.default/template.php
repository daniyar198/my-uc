<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="post-item">
				<?if($arResult["DISPLAY_ACTIVE_FROM"]):?>
                        <small><b><?=$arResult["DISPLAY_ACTIVE_FROM"]?></b></small><br/>
				<?endif?>
             <?=$arResult["~PREVIEW_TEXT"]?>
	
<div class="row mt-30">
	<?if($arResult["DISPLAY_PROPERTIES"]["COURSE"]["DISPLAY_VALUE"]):?>
	 <div class="col-md-6">
	  <h4><?=getMessage("COURSE")?></h4>
	 <?if(is_array($arResult["DISPLAY_PROPERTIES"]["COURSE"]["DISPLAY_VALUE"])):?>
	  <?foreach($arResult["DISPLAY_PROPERTIES"]["COURSE"]["DISPLAY_VALUE"] as $course):?>		 
		<p><?=$course?></p>	 
      <?endforeach;?>
	<?else:?>
	   <p><?=$arResult["DISPLAY_PROPERTIES"]["COURSE"]["DISPLAY_VALUE"]?></p>
	  <?endif;?>
	  </div>
	<?endif;?>	
	
	<?if($arResult["DISPLAY_PROPERTIES"]["SEMINAR"]["DISPLAY_VALUE"]):?>
	  <div class="col-md-6">
	  <h4><?=getMessage("SEMINAR")?></h4>
	  <?if(is_array($arResult["DISPLAY_PROPERTIES"]["SEMINAR"]["DISPLAY_VALUE"])):?>
		  <?foreach($arResult["DISPLAY_PROPERTIES"]["SEMINAR"]["DISPLAY_VALUE"] as $seminar):?>		 
			<p><?=$seminar?></p>	 
		  <?endforeach;?>
	  <?else:?>
	   <p><?=$arResult["DISPLAY_PROPERTIES"]["SEMINAR"]["DISPLAY_VALUE"]?></p>
	  <?endif;?>
	  </div>
	<?endif;?>
	
 </div>
 
    
</div>

 <?if(count($arResult["NAVIGATION"])==3):?>
		<ul class="pager">
			<li class="previous"><a href="<?=$arResult["NAVIGATION"][2]["DETAIL_PAGE_URL"]?>">&larr; <?=GetMessage("PREV_NEWS")?></a></li>
			<li class="next"><a href="<?=$arResult["NAVIGATION"][0]["DETAIL_PAGE_URL"]?>"><?=GetMessage("NEXT_NEWS")?> &rarr;</a></li>
		</ul> 
    <?elseif(count($arResult["NAVIGATION"])==2):?>
        <?if($arResult["NAVIGATION"][0]["ID"]==$arResult["ID"]):?>
			<ul class="pager">
				<li class="previous"><a href="<?=$arResult["NAVIGATION"][1]["DETAIL_PAGE_URL"]?>">&larr; <?=GetMessage("PREV_NEWS")?></a></li>
				<li class="next disabled"><a href="#"><?=GetMessage("NEXT_NEWS")?> &rarr;</a></li>
			</ul> 		
        <?elseif($arResult["NAVIGATION"][1]["ID"]==$arResult["ID"]):?>
			<ul class="pager">
				<li class="previous disabled"><a href="#">&larr; <?=GetMessage("PREV_NEWS")?></a></li>
				<li class="next"><a href="<?=$arResult["NAVIGATION"][0]["DETAIL_PAGE_URL"]?>"><?=GetMessage("NEXT_NEWS")?> &rarr;</a></li>
			</ul> 			
        <?endif?>
    <?endif?>
