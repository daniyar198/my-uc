<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult["ITEMS"])):
?>
<div id="carouselTop" class="carousel auto-carousel carousel-3 slide animate-hover-slide bg-alt" >
    <script type="text/javascript">
        $(function(){
            $(".announcing-container .btn").on("click",function(){
                $(".announcing-text").toggleClass("hidden").parents(".carousel-inner").prev().find(".btn").toggleClass("hidden");
				$(".nameAD").toggleClass("mb-hidden");
                return false;
            });
        });
    </script>
    <div class="announcing-container" style="height: 100%;">
    <div style="height: 100%;">
        <div  style="height: 100%;">
           
            <div class="carousel-nav slider top-slider" style="height: 100%;">
                <a href="" class="full-size btn"></a>
                <a href="" class="full-size btn hidden"></a>
                 <?if(count($arResult["ITEMS"])>1):?>
                <a data-slide="prev" class="left color-two d-flex align-items-center justify-content-center" href="#carouselTop"><i class="fa fa-angle-left"></i></a>
              	<a data-slide="next" class="right color-two d-flex align-items-center justify-content-center" href="#carouselTop"><i class="fa fa-angle-right"></i></a>
                <?endif?>
		   </div>
           
        </div>
    </div>
    </div>
    <div class="carousel-inner">
<?
foreach($arResult["ITEMS"] as $key=>$arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
    <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="item <?if(!$key):?>active<?endif?>">
    <div class="box-element white bg-alt" style="margin: 0;padding-top:16px;padding-bottom:16px;">
        <div class="container">
            <div class="row mb-0">
                <div class="col-md-12">
                    <h6 class="nameAD mb-none c-white mb-hidden mb-0">
                        <?=$arItem["NAME"]?>
                    </h6>
                </div>
                <!-- <div class="col-md-4"></div> -->
            </div>
        </div>
    </div>
    <div class="box-element announcing-text light hidden bg-alt" style="margin: 0;padding-top:16px;padding-bottom:16px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
        <div class="announcing fix-48" >
            <?=$arItem["PREVIEW_TEXT"]?>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
<?
endforeach;?>
        </div>
        </div>
<?
    endif;?>