<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class BlissViewDonation extends JViewLegacy
{
	public function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$result = $app->login([
			'username' => 'admin',
			'password' => '12341234'
		]);

		if ($result === false)
		{
			$messages = $app->getMessageQueue();
		}

		return parent::display($tpl);
	}
}
