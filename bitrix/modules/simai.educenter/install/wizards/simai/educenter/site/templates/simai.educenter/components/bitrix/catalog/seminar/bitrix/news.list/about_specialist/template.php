<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>


<?if (!empty($arResult["ITEMS"])):?>




<section class="main-news-swiper-area inside-btn-swiper"> <!-- color button class btn-light-swiper -->
	<div class="swiper-container main-photogallery-swiper">
		<div class="swiper-wrapper">
			<?$count=0;?>
			<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
				<?
					$this->AddEditAction($arElement['ID'], 
						$arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arElement['ID'],
						$arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"),
						array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));?>


						<div class="swiper-slide">
						 <div style= "display:inline-block;" class="view hover hover-zoom">
							<img id="<?=$this->GetEditAreaId($arElement['ID'])?>"
								src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" data-src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" 
								alt="<?=$arParams["SHOW_PHOTO_TITLE"]=="N"?"":$arElement["NAME"]?>" 
								title="<?=$arElement["NAME"]?>" class="img-fluid lazyload img-responsive">

							<a target="_blank" href="<?=$arElement["DETAIL_PAGE_URL"]?>">
								
                                <div class="mask bg-black-800 p-15">
									<div class="c-white text-center">
										<h5><?=$arElement["NAME"];?></h5>
										<p><?=$arElement["PROPERTIES"]["POSITION"]["VALUE"];?></p>
                                    </div>
                                </div>
							</a>
						  </div>
						</div>


			<?endforeach?>
		</div>
		<?if(count($arResult["ITEMS"])>1):?>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev swiper-button-white"></div>
			<div class="swiper-button-next swiper-button-white"></div>	
       <?endif;?>		
	</div>
</section>


<script>



//document.addEventListener('DOMContentLoaded', function() {

	var Yswiper = new Swiper( {
		el: '.main-photogallery-swiper',
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
		//loop: true,
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
//});
    
</script>

<script type="text/javascript">
		$(function(){
		$(".various").fancybox({
		/*maxWidth	: 800,
		maxHeight	: 600,*/
		fitToView	: false,
		//width		: '100%',
		//height		: '100%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
		});
		});
		
	</script>


<?endif?>

