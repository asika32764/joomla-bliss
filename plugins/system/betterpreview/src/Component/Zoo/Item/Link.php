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
use JText;
use RegularLabs\BetterPreview\Component\Link as Main_Link;

class Link extends Main_Link
{
	function getLinks()
	{
		$id = JFactory::getApplication()->input->get('cid', [0], 'array');
		$id = (int) $id[0];

		if (!$id)
		{
			return [];
		}

		require_once JPATH_ADMINISTRATOR . '/components/com_zoo/config.php';

		$zoo = \App::getInstance('zoo');

		$item = $zoo->table->item->get($id);

		$items   = [];
		$items[] = (object) array(
			'id'        => $item->id,
			'name'      => $item->name,
			'published' => $item->state,
			'url'       => $zoo->route->item($item, 0),
			'type'      => JText::_('ITEM'),
		);

		$cats = $item->getRelatedCategories();
		foreach ($cats as $cat)
		{
			$items[] = (object) array(
				'id'        => $cat->id,
				'name'      => $cat->name,
				'published' => $cat->published,
				'url'       => $zoo->route->category($cat, 0),
				'type'      => JText::_('CATEGORY'),
			);
		}

		return $items;
	}
}
