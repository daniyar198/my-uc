<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="service-detail">
				<?if(is_array($arResult["PREVIEW_IMG"])):
				?>
				<div class="span2">
				<a href="<?=$arResult["PREVIEW_IMG"]["OLD_LINK"]?>" class="fancybox" title="<?=$arResult["PREVIEW_IMG"]["DESCRIPTION"]?$arResult["PREVIEW_IMG"]["DESCRIPTION"]:$arResult["NAME"]?>"><img src="<?=$arResult["PREVIEW_IMG"]["SRC"]?>" alt="<?=$arResult["NAME"]?>"/></a>
				</div>
				<div class="span<?=isset($class)?$class:"5"?>">
				<div class="alert"><b><?=getMessage("COMFORT");?></b>
					<a href="#callManager" data-title="<?=getMessage("ORDER_SERVICE_BOLD")?>" data-comment="<?=getMessage("ORDER_SERVICE")?>: «<?=$arResult["NAME"]?>»" class="btn btn-theme btn-large order_site" data-toggle="modal"><?=getMessage("ORDER_SERVICE")?></a>
				</div>
				</div>
				<?endif?>
    <?if($arResult["DISPLAY_PROPERTIES"]["FILE"])
    {
        ?>
        <a class="download-link" target="_blank" href="<?= $arResult["DOC_SRC"] ?>"><i
                class="fa fa-download"></i> <?= getMessage("DOWNLOAD") ?>

            <? if ($arResult["DOC_SIZE"]):?>
                (<?= getMessage("SIZE") ?> <?= $arResult["DOC_SIZE"] ?> Kb)
            <? endif?>
        </a>
    <?
    }
    ?>
    <?if($arResult["PREVIEW_TEXT"]):?>
			    <?=$arResult["PREVIEW_TEXT"]?>
    <?endif?>

    <?if(count($arResult["NAVIGATION"])==3):?>
        <div class="news-detail-nav">
            <div class="pull-right"><a href="<?=$arResult["NAVIGATION"][0]["DETAIL_PAGE_URL"]?>"><b><?=GetMessage("NEXT_NEWS")?></b> <i class="fa fa-angle-right"></i></a></div>
            <div class="pull-left"><a href="<?=$arResult["NAVIGATION"][2]["DETAIL_PAGE_URL"]?>"><i class="fa fa-angle-left"></i> <b><?=GetMessage("PREV_NEWS")?></b></a></div>
        </div>
    <?elseif(count($arResult["NAVIGATION"])==2):?>
        <?if($arResult["NAVIGATION"][0]["ID"]==$arResult["ID"]):?>
            <div class="news-detail-nav">
                <div class="pull-right"><span><?=GetMessage("NEXT_NEWS")?> <i class="fa fa-angle-right"></i></span></div>
                <div class="pull-left"><a href="<?=$arResult["NAVIGATION"][1]["DETAIL_PAGE_URL"]?>"><i class="fa fa-angle-left"></i> <b><?=GetMessage("PREV_NEWS")?></b></a></div>
            </div>
        <?elseif($arResult["NAVIGATION"][1]["ID"]==$arResult["ID"]):?>
            <div class="news-detail-nav">
                <div class="pull-right"><a href="<?=$arResult["NAVIGATION"][0]["DETAIL_PAGE_URL"]?>"><b><?=GetMessage("NEXT_NEWS")?></b> <i class="fa fa-angle-right"></i></a></div>
                <div class="pull-left"><span><i class="fa fa-angle-left"></i> <?=GetMessage("PREV_NEWS")?></span></div>
            </div>
        <?endif?>
    <?endif?>
</div>
<?if($arResult["ID"]):?>
    <script type="text/javascript">
        $(function(){
            $(".catalog_menu li[data-id='<?=$arResult["ID"]?>']").addClass("current selected");
        });
    </script>
<?endif?>