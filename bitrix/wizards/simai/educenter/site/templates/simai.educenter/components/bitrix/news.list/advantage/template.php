<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?if($arResult["ITEMS"]):?>
  <section class="main-news-swiper-area inside-btn-swiper"> 
   <div class="swiper-container main-couse-swiper">
	 <div class="swiper-wrapper">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="swiper-slide"  id="<?= $this->GetEditAreaId($arItem['ID'])?>">
			<div class="infoicon-boby" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="infoicon-link">
					<div class="infoicon-cover">
						<span class="infoicon-box">
							<i class="fa <?=$arItem["PROPERTIES"]["ICON"]["VALUE"]?> fa-3x infoicon-icon" aria-hidden="true"></i>
						</span>
					</div>
					<div class="infoicon-text">
						<h3 class=""><?=$arItem["NAME"];?></h3>
					</div>
				</a>
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
<?endif;?>

<script>



	var Yswiper = new Swiper( {
		el: '.main-couse-swiper',
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
                slidesPerView: 6,
                spaceBetween: 30
            },
            900: {
                slidesPerView: 4,
                spaceBetween: 30
            },
            740: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            360: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
	});
    
</script>