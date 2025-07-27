<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?/*
echo "<pre>";
print_r($arResult["ITEMS"]);
echo "</pre>";
*/
if(!empty($arResult["ITEMS"]))
{
    ?>
	<section class="main-news-swiper-area inside-btn-swiper"> 
	<div class="swiper-container main-photogallery-swiper">
	 <div class="swiper-wrapper">
		<?
		foreach ($arResult["ITEMS"] as $key => $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="swiper-slide"  id="<?= $this->GetEditAreaId($arItem['ID'])?>">
				<div class="wp-block inverse text-center">
					<div class="thmb-img">
						<i class="fa <?=($arItem["PROPERTIES"]["ICON"]["VALUE"] ? $arItem["PROPERTIES"]["ICON"]["VALUE"] : "fa-star")?>"></i>
					</div>
					
					<h2><?=$arItem["NAME"]?></h2>
					<p class=""><?=$arItem["PREVIEW_TEXT"]?></p>
				</div>
			</div>		
		<?endforeach;?>
	</div>
		<?if(count($arResult["ITEMS"])>1):?>
			<div class="swiper-button-prev swiper-button-blue"></div>
			<div class="swiper-button-next swiper-button-blue"></div>	
        <?endif;?>		
	</div>
</section>


<script>



	var Yswiper = new Swiper( {
		el: '.main-photogallery-swiper',
		spaceBetween: 30,
		pagination: {
			el: '.swiper-pagination',
		},
		initialSlide: 0,
		slidesPerView: 4,
		navigation: {
		  nextEl: '.swiper-button-next',
		  prevEl: '.swiper-button-prev',
		},
    breakpoints: {
            1024: {
                slidesPerView: 4,
                spaceBetween: 30
            },
            900: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            740: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            360: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
	});
    
</script>

<script type="text/javascript">
		$(function(){
		$(".various").fancybox({
		fitToView	: false,
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
		});
		});
		
	</script>

	
    <?
}?>
