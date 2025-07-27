<?php

/**
 * ����������� ����� ��������
 */
require_once("config.php");

define('LOG_FILENAME', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/rbs.payment/log.txt');
//RDDNTSNPPTSTART?>
<script type="text/javascript">
 console.log('<?=preg_replace('/([\'\"])/','\\\\\$1',__FILE__).": ".__LINE__." start"?>');//'
	console.log(JSON.stringify(<?=CUtil::PHPToJSObject($GLOBALS["SALE_CORRESPONDENCE"])?>));
 console.log('<?=preg_replace('/([\'\"])/','\\\\\$1',__FILE__).": ".__LINE__." end"?>');//'
</script>
<?//RDDNTSNPPTEND
/**
 * RBS
 *
 * ���������� ���������� ����� RBS � CMS ��������-���������
 *
 * @author RBS
 * @version 1.0
 */
class RBS
{
    /**
     * ����� ��������� �����
     *
     * @var string
     */
    const test_url = TEST_URL;
 
    /**
     * ����� ������� �����
     *
     * @var string
     */
    const prod_url = PROD_URL;
 
    /**
     * ��� ����
     *
     * ��� �����, ������� �������� ��� �������� � ��
     *
     * @var boolean
     */
    const log_file = LOG_FILE;
 
    /**
     * ����� ��������
     *
     * @var string
     */
    private $user_name;
 
    /**
     * ������ ��������
     *
     * @var string
     */
    private $password;
 
    /**
     * ������������� ������
     *
     * ���� �������� true - ����� ������������� ������������� ������
     *
     * @var boolean
     */
    private $two_stage;
 
    /**
     * �������� �����
     *
     * ���� �������� true - ������ ����� �������� � �������� ������
     *
     * @var boolean
     */
    private $test_mode;
 
    /**
     * �����������
     *
     * ���� �������� true - ������ ����� ���������� ������� � ��
     *
     * @var boolean
     */
    private $logging;
 
    /**
     * ����������� ������
     *
     * ���������� ������� �������
     *
     * @param string $user_name ����� ��������
     * @param string $password ������ ��������
     * @param boolean $logging �����������
     * @param boolean $two_stage ������������� ������
     * @param boolean $test_mode �������� �����
     */
    public function RBS($user_name, $password, $two_stage, $test_mode, $logging)
    {
        $this->user_name = $user_name;
        $this->password = $password;
        $this->two_stage = $two_stage;
        $this->test_mode = $test_mode;
        $this->logging = $logging;
    }
 
    /**
     * ������ � ��
     *
     * ������������ ������� � ��������� ���� � ������� JSON-������
     *
     * @param string $method ����� ������� � ��
     * @param mixed[] $data ������ � �������
     * @param string $url ����� ��
     * @return mixed[]
     */
    private function gateway($method, $data)
    {
        $data['userName'] = $this->user_name;
        $data['password'] = $this->password;
		$dataEncoded = http_build_query($data);
		
        if ($this->test_mode) {
            $url = self::test_url;
        } else {
            $url = self::prod_url;
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url.$method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $dataEncoded,
            CURLOPT_HTTPHEADER => array('CMS: Bitrix', 'Module-Version: '.VERSION),
            CURLOPT_SSLVERSION => 6
        ));
		$response = curl_exec($curl);
		if(!$response)
		{
			$client = new \Bitrix\Main\Web\HttpClient(array(
				'waitResponse' => true
			));
			$response = $client->post($url.$method, $data);
		}
 
		$response = json_decode($response, true);
        if ($this->logging) {
            $this->logger($url, $method, $data, $response);
        }
        curl_close($curl);
        return $response;
    }
 
    /**
     * ������
     *
     * ����������� ������� � ������ �� ��
     *
     * @param string $url
     * @param string $method
     * @param mixed[] $data
     * @param mixed[] $response
     * @return integer
     */
    private function logger($url, $method, $data, $response)
    {
    	return AddMessage2Log('RBS PAYMENT '.$url.$method.' REQUEST: '.json_encode($data). ' RESPONSE: '.json_encode($response),'rbs.payment');
// 		return error_log('RBS PAYMENT '.$url.$method.' REQUEST: '.json_encode($data). ' RESPONSE: '.json_encode($response));
    }
 
    /**
     * ����������� ������
     *
     * ����� register.do ��� registerPreAuth.do
     *
     * @param string $order_number ����� ������ � ��������
     * @param integer $amount ����� ������
     * @param string $return_url ��������, �� ������� ���������� ������� ������������
     * @param string $currency ��� ������ ������
     * @return mixed[]
     */
    function register_order($order_number, $amount, $return_url, $currency, $orderDescription = '')
    {
    	$iso = COption::GetOptionString("rbs.payment", "iso", serialize(array()));
    	$arCurrency = unserialize($iso);
    	$arCurrency = array_filter($arCurrency);
    	$arDefaultIso = unserialize(DEFAULT_ISO);
    	if (is_array($arDefaultIso))
    		$arCurrency = array_merge($arDefaultIso, $arCurrency);

        $data = array(
            'orderNumber' => $order_number,
            'amount' => $amount,
            'returnUrl' => $return_url,
            'description' => $orderDescription,
        );
        if ($currency && isset($arCurrency[$currency]))
        	$data['currency'] = $arCurrency[$currency];
        
        if ($this->two_stage) { $method = 'registerPreAuth.do'; } else { $method = 'register.do'; }
        $response = $this->gateway($method, $data);
        return $response;
    }
 
    /**
     * ������ ������ �� ORDER ID
     *
     * ����� getOrderStatusExtended.do
     *
     * @param string $order_number ����� ������ � ��������
     * @return mixed[]
     */
    public function get_order_status_by_orderId($orderId)
    {
        $data = array('orderId' => $orderId);
        $response = $this->gateway('getOrderStatusExtended.do', $data);
        return $response;
    }
 
    /**
     * ������ ������ �� ORDER NUMBER
     *
     * ����� getOrderStatusExtended.do
     *
     * @param string $order_number ����� ������ � ��������
     * @return mixed[]
     */
    public function get_order_status_by_orderNumber($order_number)
    {
        $data = array('orderNumber' => $order_number);
        $response = $this->gateway('getOrderStatusExtended.do', $data);
        return $response;
    }
}