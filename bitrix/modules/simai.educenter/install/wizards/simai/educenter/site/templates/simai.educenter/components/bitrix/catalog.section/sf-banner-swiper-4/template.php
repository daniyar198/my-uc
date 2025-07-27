<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

//\SIMAI\Main\Page\Asset::getInstance()->load("swiper");


?>


<section class="main-news-swiper-area inside-btn-swiper dark-theme" style="background-color:rgba(0,0,0,0)">
	<div class="swiper-container main-info-swiper">
		<div class="swiper-wrapper">
			<?
			$i=0;
			foreach($arResult["ITEMS"] as $key=>$arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], 
					CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
					CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), 
					array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				//if($i && $i%4==0)echo"</div></div><div class='item'><div class='row'>";
				//$i++;?>
					<div class="swiper-slide">
						<div class="d-flex align-items-center justify-content-center flex-column">
						<?//if(is_array($arItem["PREVIEW_IMG"])):?>
							<?if(is_array($arItem["DISPLAY_PROPERTIES"]["LINK"])):?>
								<a target="_blank" href="<?=$arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]?>">
							<?endif?>
								<img alt="<?=$arItem["NAME"]?>" src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>" data-src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>"
									class="img-fluid lazyload img-responsive"/>
							<?if(is_array($arItem["DISPLAY_PROPERTIES"]["LINK"])):?>
								</a>
							<?endif?>
						<?//endif?>
						<h6 class="pt-2" style="color:rgba(0,0,0,0.87)"><?=$arItem["NAME"]?></h6>
						</div>
					</div>
			<?endforeach;?>
			</div>
		<div class="swiper-pagination sf-swiper-pagination sf-swiper-nav-circle-in swiper-pagination-bullets"></div>
		<div class="swiper-button-next sf-swiper-button sf-swiper-button-next sf-swiper-nav-circle-in"></div>
		<div class="swiper-button-prev sf-swiper-button sf-swiper-button-prev sf-swiper-nav-circle-in"></div>		
	</div>
</section>




<script>

//#reginon and
    let Banerswiper = new Swiper({
		el: '.main-info-swiper',
		paginationClickable: true,
		initialSlide: 0,
        preloadImages: false,
		pagination: {
			el: '.swiper-pagination',
		},
		navigation: {
			nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
		},
        slidesPerView: 4,
        spaceBetween: 30,
        breakpoints: {
            1024: {
                slidesPerView: 4,
                spaceBetween: 30
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
	});
//#endregion and

</script>



