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

		// Lock email
		if (!empty($data->id))
		{
			$form->setFieldAttribute('email1', 'disabled', true);
			$form->setFieldAttribute('email2', 'disabled', true);
		}

		// Load our own profiles
		$form->loadFile(__DIR__ . '/forms/profile.xml');
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

		// Load profile data if exists
		if (isset($data->id))
		{
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select('*')
				->from('#__bliss_user_profiles')
				->where('user_id = ' . $data->id);

			$profile = $db->setQuery($query)->loadObject();

			$data->profile = $profile;
		}
	}

	public function onUserAfterSave($data, $isNew, $result, $error)
	{
		if ($result)
		{
			$id = $data['id'];
			$email = $data['email'];

			// Username override
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->update('#__users')
				->set('username = ' . $query->q($email))
				->where('id = ' . $id);

			$db->setQuery($query)->execute();

			// Save profile
			if (isset($data['profile']) && is_array($data['profile']))
			{
				$profile = $data['profile'];

				$this->saveProfile($data['id'], $profile);
			}
		}

		// Notice Joomla that user save success.
		return true;
	}

	protected function saveProfile($id, array $profile)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$data = (object) $profile;
		$data->user_id = $id;

		// Check user profile exists
		$query->select('id')
			->from('#__bliss_user_profiles')
			->where('user_id = ' . $id);

		$exists = $db->setQuery($query)->loadResult();

		if (!$exists)
		{
			// Insert new one
			$db->insertObject('#__bliss_user_profiles', $data);
		}
		else
		{
			// Update old one
			$db->updateObject('#__bliss_user_profiles', $data, 'user_id');
		}
	}
}