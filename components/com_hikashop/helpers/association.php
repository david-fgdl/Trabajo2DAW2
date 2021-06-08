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

JLoader::register('MenusHelper', JPATH_ADMINISTRATOR . '/components/com_menus/helpers/menus.php');

class HikashopHelperAssociation {

	public static function getAssociations($id = 0, $view = null, $layout = null) {
		$languages	= JLanguageHelper::getLanguages();
		$jinput = JFactory::getApplication()->input;
		$ctrl = $jinput->get('ctrl');
		$ctrl_var = 'ctrl';
		if(empty($ctrl)) {
			$ctrl = $jinput->get('view');
			if(!empty($ctrl))
				$ctrl_var = 'view';
		}
		$task = $jinput->get('task');
		$task_var = 'task';
		if(empty($ctrl)) {
			$task = $jinput->get('layout');
			if(!empty($task))
				$task_var = 'layout';
		}
		$component = $jinput->getCmd('option');
		$Itemid = $jinput->get('Itemid');

		$result = array();

		if($component != 'com_hikashop')
			return $result;

		$url = 'index.php?option=com_hikashop';

		$cid = $jinput->get('cid');
		if(!empty($cid))
			$url .= '&cid='.$cid;

		$step = $jinput->get('step');
		if(!empty($step))
			$url .= '&step='.$step;

		$name = $jinput->get('name');

		$associations = MenusHelper::getAssociations($Itemid);

		$app = JFactory::getApplication();
		$menu = $app->getMenu();
		foreach($languages as $i => &$language) {
			$item_id = $Itemid;
			$lang_url = $url;
			if(!empty($associations) && !empty($associations[$language->lang_code])) {
				$menu_item = $menu->getItem($associations[$language->lang_code]);

				if(!empty($name) && !empty($cid)) {
					if($ctrl == 'product' && $task == 'show') {
						$class = hikashop_get('class.product');
						$product = $class->get($cid);
						$class->addAlias($product);
						if(!empty($product->alias))
							$name = $product->alias;
					}elseif($ctrl == 'category' && $task == 'listing') {
						$class = hikashop_get('class.category');
						$category = $class->get($cid);
						$class->addAlias($category);
						if(!empty($category->alias))
							$name = $category->alias;
					}
					$lang_url .= '&name='.$name;
				}

				if(!empty($menu_item->link)) {
					$add = false;
					if( !empty($ctrl) && strpos($menu_item->link, '&view='.$ctrl) === false )
						$add = true;
					if( !empty($task) && strpos($menu_item->link, '&layout='.$task) === false )
						$add = true;
					if($add)
						$lang_url .= '&'.$ctrl_var.'='.$ctrl.'&'.$task_var.'='.$task;
				}
				$item_id = $associations[$language->lang_code];
			}

			$result[$language->lang_code] = $lang_url . (!empty($item_id) ? '&Itemid='.$item_id : ''). '&lang='.substr($language->lang_code, 0,2);
		}

		return $result;
	}

}
