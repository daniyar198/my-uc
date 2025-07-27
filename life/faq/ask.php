<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Задать вопрос");
?>
<?
if (CModule::IncludeModule("iblock")):
    $props = array();
	$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID" => '12'));
	while ($prop_fields = $properties->GetNext())
	{
	  $props[$prop_fields["CODE"]]=$prop_fields["ID"];
	}
endif;
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form", 
	"faq", 
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "12",
		"STATUS_NEW" => "NEW",
		"LIST_URL" => "",
		"USE_CAPTCHA" => "Y",
		"USER_MESSAGE_EDIT" => "",
		"USER_MESSAGE_ADD" => "Ваш вопрос успешно добавлен!",
		"DEFAULT_INPUT_SIZE" => "30",
		"RESIZE_IMAGES" => "N",
	    "PROPERTY_CODES" => array(
			0 => $props["TITLE"],
			1 => $props["PHONE"],
			2 => $props["EMAIL"],
			3 => "NAME",
			4 => "DATE_ACTIVE_FROM",
			5 => "IBLOCK_SECTION",
		),
		"PROPERTY_CODES_REQUIRED" => array(
            0 => $props["TITLE"],
			1 => $props["PHONE"],
			2 => $props["EMAIL"],
			3 => "NAME",
			4 => "IBLOCK_SECTION",
		),
		"GROUPS" => array(
			0 => "2",
		),
		"STATUS" => "INACTIVE",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"MAX_USER_ENTRIES" => "100000",
		"MAX_LEVELS" => "100000",
		"LEVEL_LAST" => "Y",
		"MAX_FILE_SIZE" => "0",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"SEF_MODE" => "N",
		"SEF_FOLDER" => "/answers/",
		"CUSTOM_TITLE_NAME" => "Вопрос",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "Дата",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "Выбрать категорию",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"COMPONENT_TEMPLATE" => "faq"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>