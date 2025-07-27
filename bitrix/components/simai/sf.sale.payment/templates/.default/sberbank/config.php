<?
/**
 * ����������� ��� ��������� � ��� ���������
 */
$mess["module_name"] = "����� �������� ����� ��������";
$mess["module_description"] = "�������� - http://www.sberbank.ru/";
$mess["partner_name"] = "��������";
$mess["partner_uri"] = "http://www.sberbank.ru/";

/**
 * URL API
 */
if(!defined('PROD_URL'))
	define('PROD_URL', 'https://securepayments.sberbank.ru/payment/rest/'); // ��������/���
if(!defined('TEST_URL'))
	define('TEST_URL', 'https://3dsec.sberbank.ru/payment/rest/'); // ����

/**
 * ������ �������
 */
if(!defined('VERSION'))
	define(VERSION, '2.12');
if(!defined('VERSION_DATE'))
	define(VERSION_DATE, '2017-02-06 00:00:00');

/**
 * ������ �����
*/
if(!defined('OPENBANK'))
	define(OPENBANK, false);

/**
 * ���� utf-8, �� true. ���� cp1251 - false (���������� ��� Bitrix)
*/
if (LANG_CHARSET == 'UTF-8') {
	if(!defined('ENCODING'))
		define(ENCODING, true);
} else {
	if(!defined('ENCODING'))
		define(ENCODING, false);
}

$status = COption::GetOptionString("rbs.payment", "result_order_status", "P");
if(!defined('RESULT_ORDER_STATUS'))
	define('RESULT_ORDER_STATUS',$status);

$arDefaultIso = array(
	'USD' => 840,
	'EUR' => 978,
	'CNY' => 643
);

if (OPENBANK)
{
	$arDefaultIso['RUB'] = 643;
	$arDefaultIso['RUR'] = 643;
	if(!defined('DEFAULT_ISO'))
		define(DEFAULT_ISO,serialize($arDefaultIso));
}
else
{
	$arDefaultIso['RUB'] = 643;
	$arDefaultIso['RUR'] = 643;
	if(!defined('DEFAULT_ISO'))
		define(DEFAULT_ISO,serialize($arDefaultIso));
}
