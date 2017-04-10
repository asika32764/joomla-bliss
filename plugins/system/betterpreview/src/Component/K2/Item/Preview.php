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

namespace RegularLabs\BetterPreview\Component\K2\Item;

defined('_JEXEC') or die;

use JFactory;
use RegularLabs\BetterPreview\Component\Preview as Main_Preview;

class Preview extends Main_Preview
{
	function renderPreview(&$article, $context)
	{
		if ($context != 'com_k2.item' || !isset($article->id) || $article->id != JFactory::getApplication()->input->get('id'))
		{
			return;
		}

		parent::render($article, $context);
	}

	function states()
	{
		parent::initStates(
			'k2_items',
			[
				'publish_up'   => 'publish_up',
				'publish_down' => 'publish_down',
				'parent'       => 'catid',
			],
			'k2_categories',
			[]
		);
	}

	function getShowIntro(&$article)
	{
		if (!isset($article->params))
		{
			return 1;
		}

		if (!is_object($article->params))
		{
			$params = (object) json_decode($article->params);

			return $params->itemIntroText;
		}

		return $article->params->get('itemIntroText', '1');
	}
}
