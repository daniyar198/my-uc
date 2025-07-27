<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить отзыв");
?>
<?$APPLICATION->IncludeComponent(
	"simai:feedback.all.string", 
	"reviews", 
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "15",
		"EMAIL" => COption::GetOptionString($GLOBALS["moduleName"],"email",""),
		"EMAIL_SUBJ" => "Новый отзыв",
		"OK_MSG" => "Успешно отправлено",
		"ADD_ACTIVE" => "N",
		"COMPONENT_TEMPLATE" => "reviews",
		"USE_GOOGLE_CAPTCHA" => COption::GetOptionString($GLOBALS["moduleName"],"use_google_captcha",""),
		"PUBLIC_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"public_key",""),
		"PRIVATE_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"private_key",""),
		"THEME_SENDER" => "Принят отзыв",
		"MESSAGE_SENDER" => "Ваш отзыв принят"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>