<?php
class BlissViewPayment extends JViewLegacy{

	public function display($tpl = NULL)
	{
		$merchantID = 'MS31005804';
		$hashKey    = 'daMrxeY4Dxgvn5AAg6BivBuWPvMbhI1u';
		$hashIV     = 'SOWp2VuGtKbQQMr7';
		$version    = '1.2';
		$amount     = '2500';
		$orderId    = '0001_' . uniqid();
		$timestamp  = time();

		$mer_array = array(
			'MerchantID' => $merchantID,
			'TimeStamp' => $timestamp,
			'MerchantOrderNo' => $orderId,
			'Version' => $version,
			'Amt' => $amount,
		);

		ksort($mer_array);

		$check_merstr = http_build_query($mer_array);

		$CheckValue_str = "HashKey=$hashKey&$check_merstr&HashIV=$hashIV";

		$CheckValue = strtoupper(hash("sha256", $CheckValue_str));

		$this->merchantID = $merchantID;
		$this->hashKey    = $hashKey;
		$this->hashIV     = $hashIV;
		$this->version    = $version;
		$this->amount     = $amount;
		$this->orderId    = $orderId;
		$this->timestamp  = $timestamp;
		$this->checkValue = $CheckValue;

		parent::display();
	}


}

?>