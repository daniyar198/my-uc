<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>


<?if (!empty($arResult["ITEMS"])):?>


<?$id = rand();?>

<section class="main-news-swiper-area inside-btn-swiper light-theme" style="background-color:rgba(0,0,0,0)"> <!-- color button class btn-light-swiper -->
	<div class="swiper-container main-photogallery-swiper" id="swiper-<?=$id;?>">
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
		<div class="sf-swiper-pagination sf-swiper-nav-circle-in swiper-pagination-bullets"></div>
		<div class="swiper-button-next sf-swiper-button sf-swiper-button-next sf-swiper-nav-circle-in"></div>
		<div class="swiper-button-prev sf-swiper-button sf-swiper-button-prev sf-swiper-nav-circle-in"></div>		
	</div>
</section>


<script>



//document.addEventListener('DOMContentLoaded', function() {

	var Yswiper = new Swiper( {
		el: '#swiper-<?=$id;?>',
		pagination: {
			el: '.sf-swiper-pagination',
		},
		//pagination: '.swiper-pagination',
		/*paginationClickable: true,
		initialSlide: 0,
        preloadImages: false,*/
//		lazyLoading: true,
		spaceBetween: 30,
		//speed: 500,
		loop: true,
		initialSlide: 0,
		slidesPerView: 3,
		navigation: {
		  nextEl: '.swiper-button-next',
		  prevEl: '.swiper-button-prev',
		},
    breakpoints: {
            1024: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            900: {
                slidesPerView: 2,
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

