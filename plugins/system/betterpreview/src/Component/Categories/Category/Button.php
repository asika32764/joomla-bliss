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

namespace RegularLabs\BetterPreview\Component\Categories\Category;

defined('_JEXEC') or die;

use RegularLabs\BetterPreview\Component\Button as Main_Button;
use RegularLabs\BetterPreview\Component\Menu;

class Button extends Main_Button
{
	function getURL($name)
	{
		if (!$item = Helper::getCategory())
		{
			return false;
		}

		Menu::setItemId($item);

		return $item->url;
	}
}
