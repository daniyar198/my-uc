<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!defined("SF_LIB_INCLUDED") || SF_LIB_INCLUDED !== true) require_once $_SERVER['DOCUMENT_ROOT'] . '/simai/lib/init.php';

$salt = \SIMAI\Main\Utility::getRandomLine();
$imgFluid = false;
$this->setFrameMode(true);
?>

<style>
	.justify-content-between
	{
		-webkit-box-pack: justify!important;
		-webkit-justify-content: space-between!important;
		-ms-flex-pack: justify!important;
		justify-content: space-between!important;
	}
	
	.d-flex
	{
		display: -webkit-box!important;
		display: -webkit-flex!important;
		display: -ms-flexbox!important;
		display: flex!important;
	}
	
	.py-4
	{
		padding-top: 1.5rem!important;
		padding-bottom: 1.5rem!important;
	}
	
	

.flex-row-reverse {
    -webkit-box-orient: horizontal!important;
    -webkit-box-direction: reverse!important;
    -webkit-flex-direction: row-reverse!important;
    -ms-flex-direction: row-reverse!important;
    flex-direction: row-reverse!important;
}
.sf-banner-main-container, .sf-banner-main-wrap {
    height: 100%;
}

.align-self-start {
    -webkit-align-self: flex-start!important;
    -ms-flex-item-align: start!important;
    align-self: flex-start!important;
}

body {
    font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #292b2c;
    background-color: #fff;
}

html {
    font-family: sans-serif;
    line-height: 1.15;
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
}
.view .mask
			{
				background-attachment: fixed;
			}
			.view .mask, .view .content, .view .decor {
				width: 100%;
				height: 100%;
				position: absolute;
				overflow: hidden;
				top: 0;
				left: 0;
			}
			.o-3 {
				opacity: .7;
			}
			
			.c-green
			{
				color: #4CAF50;
			}
			body * {
				outline: none !important;
			}
			body {
				font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif!important;
				font-size: 1rem!important;
				font-weight: 400;
				line-height: 1.5;
				color: #292b2c;
				background-color: #fff;
			}
			.p-10
			{
				padding: 10px;
			}
</style>

<style>
	.btn-primary:hover {
		color: white;
		background-color: #116aff;
		border-color: #0764ff;
	}
	
	.btn:focus, .btn:hover {
		text-decoration: none;
	}
	
	.btn-primary {
    color: white;
    background-color: #448AFF;
    border-color: #2b7aff;
}

	
</style>


<?if (is_array($arResult["ITEMS"])):?>
<div class="swiper-container sf-banner-main" id="slider-<?=$arResult["SWIPER_SALT"]?>">
	<div class="swiper-wrapper" style="height: <?=$arParams["SF_BANNER_HEIGHT"]?>px;">
	<?foreach ($arResult["ITEMS"] as $keyOuter => $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<?if(isset($arItem["PROPERTIES"]["DESCRIPTION_TITLE"]["VALUE"]) || is_array($arItem["PROPERTIES"]["DESCRIPTION_TEXT"]["VALUE"]) || is_array($arItem["PROPERTIES"]["BUTTONS"]["VALUE"]) || isset($arItem["PROPERTIES"]["IMAGE"]["FILE_VALUE"]["SRC"])):?>
			<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="swiper-slide view main-slider-slide" 
				<?if($arItem["PROPERTIES"]["BANNER_IMAGE"]["FILE_VALUE"]["SRC"] && $arItem["PROPERTIES"]["BANNER_COLOR"]["VALUE"]):?>
					style="background: <?=$arItem["PROPERTIES"]["BANNER_COLOR"]["VALUE"]?> url('<?=$arItem["PROPERTIES"]["BANNER_IMAGE"]["FILE_VALUE"]["SRC"]?>');"
				<?elseif($arItem["PROPERTIES"]["BANNER_IMAGE"]["FILE_VALUE"]["SRC"]):?>
					style="background: url('<?=$arItem["PROPERTIES"]["BANNER_IMAGE"]["FILE_VALUE"]["SRC"]?>');" 
				<?elseif($arItem["PROPERTIES"]["BANNER_COLOR"]["VALUE"]):?>
					style="background-color: <?=$arItem["PROPERTIES"]["BANNER_COLOR"]["VALUE"]?>;" 
				<?endif;?>
			>

			<?if(isset($arItem["PROPERTIES"]["MASK_OPACITY"]["VALUE_XML_ID"])):?>
				<div class="mask bg-black <?=$arItem["PROPERTIES"]["MASK_OPACITY"]["VALUE_XML_ID"]?>"></div>
			<?endif;?>

			<?if(isset($arItem["PROPERTIES"]["MASK_PATTERN"]["VALUE"])):?>
				<div class="mask <?=$arItem["PROPERTIES"]["MASK_PATTERN"]["VALUE"]?>"></div>
			<?endif;?>		
			
			<?if(isset($arItem["PROPERTIES"]["BANNER_LINK"]["VALUE"])):?>
				<a class="fit" href="<?=$arItem["PROPERTIES"]["BANNER_LINK"]["VALUE"]?>"></a>
			<?endif;?>
				<div class="container sf-banner-main-container"> 
					<div class="d-flex justify-content-between sf-banner-main-wrap <?=$arItem["PROPERTIES"]["DESCRIPTION_POSITION"]["VALUE_XML_ID"] == "right" ? "flex-row-reverse" : ""?>">
						<?if(isset($arItem["PROPERTIES"]["DESCRIPTION_TITLE"]["VALUE"]) || is_array($arItem["PROPERTIES"]["DESCRIPTION_TEXT"]["VALUE"]) || is_array($arItem["PROPERTIES"]["BUTTONS"]["VALUE"])):?>
							<div class="slider-description-area <?=($arParams["SF_BANNER_MODIFIER_DESCRIPTION"] ? $arParams["SF_BANNER_MODIFIER_DESCRIPTION"] : "")?>" style="z-index: 1;">
								<?if(isset($arItem["PROPERTIES"]["DESCRIPTION_TITLE"]["VALUE"])):?>
									<h1 id="title-<?=$arItem["SALT"]?>" class="sf-banner-main-title <?=($arParams["SF_BANNER_MODIFIER_TITLE"] ? $arParams["SF_BANNER_MODIFIER_TITLE"] : "")?>" 
										<?if($arItem["PROPERTIES"]["DESCRIPTION_TITLE_COLOR"]["VALUE"]):?>
											style="color: <?=$arItem["PROPERTIES"]["DESCRIPTION_TITLE_COLOR"]["VALUE"]?>;"
										<?endif;?>
									>
										<?=$arItem["PROPERTIES"]["DESCRIPTION_TITLE"]["~VALUE"]?>
									</h1>
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
								<div id="buttons-<?=$arItem["SALT"]?>" class="slider-buttons-area">
									<a class="btn btn-primary p-10">TEXT</a>
									<a class="btn btn-primary p-10">TEXT</a>
									<a class="btn btn-primary p-10">TEXT</a>
								</div>
							
							<?if(is_array($arItem["PROPERTIES"]["BUTTONS"]["VALUE"])):?>
								<div  id="buttons-<?=$arItem["SALT"]?>" class="slider-buttons-area <?=($arParams["SF_BANNER_MODIFIER_BUTTONS"] ? $arParams["SF_BANNER_MODIFIER_BUTTONS"] : "")?>">
								<?foreach ($arItem["PROPERTIES"]["BUTTONS"]["VALUE"] as $key=> $button):?>
									<a class="btn 
										<?=($button["SUB_VALUES"]["BUTTON_TYPE"]["VALUE_XML_ID"] ? $button["SUB_VALUES"]["BUTTON_TYPE"]["VALUE_XML_ID"] : "")?> 
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
								<?if ($arItem["PROPERTIES"]['IMAGE_POSITION']['VALUE_XML_ID']):?><?=$arItem["PROPERTIES"]['IMAGE_POSITION']['VALUE_XML_ID']?><?endif?>" style="z-index: 1">
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
					style="background-color: <?=$arItem["PROPERTIES"]["BANNER_COLOR"]["VALUE"]?>; z-index: 1;" 
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

	<div class="swiper-pagination swiper-pagination-white"></div>
	<div class="swiper-button-next swiper-button-white"></div>
	<div class="swiper-button-prev swiper-button-white"></div>

</div>
<?endif;?>

<script>

// animation function
function animationIn(animationId, msDelay, nameAnimation)
{
	$(animationId).css('animation-delay', msDelay/1000 + 's');
	$(animationId).addClass(nameAnimation + ' animated').one('animationend webkitAnimationEnd mozAnimationEnd MSAnimationEnd oAnimationEnd',
	function()
	{
		$(this).removeClass(nameAnimation + ' animated');
	});
}

// start animation on load slider
<?if($arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TITLE_IN"]["VALUE"]):?>
	animationIn('#title-<?=$arResult["ITEMS"][0]["SALT"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TITLE_DELAY"]["VALUE"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TITLE_IN"]["VALUE"]?>');
<?endif;?>
<?if($arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TEXT_IN"]["VALUE"]):?>
	animationIn('#description-<?=$arResult["ITEMS"][0]["SALT"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TEXT_DELAY"]["VALUE"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_TEXT_IN"]["VALUE"]?>');
<?endif;?>
<?if($arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_IMAGE_IN"]["VALUE"]):?>
	animationIn('#image-<?=$arResult["ITEMS"][0]["SALT"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_IMAGE_DELAY"]["VALUE"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_IMAGE_IN"]["VALUE"]?>');
<?endif;?>
<?if($arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_BUTTONS_IN"]["VALUE"]):?>
	animationIn('#buttons-<?=$arResult["ITEMS"][0]["SALT"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_BUTTONS_DELAY"]["VALUE"]?>', '<?=$arResult["ITEMS"][0]["PROPERTIES"]["ANIMATE_BUTTONS_IN"]["VALUE"]?>');
<?endif;?>	

$(document).ready(function (){
	var swiper = new Swiper('#slider-<?=$arResult["SWIPER_SALT"]?>', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		onSlideChangeStart : function()
		{
			<?foreach($arResult['ITEMS'] as $keyOuter => $arItem):?>
				<?if($arItem["PROPERTIES"]["ANIMATE_TITLE_IN"]["VALUE"]):?>
					$('#title-<?=$arItem['SALT']?>').css("opacity", "0");
				<?endif?>
				<?if($arItem["PROPERTIES"]["ANIMATE_TEXT_IN"]["VALUE"]):?>
					$('#description-<?=$arItem['SALT']?>').css("opacity", "0");
				<?endif?>
				<?if($arItem["PROPERTIES"]["ANIMATE_IMAGE_IN"]["VALUE"]):?>
					$('#image-<?=$arItem['SALT']?>').css("opacity", "0");
				<?endif?>
				<?if($arItem["PROPERTIES"]["ANIMATE_BUTTONS_IN"]["VALUE"]):?>
					$('#buttons-<?=$arItem['SALT']?>').css("opacity", "0");
				<?endif?>
			<?endforeach?>
		},
		onSlideChangeEnd : function()
		{
			<?foreach ($arResult["ITEMS"] as $keyOuter => $arItem):?>
				<?if($arItem["PROPERTIES"]["ANIMATE_TITLE_IN"]["VALUE"]):?>
					$('#title-<?=$arItem['SALT']?>').css("opacity", "1");
					animationIn('#title-<?=$arItem["SALT"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_TITLE_DELAY"]["VALUE"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_TITLE_IN"]["VALUE"]?>');
				<?endif?>
				<?if($arItem["PROPERTIES"]["ANIMATE_TEXT_IN"]["VALUE"]):?>
					$('#description-<?=$arItem['SALT']?>').css("opacity", "1");
					animationIn('#description-<?=$arItem["SALT"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_TEXT_DELAY"]["VALUE"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_TEXT_IN"]["VALUE"]?>');
				<?endif?>
				<?if($arItem["PROPERTIES"]["ANIMATE_IMAGE_IN"]["VALUE"]):?>
					$('#image-<?=$arItem['SALT']?>').css("opacity", "1");
					animationIn('#image-<?=$arItem["SALT"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_IMAGE_DELAY"]["VALUE"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_IMAGE_IN"]["VALUE"]?>');
				<?endif?>
				<?if($arItem["PROPERTIES"]["ANIMATE_BUTTONS_IN"]["VALUE"]):?>
					$('#buttons-<?=$arItem['SALT']?>').css("opacity", "1");
					animationIn('#buttons-<?=$arItem["SALT"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_BUTTONS_DELAY"]["VALUE"]?>', '<?=$arItem["PROPERTIES"]["ANIMATE_BUTTONS_IN"]["VALUE"]?>');
				<?endif?>
			<?endforeach;?>
		},
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		spaceBetween: 30,
		effect: '<?=$arParams["SF_BANNER_EFFECT"]?>',
		autoHeight: <?=($imgFluid ? 'true' : 'false');?>,
		<?=($arParams["SF_BANNER_AUTOPLAY"] == "Y" ? "SF_BANNER_AUTOPLAY: ".$arParams["SF_BANNER_DELAY"] : '');?>
	})
});
</script>