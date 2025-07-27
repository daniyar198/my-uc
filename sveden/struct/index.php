<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Структура и органы управления");
?>
 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_RECURSIVE" => "",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"EDIT_MODE" => "",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/structure.php"
	)
);?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"sf-tree-css", 
	array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "organization",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "UF_FIO",
			1 => "UF_ADDRESS",
			2 => "UF_SITE",
			3 => "UF_EMAIL",
			4 => "UF_DIVISION",
			5 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "5",
		"VIEW_MODE" => "LINE",
		"COMPONENT_TEMPLATE" => "sf-tree-css"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>