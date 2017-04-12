<?php

class PlgSystemBliss extends JPlugin
{
	protected $allow_context = [
		'com_users.profile',
		'com_users.user',
		'com_users.registration',
		'com_admin.profile'
	];

	public function onContentPrepareForm(JForm $form, $data)
	{
		$context = $form->getName();

		// Do not run in not user component
		if (!in_array($context, $this->allow_context))
		{
			return;
		}

		// Remove username field
		$form->removeField('username');
	}

	public function onContentPrepareData($context, $data)
	{
		// Do not run in not user component
		if (!in_array($context, $this->allow_context))
		{
			return;
		}

		// If email1 exists, push it into username to override.
		if (isset($data->email1))
		{
			$data->username = $data->email1;
		}
	}

	public function onUserAfterSave($data, $isNew, $result, $error)
	{
		if ($result)
		{
			$id = $data['id'];
			$email = $data['email'];

			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->update('#__users')
				->set('username = ' . $query->q($email))
				->where('id = ' . $id);

			$db->setQuery($query)->execute();
		}

		// Notice Joomla that user save success.
		return true;
	}
}