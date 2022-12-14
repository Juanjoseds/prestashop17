<?php
/* Smarty version 3.1.47, created on 2022-12-14 21:39:29
  from 'D:\laragon\www\tienda-prestashop\themes\classic\templates\_partials\helpers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.47',
  'unifunc' => 'content_639a3481d78da9_64511165',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7a7264a4c59aae7e575cc4c2bd9b27e942b2c31' => 
    array (
      0 => 'D:\\laragon\\www\\tienda-prestashop\\themes\\classic\\templates\\_partials\\helpers.tpl',
      1 => 1671049340,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639a3481d78da9_64511165 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'renderLogo' => 
  array (
    'compiled_filepath' => 'D:\\laragon\\www\\tienda-prestashop\\var\\cache\\prod\\smarty\\compile\\classiclayouts_layout_full_width_tpl\\e7\\a7\\26\\e7a7264a4c59aae7e575cc4c2bd9b27e942b2c31_2.file.helpers.tpl.php',
    'uid' => 'e7a7264a4c59aae7e575cc4c2bd9b27e942b2c31',
    'call_name' => 'smarty_template_function_renderLogo_444057064639a3481d74116_48358614',
  ),
));
?> 

<?php }
/* smarty_template_function_renderLogo_444057064639a3481d74116_48358614 */
if (!function_exists('smarty_template_function_renderLogo_444057064639a3481d74116_48358614')) {
function smarty_template_function_renderLogo_444057064639a3481d74116_48358614(Smarty_Internal_Template $_smarty_tpl,$params) {
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

  <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['index'], ENT_QUOTES, 'UTF-8');?>
">
    <img
      class="logo img-fluid"
      src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['logo_details']['src'], ENT_QUOTES, 'UTF-8');?>
"
      alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
"
      width="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['logo_details']['width'], ENT_QUOTES, 'UTF-8');?>
"
      height="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['logo_details']['height'], ENT_QUOTES, 'UTF-8');?>
">
  </a>
<?php
}}
/*/ smarty_template_function_renderLogo_444057064639a3481d74116_48358614 */
}
