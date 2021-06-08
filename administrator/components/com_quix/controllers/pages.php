<?php
/**
 * @version    CVS: 1.0.0
 * @package    com_quix
 * @author     ThemeXpert <info@themexpert.com>
 * @copyright  Copyright (C) 2015. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

use Joomla\Utilities\ArrayHelper;

/**
 * Pages list controller class.
 *
 * @since  1.6
 */
class QuixControllerPages extends JControllerAdmin
{
	
	/**
	 * Method to save the submitted ordering values for records via AJAX.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function saveOrderAjax()
	{
		// Get the input
		$input = JFactory::getApplication()->input;
		$pks   = $input->post->get('cid', array(), 'array');
		$order = $input->post->get('order', array(), 'array');

		// Sanitize the input
		ArrayHelper::toInteger($pks);
		ArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		// Close the application
		JFactory::getApplication()->close();
	}

	/**
	 * Method to clone an existing products.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function duplicate()
	{
		$model = $this->getModel();

		// Check for request forgeries
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$pks = $this->input->post->get('cid', array(), 'array');
		JArrayHelper::toInteger($pks);

		if (empty($pks))
		{
			throw new Exception(JText::_('COM_QUIX_ERROR_NO_PAGE_SELECTED'));
		}

		// dulicate the selected the items.
		if (!$model->duplicate($pks))
		{
			$this->setMessage($model->getError());
		}
		else{
			$this->setMessage(JText::plural('COM_QUIX_N_PAGES_DUPLICATED', count($pks)));
		}

		$this->setRedirect('index.php?option=com_quix&view=pages');
	}

	/**
	 * Proxy for getModel
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  The array of possible config values. Optional.
	 *
	 * @return  object  The model.
	 *
	 * @since   1.6
	 */
	public function getModel($name = 'Page', $prefix = 'QuixModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}
}
