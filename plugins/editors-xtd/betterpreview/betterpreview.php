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

defined('_JEXEC') or die;

if (!is_file(JPATH_LIBRARIES . '/regularlabs/autoload.php'))
{
	return;
}

if (!is_file(JPATH_PLUGINS . '/system/betterpreview/vendor/autoload.php'))
{
	return;
}

require_once JPATH_LIBRARIES . '/regularlabs/autoload.php';
require_once JPATH_PLUGINS . '/system/betterpreview/vendor/autoload.php';

use RegularLabs\BetterPreview\Component as BP_Component;

/**
 * Button Plugin that places Editor Buttons
 */
class PlgButtonBetterPreview
	extends \RegularLabs\Library\EditorButton
{
	public function extraChecks($params)
	{
		if (JFactory::getApplication()->isSite())
		{
			return false;
		}

		if (!$class = BP_Component::getClass('Button'))
		{
			return false;
		}

		return true;
	}
}
