<?php
/**
 * @package	HikaShop for Joomla!
 * @version	4.4.2
 * @author	hikashop.com
 * @copyright	(C) 2010-2021 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
class paymentController extends hikashopController {
	var $display = array();
	var $modify_views = array();
	var $add = array();
	var $modify = array('apply','orderdown','orderup','saveorder','toggle');
	var $delete = array('delete');
}
