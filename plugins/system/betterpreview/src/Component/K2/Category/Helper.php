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

namespace RegularLabs\BetterPreview\Component\K2\Category;

defined('_JEXEC') or die;

if (!class_exists('K2HelperRoute'))
{
	include_once JPATH_SITE . '/components/com_k2/helpers/route.php';
}

use JFactory;
use K2HelperRoute;
use RegularLabs\BetterPreview\Component\Helper as Main_Helper;

class Helper extends Main_Helper
{
	public static function getK2Category()
	{
		if (!JFactory::getApplication()->input->get('cid'))
		{
			return false;
		}

		$item = self::getItem(
			JFactory::getApplication()->input->get('cid'),
			'k2_categories',
			[],
			['type' => 'K2_CATEGORY']
		);

		$item->url = K2HelperRoute::getCategoryRoute($item->id);

		return $item;
	}

	public static function getK2CategoryParents($item)
	{
		if (empty($item)
			|| !JFactory::getApplication()->input->get('cid')
		)
		{
			return false;
		}

		$parents = self::getParents(
			$item,
			'k2_categories',
			[],
			['type' => 'K2_CATEGORY']
		);

		foreach ($parents as &$parent)
		{
			$parent->url = K2HelperRoute::getCategoryRoute($parent->id);
		}

		return $parents;
	}
}
