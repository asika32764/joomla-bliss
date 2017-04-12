<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Authentication.joomla
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

include_once JPATH_LIBRARIES . '/windwalker/src/init.php';

/**
 * Joomla Authentication plugin
 *
 * @since  1.5
 */
class PlgSystemBliss extends JPlugin
{
	protected $allow_context = [
		'com_users.profile',
		'com_users.user',
		'com_users.registration',
		'com_admin.profile'
	];

	/**
	 * @param   JForm $form The form to be altered.
	 * @param   array $data The associated data for the form.
	 *
	 * @return  boolean
	 */
	public function onContentPrepareForm($form, $data)
	{
		// Check we are manipulating a valid form.
		$name = $form->getName();

		if (!in_array($name, $this->allow_context))
		{
			return true;
		}

		$form->removeField('username');

		// Add Extra Form
		$form->loadFile(__DIR__ . '/forms/profile.xml');

		return true;
	}

	public function onContentPrepareData($context, $data)
	{
		if (!in_array($context, $this->allow_context))
		{
			return true;
		}

		$data->username = $data->email1;

		$data->extra = [
			'address' => 'QWE'
		];
	}

	/**
	 * Saves user profile data
	 *
	 * @param   array    $data    entered user data
	 * @param   boolean  $isNew   true if this is a new user
	 * @param   boolean  $result  true if saving the user worked
	 * @param   string   $error   error message
	 *
	 * @return bool
	 */
	public function onUserAfterSave($data, $isNew, $result, $error)
	{
		if (!$result)
		{
			return true;
		}

		$mapper = new \Windwalker\DataMapper\DataMapper('#__users');
		$mapper->updateAll(['username' => $data['email']], ['id' => $data['id']]);

		if (isset($data['extra']))
		{
			// Save extra
		}

		return true;
	}
}
