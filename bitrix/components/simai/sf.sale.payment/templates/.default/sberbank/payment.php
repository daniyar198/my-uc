<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/classes/general/update_class.php');

/**
 * Поддержка сессий
 */
session_start();

/**
 * Подключение файла настроек
 */
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/rbs.payment/config.php");

/**
 * Подключение класса RBS
 */
require_once("rbs.php");
if (CSalePaySystemAction::GetParamValue("TEST_MODE") == 'Y') {$test_mode = true;} else {$test_mode = false;}
if (CSalePaySystemAction::GetParamValue("TWO_STAGE") == 'Y') {$two_stage = true;} else {$two_stage = false;}
if (CSalePaySystemAction::GetParamValue("LOGGING") == 'Y') {$logging = true;} else {$logging = false;}
$rbs = new RBS(CSalePaySystemAction::GetParamValue("USER_NAME"), CSalePaySystemAction::GetParamValue("PASSWORD"), $two_stage, $test_mode, $logging);

$app = \Bitrix\Main\Application::getInstance();
$request = $app->getContext()->getRequest();

/**
 * Запрос register.do или regiterPreAuth.do в ПШ
 */

$order_number = CSalePaySystemAction::GetParamValue("ORDER_NUMBER");

$entityId = CSalePaySystemAction::GetParamValue("ORDER_PAYMENT_ID");

if(CUpdateSystem::GetModuleVersion('sale') <= "16.0.11")
{
	$orderId = $order_number;
}
else
{
	list($orderId, $paymentId) = \Bitrix\Sale\PaySystem\Manager::getIdsByPayment($entityId);
}

if(!$order_number)
	$order_number = $orderId;
if(!$order_number)
	$order_number = $GLOBALS['SALE_INPUT_PARAMS']['ID'];

if(!$order_number)
	$order_number = $_REQUEST['ORDER_ID'];

$arOrder = CSaleOrder::GetByID($orderId);

$currency = $arOrder['CURRENCY'];

$amount = CSalePaySystemAction::GetParamValue("AMOUNT") * 100;
$return_url = 'http://' . $_SERVER['SERVER_NAME'] . '/sale/payment/result.php?ID='.$order_number;
for ($i = 0; $i <= 10; $i++) {
	$response = $rbs->register_order($order_number.'_'.$i, $amount, $return_url, $currency, $arOrder['USER_DESCRIPTION']);
	if ($response['errorCode'] != 1) break;
}

/**
 * Разбор ответа
 */
?>
<div class="sale-paysystem-wrapper">
<?
if (in_array($response['errorCode'], array(1,2,3,4,5,7))) {
	$error = 'Ошибка №'.$response['errorCode'].': '.$response['errorMessage'];
	?>
	<span><?=$error?></span>
	<?
} elseif ($response['errorCode'] == 0){
	$_SESSION['ORDER_NUMBER'] = $order_number;
	$arUrl = parse_url($response['formUrl']);
	parse_str($arUrl['query'], $arQuery);
	?>
	<span>Сумма к оплате по счету: <?=CurrencyFormat(CSalePaySystemAction::GetParamValue("AMOUNT"), $currency)?></span>
	<form action="<?=$response['formUrl']?>" method="get">
		<?foreach($arQuery as $key => $value):?>
			<input type="hidden" name="<?=$key?>" value="<?=$value?>">
		<?endforeach?>
		<div class="sale-paysystem-button-container">
			<span class="sale-paysystem-button">
				<button>Оплатить</button>
			</span>
			<span class="sale-paysystem-button-descrition">
				Вы будете перенаправленны на страницу оплаты
			</span>
		</div>
		<p>
			<span class="tablebodytext sale-paysystem-description">
				<b>Обратите внимание:</b>
				если вы откажетесь от покупки, для возврата денег вам придется обратиться в магазин.
			</span>
		</p>
	</form>
	<?
} else {
	$error = "Неизвестная ошибка. Попробуйте оплатить заказ позднее.";
	?>
	<span><?=$error?></span>
	<?
}
?>
</div>