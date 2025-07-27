<?$this->setFrameMode(true);?>
<?
$path=substr(__DIR__,0,strlen(__DIR__)-18);
if($APPLICATION->GetCurDir(false) == SITE_DIR)
	$site_dir=true;
else 
	$site_dir=false;

$headerMode = COption::GetOptionString($GLOBALS["moduleName"], "headerMode", ""); 
?>
<header class="<?=($headerMode == 'EMPTY' ? 'header-light' : '');?>">
    <div class="top-header-top <?=($headerMode != 'EMPTY' ? $arResult["style_template"] : '');?>" <?=($headerMode != 'EMPTY' ? $arResult["styleBackground"] : '');?>>
        <div class="top-header-fixed"></div>
        <div class="container pt-10">
            <div class="row">
                <div class="top-info col-md-6 navbar-header">
					<div class="display-row vertical-al-logo-text">
						<div class="middle hidden-sm hidden-xs" style="display: table-cell;">
							<span class="navbar-brand relative">
                               <?if(!$site_dir):?><a href="/"><?endif;?>
                                  <?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => SITE_DIR."include/header_site_logo.php",
											"AREA_FILE_RECURSIVE" => "N",
											"EDIT_MODE" => "txt",
										),
										false,
										Array('HIDE_ICONS' => 'N')
									);?>
                              <?if(!$site_dir):?></a><?endif;?>
							</span>
						</div>
                        <div class="title display-cell middle">
						   <?if(!$site_dir):?><a href="/"><?endif;?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/header_site_name.php",
									"AREA_FILE_RECURSIVE" => "N",
									"EDIT_MODE" => "txt",
								),
								false,
								Array('HIDE_ICONS' => 'N')
							);?>
                           <?if(!$site_dir):?></a><?endif;?>							
						</div>
					</div>
                </div>
                <div class="top-info col-md-6 ">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-xs-12 contacts-top">
                            <ul>
								<li><i class="fa fa-map-marker"></i> <?=COption::GetOptionString($GLOBALS["moduleName"], "address", "")?></li>
								<li><i class="fa fa-phone"></i> <?
								   $arPhones=explode(",",COption::GetOptionString($GLOBALS["moduleName"], "phone", ""));
								   foreach( $arPhones as $code=> $phone){
                                   if($code) echo ", ";
                                      ?><a class="c-gray" href="callto:<?=$phone?>"><?=$phone?></a><?
								   }
								
								?></li>
								<li><i class="fa fa-envelope"></i> <?=COption::GetOptionString($GLOBALS["moduleName"], "email", "")?></li>
							</ul>
                        </div>
                        <div class="top-info col-md-4 col-sm-6 col-xs-12">
                          <div>
                            <nav class="right top-header-menu">
                                <ul class="menu">
                                    <?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "auth-btn", Array(
                                            "REGISTER_URL" => SITE_DIR."auth/", 
                                            "FORGOT_PASSWORD_URL" => "", 
                                            "PROFILE_URL" => SITE_DIR."personal/",
                                            "SHOW_ERRORS" => "Y",  
                                            "URL_BASKET" => "", 
                                            "URL_ORDER" => "",  
                                            "URL_SUBSCRIBE" => "", 
                                            "URL_REQUEST" => "", 
                                        ),
                                        false
                                    );?>
                                </ul>
                            </nav>
                            <span <?if($_SESSION["SITE_SETTINGS"]["MAIN"]["SPECIAL"]=="on"){?>style="display: none;"<?}?>  data-aa-on="" class="right switch-vision return-eye">
								<a class="btn btn-b-white" style="padding: 10px 15px;" title="<?=GetMessage("SIMAI_BUTTON_BLIND_OFF")?>" href="<?=SITE_DIR?>?set-aa=special">
									<i class="fa fa-eye-slash" ></i>
								</a>
							</span>
                            <span <?if($_SESSION["SITE_SETTINGS"]["MAIN"]["SPECIAL"]!="on"){?>style="display: none;"<?}?> class="right return-normal" data-aa-off>
								<a class="btn btn-b-white" style="padding: 10px 15px;" title="<?=GetMessage("SIMAI_BUTTON_BLIND_ON")?>" href="<?=SITE_DIR?>?set-aa=normal" >
									<i class="fa fa-eye"></i>
								</a>
							</span>
						 </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:search.form",
                                "top",
                                Array(
                                    "PAGE" => "#SITE_DIR#search/index.php",
                                    "USE_SUGGEST" => "N"
                                )
                            );?>
                        </div>
						<div class="col-md-3 pl-0">
							<?$APPLICATION->IncludeComponent(
								"simai:sf.basket.count",
								"",
								Array(
									"BASKET_PATH" => SITE_DIR."order/"
								),
							false
							);?>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?
	$APPLICATION->IncludeComponent(
	"simai:sf.menu", 
	"navbar.multi", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"DELAY" => "N",
		"MAX_LEVEL" => "4",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"SF_NAVBAR_COLOR_THEME" => "dark-theme",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "navbar.multi",
		"PARAMETERS" => "",
		"SF_MODE_NAVBAR" => "TOP",
		"SF_MODE_CONTAINER" => "Y",
		"SF_MODE_CONTAINER_COLOR" => "rgb(255,202,40)",
		"SF_MODE_CONTAINER_TEXT_COLOR" => "rgba(0,0,0, 0.87)",
		"SF_NAVBAR_COLOR_THEME_SUBMENU" => "light-theme",
		"SF_NAVBAR_BRAND" => "N",
		"SF_NAVBAR_COLOR_THEME_MOBILE" => "mobile-dark-theme mobile-view",
		"0" => "LIGHT",
		"SF_NAVBAR_FIXED" => "Y",
		"SF_NAVBAR_FIXED_COLOR" => "white",
		"SF_NAVBAR_FIXED_COLOR_TEXT" => "rgba(0, 0, 0, 0.87)",
		"SF_NAVBAR_SEARCH" => "N",
		"SF_MODE_NAVBAR_SOCIAL_ICON" => "N",
		"SF_NAVBAR_BUTTON" => "N",
		"SF_NAVBAR_BUTTON_TEXT" => "Òåñò",
		"SF_NAVBAR_BUTTON_LINK" => "/",
		"SF_NAVBAR_BUTTON_TYPE" => "btn-success",
		"SF_NAVBAR_BUTTON_STYLE" => "btn-square",
		"SF_NAVBAR_MEGA_MODE" => "N",
		"SF_NAVBAR_MEGA_CONTENT" => "",
		"SF_NAVBAR_MEGA_PASTE_LIST" => "1",
		"SF_NAVBAR_TRANSFER_HEADING_LONG" => "N",
		"SUB_CHILD_MENU_TYPE" => "section",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SF_NAVBAR_MEGA_NAME_ITEM" => "Ìåãà ìåíþ",
		"SF_NAVBAR_MEGA_CONTENT_FILE" => "/simai.data/mega/menu_large.php",
		"SF_NAVBAR_MEGA_LINK" => "/",
		"SF_NAVBAR_FULLSCREEN" => "Y",
		"SF_NAVBAR_TRANSFORM" => "Y",
		"SF_NAVBAR_MOBILE" => "Y",
		"SF_NAVBAR_SECTION_LEFT" => "Y",
		"SF_NAVBAR_SECTION_LEFT_HTML" => "",
		"SF_NAVBAR_SECTION_RIGHT" => "Y",
		"SF_NAVBAR_SECTION_RIGHT_HTML" => "",
		"SF_NAVBAR_ALIGN" => "CENTER",
		"SF_NAVBAR_PADDING_ONE_LEVEL" => "t--1 p-2",
		"SF_NAVBAR_PADDING_LOWER_LEVEL" => "t-0 p-3",
		"SF_NAVBAR_ITEM_EFFECT_HOVER" => "blackout",
		"SF_NAVBAR_BRAND_MODULE" => "Y",
		"SF_NAVBAR_BRAND_SOURCE" => "NAME_BRAND",
		"SOURCE_BRAND_NAME" => "ÁÐÅÍÄ",
		"SF_MODE_NAVBAR_COLOR" => "#455A64",
		"SF_NAVBAR_COLOR_CHILD_ITEM_MENU" => "",
		"SF_NAVBAR_SETTINGS_FIXED_SPECIAL" => "N",
		"SF_NAVBAR_COLOR_MOBILE_NAME" => "#455A64",
		"SF_NAVBAR_COLOR_THEME_FULLSCREEN" => "light-theme",
		"SF_NAVBAR_COLOR_FULLSCREEN" => "",
		"SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU" => "fixed-dark-theme-submenu",
		"SF_NAVBAR_FIXED_COLOR_SUBMENU" => "black",
		"SF_NAVBAR_COLOR_THEME_FIXED_MAIN" => "fixed-light-theme",
		"NAVBAR_SOCIAL_SELECTED" => array(
			0 => "facebook",
			1 => "twitter",
		),
		"NAVBAR_SOCIAL_ORDER" => "twitter,facebook",
		"SF_NAVBAR_ITEMS_UPPERCASE_LATTERS" => "Y",
		"SF_MODE_NAVBAR_SUBMENU" => "vertical-submenu",
		"SF_NAVBAR_CONTAINER_ON" => "Y"
	),
	false,
	array(
		"HIDE_ICONS" => "N"
	)
);
	?>
	
	<?
	function componentBreadcrumb()
    {
		global $APPLICATION;
		if($APPLICATION->GetProperty("show_breadcrumb")=="Y") $show_breadcrumb=true;
		 else $show_breadcrumb=false;
		ob_start();
		if(!$site_dir && $show_breadcrumb):?>
			<div class="pg-opt">
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-sm-8">
							<?$APPLICATION->IncludeComponent("simai:breadcrumb", ".default", array(
									"START_FROM" => "0",
									"PATH" => "",
									"SITE_ID" => "-"
								),
								false,
								Array('HIDE_ICONS' => 'Y')
							);?>
						</div>
						<div class="col-md-3 col-sm-4 text-right pt-15">
								<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
								<script src="//yastatic.net/share2/share.js"></script>
								<div class="ya-share2" data-services="vkontakte,facebook,twitter,odnoklassniki,moimir" data-counter="" style="padding-bottom:16px;"></div>
						</div>					
					</div>
				</div>
			</div>
		<?endif;
		$contentTime = ob_get_contents();
		ob_end_clean();
		return $contentTime;
	}
	?>
	<?$APPLICATION->AddBufferContent("componentBreadcrumb");?>
	

</header>

