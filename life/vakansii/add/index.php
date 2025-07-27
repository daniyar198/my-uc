<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заполнить анкету");
?><?$APPLICATION->IncludeComponent(
	"simai:feedback.all.string", 
	"feedback", 
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "6",
		"EMAIL" => COption::GetOptionString($GLOBALS["moduleName"],"email",""),
		"EMAIL_SUBJ" => "Новая заявка на вакансию",
		"OK_MSG" => "Успешно отправлено",
		"COMPONENT_TEMPLATE" => "feedback",
		"ADD_ACTIVE" => "Y",
        "USE_GOOGLE_CAPTCHA" => COption::GetOptionString($GLOBALS["moduleName"],"use_google_captcha",""),
		"PUBLIC_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"public_key",""),
		"PRIVATE_KEY" => COption::GetOptionString($GLOBALS["moduleName"],"private_key",""),
		"THEME_SENDER" => "Принята заявка на вакансию",
		"MESSAGE_SENDER" => "Ваше заявка принята к рассмотрению"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>