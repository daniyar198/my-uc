<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
/*
echo "<pre>";
print_r($arResult["DISPLAY_PROPERTIES"]["EDUCATION"]);
echo "</pre>";*/
?>
<section>
<div class="row">
    <?if(is_array($arResult["PREVIEW_IMG"])):?>
<div class="col-md-6">
    <div id="workCarousel" class="carousel carousel-4 slide color-two-l" data-ride="carousel">
        <div class="carousel-inner">
            <?if(is_array($arResult["PREVIEW_IMG"])):?>
                <div class="item item-dark active">
                    <a class="theater" <?if(!empty($arResult["MORE_PHOTO"])):?>rel="group"<?endif?> title="<?=$arResult["PREVIEW_IMG"]["DESCRIPTION"]?$arResult["PREVIEW_IMG"]["DESCRIPTION"]:$arResult["NAME"]?>" href="<?=$arResult["PREVIEW_IMG"]["OLD_LINK"]?>"><img alt="<?=$arResult["NAME"]?>" src="<?=$arResult["PREVIEW_IMG"]["SRC"]?>"></a>
                </div>
            <?endif?>
            <?if(!empty($arResult["MORE_PHOTO"])):
                foreach($arResult["MORE_PHOTO"] as $cell=>$arPhoto):?>
                    <div class="item item-dark <?if(!$cell && !is_array($arResult["PREVIEW_IMG"])):?>active<?endif?>">
                        <a class="theater" <?if(count($arResult["MORE_PHOTO"])>1 || is_array($arResult["PREVIEW_IMG"])):?>rel="group"<?endif?> title="<?=$arPhoto["DESCRIPTION"]?$arPhoto["DESCRIPTION"]:$arResult["NAME"]?>" href="<?=$arPhoto["OLD_LINK"]?>" ><img src="<?=$arPhoto["SRC"]?>" alt="<?=$arResult["NAME"]?>"></a>
                    </div>
                <?endforeach;
            endif?>
        </div>
        <?if((is_array($arResult["PREVIEW_IMG"]) && !empty($arResult["MORE_PHOTO"])) || count($arResult["MORE_PHOTO"])>1):?>
            <a class="left carousel-control" href="#workCarousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right carousel-control" href="#workCarousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        <?endif?>
    </div>
</div>
<div class="col-md-6">
    <?else:?>
    <div class="col-md-12">
    <?endif?>
    <div class="vertical-info">
        <?if(is_array($arResult["DISPLAY_PROPERTIES"]["POSITION"])):?>
            <h6 class="fwb"><?=$arResult["DISPLAY_PROPERTIES"]["POSITION"]["NAME"]?></h6>
            <p><?=$arResult["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"]?></p>
        <?endif?>
        <?if(is_array($arResult["DISPLAY_PROPERTIES"]["PHONE"])):?>
            <h6 class="fwb"><?=$arResult["DISPLAY_PROPERTIES"]["PHONE"]["NAME"]?></h6>
            <p><?=$arResult["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"]?></p>
        <?endif?>
        <?if(is_array($arResult["DISPLAY_PROPERTIES"]["EMAIL"])):?>
            <h6 class="fwb"><?=$arResult["DISPLAY_PROPERTIES"]["EMAIL"]["NAME"]?></h6>
            <p><?=$arResult["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]?></p>
        <?endif?>
        <?if(is_array($arResult["DISPLAY_PROPERTIES"]["EDUCATION"])):?>
            <h6 class="fwb"><?=$arResult["DISPLAY_PROPERTIES"]["EDUCATION"]["NAME"]?></h6>
            <p><?=$arResult["DISPLAY_PROPERTIES"]["EDUCATION"]["DISPLAY_VALUE"]?></p>
        <?endif?>
        <?if(is_array($arResult["DISPLAY_PROPERTIES"]["QUALIFICATION"])):?>
            <h6 class="fwb"><?=$arResult["DISPLAY_PROPERTIES"]["QUALIFICATION"]["NAME"]?></h6>
            <p><?=strip_tags($arResult["DISPLAY_PROPERTIES"]["QUALIFICATION"]["DISPLAY_VALUE"])?></p>
        <?endif?>
        <?if(is_array($arResult["DISPLAY_PROPERTIES"]["DISCIPLINE"])):?>
            <h6 class="fwb"><?=$arResult["DISPLAY_PROPERTIES"]["DISCIPLINE"]["NAME"]?>:</h6> 
				<?foreach($arResult['DISPLAY_PROPERTIES']['DISCIPLINE']['VALUE'] as $discipline):?>
                    <p><?=$arResult["DISCIPLINE"][$discipline]?></p>
                <?endforeach?>
			
        <?endif?>
        <?if(is_array($arResult["DISPLAY_PROPERTIES"]["RETRAINING"])):?>
            <h6 class="fwb"><?=$arResult["DISPLAY_PROPERTIES"]["RETRAINING"]["NAME"]?></h6>
            <p><?=$arResult["DISPLAY_PROPERTIES"]["RETRAINING"]["DISPLAY_VALUE"]?></p>
        <?endif?>
		<?if(is_array($arResult["DISPLAY_PROPERTIES"]["DEGREE"])):?>
            <h6 class="fwb"><span><?=$arResult["DISPLAY_PROPERTIES"]["DEGREE"]["NAME"]?></h6>
            <p><?=$arResult["DISPLAY_PROPERTIES"]["DEGREE"]["DISPLAY_VALUE"]?></p>
        <?endif?>
		<?if(is_array($arResult['PROPERTIES']['FILIAL']) && !empty($arResult['PROPERTIES']['FILIAL']['VALUE'])):?>
            <h6 class="fwb"><?=$arResult['PROPERTIES']['FILIAL']["NAME"]?></h6>
            <p><?=$arResult["FILIAL"][$arResult['PROPERTIES']['FILIAL']['VALUE']]?></p>
        <?endif?>
		<?if($arResult["DISPLAY_PROGRAM"]!=""):?>
		    <h6 class="fwb"><?=$arResult['PROPERTIES']['PROGRAM']["NAME"]?></h6>
            <p><?=$arResult["DISPLAY_PROGRAM"]?></p>
        <?endif?>
		
		
</div>
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
</section>