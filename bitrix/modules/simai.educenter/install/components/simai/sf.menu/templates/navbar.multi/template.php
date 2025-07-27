<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<?if(!empty($arResult)):?>

<?$Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZabcdefghijklmopqrstuvxwyz0123456789'; 
$QuantidadeCaracteres = strlen($Caracteres); 
$QuantidadeCaracteres--; 

$Hash=NULL; 
    for($x=1;$x<=6;$x++) {
        $Posicao = rand(0,$QuantidadeCaracteres); 
        $Hash .= substr($Caracteres,$Posicao,1); 
    } 

$idSfNav = 'sf-nav-'.$Hash;

?>

<style>
    .overflow-hidden {
        overflow: hidden!important;
    }
    .text-t-u {
        text-transform: uppercase;
    }
    .h-100 {
        height: 100%!important;
    }
</style>

    <?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?>
        <style>
            <?if($arParams["SF_MODE_NAVBAR_COLOR"] !== ''):?>
                .sf-nav-fixed<?=$Hash?> {background: <?=$arParams["SF_MODE_NAVBAR_COLOR"]?>}
            <?endif?>
            <?if($arParams["SF_NAVBAR_COLOR_MOBILE_NAME"] !== ''):?>
                @media (max-width: 768px) {
                    .mobile-view<?=$Hash?> {background: <?=$arParams["SF_NAVBAR_COLOR_MOBILE_NAME"]?>!important;}
                }
            <?endif?>
            <?if($arParams["SF_NAVBAR_COLOR_FULLSCREEN"] !== ''):?>
                .full-screen-color-<?=$Hash;?> {background: <?=$arParams['SF_NAVBAR_COLOR_FULLSCREEN']?>;}
            <?endif?>
            
            <?if($arParams["SF_NAVBAR_COLOR_CHILD_ITEM_MENU"] !== ''):?>
                .child-color-submenu-<?=$Hash;?> {background:<?=$arParams["SF_NAVBAR_COLOR_CHILD_ITEM_MENU"]?>;}
            <?endif?>

            <?if($arParams["SF_NAVBAR_SETTINGS_FIXED_SPECIAL"] === 'Y'):?>
                 
                .nav-fixed-<?=$Hash?> {background: <?=$arParams["SF_NAVBAR_FIXED_COLOR"]?>}
                
                <?if($arParams["SF_NAVBAR_FIXED_COLOR_SUBMENU"] !== ''):?>
                    .nav-fixed-<?=$Hash?> .fixed-submenu-color<?=$Hash?> {background: <?=$arParams["SF_NAVBAR_FIXED_COLOR_SUBMENU"]?>}
                <?endif?>
            <?endif?>


        </style>
	<?else:?>
        <style>
            .sf-nav-left-catalog {display: block;}
        
            <?//if($arParams["SF_NAVBAR_LEFT_COLOR"] !== ""):?>
                    .sf-left-catalog.left-view-<?=$Hash;?> {
                        background-color: <?=$arParams["SF_NAVBAR_LEFT_COLOR"]?>;
                    }
                    .sf-left-catalog ul li div.catalog-submenu.left-view-child-<?=$Hash;?> {
                        background-color: <?=$arParams["SF_NAVBAR_LEFT_SUBMENU_COLOR"]?>!important;
                    }
            <?//endif?>
        </style>
    <?endif?>
<?//============= NAVBAR.TOP =============//?>
    <?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?>
        <div class="navigation-container sf-nav-fixed<?=$Hash?> no-fixed sf-nav-fixed 
            <?if($arParams['SF_NAVBAR_COLOR_THEME']):?>
                <?=$arParams['SF_NAVBAR_COLOR_THEME'];?> 
            <?endif?>
            <?if($arParams["SF_NAVBAR_SETTINGS_FIXED_SPECIAL"] === 'Y'):?>
                <?=$arParams["SF_NAVBAR_COLOR_THEME_FIXED_MAIN"]?>
            <?endif?> 
            <?=$arParams["SF_MODE_NAVBAR_SUBMENU"]?>"
            id="sf-fixed-id-<?=$Hash?>">  <?// FIXED ?>
    <?endif?>
<?//============= END NAVBAR.TOP =============//?>

<?//============= NAVBAR.CONTAINER =============//?>
    <?if($arParams["SF_MODE_NAVBAR"] === "TOP"):?> <?/// TOP ?>
        <div class="container-wrap w-100">
            <div class="<?if($arParams["SF_NAVBAR_CONTAINER_ON"] === "Y"):?>container<?else:?>w-100<?endif?> nav-container">
    <?endif?>
<?//============= END NAVBAR.CONTAINER =============//?>

    <?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?> <?/// TOP ?>
        <nav data-nav id="<?=$idSfNav;?>"
            class="sf-nav w-100 m-0 p-0 d-flex align-items-streach justify-content-between flex-row flex-wrap">
        <?//============= SECTION.LEFT =============//?>
        <section class="left-section d-flex align-items-streach justify-content-between flex-row flex-wrap">
                <?if($arParams["SF_NAVBAR_FULLSCREEN"] == "Y"):?>
                    <button class="btn-full-screen b-0 hidden-md-down hidden-sm <?=$arParams["SF_NAVBAR_PADDING_ONE_LEVEL"]?>">
                        <i class="fa fa-ellipsis-v fa-lg" aria-hidden="true"></i>
                    </button>
                <?endif?>
        <?//============= BRAND =============//?>
            <?if($arParams["SF_NAVBAR_BRAND"] == 'Y'):?>
                <a class="nav-brand mr-3 <?=$arParams["SF_NAVBAR_PADDING_ONE_LEVEL"]?>" href="/">
                    <?if($arParams["SF_NAVBAR_BRAND_SOURCE"] === "SETTINGS_SITE"):?>
                        <?//=\SIMAI\Main\Configuration\Property::getInstance()->get(SF_SITE_DIR, 'organization_name');?>
                    <?elseif($arParams["SF_NAVBAR_BRAND_SOURCE"] === "NAME_BRAND"):?>
                        <?=$arParams["SOURCE_BRAND_NAME"];?>
                    <?elseif($arParams["SF_NAVBAR_BRAND_SOURCE"] === "LOGO_BRAND"):?>                    
                        <img src="<?=$arParams["SOURCE_BRAND_LOGO"]?>"
                            class="hidden-md-down d-inline">
                    <?endif?>
                </a>
            <?endif?>
        <?//============= END BRAND =============//?>
            <!--<a class="nav-logo" href="/">
                <img src="image/list.jpg"
                    class="hidden-md-down d-inline mr-2 w-75">
            </a>-->
        </section>
        <?//============= END SECTION.LEFT =============//?>
        <?if($arParams["SF_NAVBAR_SECTION_LEFT"] === "Y"):?>
            <section class="left-region-section d-flex align-items-center justify-content-center">
				<?=$arParams["~SF_NAVBAR_SECTION_LEFT_HTML"];?>
            </section>
        <?endif?>
        <?//============= SECTION.CENTER =============//?>
        <section style="justify-content:flex-start!important;" class="center-section align-items-streach mobile-level overflow-hidden 
        <?if($arParams["SF_NAVBAR_ALIGN"] == "START"):?>justify-content-start<?elseif($arParams["SF_NAVBAR_ALIGN"] == "END"):?>justify-content-end <?else:?>justify-content-center<?endif?>
            <?if($arParams["SF_NAVBAR_MOBILE"] === "Y"):?>
                <?=$arParams["SF_NAVBAR_COLOR_THEME_MOBILE"].$Hash;?>
            <?endif?>
            ">
            <button class="mobile-close sf-close" style="display:none"></button>
            <h3 class="mobile-header m-0" style="display: none">
                <?=GetMessage("SF_NAVBAR_NAME_MOBILE_MENU");?>
            </h3>
    <?else:?>
        <?//====================== START LEFT.MENU ====================//?>
        <div id="<?=$idSfNav?>" class="sf-left-catalog hidden-xs
            <?if($arParams["SF_NAVBAR_LEFT_VIEW"] == "DOC"):?>sf-nav-left-catolog-page-doc<?else:?><?endif?>
            <?=$arParams['SF_NAVBAR_LEFT_COLOR_THEME']?> left-view-<?=$Hash;?>">
        <?//==========================================//?>
    <?endif?>   <?/// END TOP ?>
<?//=========== TOP.MENU & LEFT.MENU ==============?>
            <ul class="<?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?>nav-items d-inline-flex align-items-streach justify-content-end p-0 m-0<?else:?>nav-items<?endif?>">
            <?$previousLevel = 0;
                foreach($arResult as $arItem): ?>
                    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                        <?if ($previousLevel - $arItem["DEPTH_LEVEL"] >= 2):?>
                            </ul>
                                </div>
                                    </li>
                        <?endif?>
                            </ul>
                                </div>
                                    </li>
                    <?endif?>

                    <?if($arParams["SF_MODE_NAVBAR"] == "TOP" && $arItem["PARAMS"]["TYPE"] == "mega"):?>
                        <?if($arItem["DEPTH_LEVEL"] == "1"):?>
                            <li class="nav-item item-mega">
                                <a class="item-link <?=$arParams["SF_NAVBAR_PADDING_ONE_LEVEL"];?> <?=$arParams["SF_NAVBAR_ITEM_EFFECT_HOVER"]?>
                                    <?if($arParams["SF_NAVBAR_ITEMS_UPPERCASE_LATTERS"] === "Y"):?> text-t-u<?endif?>">
                                    <?if ($arItem['PARAMS']['ICON']):?>
                                        <div class="start-icon <?if($arItem["TEXT"] !== ""):?>mr-2<?endif?>">
                                            <i class="<?=($arItem['PARAMS']['ICON'])?>"></i>
                                        </div>
                                    <?endif?>
                                    <?if($arItem["TEXT"] !== ""):?>
                                        <span class="item-text">
                                            <?=$arItem["TEXT"]?>
                                        </span>
                                    <?endif?>
                                    <span class='item-icon submenu-indicator <?if($arItem['SELECTED']):?>submenu-indicator-minus<?endif?>'>
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </span>
                                    
                                    <span class="item-hover" style="display:none"></span>
                                </a>
                                <div class="nav-submenu mobile-level mega-menu align-items-start justify-content-center
                                    <?if($arParams["SF_NAVBAR_COLOR_CHILD_ITEM_MENU"] === ''):?>
                                        <?=$arParams["SF_NAVBAR_COLOR_THEME_SUBMENU"];?> 
                                    <?else:?>
                                        <?=$arParams["SF_NAVBAR_COLOR_THEME_SUBMENU"];?> child-color-submenu-<?=$Hash;?> 
                                    <?endif?>
<?// ===================== НАСТРОЙКА ФИКСИРОВАННОГО ЦВЕТА МЕНЮ И ПОДМЕНЮ ===================== //?>
                                    <?if($arParams["SF_NAVBAR_SETTINGS_FIXED_SPECIAL"] === 'Y'):?>
                                        <?if($arParams["SF_NAVBAR_FIXED_COLOR_SUBMENU"] !== ''):?>
                                            <?=$arParams["SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU"]?> fixed-submenu-color<?=$Hash?>
                                        <?else:?>
                                            <?=$arParams["SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU"]?>
                                        <?endif?>
                                    <?endif?>
<?// ===================== НАСТРОЙКА МОБИЛЬНОГО ЦВЕТА МЕНЮ И ПОДМЕНЮ ===================== //?>                                    
                                    <?if($arParams["SF_NAVBAR_MOBILE"] === "Y"):?>
                                        <?=$arParams["SF_NAVBAR_COLOR_THEME_MOBILE"].$Hash;?>
                                    <?endif?>">
                                    <div class="content-mobile-horizontal" style="display:none">
                                        <h3 class="m-0" style="display:none">
                                            <?=$arItem["TEXT"]?>
                                        </h3>
                                        <a class="nav-back w-100 align-items-center justify-content-start pt-3 pb-3" href="#" style="display:none">
                                            <span class="back-icon mr-2">
                                                <i class="fa fa-arrow-left"></i>
                                            </span>
                                            <span class="item-text">
                                                <?=GetMessage("SF_NAVBAR_MOBILE_BACK");?>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="nav-mega w-100 d-flex align-items-start justify-content-between flex-wrap sf-scroll container">
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:main.include",
                                            "",
                                            Array(
                                                "AREA_FILE_SHOW" => "file", 
                                                "PATH" => $arItem["LINK"].$arItem['PARAMS']["SRC"],
                                            )
                                        );?>
                                    </div>
                                </div>
                            </li>
                        <?endif?>
                    <?endif?>
                    <?if($arItem["PARAMS"]["TYPE"] != 'mega'):?>
                        <?if ($arItem["IS_PARENT"]):?>
                            <?if($arParams["SF_MODE_NAVBAR"] == "LEFT"):?>
                                <?
                                $i = $key;
                                $bHasSelected = $arItem['SELECTED'];
                                $childSelected = false;
                                while ($arResult[++$i]['DEPTH_LEVEL'] > $arItem['DEPTH_LEVEL'])
                                {
                                    if ($arResult[$i]['SELECTED'])
                                    {
                                        $childSelected = true; break;   
                                    }
                                }?>
                            <?endif?>
                            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                <li class="nav-item <?=($arItem["SELECTED"] ? "active" : "")?>">

                                    <a class="<?=$arParams["SF_NAVBAR_PADDING_ONE_LEVEL"];?> <?=$arParams["SF_NAVBAR_ITEM_EFFECT_HOVER"]?>
                                        <?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?> item-link<?endif?>
                                        <?if($arParams["SF_NAVBAR_TRANSFER_HEADING_LONG"] === "Y"):?> transfer-item<?endif?>
                                        <?if($arParams["SF_NAVBAR_ITEMS_UPPERCASE_LATTERS"] === "Y"):?> text-t-u<?endif?>" 
                                        href="<?=$arItem["LINK"]?>">
                                        <?if ($arItem['PARAMS']['ICON']):?>
                                            <div class="start-icon <?if($arItem["TEXT"] !== ""):?>mr-2<?endif?>">
                                                <i class="<?=($arItem['PARAMS']['ICON'])?>"></i>
                                            </div>
                                        <?endif?>
                                        <?if($arItem["TEXT"] !== ""):?>
                                            <span class="item-text">
                                                <?=$arItem["TEXT"]?>
                                            </span>
                                        <?endif?>
                                        <span class='item-icon submenu-indicator <?if($arItem['SELECTED']):?>submenu-indicator-minus<?endif?>'>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </span>
                                        <span class="item-hover" style="display:none"></span>
                                    </a>
                                    
                                    <!-- -->
                                    <?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?>
                                        <div class="nav-submenu mobile-level sf-scroll align-items-start justify-content-center
                                            <?if($arParams["SF_NAVBAR_COLOR_CHILD_ITEM_MENU"] === ''):?>
                                                <?=$arParams["SF_NAVBAR_COLOR_THEME_SUBMENU"];?> 
                                            <?else:?>
                                                <?=$arParams["SF_NAVBAR_COLOR_THEME_SUBMENU"];?> child-color-submenu-<?=$Hash;?> 
                                            <?endif?>
                                            <?if($arParams["SF_NAVBAR_SETTINGS_FIXED_SPECIAL"] === 'Y'):?>
                                                <?if($arParams["SF_NAVBAR_FIXED_COLOR_SUBMENU"] !== ''):?>
                                                    <?=$arParams["SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU"]?> fixed-submenu-color<?=$Hash?>
                                                <?else:?>
                                                    <?=$arParams["SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU"]?>
                                                <?endif?>
                                            <?endif?>
                                            <?if($arParams["SF_NAVBAR_MOBILE"] === "Y"):?>
                                                <?=$arParams["SF_NAVBAR_COLOR_THEME_MOBILE"].$Hash;?>
                                            <?endif?>">
                                            <div class="content-mobile-horizontal" style="display:none">
                                                <h3 class="mobile-header m-0" style="display:none">
                                                    <?=$arItem["TEXT"]?>
                                                </h3>
                                                <a class="nav-back w-100 align-items-center justify-content-start pt-3 pb-3" href="#">
                                                    <span class="back-icon mr-2">
                                                        <i class="fa fa-arrow-left"></i>
                                                    </span>
                                                    <span class="back-text">
                                                        <?=GetMessage("SF_NAVBAR_MOBILE_BACK");?>
                                                    </span>
                                                </a>
                                            </div>
                                            <ul class="nav-items submenu-items p-0 <?if($arParams["SF_MODE_NAVBAR_SUBMENU"]):?>container<?endif?>">
                                                <li class="nav-item one-mobile <?=($arItem["SELECTED"] ? "active" : "")?> one-link">
                                                <a class="<?=$arParams["SF_NAVBAR_PADDING_LOWER_LEVEL"];?>
                                                    <?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?> item-link<?endif?>" 
                                                        href="<?=$arItem["LINK"]?>">
                                                        <span class="item-text">
                                                            <?=$arItem["TEXT"]?>
                                                        </span>
                                                    </a>
                                    <?else:?>
                                        <div class="catalog-submenu <?=$arParams["SF_NAVBAR_LEFT_SUBMENU_COLOR_THEME"]?> left-view-child-<?=$Hash;?>">														
                                            <ul class="submenu"
                                                <?if($arItem["SELECTED"]):?>
                                                    style="display: block;"
                                                <?endif?>>
                                    <?endif?>
                            <?else:?>
                                    <li class="nav-item <?if($arItem["SELECTED"]):?>active<?endif?>">
                                    <a class="<?=$arParams["SF_NAVBAR_PADDING_LOWER_LEVEL"];?>
                                        <?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?> item-link<?endif?>" 
                                        href="<?=$arItem["LINK"]?>">

                                            <?if($arParams["SF_MODE_NAVBAR"] == "LEFT"):?>
                                                <span class="item-icon nav-item-indicator"></span>
                                            <?endif?>
                                            
                                            <span class="item-text">
                                                <?=$arItem["TEXT"]?>
                                            </span>
                                            <span class='item-icon submenu-indicator nav-next-level <?if($arItem['SELECTED']):?>submenu-indicator-minus<?endif?>'> 
                                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                                            </span>

                                        </a>
                                        
                                        <?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?>
                                            <div class="nav-submenu mobile-level sf-scroll align-items-start justify-content-center
                                                <?if($arParams["SF_NAVBAR_COLOR_CHILD_ITEM_MENU"] === ''):?>
                                                    <?=$arParams["SF_NAVBAR_COLOR_THEME_SUBMENU"];?> 
                                                <?else:?>
                                                    <?=$arParams["SF_NAVBAR_COLOR_THEME_SUBMENU"];?> child-color-submenu-<?=$Hash;?> 
                                                <?endif?>
                                                <?if($arParams["SF_NAVBAR_SETTINGS_FIXED_SPECIAL"] === 'Y'):?>
                                                    <?if($arParams["SF_NAVBAR_FIXED_COLOR_SUBMENU"] !== ''):?>
                                                        <?=$arParams["SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU"]?> fixed-submenu-color<?=$Hash?>
                                                    <?else:?>
                                                        <?=$arParams["SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU"]?>
                                                    <?endif?>
                                                <?endif?>
                                                <?if($arParams["SF_NAVBAR_MOBILE"] === "Y"):?>
                                                    <?=$arParams["SF_NAVBAR_COLOR_THEME_MOBILE"].$Hash;?>
                                                <?endif?>">
                                                <div class="content-mobile-horizontal" style="display:none">
                                                    <h3 class="mobile-header" style="display:none"><?=$arItem["TEXT"]?></h3>
                                                    <a class="nav-back w-100 align-items-center justify-content-start pt-3 pb-3" href="#">
                                                        <span class="back-icon mr-2">
                                                            <i class="fa fa-arrow-left"></i>
                                                        </span>
                                                        <span class="back-text">
                                                            <?=GetMessage("SF_NAVBAR_MOBILE_BACK");?>
                                                        </span>
                                                    </a>
                                                </div>
                                                <ul class="nav-items submenu-items p-0 <?if($arParams["SF_MODE_NAVBAR_SUBMENU"]):?>container<?endif?>">
                                                <li class="nav-item one-mobile<?if($arItem["SELECTED"]):?>active<?endif?>">
                                                <a class="<?=$arParams["SF_NAVBAR_PADDING_LOWER_LEVEL"];?>
                                                    <?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?> item-link<?endif?>"
                                                            href="<?=$arItem["LINK"]?>">
                                                            <?if($arParams["SF_MODE_NAVBAR"] == "LEFT"):?>
                                                                <span class="item-icon nav-item-indicator"></span>
                                                            <?endif?>
                                                            <span class="item-text">
                                                                <?=$arItem["TEXT"]?>
                                                            </span>
                                                        </a>
                                        <?else:?>
                                            <div class="catalog-submenu">														
                                                <ul class="submenu"
                                                    <?if($arItem["SELECTED"]):?>
                                                        style="display: block;"
                                                    <?endif?>>
                                        <?endif?>
                            <?endif?>
                        <?else:?>
                            <?if ($arItem["PERMISSION"] > "D"):?>
                                <?if ($arItem["DEPTH_LEVEL"] == 1):?>	
                                    <li class="nav-item <?=($arItem["SELECTED"] ? "active" : "")?>">
                                        <a class="<?=$arParams["SF_NAVBAR_PADDING_ONE_LEVEL"];?> <?=$arParams["SF_NAVBAR_ITEM_EFFECT_HOVER"]?>
                                            <?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?> item-link<?endif?>
                                            <?if($arParams["SF_NAVBAR_TRANSFER_HEADING_LONG"] === "Y"):?> transfer-item<?endif?>
                                            <?if($arParams["SF_NAVBAR_ITEMS_UPPERCASE_LATTERS"] === "Y"):?> text-t-u<?endif?>"
                                            href="<?=$arItem["LINK"]?>">
                                            <?if ($arItem['PARAMS']['ICON']):?>
                                                <div class="start-icon <?if($arItem["TEXT"] !== ""):?>mr-2<?endif?>">
                                                    <i class="<?=($arItem['PARAMS']['ICON'])?>"></i>
                                                </div>
                                            <?endif?>
                                            <?if($arItem["TEXT"] !== ""):?>
                                                <span class="item-text">
                                                    <?=$arItem["TEXT"]?>
                                                </span>
                                            <?endif?>
                                            <span class="item-hover" style="display:none"></span>
                                        </a>
                                    </li>
                                <?else:?>
                                    <li class="nav-item <?=($arItem["SELECTED"] ? "active" : "")?>">
                                        <a class="<?=$arParams["SF_NAVBAR_PADDING_LOWER_LEVEL"];?> item-link" href="<?=$arItem["LINK"]?>">
                                            <?if($arParams["SF_MODE_NAVBAR"] == "LEFT"):?>
                                                <span class="nav-icon nav-item-indicator"></span>
                                            <?endif?>
                                            <span class="item-text">
                                                <?=$arItem["TEXT"]?>
                                            </span>
                                        </a>
                                    </li>													
                                <?endif?>
                            <?else:?>
                                <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                    <li class="nav-item<?=($arItem["SELECTED"] ? "active" : "")?>">
                                        <a class="<?=$arParams["SF_NAVBAR_PADDING_ONE_LEVEL"];?> item-link <?=$arParams["SF_NAVBAR_ITEM_EFFECT_HOVER"]?>
                                            <?if($arParams["SF_NAVBAR_TRANSFER_HEADING_LONG"] === "Y"):?> transfer-item<?endif?>
                                            <?if($arParams["SF_NAVBAR_ITEMS_UPPERCASE_LATTERS"] === "Y"):?> text-t-u<?endif?>" 
                                            href="<?=$arItem["LINK"]?>">
                                            <?if ($arItem['PARAMS']['ICON']):?>
                                                <div class="start-icon <?if($arItem["TEXT"] !== ""):?>mr-2<?endif?>">
                                                    <i class="<?=($arItem['PARAMS']['ICON'])?>"></i>
                                                </div>
                                            <?endif?>
                                            <?if($arItem["TEXT"] !== ""):?>
                                                <span class="item-text">
                                                    <?=$arItem["TEXT"]?>															
                                                </span>	
                                            <?endif?>
                                            <span class="item-icon">
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            </span>
                                            <span class="item-hover" style="display:none"></span>
                                        </a>
                                    </li>
                                <?else:?>
                                    <li class="nav-item <?if($arItem["SELECTED"]):?>
                                            active
                                        <?endif?>">
                                        <a class="<?=$arParams["SF_NAVBAR_PADDING_LOWER_LEVEL"];?> item-link" href="<?=$arItem["LINK"]?>">
                                            <?if($arParams["SF_MODE_NAVBAR"] == "LEFT"):?>
                                                <span class="item-icon nav-item-indicator"></span>
                                            <?endif?>
                                            <span class="item-text">
                                                <?=$arItem["TEXT"]?>
                                            </span>
                                            <span class="item-icon">
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            </span>
                                        </a>
                                    </li>
                                <?endif?>
                            <?endif?>
                        <?endif?>
                        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
                    <?endif?>
                <?endforeach;?>

                <?if ($previousLevel > 1)://close last item tags?>
                    <?if ($previousLevel - $arItem["DEPTH_LEVEL"] > 2):?>
                        <?=str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                    <?endif?>
                            </ul>
                        </div>
                    </li>
                <?endif?>
            </ul>
<?//========================= TOP.MENU & LEFT.MENU //?>
    <?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?> <?/// TOP ?>
            </section>
        <?//============= END SECTION.CENTER =============//?>
        <?if($arParams["SF_NAVBAR_SECTION_RIGHT"] == "Y"):?>
            <section class="right-region-section d-flex align-items-center justify-content-center">
                <?=$arParams["~SF_NAVBAR_SECTION_RIGHT_HTML"];?>
            </section>
        <?endif?>
        <?//============= SECTION.RIGHT =============//?>
            <section class="right-section d-inline-flex align-items-streach justify-content-end flex-row flex-wrap">
                <?//========= BUTTON ===============// ?>
                    <?if($arParams['SF_NAVBAR_BUTTON'] == "Y"):?>
                        <div class="nav-btn-container h-100 d-flex align-items-center justify-content-center mx-3 hidden-xs hidden-xs-down">
                            <a 
                                class="btn <?=$arParams['SF_NAVBAR_BUTTON_TYPE'];?> <?=$arParams['SF_NAVBAR_BUTTON_STYLE']?>"
                                href="<?=$arParams['SF_NAVBAR_BUTTON_LINK']?>">
                            <span class="nav-item-text">											
                                <?=$arParams['SF_NAVBAR_BUTTON_TEXT']?>
                            </span>
                        </a>
                        </div>
                    <?endif?>
                <?//================================// ?>
                <?//========= SOCIAL.SHARE =========// ?> 
                        <?/*if($arParams["SF_MODE_NAVBAR_SOCIAL_ICON"] === "Y"):?>
                            <div class="nav-social hidden-sm hidden-sm-down d-flex align-items-center justify-content-center">
                                <?$APPLICATION->IncludeComponent(
                                    "simai:sf.share", 
                                    ".default", 
                                    array(
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "SOCIAL" => $arParams["NAVBAR_SOCIAL_SELECTED"],
                                        "VIEW" => array(
                                            0 => "icon",
                                        ),
                                        "SIZE" => "small",
                                        "STYLE" => "text",
                                        "MODIFIER_BUTTON" => "mr-0 mb-0",
                                        "MODIFIER_ICON" => "c-icon-active p-0",
                                        "MODIFIER_TITLE" => "",
                                        "MODIFIER_COUNTER" => "",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO"
                                    ),
                                    array("HIDE_ICONS" => "Y")
                                );?>
                            </div>
                        <?endif;*/?>
                <?//================================// ?>
                <?//========= BUTTON MOBILE =========//?>
                        <button class="btn-mobile b-0 t-2 p-3"> 
                            <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
                        </button>
                <?//================================// ?>   
                <?//========= NAVIGATION SEARCH =====// ?>         
                        <?if($arParams['SF_NAVBAR_SEARCH'] == 'Y'):?>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:search.title",
                                "nav.search",
                                Array(
                                    "CATEGORY_0" => array(0=>"no",),
                                    "CATEGORY_0_TITLE" => "",
                                    "CHECK_DATES" => "N",
                                    "CONTAINER_ID" => "title-search",
                                    "INPUT_ID" => "title-search-input",
                                    "NUM_CATEGORIES" => "1",
                                    "ORDER" => "rank",
                                    "PAGE" => "#SITE_DIR#search/index.php",
                                    "SHOW_INPUT" => "Y",
                                    "SHOW_OTHERS" => "N",
                                    "TOP_COUNT" => "5",
                                    "USE_LANGUAGE_GUESS" => "Y",
                                    "SF_NAVBAR_PADDING_ONE_LEVEL" => $arParams["SF_NAVBAR_PADDING_ONE_LEVEL"],
                                ),
                                array("HIDE_ICONS" => "Y")
                            );?>
                        <?endif?>
                <?//================================// ?>
            </section>
        <?//=========================== END SECTION.RIGHT//?>
        </nav>
<?//=========================== END NAVIGATION //?>
    <?else:?>
        </div>
    <?endif?>   <?/// END TOP ?>
<?//============= NAVBAR.CONTAINER =============//?>
    <?if($arParams["SF_MODE_NAVBAR"] === "TOP"):?> <?/// LEFT ?>
            </div>
        </div>
    <?endif?>
<?//========================== END NAVBAR.CONTAINER//?>

<?if($arParams["SF_MODE_NAVBAR"] == "TOP"):?> <?/// TOP ?>
    </div>  <?// end fixed?>
<?endif?>


<?endif?>




<script>
    window.addEventListener("DOMContentLoaded", function() {
        $('#<?=$idSfNav;?>').sfNavMulti({
            <?if($arParams["SF_MODE_NAVBAR"] == "LEFT"):?> <?/// TOP ?>
                leftFlag: true,
            <?else:?>
            <?if($arParams["SF_MODE_NAVBAR_SUBMENU"] == "horizontal-submenu"):?>
                searchContainer: true,
                horizontalSubmenu: true,
            <?else:?>
                searchContainer: false,
                horizontalSubmenu: false,
            <?endif?>
            <?if($arParams["SF_NAVBAR_TRANSFER_HEADING_LONG"] === "Y"):?>
                transferHeadingItem: true,
            <?else:?>
                transferHeadingItem: false,
            <?endif?>
//===================== ФИКСИРОВАННОЕ =====================//
                <?if($arParams["SF_NAVBAR_FIXED"] == "Y"):?>
                    fixedFlag: true,
                    fixedId: "#sf-fixed-id-<?=$Hash;?>",
                    fixedClass: 'nav-fixed-<?=$Hash?> nav-fixed',
                <?else:?>
                    fixedFlag: false,
                <?endif?>
//===================== ПОЛНОЭКРАННОЕ =====================//
                <?if($arParams["SF_NAVBAR_FULLSCREEN"] == "Y"):?>
                    fullScreenFlag: true,
                    <?if($arParams["SF_NAVBAR_COLOR_FULLSCREEN"] === ''):?>
                        fullScreenTheme: "<?=$arParams['SF_NAVBAR_COLOR_THEME_FULLSCREEN']?>",
                    <?else:?>
                        fullScreenTheme: '<?=$arParams['SF_NAVBAR_COLOR_THEME_FULLSCREEN']?> full-screen-color-<?=$Hash;?>',
                    <?endif?>
                <?else:?>
                    fullScreenFlag: false,
                <?endif?>
//===================== ТРАНСФОРМ =====================//
                <?if($arParams["SF_NAVBAR_TRANSFORM"] == "Y"):?>
                    transformFlag: true,
                    transformPaddingOne: '<?=$arParams["SF_NAVBAR_PADDING_ONE_LEVEL"]?>',
                    transformPaddingLower: '<?$arParams["SF_NAVBAR_PADDING_LOWER_LEVEL_TEXT"]?>',
                    transformEffectHover: '<?=$arParams["SF_NAVBAR_ITEM_EFFECT_HOVER"]?>',
                    <?if($arParams["SF_NAVBAR_COLOR_CHILD_ITEM_MENU"] === ''):?>
                        transformTheme: '<?=$arParams["SF_NAVBAR_COLOR_THEME_SUBMENU"];?> '
                                        <?if($arParams["SF_NAVBAR_SETTINGS_FIXED_SPECIAL"] === 'Y'):?>
                                            <?if($arParams["SF_NAVBAR_FIXED_COLOR_SUBMENU"] !== ''):?>
                                                + '<?=$arParams["SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU"]?> fixed-submenu-color<?=$Hash?>'
                                            <?else:?>
                                                + '<?=$arParams["SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU"]?>'
                                            <?endif?>
                                        <?endif?>,
                    <?else:?>
                        transformTheme: '<?=$arParams["SF_NAVBAR_COLOR_THEME_SUBMENU"];?> child-color-submenu-<?=$Hash;?>
                                        <?if($arParams["SF_NAVBAR_SETTINGS_FIXED_SPECIAL"] === 'Y'):?>
                                            <?if($arParams["SF_NAVBAR_FIXED_COLOR_SUBMENU"] !== ''):?>
                                                <?=$arParams["SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU"]?> fixed-submenu-color<?=$Hash?>
                                            <?else:?>
                                                <?=$arParams["SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU"]?>
                                            <?endif?>
                                        <?endif?>', 
                    <?endif?>
                <?else:?>
                    transformFlag: false,
                <?endif?>
//===================== МОБИЛЬНОЕ =====================//
                <?if($arParams["SF_NAVBAR_MOBILE"] == "Y"):?>
                    mobileFlag: true,
                <?else:?>
                    mobileFlag: false,
                <?endif?>
            <?endif?>
        });

    });
</script>