<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<style>

@media (max-width: 420px) {
	.header-news {
		font-size: 12px;
	}

	.news-list-item-text {
		margin-bottom: 0!important;
		margin: 0!important;
	}
}

</style>

<?$id = rand();?>


	<div class="swiper-container gallery-top main-gallery-top light-theme" id="swiper-<?=$id?>">
		<div class="swiper-wrapper">
			<?$count=0;
			foreach($arResult["ITEMS"] as $cell=>$arElement):
				if(is_array($arElement["PREVIEW_IMG"])):
				$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
				?>
					<div class="swiper-slide view hover hover-zoom">
						
						<div class="aspect-ratio aspect-ratio-2x1">
							<div class="aspect-ratio-content sf-viewbox-wrap hover transition">
								

								<div class="sf-viewbox d-flex flex-column justify-content-end" style="background-image: url(<?=$arElement["PREVIEW_IMG"]["OLD_SRC"]?>);background-size:cover;">
									<a class="sf-viewbox" href="<?=$arElement["DETAIL_PAGE_URL"]?>" style="width: 100%; height: 100%;display:block;background:linear-gradient(to top, rgba(0,0,0,0.67), rgba(0,0,0,0));">
									</a>
									<div class="news-list-item-text t-center c-white mb-4 p-3" style="z-index:1">
								
										<?if($arElement["DISPLAY_PROPERTIES"]["DATE"]):?>
											<p class="t-0 m-0" style="color:rgba(255,255,255,0.87)">
												<?=$arElement["DISPLAY_PROPERTIES"]["DATE"]["DISPLAY_VALUE"]?>
											</p>
										<?elseif($arElement["DATE_ACTIVE_FROM"]):?>
											<p class="t-0 m-0" style="color:rgba(255,255,255,0.67)">											
												<?=$arElement["DATE_ACTIVE_FROM"]?>
											</p>
										<?endif?>

										
										<h3 class="t-3 t-title ñ-text-primary l-inherit l-hover-underline-none transition my-2 header-news">
											<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" >
												<?=$arElement["NAME"]?>
											</a>
										</h3>
										<?$res = CIBlockSection::GetByID($arElement["IBLOCK_SECTION_ID"]);
										if($ar_res = $res->GetNext()):?>

											<a class="t--3 t-bold t-uppercase bg-white l-primary py-1 px-2" style="color:#448aff!important" href="<?=$ar_res["SECTION_PAGE_URL"]?>">
												<?=$ar_res['NAME'];?>
											</a>
										<?endif?>

									</div>
								</div>

								
							</div>
						</div>
					</div>
				<?endif;
			endforeach?>
		</div>
		<div class="sf-swiper-pagination sf-swiper-nav-circle-in swiper-pagination-bullets"></div>
		<div class="swiper-button-next sf-swiper-button sf-swiper-button-next sf-swiper-nav-circle-in"></div>
		<div class="swiper-button-prev sf-swiper-button sf-swiper-button-prev sf-swiper-nav-circle-in"></div>
	</div>

<script>

			let Nswiper = new Swiper({
				el: '#swiper-<?=$id?>',
				initialSlide: 0,
				pagination: {
					el: '.sf-swiper-pagination',
				},
				navigation: {
					nextEl:'.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				lazy: true,
			});

	</script>

  </script>

	

