<?php

class BlissController extends JControllerLegacy{

	public function display($cachable = false, $urlparams = array()){

		$viewName=$this->input->get('view','payment');

		$viewLayout=$this->input->get('layout');

		$view=$this->getView($viewName,'html');

		$model=$this->getModel($viewName);

		if ($model)
		{
			$view->setModel($model,true);
		}

		$view->setLayout($viewLayout);

		$view->display();

	}

	public function spReturn()
	{
		// CREDIT, WEBATM Will return OR error.
		echo '<pre>' . print_r($this->input->post->getArray(), 1) . '</pre>';

		$status = $this->input->post->get('Status');

		if ($status !== 'SUCCESS')
		{
			$this->setRedirect(
				JRoute::_('index.php?option=com_bliss&view=payment'),
				'[Error] Your error code is: ' . $status,
				'warning'
			);

			return false;
		}

		// Validate CheckCode
		if (!$this->validateCheckCode())
		{
			$this->setRedirect(
				JRoute::_('index.php?option=com_bliss&view=payment'),
				'[Error] Trade validate fail.',
				'warning'
			);

			return false;
		}

		$order = $this->getModel('Order')->getTable('Order');
		$order->load($this->input->post->get('MerchantOrderNo'));

		// Instant payment
		if (in_array($this->input->post->get('PaymentType'), ['CREDIT', 'WEBATM']))
		{
			$order->state = 1;
		}
		// Deferral payment
		else
		{
			$order->state = 0;
			$order->expired = $this->input->post->get('ExpireDate');
		}

		$order->params = json_encode($this->input->post->getArray());

		$order->store();

		echo 'Pay Success';
	}

	public function spNotify()
	{
		echo '<pre>' . print_r($this->input->post->getArray(), 1) . '</pre>';
	}

	public function spCustomer()
	{
		echo '<pre>' . print_r($this->input->post->getArray(), 1) . '</pre>';
	}

	protected function validateCheckCode()
	{
		$params = JComponentHelper::getParams('com_bliss');

		$merchantID = $params->get('Spgateway.MerchantID');
		$hashKey    = $params->get('Spgateway.HashKey');
		$hashIV     = $params->get('Spgateway.HashIV');

		$orderId = $this->input->post->get('MerchantOrderNo');
		$tradeNo = $this->input->post->get('TradeNo');
		$amount  = $this->input->post->get('Amt');

		$check_code = array(
			"MerchantID" => $merchantID,
			"Amt" => $amount,
			"MerchantOrderNo" => $orderId,
			"TradeNo" => $tradeNo,
		);

		ksort($check_code);
		$check_str = http_build_query($check_code);
		$CheckCode = "HashIV=$hashIV&$check_str&HashKey=$hashKey";
		$CheckCode = strtoupper(hash("sha256", $CheckCode));

		return $CheckCode === $this->input->post->get('CheckCode');
	}

	public function getCities()
	{
		$cities = $db->loadObjectList();
		echo json_decode($cities);

		die;
	}

	public function loginAjax()
	{

	}

	public function registerAjax()
	{
		$data = [
			'username' => 'hello3',
			'name' => 'Hello',
			'password1' => '1234',
			'email' => 'qwe3@test.com',
			'profile' => [
				'birthday' => '2011-02-02'
			]
		];

		// Validate data

		$user = JUser::getInstance();
		$user->bind($data);
		JPluginHelper::importPlugin('user');
		$user->save();

		header('Content-type: text/json');
		echo new JResponseJson($user->getProperties());

		die;
	}
}

?>