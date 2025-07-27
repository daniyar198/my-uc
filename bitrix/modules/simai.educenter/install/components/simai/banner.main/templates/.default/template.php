<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//if (!defined("SF_LIB_INCLUDED") || SF_LIB_INCLUDED !== true) require_once $_SERVER['DOCUMENT_ROOT'] . '/simai/lib/init.php';

$salt = randString(4);
$imgFluid = false;
$this->setFrameMode(true);
?>
<?if (is_array($arResult["ITEMS"])):?>
<div class="swiper-container sf-banner-main dark-theme" id="slider-<?=$arResult["SWIPER_SALT"]?>" style="position:relative;background-color:rgba(0,0,0,0)">
	<div class="swiper-wrapper" style="height: <?=$arParams["SF_BANNER_HEIGHT"]?>px;">
	<?foreach ($arResult["ITEMS"] as $keyOuter => $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<?if(isset($arItem["PROPERTIES"]["DESCRIPTION_TITLE"]["VALUE"]) || is_array($arItem["PROPERTIES"]["DESCRIPTION_TEXT"]["VALUE"]) || is_array($arItem["PROPERTIES"]["BUTTONS"]["VALUE"]) || isset($arItem["PROPERTIES"]["IMAGE"]["FILE_VALUE"]["SRC"])):?>
			<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="swiper-slide view main-slider-slide" 
				<?if($arItem["PROPERTIES"]["BANNER_IMAGE"]["FILE_VALUE"]["SRC"] && $arItem["PROPERTIES"]["BANNER_COLOR"]["VALUE"]):?>
					style="height:100%; background: <?=$arItem["PROPERTIES"]["BANNER_COLOR"]["VALUE"]?> url('<?=$arItem["PROPERTIES"]["BANNER_IMAGE"]["FILE_VALUE"]["SRC"]?>');"
				<?elseif($arItem["PROPERTIES"]["BANNER_IMAGE"]["FILE_VALUE"]["SRC"]):?>
					style="height:100%; background: url('<?=$arItem["PROPERTIES"]["BANNER_IMAGE"]["FILE_VALUE"]["SRC"]?>');" 
				<?elseif($arItem["PROPERTIES"]["BANNER_COLOR"]["VALUE"]):?>
					style="height:100%; background-color: <?=$arItem["PROPERTIES"]["BANNER_COLOR"]["VALUE"]?>;" 
				<?endif;?>
			>

			<?if($arItem["PROPERTIES"]["BANNER_VIDEO"]["VALUE"]):?>
				<iframe style="width: 100%;height: 100%;position: absolute;" name="video"
					srcdoc='
					<style>
						video { 
							position: fixed;
							top: 50%;
							left: 50%;
							min-width: 100%;
							min-height: 100%;
							width: auto;
							height: auto;
							z-index: -100;
							transform: translateX(-50%) translateY(-50%);
							background-size: cover;
							transition: 1s opacity;
						}

						@media screen and (max-width: 500px) { 
							div{width:70%;} 
						}
						@media screen and (max-device-width: 800px) {
							html { background:  #000 no-repeat center center fixed; }
						#bgvid { display: none; }
						}
					</style>
					<video poster="" 
						id="bgvid" playsinline autoplay="autoplay" muted loop>
						<!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->
						<source src="<?=$arItem['PROPERTIES']['BANNER_VIDEO']['FILE_VALUE']['SRC']?>"
						type="video/mp4;">
						</video>'>
				</iframe>
			<?endif?>

			<?if(isset($arItem["PROPERTIES"]["MASK_OPACITY"]["VALUE_XML_ID"])):?>
				<div class="mask <?=$arItem["PROPERTIES"]["MASK_COLOR"]["VALUE_XML_ID"]?> <?=$arItem["PROPERTIES"]["MASK_OPACITY"]["VALUE_XML_ID"]?>"></div>
			<?endif;?>

			<?if(isset($arItem["PROPERTIES"]["MASK_PATTERN"]["VALUE"])):?>
				<div class="mask <?=$arItem["PROPERTIES"]["MASK_PATTERN"]["VALUE"]?>"></div>
			<?endif;?>		
			
			<?if(isset($arItem["PROPERTIES"]["BANNER_LINK"]["VALUE"])):?>
				<a class="fit" href="<?=$arItem["PROPERTIES"]["BANNER_LINK"]["VALUE"]?>"></a>
			<?endif;?>
				<div class="container sf-banner-main-container" style="opacity: .99"> 
					<div class="d-flex justify-content-between sf-banner-main-wrap <?=$arItem["PROPERTIES"]["DESCRIPTION_POSITION"]["VALUE_XML_ID"] == "right" ? "flex-row-reverse" : ""?>">
						<?if(isset($arItem["PROPERTIES"]["DESCRIPTION_TITLE"]["VALUE"]) || is_array($arItem["PROPERTIES"]["DESCRIPTION_TEXT"]["VALUE"]) || is_array($arItem["PROPERTIES"]["BUTTONS"]["VALUE"])):?>
							<div class="slider-description-area <?=($arParams["SF_BANNER_MODIFIER_DESCRIPTION"] ? $arParams["SF_BANNER_MODIFIER_DESCRIPTION"] : "")?>" style="opacity: .99">
								<?if(isset($arItem["PROPERTIES"]["DESCRIPTION_TITLE"]["VALUE"])):?>
									<h1 id="title-<?=$arItem["SALT"]?>" class="sf-banner-main-title <?=($arParams["SF_BANNER_MODIFIER_TITLE"] ? $arParams["SF_BANNER_MODIFIER_TITLE"] : "")?>" 
										<?if($arItem["PROPERTIES"]["DESCRIPTION_TITLE_COLOR"]["VALUE"]):?>
											style="color: <?=$arItem["PROPERTIES"]["DESCRIPTION_TITLE_COLOR"]["VALUE"]?>;"
										<?endif;?>
									>
										<?=$arItem["PROPERTIES"]["DESCRIPTION_TITLE"]["~VALUE"]?>
									</h2>
								<?endif;?>
								<?if(isset($arItem["PROPERTIES"]["DESCRIPTION_TEXT"]["VALUE"]["TEXT"])):?>
									<div id="description-<?=$arItem["SALT"]?>" class="sf-banner-main-description <?=($arParams["SF_BANNER_MODIFIER_TEXT"] ? $arParams["SF_BANNER_MODIFIER_TEXT"] : "")?>" 
										<?if($arItem["PROPERTIES"]["DESCRIPTION_TEXT_COLOR"]["VALUE"]):?>
											style="color: <?=$arItem["PROPERTIES"]["DESCRIPTION_TEXT_COLOR"]["VALUE"]?>;"
										<?endif;?>
									>
									<?=$arItem["PROPERTIES"]["DESCRIPTION_TEXT"]["~VALUE"]["TEXT"]?>
								</div>
							<?endif;?>
							<?if(is_array($arItem["PROPERTIES"]["BUTTONS"]["VALUE"])):?>
								<div  id="buttons-<?=$arItem["SALT"]?>" class="slider-buttons-area <?=($arParams["SF_BANNER_MODIFIER_BUTTONS"] ? $arParams["SF_BANNER_MODIFIER_BUTTONS"] : "")?>">
								<?foreach ($arItem["PROPERTIES"]["BUTTONS"]["VALUE"] as $key=> $button):?>
									<a class="btn mb-10
										<?=($button["SUB_VALUES"]["BUTTON_TYPE"]["VALUE_XML_ID"] ? $button["SUB_VALUES"]["BUTTON_TYPE"]["VALUE_XML_ID"] : "btn-info")?> 
										<?=($button["SUB_VALUES"]["BUTTON_STYLE"]["VALUE_XML_ID"] ? $button["SUB_VALUES"]["BUTTON_STYLE"]["VALUE_XML_ID"] : "")?>
										"
										href="<?=$button["SUB_VALUES"]["BUTTON_LINK"]["VALUE"]?>"><?=$button["SUB_VALUES"]["BUTTON_TEXT"]["VALUE"]?>
									</a>
								<?endforeach;?>
								</div>
							<?endif;?>
							</div>
						<?endif;?>


						<?if(isset($arItem["PROPERTIES"]["IMAGE"]["FILE_VALUE"]["SRC"])):?>
							<div  id="image-<?=$arItem["SALT"]?>" class="sf-banner-main-image <?=($arParams["SF_BANNER_MODIFIER_IMAGE"] ? $arParams["SF_BANNER_MODIFIER_IMAGE"] : "")?>
								<?if ($arItem["PROPERTIES"]['IMAGE_POSITION']['VALUE_XML_ID']):?><?=$arItem["PROPERTIES"]['IMAGE_POSITION']['VALUE_XML_ID']?><?endif?>">
								<img class="img-fluid" src="<?=$arItem["PROPERTIES"]["IMAGE"]["FILE_VALUE"]["SRC"]?>">
							</div>
						<?endif;?>
					</div>
				</div>
			</div> 
		<?elseif(isset($arItem["PROPERTIES"]["BANNER_IMAGE"]["FILE_VALUE"]["SRC"])):?>
			<?$imgFluid = true;?>
			<div  id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="swiper-slide view main-slider-slide" 
				<?if($arItem["PROPERTIES"]["BANNER_COLOR"]["VALUE"]):?>
					style="background-color: <?=$arItem["PROPERTIES"]["BANNER_COLOR"]["VALUE"]?>;" 
				<?endif;?>
			>
				<img class="img-fluid" src="<?=$arItem["PROPERTIES"]["BANNER_IMAGE"]["FILE_VALUE"]["SRC"]?>">

				<?if(isset($arItem["PROPERTIES"]["MASK_OPACITY"]["VALUE_XML_ID"])):?>
					<div class="mask bg-black <?=$arItem["PROPERTIES"]["MASK_OPACITY"]["VALUE_XML_ID"]?>"></div>
				<?endif;?>

				<?if(isset($arItem["PROPERTIES"]["MASK_PATTERN"]["VALUE"])):?>
					<div class="mask <?=$arItem["PROPERTIES"]["MASK_PATTERN"]["VALUE"]?>"></div>
				<?endif;?>	
				
				<?if(isset($arItem["PROPERTIES"]["BANNER_LINK"]["VALUE"])):?>
					<a class="fit" href="<?=$arItem["PROPERTIES"]["BANNER_LINK"]["VALUE"]?>"></a>
				<?endif;?>				
			</div>
		<?endif;?>
	<?endforeach;?>
	</div>
	
	<?if(count($arResult["ITEMS"]) > 1):?>
		<div class="sf-swiper-pagination sf-swiper-nav-circle-in swiper-pagination-bullets"></div>
		<div class="swiper-button-next sf-swiper-button sf-swiper-button-next sf-swiper-nav-circle-in"></div>
		<div class="swiper-button-prev sf-swiper-button sf-swiper-button-prev sf-swiper-nav-circle-in"></div>
	<?endif?>

</div>
<?endif;?>

<script>
// animation function
function animationIn(animationId, msDelay, nameAnimation) {
	animationId.css('animation-delay', msDelay/1000 + 's');
	//console.log(nameAnimation);
	animationId.addClass(nameAnimation + ' animated').on('animationend webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd',
	function() {
		$(this).removeClass(nameAnimation + ' animated');
	});
}
$titleS = $(document.querySelector('.title-animation'));
$descriptionS = $(document.querySelector('.description-animation'));
$imageS = $(document.querySelector('.image-animation'));
$buttonS = $(document.querySelector('.button-animation'));

// start animation on load slider
<?if($arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TITLE_IN"]["VALUE"]):?>
	animationIn($titleS, '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TITLE_DELAY"]["VALUE"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TITLE_IN"]["VALUE"]?>');
<?endif;?>
<?if($arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TEXT_IN"]["VALUE"]):?>
	animationIn($descriptionS , '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TEXT_DELAY"]["VALUE"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TEXT_IN"]["VALUE"]?>');
<?endif;?>
<?if($arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_IMAGE_IN"]["VALUE"]):?>
	animationIn($imageS, '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_IMAGE_DELAY"]["VALUE"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_IMAGE_IN"]["VALUE"]?>');
<?endif;?>
<?if($arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_BUTTONS_IN"]["VALUE"]):?>
	animationIn($buttonS, '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_BUTTONS_DELAY"]["VALUE"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_BUTTONS_IN"]["VALUE"]?>');
<?endif;?>	

var arTitle = [],
	arDesc = [],
	arImage = [],
	arButton = [];

<?$index = 0;?>
<?foreach ($arResult["ITEMS"] as $keyOuter => $arItem):?>
		var ar = ['<?=$arItem["PROPERTIES"]["ANIMATE_TITLE_DELAY"]["VALUE"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_TITLE_IN"]["VALUE"]?>'];
		arTitle.push(ar);
		var ar = ['<?=$arItem["PROPERTIES"]["ANIMATE_TEXT_DELAY"]["VALUE"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_TEXT_IN"]["VALUE"]?>'];
		arDesc.push(ar);
		var ar = ['<?=$arItem["PROPERTIES"]["ANIMATE_IMAGE_DELAY"]["VALUE"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_IMAGE_IN"]["VALUE"]?>'];
		arImage.push(ar);
		var ar = ['<?=$arItem["PROPERTIES"]["ANIMATE_BUTTONS_DELAY"]["VALUE"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_BUTTONS_IN"]["VALUE"]?>'];
		arButton.push(ar);
	<?$index++;?>
<?endforeach;?>

$(document).ready(function (){
	var Aswiper = new Swiper({
		el: '#slider-<?=$arResult["SWIPER_SALT"]?>',
		pagination: {
			el: '.sf-swiper-pagination',
		},
		initialSlide: 0,
		on : {
			slideChangeTransitionStart : function() {
				$title = $(this.slides[this.activeIndex]).find('.title-animation');
				$description = $(this.slides[this.activeIndex]).find('.description-animation');
				$image = $(this.slides[this.activeIndex]).find('.image-animation');
				$button = $(this.slides[this.activeIndex]).find('.button-animation');

				<?foreach($arResult['ITEMS'] as $keyOuter => $arItem):?>
					<?if($arItem["PROPERTIES"]["ANIMATE_TITLE_IN"]["VALUE"]):?>
						$title.css("opacity", "0");
					<?endif?>
					<?if($arItem["PROPERTIES"]["ANIMATE_TEXT_IN"]["VALUE"]):?>
						$description.css("opacity", "0");
					<?endif?>
					<?if($arItem["PROPERTIES"]["ANIMATE_IMAGE_IN"]["VALUE"]):?>
						$image.css("opacity", "0");
					<?endif?>
					<?if($arItem["PROPERTIES"]["ANIMATE_BUTTONS_IN"]["VALUE"]):?>
						$button.css("opacity", "0");
					<?endif?>
				<?endforeach?>

			},
			slideChangeTransitionEnd : function() {
				$title = $(this.slides[this.activeIndex]).find('.title-animation');
				$description = $(this.slides[this.activeIndex]).find('.description-animation');
				$image = $(this.slides[this.activeIndex]).find('.image-animation');
				$button = $(this.slides[this.activeIndex]).find('.button-animation');
					if(arTitle[this.realIndex][0] != '') {
						$title.css("opacity", "1");
						animationIn($title, arTitle[this.realIndex][0], arTitle[this.realIndex][1]);
					}
					if(arDesc[this.realIndex][0] != '') {
						$description.css("opacity", "1");
						animationIn($description, arDesc[this.realIndex][0], arDesc[this.realIndex][1]);
					}
					if(arImage[this.realIndex][0] != '') {
						$image.css("opacity", "1");
						animationIn($image, arImage[this.realIndex][0], arImage[this.realIndex][1]);
					}
					if(arButton[this.realIndex][0] != '') {
						$button.css("opacity", "1");
						animationIn($button, arButton[this.realIndex][0], arButton[this.realIndex][1]);
					}
			},
		},
		loop: true,
		navigation: {
			nextEl:'.sf-swiper-button-next',
			prevEl: '.sf-swiper-button-prev',
		},
		lazy: true,
		effect: '<?=$arParams["SF_BANNER_EFFECT"]?>',
		autoHeight: <?=($imgFluid ? 'true' : 'false');?>,
		<?=($arParams["SF_BANNER_AUTOPLAY"] == "Y" ? "autoplay: { delay:".$arParams["SF_BANNER_DELAY"].",}" : '');?>
	});


	var flag = false,
		flag2 = false;


});
</script>