<?php

if (!defined('_PS_VERSION_'))
	exit;

class CookieConsent extends Module
{
	private $_html = '';

	function __construct()
	{
		$this->name = 'cookieconsent';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Badr TOUNZI';
		$this->need_instance = 0;
		$this->bootstrap = true;

	 	parent::__construct();
		$this->displayName = $this->l('Cookie Consent RGPD');
		$this->description = $this->l('Notify your visitors that your site uses cookies.');
		$this->confirmUninstall = $this->l('Are you sure you want to do it?');
	}

	public function install()
	{
		if (!parent::install() OR
			!$this->registerHook('displayHeader')
		   )
			return false;
		return true;
	}

	public function uninstall()
	{
		if (!parent::uninstall() OR
			Configuration::deleteByName('COOKIECONSENT_POLICY_LINK')
			)
			return false;
		return true;
	}

	public function hookDisplayHeader($params)
	{
		$this->context->controller->addCSS($this->_path . 'views/css/cookieconsent.css');
		$this->context->controller->addJS($this->_path . 'views/js/cookieconsent.min.js');
		Media::addJsDef(array('cookieconsent' => array('policy_link' => Configuration::get('COOKIECONSENT_POLICY_LINK'))));
		$this->context->controller->addJS($this->_path . 'views/js/cookieconsent.js');
	}

	public function getContent()
	{
		$this->_postProcess();
		$this->_displayForm();
		return $this->_html;
	}

	private function _postProcess()
	{
		if(Tools::isSubmit('submitUpdate'))
		{
			if (Validate::isUrl(Tools::getValue('policy_link')))
			{
				Configuration::updateValue('COOKIECONSENT_POLICY_LINK', Tools::getValue('policy_link'), true);
				$this->_html .= $this->displayConfirmation($this->l('Settings Updated'));
			}
			else
			{
				$this->_html .= $this->displayError($this->l('Please enter a valid URL.'));
			}
		}
	}

	private function _displayForm()
	{
		$this->context->smarty->assign(array(
			'policy_link'=> Configuration::get('COOKIECONSENT_POLICY_LINK')
		));

		$this->_html .=  $this->display(__FILE__, 'views/templates/admin/config.tpl');
	}
}