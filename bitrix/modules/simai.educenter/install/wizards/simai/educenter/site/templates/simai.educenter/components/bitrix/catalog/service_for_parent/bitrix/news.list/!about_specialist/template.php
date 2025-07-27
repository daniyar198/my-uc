<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>


<?if (!empty($arResult["ITEMS"])):?>
    <section class="slice animate-hover-slide-2">
        <div class="section-title-wr mp mt-20">
            <h2 class="section-title"><span><?=getMessage("SPECIALIST")?></span></h3>
        </div>
        <div id="carouselSeminar" class="carousel carousel-3 slide animate-hover-slide">
        <?if(count($arResult["ITEMS"])>4):?>
            <div class="carousel-nav">
                <a style="top: -50px;" data-slide="prev" class="left" href="#carouselSeminar"><i class="fa fa-angle-left"></i></a>
                <a style="top: -50px;" data-slide="next" class="right" href="#carouselSeminar"><i class="fa fa-angle-right"></i></a>
            </div>
        <?endif?>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="row">
		<?
        $i=0;
        foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            if($i && $i%4==0)echo "</div></div><div class='item'><div class='row'>";
		?><div class="col-md-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="view third-effect relative text-center"> 
                        <?if(is_array($arItem["PREVIEW_PICTURE"])):?>
                            <img class="img-responsive" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="image">
                        <?endif?>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
							<div class="mask pt-50 c-white text-center"> 
								<h5><?=$arItem["NAME"];?></h5>
								<p><?=$arItem["PROPERTIES"]["POSITION"]["VALUE"];?></p>
							</div>
						</a>
                    </div>
                </div>
            

	<?
        $i++;
        endforeach;?>
    </div>
   </div>
    </div>
        </div>
   </section> 
<?endif;?>

