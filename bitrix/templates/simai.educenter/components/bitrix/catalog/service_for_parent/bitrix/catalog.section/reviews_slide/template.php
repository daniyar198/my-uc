<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>


<?if(count($arResult["ITEMS"])):?>

<section class="prlx-bg inset-shadow-1" data-stellar-ratio="2" style="padding: 50px 0; background-size: cover;background-attachment: fixed;background-image: url('<?=SITE_TEMPLATE_PATH?>/images/feedback/fb_1.jpg'); background-position: 0 0;">
        <div class="mask bg-dark-60"></div>
        <div class="wp-section c-white">

<section class="main-news-swiper-area inside-btn-swiper"> <!-- color button class btn-light-swiper -->
	<div class="swiper-container main-rewiews-swiper">
		<div class="swiper-wrapper">
			<?$count=0;?>
			<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
				<?
					$this->AddEditAction($arElement['ID'], 
						$arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arElement['ID'],
						$arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"),
						array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));?>


						<div class="swiper-slide view hover hover-zoom">
                            <div class="mh-200 item <?=(!$key?"active":"")?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <div class="text-center">
                                    <h4 class="c-white hidden-xs"><i class="fa fa-quote-left fa-3x"></i></h4>
                                    <h2 class="c-white"><?=$arElement["PROPERTIES"]["NAME"]["VALUE"]?></h2>
                                    <div class="c-white" style="min-height: 44px;padding: 0 10%;">
                                        <h4 class="font-media-16"><?=truncateText(strip_tags($arElement["PROPERTIES"]["REVIEW"]["~VALUE"]["TEXT"]),600)?></h4>
                                    </div>
                                    <span class="clearfix"></span>
                                </div>
                            </div>
						</div>


			<?endforeach?>
		</div>
		<div class="swiper-pagination"></div>
		<div class="swiper-button-prev swiper-button-white"></div>
		<div class="swiper-button-next swiper-button-white"></div>		
	</div>
</section>

</div>
</section>


<script>



//document.addEventListener('DOMContentLoaded', function() {

	var Yswiper = new Swiper( {
		el: '.main-rewiews-swiper',
		//pagination: '.swiper-pagination',
		/*paginationClickable: true,
		initialSlide: 0,
        preloadImages: false,*/
//		lazyLoading: true,
		spaceBetween: 30,
		pagination: {
			el: '.swiper-pagination',
		},
		//speed: 500,
		loop: true,
		initialSlide: 0,
		slidesPerView: 1,
		navigation: {
		  nextEl: '.swiper-button-next',
		  prevEl: '.swiper-button-prev',
		},

	});
//});
    
</script>

<?endif?>