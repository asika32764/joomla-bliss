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
use JText;

class PreLoader
{
	public static function _()
	{
		$fid = JFactory::getApplication()->input->get('fid');

		$template = file_get_contents(__DIR__ . '/Layout/PreLoader.html');
		$template = str_replace(
			array(
				'{loading}',
				'{fid}',
			),
			array(
				JText::_('BP_LOADING'),
				$fid,
			),
			$template
		);

		echo $template;

		die;
	}
}
