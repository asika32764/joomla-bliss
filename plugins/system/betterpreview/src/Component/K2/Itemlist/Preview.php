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

namespace RegularLabs\BetterPreview\Component\K2\Itemlist;

defined('_JEXEC') or die;

use RegularLabs\BetterPreview\Component\Preview as Main_Preview;

class Preview extends Main_Preview
{
	function renderPreview(&$article, $context)
	{
		if ($context != 'com_k2.category' || !isset($article->description))
		{
			return;
		}

		parent::render($article, $context);
	}

	function states()
	{
		parent::initStates(
			'k2_categories',
			[],
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

			return $params->catItemIntroText;
		}

		return $article->params->get('catItemIntroText', '1');
	}
}
