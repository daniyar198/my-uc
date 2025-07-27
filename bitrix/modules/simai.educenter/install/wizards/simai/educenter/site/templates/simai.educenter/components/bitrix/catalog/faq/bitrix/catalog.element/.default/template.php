<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="section-title-wr">
    <h3 class="section-title left"><span><?=$arResult["NAME"]?></span></h3>
</div>
<?
if($arResult["PREVIEW_TEXT"]):
    ?>
    <div class="wp-block testimonial style-1">
        <div class="wp-block-body">
            <?if($arResult["PREVIEW_TEXT_TYPE"] !="html"):?>
            <p>
                <?=$arResult["PREVIEW_TEXT"]?>
            </p>
            <?else:?>
                <?=$arResult["PREVIEW_TEXT"]?>
            <?endif?>
        </div>
        <div class="testimonial-author">
            <?if(is_array($arResult["RESPONDENT_IMG"])):?>
                <div class="author-img">
                    <a href="<?=$arResult["RESPONDENT_DETAIL_PAGE_URL"]?>"><img src="<?=$arResult["RESPONDENT_IMG"]["SRC"]?>" alt="<?=$arResult["RESPONDENT"]?>"></a>
                </div>
            <?endif?>
            <div class="author-info">
                <span class="author-name"><a href="<?=$arResult["RESPONDENT_DETAIL_PAGE_URL"]?>"><?=$arResult["RESPONDENT"]?></a></span>
                <small class="author-pos"><?=$arResult["RESPONDENT_POSITION"]?></small>
            </div>
        </div>
    </div>
<?endif?>