<?php
/**
* 2007-2022 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2022 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

use PrestaShopBundle\Controller\Admin\Sell\Order\ActionsBarButton;

if (!defined('_PS_VERSION_')) {
    exit;
}

class JuanjoModule extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'juanjomodule';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Juanjo';
        $this->need_instance = 1;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Juanjo Test Module');
        $this->description = $this->l('Este es mi primer módulo de pruebas');

        $this->confirmUninstall = $this->l('¿Está seguro que deseas desinstalar el módulo?');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        //Configuration::updateValue('JUANJOMODULE_LIVE_MODE', false);

        //include(dirname(__FILE__).'/sql/install.php');

        return parent::install() &&
            $this->registerHook('actionGetAdminOrderButtons') &&
            $this->registerHook('displayAdminOrderSide');
    }

    public function uninstall()
    {
        Configuration::deleteByName('JUANJOMODULE_LIVE_MODE');

        include(dirname(__FILE__).'/sql/uninstall.php');

        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent() {
        /**
         * If values have been submitted in the form, process.
         */
//        if (((bool)Tools::isSubmit('submitJuanjomoduleModule')) == true) {
//            $this->postProcess();
//        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $this->assignTextConfiguration();
        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output.$this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);
        $helper->identifier = $this->identifier;
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->submit_action = 'submitJuanjomoduleModule';
//        $helper->tpl_vars = array(
//            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
//            'languages' => $this->context->controller->getLanguages(),
//            'id_language' => $this->context->language->id,
//        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm(){
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Live mode'),
                        'name' => 'JUANJOMODULE_LIVE_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('Use this module in live mode'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Enter a valid email address'),
                        'name' => 'JUANJOMODULE_ACCOUNT_EMAIL',
                        'label' => $this->l('Email'),
                    ),
                    array(
                        'type' => 'password',
                        'name' => 'JUANJOMODULE_ACCOUNT_PASSWORD',
                        'label' => $this->l('Password'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Set values for the inputs.
     */
//    protected function getConfigFormValues()
//    {
//        return array(
//            'JUANJOMODULE_LIVE_MODE' => Configuration::get('JUANJOMODULE_LIVE_MODE', true),
//            'JUANJOMODULE_ACCOUNT_EMAIL' => Configuration::get('JUANJOMODULE_ACCOUNT_EMAIL', 'contact@prestashop.com'),
//            'JUANJOMODULE_ACCOUNT_PASSWORD' => Configuration::get('JUANJOMODULE_ACCOUNT_PASSWORD', null),
//        );
//    }

    /**
     * Save form data.
     */
//    protected function postProcess()
//    {
//        $form_values = $this->getConfigFormValues();
//
//        foreach (array_keys($form_values) as $key) {
//            Configuration::updateValue($key, Tools::getValue($key));
//        }
//    }


    public function hookDisplayAdminOrderSide(){
        $this->assignTextHookDisplayAdminOrderSide();
        return $this->display(__FILE__, 'card-odt.tpl');
    }

    public function hookActionGetAdminOrderButtons(array $params){
        //        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        //        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
        $bar = $params['actions_bar_buttons_collection'];

        // Imprimir etiqueta
        $texto = $this->l('Print label');
        $bar->add(
            new ActionsBarButton(
                'btn-action',
                ['href' => 'www.google.es'],
                "<i class='material-icons' aria-hidden='true'>print</i> {$texto}"
            )
        );

        // Crear ODT
        $texto = $this->l('Create ODT');
        $bar->add(
            new ActionsBarButton(
                'btn-action',
                ['href' => 'www.google.es'],
                "<i class='material-icons' aria-hidden='true'>description</i> {$texto}"
            )
        );


    }

    public function assignTextHookDisplayAdminOrderSide(){
        $odt_titulo=$this->l('Generate ODT');
        $odt_note=$this->l('Remember that you can generate odt in the top action buttons bar');
        $this->context->smarty->assign([
            'odt_titulo' => $odt_titulo,
            'odt_note' => $odt_note,
        ]);
    }

    public function assignTextConfiguration(){
        $conf_titulo=$this->l('¡Soy Juanjo!');
        $conf_description=$this->l('Este módulo hará que aparezca una tarjeta y unos botones en la órden de un pedido.');
        $this->context->smarty->assign([
            'conf_titulo' => $conf_titulo,
            'conf_description' => $conf_description,
        ]);
    }
}
