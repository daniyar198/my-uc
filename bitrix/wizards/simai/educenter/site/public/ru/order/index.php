<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");?>

 <?$APPLICATION->IncludeComponent(
	"simai:sf.basket.order", 
	".default", 
	array(
		"FIELDS_2_USER" => array(
			0 => "USERNAME",
			1 => "PHONE",
			2 => "EMAIL",
		),
		"FIELDS_2_USER_REQ" => array(
			0 => "USERNAME",
			1 => "PHONE",
		),
		"EMAIL_THEME" => "новый заказ",
		"EMAIL" => " ",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "payments",
		"IBLOCK_ID" => "#payment#",
		"CATALOG_IBLOCK_TYPE" => "organization",
		"CATALOG_IBLOCK_ID" => "#courses#",
		"CATALOG_PRICE_PROPERTY" => "prop_PRICE",
		"EMAIL_TO" => "",
		"EMAIL_SUBJ" => "",
		"ITEMS_LINKS" => "Y",
		"DISPLAY_CENTS" => "Y",
		"CONT_SESSION" => "Y",
		"CATALOG_IBLOCK_ID_2" => "#seminars#",
		"COUPON_IBLOCK_ID" => ""
	),
	false
);?> 


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>