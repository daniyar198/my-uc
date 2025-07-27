<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?


use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);


session_start();
require_once("config.php");
require_once("rbs.php");


if (COption::GetOptionString("simai.fund", "mode_sber", "") == 'Y') {$test_mode = true;} else {$test_mode = false;}
$two_stage = false;
$logging = false;
$rbs = new RBS(COption::GetOptionString("simai.fund", "merchant_sber", ""), COption::GetOptionString("simai.fund", "pass_sber", ""), $two_stage, $test_mode, $logging);

$app = \Bitrix\Main\Application::getInstance();
$request = $app->getContext()->getRequest();


//Запрос register.do или regiterPreAuth.do в ПШ


$order_number = $arResult["PROPERTIES"]["NOMER"]["VALUE"];

$currency =  "RUB";

$amount = $arResult["PROPERTIES"]["SUM"]["VALUE"] * 100;
$return_url = 'http://' . $_SERVER['SERVER_NAME'] . '/sale/payment/result.php?ID='.$order_number;
for ($i = 0; $i <= 10; $i++) {
	$response = $rbs->register_order($order_number.'_'.$i, $amount, $return_url, $currency, "");
	if ($response['errorCode'] != 1) break;
}


// Разбор ответа

?>
<div class="sale-paysystem-wrapper">
<?
if (in_array($response['errorCode'], array(1,2,3,4,5,7))) {
	$error = Loc::getMessage("NOMER_ERROR").$response['errorCode'].': '.$response['errorMessage'];
	?>
	<span><?=$error?></span>
	<?
} elseif ($response['errorCode'] == 0){
	$_SESSION['ORDER_NUMBER'] = $order_number;
	$arUrl = parse_url($response['formUrl']);
	parse_str($arUrl['query'], $arQuery);
	?>
	<span><?=Loc::getMessage("SUM_K_OPLATE")?>: <?=$arResult["PROPERTIES"]["SUM"]["VALUE"]?> <?=$currency?></span>
	<form action="<?=$response['formUrl']?>" method="get">
		<?foreach($arQuery as $key => $value):?>
			<input type="hidden" name="<?=$key?>" value="<?=$value?>">
		<?endforeach?>
		<div class="sale-paysystem-button-container">
			<span class="sale-paysystem-button">
				<button><?=Loc::getMessage("PAY_NOW")?></button>
			</span>
			<span class="sale-paysystem-button-descrition">
				<?=Loc::getMessage("YOU_REDIRECT")?>
			</span>
		</div>
		<p>
			<span class="tablebodytext sale-paysystem-description">
				<b><?=Loc::getMessage("ATTENTION")?>:</b>
				<?=Loc::getMessage("REFUSE_ITEMS")?>
			</span>
		</p>
	</form>
	<?
} else {
	$error = Loc::getMessage("UNKNOW_ERROR");
	?>
	<span><?=$error?></span>
	<?
}
?>
</div>
