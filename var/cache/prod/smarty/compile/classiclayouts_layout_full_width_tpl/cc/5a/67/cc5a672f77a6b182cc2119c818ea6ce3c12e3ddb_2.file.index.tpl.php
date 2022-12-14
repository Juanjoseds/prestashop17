<?php
/* Smarty version 3.1.47, created on 2022-12-14 21:39:29
  from 'D:\laragon\www\tienda-prestashop\themes\classic\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.47',
  'unifunc' => 'content_639a3481d2e836_13271533',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc5a672f77a6b182cc2119c818ea6ce3c12e3ddb' => 
    array (
      0 => 'D:\\laragon\\www\\tienda-prestashop\\themes\\classic\\templates\\index.tpl',
      1 => 1671049340,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639a3481d2e836_13271533 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_290568762639a3481d2cef0_16184510', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_1495862736639a3481d2d276_46270250 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_300907269639a3481d2db05_16537401 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_680698751639a3481d2d817_19147714 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_300907269639a3481d2db05_16537401', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_290568762639a3481d2cef0_16184510 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_290568762639a3481d2cef0_16184510',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_1495862736639a3481d2d276_46270250',
  ),
  'page_content' => 
  array (
    0 => 'Block_680698751639a3481d2d817_19147714',
  ),
  'hook_home' => 
  array (
    0 => 'Block_300907269639a3481d2db05_16537401',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1495862736639a3481d2d276_46270250', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_680698751639a3481d2d817_19147714', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
