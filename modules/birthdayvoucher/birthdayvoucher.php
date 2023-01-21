<?php
/**
* 2007-2023 PrestaShop
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
*  @copyright 2007-2023 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Birthdayvoucher extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'birthdayvoucher';
        $this->tab = 'emailing';
        $this->version = '1.0.0';
        $this->author = 'Juan José Díaz Santana';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Birthday Voucher');
        $this->description = $this->l('Send a discount coupon to the user on their birthday');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('BIRTHDAYVOUCHER_LIVE_MODE', false);

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('displayBackOfficeHeader') &&
            $this->registerHook('actionAdminControllerSetMedia');
    }

    public function uninstall()
    {
        Configuration::deleteByName('BIRTHDAYVOUCHER_LIVE_MODE');

        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
//        if (((bool)Tools::isSubmit('submitBirthdayvoucherModule')) == true) {
//            $this->postProcess();
//        }

        $this->context->smarty->assign('module_dir', $this->_path);
        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output.$this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        return $this->postProcess() . $this->getConfigForm();
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $default_lang = (int) Configuration::get('PS_LANG_DEFAULT');
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitBirthdayvoucherModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->submit_action = 'submitForm';

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        $options = [
            [
                'id_option' => 0,
                'name' => $this->l('Porcentage')
            ],
            [
                'id_option' => 1,
                'name' => $this->l('Amount')
            ]
        ];

        $form[] = array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Active'),
                        'name' => 'BIRTHDAYVOUCHER_ACTIVE',
                        'is_bool' => true,
                        'desc' => $this->l('Active to send vouchers to the clients'),
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
                        'desc' => $this->l('Enter a name for the voucher'),
                        'name' => 'BIRTHDAYVOUCHER_NAME',
                        'label' => $this->l('Voucher name'),
                        'lang' => true,
                        'required' => true,
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-code"></i>',
                        'desc' => $this->l('Enter the code that will be sent to the client'),
                        'name' => 'BIRTHDAYVOUCHER_VOUCHER_CODE',
                        'label' => $this->l('Voucher code'),
                        'hint' => $this->l('e.g. BIRTHDAY10'),
                        'placeholder' => 'BIRTHDAY10',
                        'required' => true,
                    ),
                    array(
                        'col' => 3,
                        'type' => 'select',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Select a type of discount to this voucher'),
                        'name' => 'BIRTHDAYVOUCHER_TYPE',
                        'label' => $this->l('Type of voucher'),
                        'required' => true,
                        'options' => array(                                  // This is only useful if type == select
                            'query' => $options,                           // $array_of_rows must contain an array of arrays, inner arrays (rows) being mode of many fields
                            'id' => 'id_option',                                // The key that will be used for each option "value" attribute
                            'name' => 'name'
                        ),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-tag"></i>',
                        'desc' => $this->l('Select an amount for the voucher'),
                        'name' => 'BIRTHDAYVOUCHER_VALUE',
                        'label' => $this->l('Amount'),
                        'placeholder' => '10',
                        'required' => true,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Free shipping'),
                        'name' => 'BIRTHDAYVOUCHER_FREE_SHIPPING',
                        'is_bool' => true,
                        'desc' => $this->l('The voucher include free shipping too'),
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
//                    array(
//                        'type' => 'password',
//                        'name' => 'BIRTHDAYVOUCHER_ACCOUNT_PASSWORD',
//                        'label' => $this->l('Password'),
//                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );

        return $helper->generateForm($form);

    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        $languages = Language::getLanguages(false);
        $campos = [
            'BIRTHDAYVOUCHER_ACTIVE',
            'BIRTHDAYVOUCHER_NAME',
            'BIRTHDAYVOUCHER_VOUCHER_CODE',
            'BIRTHDAYVOUCHER_TYPE',
            'BIRTHDAYVOUCHER_VALUE',
            'BIRTHDAYVOUCHER_FREE_SHIPPING',
        ];

        $result = [];
        foreach ($campos as $campo){

            $config = [];
            foreach ($languages as $lang){
                if(Configuration::get($campo.'_' . $lang['id_lang'])){
                    $langId = $lang['id_lang'];
                    $config[$langId] = Configuration::get($campo.'_'.$langId);
                }
            }

            if(count($config) > 0){
                $result = array_merge($result, [$campo => $config]);

            }else{
                $result = array_merge($result, [$campo => Configuration::get($campo)]);
            }
        }

//        dump($result);
        return $result;
//        return array(
//            'BIRTHDAYVOUCHER_ACTIVE' => Configuration::get('BIRTHDAYVOUCHER_ACTIVE', null),
//            'BIRTHDAYVOUCHER_NAME' => [1 => Configuration::get('BIRTHDAYVOUCHER_NAME_1', null), 2=>Configuration::get('BIRTHDAYVOUCHER_NAME_2', null)],
//            'BIRTHDAYVOUCHER_VOUCHER_CODE' => Configuration::get('BIRTHDAYVOUCHER_VOUCHER_CODE', null),
//            'BIRTHDAYVOUCHER_TYPE' => Configuration::get('BIRTHDAYVOUCHER_TYPE', null),
//            'BIRTHDAYVOUCHER_VALUE' => Configuration::get('BIRTHDAYVOUCHER_VALUE', null),
//            'BIRTHDAYVOUCHER_FREE_SHIPPING' => Configuration::get('BIRTHDAYVOUCHER_FREE_SHIPPING', null),
//        );
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        if (((bool)Tools::isSubmit('submitForm')) == true) {
            $form_values = $this->getConfigFormValues();
            $languages = Language::getLanguages(false);

            foreach (array_keys($form_values) as $key) {

                $hasLang = false;
                foreach ($languages as $lang)
                {
                    if(Tools::getValue($key.'_'.$lang['id_lang'])){
                        Configuration::updateValue($key.'_'.$lang['id_lang'], Tools::getValue($key.'_'.$lang['id_lang']));
                        $hasLang = true;
                    }
                }
                if(!$hasLang){
                    Configuration::updateValue($key, Tools::getValue($key));
                }


            }

            // Comprobamos si existe el voucher
            if(!$this->checkVoucher()){
                // Si no existe, creamos el voucher
                $this->createVoucher();
            }
        }
    }

    protected function checkVoucher(){
        $sql = new DbQuery();
        $sql->select('*')
            ->from('cart_rule', 'c')
            ->where("c.code = '" . Tools::getValue('BIRTHDAYVOUCHER_VOUCHER_CODE') . "'");
        $result = Db::getInstance()->executeS($sql);
        return (count($result) >= 1);
    }

    protected function createVoucher(){
        $now = date('Y-m-d H:i:s');
        $data = [
            'code' => Tools::getValue('BIRTHDAYVOUCHER_VOUCHER_CODE'),
            'description' => $this->l('Birthday voucher'),
            'active' => 1,
            'free_shipping' => Tools::getValue('BIRTHDAYVOUCHER_FREE_SHIPPING'),
            'date_add' => $now,
            'date_upd' => $now,
        ];

        $columnaDB = Tools::getValue('BIRTHDAYVOUCHER_TYPE') == 0 ? 'reduction_percent' : 'reduction_amount';
        $data = array_merge($data, [$columnaDB => Tools::getValue('BIRTHDAYVOUCHER_VALUE')]);

        Db::getInstance()->insert("cart_rule", $data);
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('configure') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function hookActionAdminControllerSetMedia()
    {
        /* Place your code here. */
    }
}
