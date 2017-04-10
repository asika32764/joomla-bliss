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

namespace RegularLabs\BetterPreview\Component\Zoo\Item;

defined('_JEXEC') or die;

use JFactory;
use RegularLabs\BetterPreview\Component\Button as Main_Button;

class Button extends Main_Button
{
	function getExtraJavaScript($text)
	{
		return '
				isjform = 0;
			';
	}

	function getURL($name)
	{
		$id = JFactory::getApplication()->input->get('cid', [0], 'array');
		$id = (int) $id[0];

		if (!$id)
		{
			return false;
		}

		require_once JPATH_ADMINISTRATOR . '/components/com_zoo/config.php';

		$zoo = \App::getInstance('zoo');

		$item = $zoo->table->item->get($id);

		$url = $zoo->route->item($item, 0);

		if (strpos($url, 'item_id=') !== false)
		{
			return $url;
		}

		return $url . '&item_id=' . $id;
	}
}
