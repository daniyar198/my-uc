<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Web\Json;

Loc::loadMessages(__FILE__);

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arMenu = GetMenuTypes($site);

$arComponentParameters = Array(
	"GROUPS" => array(
		"MAIN_MENU_SETTINGS" => Array(
			"NAME" => Loc::getMessage("COMP_MAIN_MENU_SETTINGS"),
			"SORT" => 500,
		),
		"DECOR_MENU_SETTINGS" => Array(
			"NAME" => Loc::getMessage("COMP_DECOR_MENU_SETTINGS"),
			"SORT" => 510,
		),
		"CACHE_SETTINGS" => array(
			"NAME" => Loc::getMessage("COMP_GROUP_CACHE_SETTINGS"),
			"SORT" => 600
		),
	),
	"PARAMETERS" => array(
	)
);

// 1 ÂÈÄ ÌÅÍÞ ÄËß ÏÅÐÂÎÃÎ ÓÐÎÂÍß
	$arComponentParameters["PARAMETERS"]["SF_MODE_NAVBAR"] = Array(
		"PARENT" => "BASE",
		"NAME" => Loc::getMessage("SF_MODE_NAVBAR_TEXT"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"TOP" => Loc::getMessage("SF_MODE_NAVBAR_TOP"),
			"LEFT" => Loc::getMessage("SF_MODE_NAVBAR_LEFT"),
		),
		"DEFAULT" => "TOP",
		"REFRESH" => "Y"
	);
//===================
	// 1.1 ÂÈÄ ÌÅÍÞ ÄËß ÎÑÒÀËÜÍÛÕ ÓÐÎÂÍÅÉ
		if($arCurrentValues["SF_MODE_NAVBAR"] === "TOP") {
			$arComponentParameters["PARAMETERS"]["SF_MODE_NAVBAR_SUBMENU"] = Array(
				"PARENT" => "BASE",
				"NAME" => Loc::getMessage("SF_MODE_NAVBAR_SUBMENU_TEXT"),
				"TYPE" => "LIST",
				"VALUES" => array(
					"horizontal-submenu" => Loc::getMessage("SF_MODE_NAVBAR_SUBMENU_TOP"),
					"vertical-submenu" => Loc::getMessage("SF_MODE_NAVBAR_SUBMENU_LEFT"),
				),
				"DEFAULT" => "vertical-submenu",
				"REFRESH" => "Y"
			);
		}
	//===================
// 2 ÒÈÏ ÌÅÍÞ ÄËß ÏÅÐÂÎÃÎ ÓÐÎÂÍß
	$arComponentParameters["PARAMETERS"]["ROOT_MENU_TYPE"] = Array(
		"NAME" => Loc::getMessage("MAIN_MENU_TYPE_NAME"),
		"TYPE" => "LIST",
		"DEFAULT" => 'left',
		"VALUES" => $arMenu,
		"ADDITIONAL_VALUES"	=> "Y",
		"DEFAULT"=>'left',
		"PARENT" => "BASE",
		"COLS" => 45
	);
//===================
// 3 ÒÈÏ ÌÅÍÞ ÄËß ÎÑÒÀËÜÍÛÕ ÓÐÎÂÍÅÉ
	$arComponentParameters["PARAMETERS"]["SUB_CHILD_MENU_TYPE"] = Array(
		"NAME"=>Loc::getMessage("SUB_CHILD_MENU_TYPE_NAME"),
		"TYPE" => "LIST",
		"DEFAULT"=>'section',
		"VALUES" => $arMenu,
		"ADDITIONAL_VALUES"	=> "Y",
		"PARENT" => "BASE",
		"DEFAULT"=>'section',
		"COLS" => 45
	);
//===================
// 4 ÓÐÎÂÅÍÜ ÂËÎÆÅÍÍÎÑÒÈ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["MAX_LEVEL"] = Array(
		"NAME"=>Loc::getMessage("MAX_LEVEL_NAME"),
		"TYPE" => "LIST",
		"DEFAULT"=>'1',
		"PARENT" => "BASE",
		"VALUES" => Array(
			1 => "1",
			2 => "2",
			3 => "3",
			4 => "4",
		),
		"ADDITIONAL_VALUES"	=> "N",
	);
//===================
// 5 ÏÎÄÊËÞ×ÀÒÜ ÔÀÉËÛ Ñ ÈÌÅÍÀÌÈ ÂÈÄÀ .òèï_ìåíþ.menu_exp.php
	$arComponentParameters["PARAMETERS"]["USE_EXT"] = Array(
		"NAME"=>Loc::getMessage("USE_EXT_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT"=>'N',
		"PARENT" => "BASE",
	);
//===================
$arComponentParameters["PARAMETERS"]["DELAY"] = Array(
	"NAME"=>Loc::getMessage("DELAY_NAME"),
	"TYPE" => "CHECKBOX",
	"DEFAULT"=>'N',
	"PARENT" => "ADDITIONAL_SETTINGS",
);

$arComponentParameters["PARAMETERS"]["ALLOW_MULTI_SELECT"] = Array(
	"NAME"=>Loc::getMessage("comp_menu_allow_multi_select"),
	"TYPE" => "CHECKBOX",
	"DEFAULT"=>'N',
	"PARENT" => "ADDITIONAL_SETTINGS",
);

$arComponentParameters["PARAMETERS"]["MENU_CACHE_TYPE"] = Array(
	"PARENT" => "CACHE_SETTINGS",
	"NAME" => Loc::getMessage("COMP_PROP_CACHE_TYPE"),
	"TYPE" => "LIST",
	"VALUES" => array(
		"A" => Loc::getMessage("COMP_PROP_CACHE_TYPE_AUTO"),
		"Y" => Loc::getMessage("COMP_PROP_CACHE_TYPE_YES"),
		"N" => Loc::getMessage("COMP_PROP_CACHE_TYPE_NO"),
	),
	"DEFAULT" => "N",
	"ADDITIONAL_VALUES" => "N",
);

$arComponentParameters["PARAMETERS"]["MENU_CACHE_TIME"] = Array(
	"PARENT" => "CACHE_SETTINGS",
	"NAME" => Loc::getMessage("COMP_PROP_CACHE_TIME"),
	"TYPE" => "STRING",
	"MULTIPLE" => "N",
	"DEFAULT" => 3600,
	"COLS" => 5,
);

$arComponentParameters["PARAMETERS"]["MENU_CACHE_USE_GROUPS"] = Array(
	"PARENT" => "CACHE_SETTINGS",
	"NAME" => Loc::getMessage("CP_BM_MENU_CACHE_USE_GROUPS"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);

$arComponentParameters["PARAMETERS"]["MENU_CACHE_GET_VARS"] = Array(
	"PARENT" => "CACHE_SETTINGS",
	"NAME" => Loc::getMessage("CP_BM_MENU_CACHE_GET_VARS"),
	"TYPE" => "STRING",
	"MULTIPLE" => "Y",
	"DEFAULT" => "",
	"COLS" => 15,
);



//=================== ÍÀÑÒÐÎÉÊÀ ÎÑÍÎÂÍÎÃÎ ÌÅÍÞ ===================//
//========================================
if($arCurrentValues["SF_MODE_NAVBAR"] === "TOP") {
//========= 6 ÌÅÍÞ ÍÀ ÂÅÑÜ ÝÊÐÀÍ =================//
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_FULLSCREEN"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_FULLSCREEN_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
		"REFRESH" => "Y",
	);
//===================	
//========== 7 ÁÐÅÍÄ =================//
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_BRAND"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_BRAND_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
		"REFRESH" => "Y",
	);
	if($arCurrentValues["SF_NAVBAR_BRAND"] === "Y") {
	//========== 7.1 ÁÐÅÍÄ. ÈÑÒÎ×ÍÈÊ. =================//
		$arComponentParameters["PARAMETERS"]["SF_NAVBAR_BRAND_SOURCE"] = Array(
			"PARENT" => "MAIN_MENU_SETTINGS",
			"NAME" => Loc::getMessage("SF_NAVBAR_BRAND_SOURCE_NAME"),
			"TYPE" => "LIST",
			"VALUES" => Array(
				"SETTINGS_SITE" => Loc::getMessage("SETTINGS_SITE_TEXT"),
				"NAME_BRAND" => Loc::getMessage("NAME_BRAND_TEXT"),
				"LOGO_BRAND" => Loc::getMessage("LOGO_BRAND_TEXT"),				
			),
			"DEFAULT" => "Y",
			"REFRESH" => "Y",
		);
	//===================
	//========== 7.2 ÁÐÅÍÄ. ÍÀÇÂÀÍÈÅ. =================//
		if($arCurrentValues["SF_NAVBAR_BRAND_SOURCE"] === "NAME_BRAND") {
			
			$arComponentParameters["PARAMETERS"]["SOURCE_BRAND_NAME"] = Array(
				"PARENT" => "MAIN_MENU_SETTINGS",
				"NAME" => Loc::getMessage("SOURCE_BRAND_NAME_TEXT"),
				"TYPE" => "STRING",           
				"DEFAULT" => "",
			);
		}
	//===================
	//========== 7.3 ÁÐÅÍÄ. ËÎÃÎÒÈÏ. =================//
		if($arCurrentValues["SF_NAVBAR_BRAND_SOURCE"] === "LOGO_BRAND") {
			$arComponentParameters["PARAMETERS"]["SOURCE_BRAND_LOGO"] = Array(
				"PARENT" => "MAIN_MENU_SETTINGS",
				"NAME" => Loc::getMessage("SOURCE_BRAND_LOGO_TEXT"),
				"TYPE" => "STRING",           
				"DEFAULT" => "",
			);
		}
	//===================
	}
//===================
// ============ 8 ÀÄÀÏÒÈÂÍÎÅ ÊÎËÈ×ÅÑÒÂÎ ÏÓÍÊÒÎÂ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_TRANSFORM"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_TRANSFORM_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	);
//===================
// 9 ÌÎÁÈËÜÍÎÅ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_MOBILE"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_MOBILE_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
		"REFRESH" => "Y",		
	);
//===================
// ============ 10 ÊÍÎÏÊÀ ============ //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_BUTTON"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_BUTTON_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
		"REFRESH" => "Y",
	);
	if($arCurrentValues["SF_NAVBAR_BUTTON"] === "Y") {
	// ========= 10.1 ÊÍÎÏÊÀ. ÒÈÏ. ========= //
		$arComponentParameters["PARAMETERS"]["SF_NAVBAR_BUTTON_TYPE"] = array(
			"PARENT" => "MAIN_MENU_SETTINGS",
			"NAME" => Loc::getMessage("SF_NAVBAR_BUTTON_TYPE_NAME"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"btn-default" => Loc::getMessage("SF_NAVBAR_BUTTON_TYPE_DEFAULT_NAME"),
				"btn-primary" => Loc::getMessage("SF_NAVBAR_BUTTON_TYPE_PRIMARY_NAME"),
				"btn-secondary" => Loc::getMessage("SF_NAVBAR_BUTTON_TYPE_SECONDARY_NAME"),
				"btn-success" => Loc::getMessage("SF_NAVBAR_BUTTON_TYPE_SUCCESS_NAME"),
				"btn-info" => Loc::getMessage("SF_NAVBAR_BUTTON_TYPE_INFO_NAME"),
				"btn-warning" => Loc::getMessage("SF_NAVBAR_BUTTON_TYPE_WARNING_NAME"),
				"btn-danger" => Loc::getMessage("SF_NAVBAR_BUTTON_DANGER_TYPE_NAME"),
				"btn-link" => Loc::getMessage("SF_NAVBAR_BUTTON_LINK_TYPE_NAME"),
			),
			"DEFAULT" => "btn-default",
		);
	//===================
	// ========= 10.2 ÊÍÎÏÊÀ. ÑÑÛËÊÀ. ========= //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_BUTTON_LINK"] = array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_BUTTON_LINK_NAME"),
		"TYPE" => "STRING",
		'MULTIPLE' => 'N',            
		"DEFAULT" => "",
	);

	// ========= 10.3 ÊÍÎÏÊÀ. ÒÅÊÑÒ ========= //
		$arComponentParameters["PARAMETERS"]["SF_NAVBAR_BUTTON_TEXT"] = array(
			"PARENT" => "MAIN_MENU_SETTINGS",
			"NAME" => Loc::getMessage("SF_NAVBAR_BUTTON_TEXT_NAME"),
			"TYPE" => "STRING",
			'MULTIPLE' => 'N',            
			"DEFAULT" => "",
		);
	//===================
	// ========= 10.4 ÊÍÎÏÊÀ. ÑÒÈËÜ ========= //
		$arComponentParameters["PARAMETERS"]["SF_NAVBAR_BUTTON_STYLE"] = Array(
			"PARENT" => "MAIN_MENU_SETTINGS",
			"NAME" => Loc::getMessage("SF_NAVBAR_BUTTON_STYLE_NAME"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"btn-square" => Loc::getMessage("SF_NAVBAR_BUTTON_STYLE_SQUARE_NAME"),
				"btn-md" => Loc::getMessage("SF_NAVBAR_BUTTON_STYLE_MD_NAME"),
				"btn-rounded" => Loc::getMessage("SF_NAVBAR_BUTTON_STYLE_ROUNDED_NAME"),
				"btn-md btn-rounded" => Loc::getMessage("SF_NAVBAR_BUTTON_STYLE_MD_ROUNDED_NAME"),
				"btn-outline" => Loc::getMessage("SF_NAVBAR_BUTTON_STYLE_OUTLINE_NAME"),
				"btn-square btn-outline" => Loc::getMessage("SF_NAVBAR_BUTTON_STYLE_SQUARE_OUTLINE_NAME"),
				"btn-rounded btn-outline" => Loc::getMessage("SF_NAVBAR_BUTTON_STYLE_ROUNDED_OUTLINE_NAME"),
			),
			"DEFAULT" => "btn-rounded",
		);
	//===================
	}
//===================
//============= 11 ÏÎÈÑÊ ============ //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_SEARCH"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("NAVBAR_SEARCH_ON"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	);
//===================
// ============ 12 ÑÎÖÈÀËÜÍÛÅ ÑÅÒÈ ============ //
	$arComponentParameters["PARAMETERS"]["SF_MODE_NAVBAR_SOCIAL_ICON"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_MODE_NAVBAR_SOCIAL_ICON_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
		"REFRESH" => "Y",
	);
	if($arCurrentValues["SF_MODE_NAVBAR_SOCIAL_ICON"] === "Y") {
	// ============ 12.1 ÂÛÁÎÐ ÑÎÖÈÀËÜÍÛÕ ÑÅÒÅÉ ============ //
		$arComponentParameters["PARAMETERS"]["NAVBAR_SOCIAL_SELECTED"] = Array(
			"PARENT" => "MAIN_MENU_SETTINGS",
			"NAME" => Loc::getMessage("NAVBAR_SOCIAL_SELECTED_TEXT"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => Array(
				"facebook" => Loc::getMessage("SOCIAL_FACEBOOK"),
				"twitter" => Loc::getMessage("SOCIAL_TWITTER"),
				"plusone" => Loc::getMessage("SOCIAL_PLUSONE"),
				"vkontakte" => Loc::getMessage("SOCIAL_VKONTAKTE"),
				"pinterest" => Loc::getMessage("SOCIAL_PINTEREST"),
				"odnoklassniki" => Loc::getMessage("SOCIAL_ODNOKLASSNIKI"),
				"mailru" => Loc::getMessage("SOCIAL_MAILRU"),
			),
			"DEFAULT" => "facebook",
			"REFRESH" => "Y",
		);
	//===================
		$selectSocial = $arCurrentValues["NAVBAR_SOCIAL_SELECTED"];
		$arSort = array();

		foreach($selectSocial as $select) {
	
			if($select == "facebook") {
				$arSort[$select] = Loc::getMessage("SOCIAL_FACEBOOK");
			}
		
			if($select == "twitter") {
				$arSort[$select] = Loc::getMessage("SOCIAL_TWITTER");
			}	
			
			if($select == "plusone") {
				$arSort[$select] = Loc::getMessage("SOCIAL_PLUSONE");
			}	
		
			if($select == "vkontakte") {
				$arSort[$select] = Loc::getMessage("SOCIAL_VKONTAKTE");
			}	
		
			if($select == "pinterest") {
				$arSort[$select] = Loc::getMessage("SOCIAL_PINTEREST");
			}	
		
			if($select == "odnoklassniki") {
				$arSort[$select] = Loc::getMessage("SOCIAL_ODNOKLASSNIKI");
			}	
		
			if($select == "mailru") {
				$arSort[$select] = Loc::getMessage("SOCIAL_MAILRU");
			}	
		}
		
	// ============ 12.2 ÏÎÐßÄÎÊ ÐÀÑÏÎËÎÆÅÍÈß ÑÎÖÈÀËÜÍÛÕ ÑÅÒÅÉ ============ //
		$arComponentParameters["PARAMETERS"]["NAVBAR_SOCIAL_ORDER"] = Array(
			"PARENT" => "MAIN_MENU_SETTINGS",
			"NAME" => Loc::getMessage("NAVBAR_SOCIAL_ORDER_TEXT"),
			"TYPE" => "CUSTOM",
			"JS_FILE" => str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/control/order/script.js",
			"JS_EVENT" => "initDraggableOrderControl",
			"JS_DATA" => Json::encode($arSort),
				"DEFAULT" => "",
		);
	//===================
	}
//===================
//============= 12_1 ÐÀÇÌÅÑÒÈÒÜ ÌÅÍÞ Â ÊÎÍÒÅÉÍÅÐÅ ============ //
$arComponentParameters["PARAMETERS"]["SF_NAVBAR_CONTAINER_ON"] = Array(
	"PARENT" => "MAIN_MENU_SETTINGS",
	"NAME" => Loc::getMessage("SF_NAVBAR_CONTAINER_ON_TEXT"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);
//===================
// ============ 13 ËÅÂÀß ÂÊËÞ×ÀÅÌÀß ÎÁËÀÑÒÜ ============ //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_SECTION_LEFT_HTML"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_SECTION_LEFT_HTML_TEXT"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);
//===============
// ============ 14 ÏÐÀÂÀß ÂÊËÞ×ÀÅÌÀß ÎÁËÀÑÒÜ ============ //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_SECTION_RIGHT_HTML"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_SECTION_RIGHT_HTML_TEXT"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);
//===============
// ============ 15 ÔÈÊÑÈÐÎÂÀÒÜ ÌÅÍÞ ============ //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_FIXED"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_TEXT_NAVBAR_FIXED"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
		"REFRESH" => "Y",
	);
//===============
// ============ 16 ÂÛÐÀÂÍÈÂÀÍÈÅ ÏÓÍÊÒÎÂ ÌÅÍÞ ============ //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_ALIGN"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_ALIGN_TEXT"),
		"TYPE" => "LIST",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => Array(
			"START" => Loc::getMessage("SF_NAVBAR_ALIGN_START"),
			"END" => Loc::getMessage("SF_NAVBAR_ALIGN_END"),
			"CENTER" => Loc::getMessage("SF_NAVBAR_ALIGN_CENTER"),
		),
	);
//===============
// ============ 17 ÎÒÑÒÓÏÛ ÏÓÍÊÒÎÂ ÏÅÐÂÎÃÎ ÓÐÎÂÍß ============ //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_PADDING_ONE_LEVEL"] = array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_PADDING_ONE_LEVEL_TEXT"),
		"TYPE" => "LIST",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array(
			"t--1 p-2" => Loc::getMessage("SF_NAVBAR_SMALL_PADDING"),
			"t-0 p-3" => Loc::getMessage("SF_NAVBAR_NORMAL_PADDING"),
			//"p-3" => Loc::getMessage("SF_NAVBAR_BIG_PADDING"),                            
		),
	);
//===============
// ============ 18 ÎÒÑÒÓÏÛ ÏÓÍÊÒÎÂ ÂÒÎÐÎÃÎ ÓÐÎÂÍß ============ //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_PADDING_LOWER_LEVEL"] = array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_PADDING_LOWER_LEVEL_TEXT"),
		"TYPE" => "LIST",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array(
			"t--1 p-2" => Loc::getMessage("SF_NAVBAR_SMALL_PADDING"),
			"t-0 p-3" => Loc::getMessage("SF_NAVBAR_NORMAL_PADDING"),
			//"p-3" => Loc::getMessage("SF_NAVBAR_BIG_PADDING"),                          
		),
	);
//===============
// ============ 19 ÂÈÄ ÀÊÒÈÂÍÎÃÎ ÏÓÍÊÒÀ ============ //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_ITEM_EFFECT_HOVER"] = array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_ITEM_EFFECT_HOVER_TEXT"),
		"TYPE" => "LIST",
		"ADDITIONAL_VALUES" => "N",
		"VALUES" => array(
			"allotment" => Loc::getMessage("SF_NAVBAR_ALLOTMENT"),
			"underline" => Loc::getMessage("SF_NAVBAR_UNDERLINE"),
			"blackout" => Loc::getMessage("SF_NAVBAR_BLACKOUT"),
			"fill" => Loc::getMessage("SF_NAVBAR_FILL"),
		),
	);
//===============
// ============ 20 ÏÅÐÅÍÎÑÈÒÜ ÄËÈÍÍÛÅ ÇÀÃÎËÎÂÊÈ ============ //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_TRANSFER_HEADING_LONG"] = array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_TRANSFER_HEADING_LONG_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	);
//===============
// ============ 20.1 ÏÐÎÏÈÑÍÛÅ ÏÓÍÊÒÛ ÌÅÍÞ ÏÅÐÂÎÃÎ ÓÐÎÂÍß ============ //
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_ITEMS_UPPERCASE_LATTERS"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_ITEMS_UPPERCASE_LATTERS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	);
//===============
}

if($arCurrentValues["SF_MODE_NAVBAR"] === "LEFT") {

// 21 ÂÈÄ ÌÅÍÞ
$arComponentParameters["PARAMETERS"]["SF_NAVBAR_LEFT_VIEW"] = Array(
		"PARENT" => "MAIN_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_LEFT_VIEW_TEXT"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"SITE" => Loc::getMessage("SF_NAVBAR_LEFT_VIEW_SITE"),
			"DOC" => Loc::getMessage("SF_NAVBAR_LEFT_VIEW_DOC")
		),
		"DEFAULT" => "SITE",
	);
//===============	
}

// ========================== ÍÀÑÒÐÎÉÊÈ ÎÔÎÐÌËÅÍÈß ==========================//
if($arCurrentValues["SF_MODE_NAVBAR"] === "TOP") {

// 22 ÖÂÅÒÎÂÀß ÑÕÅÌÀ ÏÅÐÂÎÃÎ ÓÐÎÂÍß ÎÑÍÎÂÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_COLOR_THEME"] = array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("NAVBAR_THEME"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"dark-theme" => Loc::getMessage("NAVBAR_THEME_DARK"),
			"light-theme" => Loc::getMessage("NAVBAR_THEME_LIGHT")
		),
		"DEFAULT" => "light-theme",
	);
//===============

//if($arCurrentValues["SF_NAVBAR_MOBILE"] === "N") {
// 23 ÖÂÅÒ ÔÎÍÀ ÏÅÐÂÎÃÎ ÓÐÎÂÍß ÎÑÍÎÂÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_MODE_NAVBAR_COLOR"] = array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_TEXT_MODE_NAVBAR_COLOR_NAME"),
		"TYPE" => "STRING",
		"DEFAULT" => "inherit",
	);
//===============
// 24 ÖÂÅÒÎÂÀß ÑÕÅÌÀ ÎÑÒÀËÜÍÛÕ ÓÐÎÂÍÅÉ ÎÑÍÎÂÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_COLOR_THEME_SUBMENU"] = Array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_THEME_SUBMENU"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"dark-theme" => Loc::getMessage("SF_NAVBAR_THEME_SUBMENU_LIGHT_DARK"),
			"light-theme" => Loc::getMessage("SF_NAVBAR_THEME_SUBMENU_DARK_LIGHT"),
		),
		"DEFAULT" => "light-theme"
	);
//===============
// 25 ÖÂÅÒ ÔÎÍÀ ÎÑÒÀËÜÍÛÕ ÓÐÎÂÍÅÉ ÎÑÍÎÂÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_COLOR_CHILD_ITEM_MENU"] = Array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_COLOR_CHILD_ITEM_MENU_TEXT"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);
//===============

if($arCurrentValues["SF_NAVBAR_FIXED"] === "Y") {

// 26 ÎÑÎÁÛÅ ÍÀÑÒÐÎÉÊÈ ÄËß ÔÈÊÑÈÐÎÂÀÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_SETTINGS_FIXED_SPECIAL"] = Array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_SETTINGS_FIXED_SPECIAL_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
		"REFRESH" => "Y",
	);

	if($arCurrentValues["SF_NAVBAR_SETTINGS_FIXED_SPECIAL"] === "Y") {

	// 26.1 ÖÂÅÒÎÂÀß ÑÕÅÌÀ ÏÅÐÂÎÃÎ ÓÐÎÂÍß ÔÈÊÑÈÐÎÂÀÍÍÎÃÎ ÌÅÍÞ
		$arComponentParameters["PARAMETERS"]["SF_NAVBAR_COLOR_THEME_FIXED_MAIN"] = Array(
			"PARENT" => "DECOR_MENU_SETTINGS",
			"NAME" => Loc::getMessage("SF_NAVBAR_THEME_SPECIAL_FIXED"),
			"TYPE" => "LIST",
			"VALUES" => Array(
				"fixed-dark-theme" => Loc::getMessage("SF_NAVBAR_THEME_SPECIAL_FIXED_DARK"),
				"fixed-light-theme" => Loc::getMessage("SF_NAVBAR_THEME_SPECIAL_FIXED_LIGHT"),
			),
			"DEFAULT" => "fixed-light-theme"
		);
	//===============
	// 26.2 ÖÂÅÒ ÔÎÍÀ ÏÅÐÂÎÃÎ ÓÐÎÂÍß ÔÈÊÑÈÐÎÂÀÍÍÎÃÎ ÌÅÍÞ
		$arComponentParameters["PARAMETERS"]["SF_NAVBAR_FIXED_COLOR"] = Array(
			"PARENT" => "DECOR_MENU_SETTINGS",
			"NAME" => Loc::getMessage("SF_NAVBAR_FIXED_COLOR_TEXT"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		);
	// 26.3 ÖÂÅÒÎÂÀß ÑÕÅÌÀ ÎÑÒÀËÜÍÛÕ ÓÐÎÂÍÅÉ ÔÈÊÑÈÐÎÂÀÍÎÃÎ ÌÅÍÞ
		$arComponentParameters["PARAMETERS"]["SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU"] = Array(
			"PARENT" => "DECOR_MENU_SETTINGS",
			"NAME" => Loc::getMessage("SF_NAVBAR_FIXED_COLOR_THEME_SUBMENU_TEXT"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"fixed-dark-theme-submenu" => Loc::getMessage("SF_NAVBAR_THEME_SPECIAL_FIXED_LIGHT_DARK_SUBMENU"),
				"fixed-light-theme-submenu" => Loc::getMessage("SF_NAVBAR_THEME_SPECIAL_FIXED_DARK_LIGHT_SUBMENU")
			),
			"DEFAULT" => "fixed-light-theme-submenu"
		);
	//===============
	// 26.4 ÖÂÅÒ ÔÎÍÀ ÎÑÒÀËÜÍÛÕ ÓÐÎÂÍÅÉ ÔÈÊÑÈÐÎÂÀÍÍÎÃÎ ÌÅÍÞ
		$arComponentParameters["PARAMETERS"]["SF_NAVBAR_FIXED_COLOR_SUBMENU"] = array(
			"PARENT" => "DECOR_MENU_SETTINGS",
			"NAME" => Loc::getMessage("SF_NAVBAR_FIXED_COLOR_SUBMENU_TEXT"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		);
	//===============
	}
//===============
}

//}


if($arCurrentValues["SF_NAVBAR_MOBILE"] === "Y") {

// 27 ÖÂÅÒÎÂÀß ÑÕÅÌÀ ÌÎÁÈËÜÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_COLOR_THEME_MOBILE"] = Array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_COLOR_THEME_MOBILE_NAME"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"mobile-dark-theme mobile-view" => Loc::getMessage("SF_NAVBAR_THEME_SUBMENU_LIGHT_DARK"),
			"mobile-light-theme mobile-view" => Loc::getMessage("SF_NAVBAR_THEME_SUBMENU_DARK_LIGHT")
		),
		"DEFAULT" => "mobile-dark-theme mobile-view"
	);
//===============
// 28 ÖÂÅÒ ÔÎÍÀ ÌÎÁÈËÜÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_COLOR_MOBILE_NAME"] = Array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_COLOR_MOBILE_NAME_TEXT"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);
//===============
}

if($arCurrentValues["SF_NAVBAR_FULLSCREEN"] === "Y") {

// 29 ÖÂÅÒÎÂÀß ÑÕÅÌÀ ÏÎËÍÎÝÊÐÀÍÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_COLOR_THEME_FULLSCREEN"] = Array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_COLOR_THEME_FULLSCREEN_NAME"),
		"TYPE" => "LIST",
		"VALUES" => Array(
			"light-theme" => Loc::getMessage("SF_NAVBAR_THEME_FULLSCREEN_LIGHT"),
			"dark-theme" => Loc::getMessage("SF_NAVBAR_THEME_FULLSCREEN_DARK"),
		),
		"DEFAULT" => "dark-theme"
	);
//===============
// 30 ÖÂÅÒ ÔÎÍÀ ÏÎËÍÎÝÊÐÀÍÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_COLOR_FULLSCREEN"] = Array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_COLOR_FULLSCREEN_TEXT"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);
//===============
}
}


if($arCurrentValues["SF_MODE_NAVBAR"] === "LEFT") {

// 31 ÖÂÅÒÎÂÀß ÑÕÅÌÀ ÏÅÐÂÎÃÎ ÓÐÎÂÍß ÎÑÍÎÂÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_LEFT_COLOR_THEME"] = Array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_LEFT_COLOR_THEME_TEXT"),
		"TYPE" => "LIST",
		"VALUES" => Array(
			"light-theme" => Loc::getMessage("SF_NAVBAR_THEME_LEFT_LIGHT"),
			"dark-theme" => Loc::getMessage("SF_NAVBAR_THEME_LEFT_DARK")
		),
		"DEFAULT" => "dark-theme"
	);
//===============
// 32 ÖÂÅÒ ÔÎÍÀ ÏÅÐÂÎÃÎ ÓÐÎÂÍß ÎÑÍÎÂÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_LEFT_COLOR"] = Array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_LEFT_COLOR_TEXT"),
		"TYPE" => "STRING",
		"DEFAULT" => "#FFFFFF",
	);
//===============
// 33 ÖÂÅÒÎÂÀß ÑÕÅÌÀ ÎÑÒÀËÜÍÛÕ ÓÐÎÂÍÅÉ ÎÑÍÎÂÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_LEFT_SUBMENU_COLOR_THEME"] = Array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_LEFT_SUBMENU_COLOR_THEME_TEXT"),
		"TYPE" => "LIST",
		"VALUES" => Array(
			"light-theme" => Loc::getMessage("SF_NAVBAR_THEME_LEFT_SUBMENU_LIGHT"),
			"dark-theme" => Loc::getMessage("SF_NAVBAR_THEME_LEFT_SUBMENU_DARK")
		),
		"DEFAULT" => "dark-theme"
	);
//===============
// 34 ÖÂÅÒ ÔÎÍÀ ÎÑÒÀËÜÍÛÕ ÓÐÎÂÍÅÉ ÎÑÍÎÂÍÎÃÎ ÌÅÍÞ
	$arComponentParameters["PARAMETERS"]["SF_NAVBAR_LEFT_SUBMENU_COLOR"] = Array(
		"PARENT" => "DECOR_MENU_SETTINGS",
		"NAME" => Loc::getMessage("SF_NAVBAR_LEFT_SUBMENU_COLOR_TEXT"),
		"TYPE" => "STRING",
		"DEFAULT" => "#FFFFFF",
	);
//===============
}

?>
