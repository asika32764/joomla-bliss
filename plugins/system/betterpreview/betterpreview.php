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

if (!is_file(__DIR__ . '/vendor/autoload.php'))
{
	return;
}

require_once __DIR__ . '/vendor/autoload.php';

use RegularLabs\BetterPreview\Plugin;

class PlgSystemBetterPreview extends Plugin
{
	public $_alias       = 'betterpreview';
	public $_title       = 'BETTER_PREVIEW';
	public $_lang_prefix = 'BP';

	public $_enable_in_admin = true;
	public $_page_types      = ['html'];
}
