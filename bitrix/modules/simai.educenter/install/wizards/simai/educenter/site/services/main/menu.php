<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

	CModule::IncludeModule('fileman');
	$arMenuTypes = GetMenuTypes(WIZARD_SITE_ID);
	$arMenu = array(
	        "top" => getMessage("WIZ_MENU_TOP_DEFAULT"),
			"left" => getMessage("WIZ_MENU_LIGHT_TOP"),
			"bottom" => getMessage("WIZ_MENU_LIGHT_BOTTOM"),
			"section" => getMessage("WIZ_MENU_LIGHT_SECTION"),
	
	);
	
	
	SetMenuTypes(array_merge($arMenu,$arMenuTypes), WIZARD_SITE_ID);
	COption::SetOptionInt("fileman", "num_menu_param", 2, false ,WIZARD_SITE_ID);
	
	?>