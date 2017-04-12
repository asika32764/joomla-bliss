<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

class BlissHelper
{
	public static function getUserProfile($id)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('*')
			->from('#__bliss_user_profiles')
			->where('user_id = ' . $id);

		return $db->setQuery($query)->loadObject();
	}
}
