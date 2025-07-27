<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Карта сайта");?>
<h1 class="mt-10">Карта сайта</h1>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.map",
	".default",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COL_NUM" => "1",
		"COMPONENT_TEMPLATE" => ".default",
		"LEVEL" => "5",
		"SET_TITLE" => "Y",
		"SHOW_DESCRIPTION" => "N"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>