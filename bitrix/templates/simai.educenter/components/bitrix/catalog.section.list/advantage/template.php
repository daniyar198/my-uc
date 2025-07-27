<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>
<style>

.swiper-container{position:relative}
.swiper-button-disabled{display:none!important}
.swiper-container .sf-swiper-button.sf-swiper-nav-circle-in {opacity:0;transition:all 1s ease}
.swiper-container:hover .sf-swiper-button.sf-swiper-nav-circle-in {opacity:1;transition:all 1s ease}

/* buttons */
.sf-swiper-button.sf-swiper-nav-circle-in{cursor:pointer;position: absolute;top: 50%;height:3rem;width:3rem;margin-top:-2rem!important;background-size:30%;background-position: center;background-repeat: no-repeat;display:block;border-radius:50%;padding:2rem;margin-top:0;transition-property:all;opacity:0;animation-duration:.3s;animation-timing-function:ease-in-out;animation-iteration-count:1;z-index: 1;}

.light-theme .sf-swiper-button, .dark-theme .light-theme .sf-swiper-button, .dark-theme .dark-theme .light-theme .sf-swiper-button{background-color:rgba(255,255,255,.87)!important}
.dark-theme .sf-swiper-button, .light-theme .dark-theme .sf-swiper-button, .light-theme .light-theme .dark-theme .sf-swiper-button {background-color:rgba(0,0,0,.54)!important}

.light-theme .sf-swiper-nav-circle-in.sf-swiper-button-next, .dark-theme .light-theme .sf-swiper-nav-circle-in.sf-swiper-button-next, .dark-theme .dark-theme .light-theme .sf-swiper-nav-circle-in.sf-swiper-button-next{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'rgba(0%2C0%2C0%2C0.87)'%2F%3E%3C%2Fsvg%3E")!important}

.light-theme .sf-swiper-nav-circle-in.sf-swiper-button-prev, .dark-theme .light-theme .sf-swiper-nav-circle-in.sf-swiper-button-prev, .dark-theme .dark-theme .light-theme .sf-swiper-nav-circle-in.sf-swiper-button-prev{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'rgba(0%2C0%2C0%2C0.87)'%2F%3E%3C%2Fsvg%3E")!important}

.dark-theme .sf-swiper-nav-circle-in.sf-swiper-button-next, .light-theme .dark-theme .sf-swiper-nav-circle-in.sf-swiper-button-next, .light-theme .light-theme .dark-theme .sf-swiper-nav-circle-in.sf-swiper-button-next{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%23ffffff'%2F%3E%3C%2Fsvg%3E")!important}

.dark-theme .sf-swiper-nav-circle-in.sf-swiper-button-prev, .light-theme .dark-theme .sf-swiper-nav-circle-in.sf-swiper-button-prev, .light-theme .light-theme .dark-theme .sf-swiper-nav-circle-in.sf-swiper-button-prev{background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%23ffffff'%2F%3E%3C%2Fsvg%3E")!important}

@keyframes sf-swiper-nav-circle-in-prev-out{from{left:1rem;opacity:1;}to{left:3rem;opacity:0;}}
@keyframes sf-swiper-nav-circle-in-next-out{from{right:1rem;opacity:1;}to{right:3rem;opacity:0;}}

@keyframes sf-swiper-nav-circle-in-prev{from{left:3rem;opacity:0;}to{left:1rem;opacity:1;}}
@keyframes sf-swiper-nav-circle-in-next{from{right:3rem;opacity:0;}to{right:1rem;opacity:1;}}

/* pagination */
.sf-swiper-pagination.sf-swiper-nav-circle-in {bottom: 0.5rem;width: 100%;position: absolute;text-align: center;transition: .3s opacity;transform: translate3d(0,0,0);z-index: 10;}

.swiper-container .sf-swiper-nav-circle-in{opacity:0;transition:all 1s ease}
.swiper-container:hover .sf-swiper-nav-circle-in{opacity:1;transition:all 1s ease}

.sf-swiper-nav-circle-in.sf-swiper-button-prev{left:1rem;animation-name:sf-swiper-nav-circle-in-prev-out;}
.sf-swiper-nav-circle-in.sf-swiper-button-next{right:1rem;animation-name:sf-swiper-nav-circle-in-next-out}

.swiper-container:hover .sf-swiper-nav-circle-in.sf-swiper-button-prev{left:1rem;animation-name:sf-swiper-nav-circle-in-prev;}
.swiper-container:hover .sf-swiper-nav-circle-in.sf-swiper-button-next{right:1rem;animation-name:sf-swiper-nav-circle-in-next;}

.light-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet,.dark-theme .light-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet, .dark-theme .dark-theme .light-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet{background:rgba(0,0,0,1)!important}
.dark-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet, .light-theme .dark-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet, .light-theme .light-theme .dark-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet{background:rgba(255,255,255,1)!important}

.light-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet.swiper-pagination-bullet-active, .dark-theme .light-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet.swiper-pagination-bullet-active, .dark-theme .dark-theme .light-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet.swiper-pagination-bullet-active{background:rgba(0,0,0,.87)!important}
.dark-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet.swiper-pagination-bullet-active, .light-theme .dark-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet.swiper-pagination-bullet-active, .light-theme .light-theme .dark-theme .sf-swiper-nav-circle-in .swiper-pagination-bullet.swiper-pagination-bullet-active{background:rgba(255,255,255,1)!important}

/* preloader indicator */
.sf-swiper-nav-circle-in.swiper-lazy-preloader{width:100%;height:100%;position:absolute;left:0;top:0;z-index:10;transform-origin:50%;-webkit-animation:none;animation:none;margin:0}
.sf-swiper-nav-circle-in.swiper-lazy-preloader:after{display:block;content:'';width:100%;height:100%;background:no-repeat;background-size:100%}
</style>

<?if(!empty($arResult["SECTIONS"])):?>
  <section class="main-news-swiper-area outside-btn-swiper dark-theme" style="background:transparent"> 
   <div class="swiper-container main-couse-swiper">
	 <div class="swiper-wrapper">
	<?foreach($arResult["SECTIONS"] as $arSection):?>
		<?
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="swiper-slide">
			<div class="infoicon-boby" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="infoicon-link c-hover-alt">
					<div class="infoicon-cover b-alt">
						<span class="infoicon-box">
							<i class="fa <?=$arSection["UF_ICON"]?> fa-3x infoicon-icon" aria-hidden="true"></i>
						</span>
					</div>
					<div class="infoicon-text">
						<h3 class="c-alt"><?=$arSection["NAME"];?></h3>
					</div>
				</a>
			</div>
		</div>
	<?endforeach;?>
	</div>
		<?if(count($arResult["SECTIONS"])>1):?>
			<div class="swiper-button-next sf-swiper-button sf-swiper-button-next sf-swiper-nav-circle-in"></div>
			<div class="swiper-button-prev sf-swiper-button sf-swiper-button-prev sf-swiper-nav-circle-in"></div>	
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
		slidesPerView: 6,
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
                slidesPerView: 4,
                spaceBetween: 30
            },
            740: {
                slidesPerView: 3,
                spaceBetween: 20
            },
			440: {
				slidesPerView: 2,
                spaceBetween: 10
			},
            360: {
                slidesPerView: 2,
                spaceBetween: 10
            }
        }
	});
    
</script>