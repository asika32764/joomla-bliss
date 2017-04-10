<?php
/**
 * @package         Better Preview
 * @version         6.0.0
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2017 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

namespace RegularLabs\BetterPreview;

defined('_JEXEC') or die;

use JFactory;

class Sefs
{
	public static function purge()
	{
		if (!JFactory::getApplication()->isAdmin())
		{
			die('No Access!');
		}

		// need to set the user agent, to prevent breaking when debugging is switched on
		$_SERVER['HTTP_USER_AGENT'] = '';

		$db = JFactory::getDbo();

		$query = $db->getQuery(true)
			->delete('#__betterpreview_sefs');
		$db->setQuery($query);
		$db->execute();

		die();
	}
}
