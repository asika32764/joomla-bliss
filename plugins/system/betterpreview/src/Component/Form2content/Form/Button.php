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

namespace RegularLabs\BetterPreview\Component\Form2content\Form;

defined('_JEXEC') or die;

use RegularLabs\BetterPreview\Component\Button as Main_Button;
use RegularLabs\BetterPreview\Component\Menu;

class Button extends Main_Button
{
	function getExtraJavaScript($text)
	{
		return '
				cat = document.getElementById("jform_catid");
				category_title = cat == undefined ? "" : cat.options[cat.selectedIndex].text.replace(/^(\s*-\s+)*/, "").trim();
				overrides = {
						category_title: category_title,
					};
			';
	}

	function getURL($name)
	{
		if (!$item = Helper::getArticle())
		{
			return false;
		}

		Menu::setItemId($item);

		return $item->url;
	}
}
