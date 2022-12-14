<?php
/* Smarty version 3.1.47, created on 2022-12-14 21:39:29
  from 'D:\laragon\www\tienda-prestashop\themes\classic\templates\page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.47',
  'unifunc' => 'content_639a3481d3f778_73820042',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd397d2eed0648114d4b35cebe7cdb11bffe17a3c' => 
    array (
      0 => 'D:\\laragon\\www\\tienda-prestashop\\themes\\classic\\templates\\page.tpl',
      1 => 1671049340,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639a3481d3f778_73820042 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_944560417639a3481d3b136_74833348', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_1620202502639a3481d3b877_58328241 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h1><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h1>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_1301566069639a3481d3b499_06613661 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1620202502639a3481d3b877_58328241', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_723913853639a3481d3de89_12271568 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_1404466670639a3481d3e343_18450166 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_1852648680639a3481d3db51_28091064 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_723913853639a3481d3de89_12271568', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1404466670639a3481d3e343_18450166', 'page_content', $this->tplIndex);
?>

      </div>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_1197245377639a3481d3edf2_08172381 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_418270046639a3481d3ea43_76074495 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1197245377639a3481d3edf2_08172381', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_944560417639a3481d3b136_74833348 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_944560417639a3481d3b136_74833348',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_1301566069639a3481d3b499_06613661',
  ),
  'page_title' => 
  array (
    0 => 'Block_1620202502639a3481d3b877_58328241',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_1852648680639a3481d3db51_28091064',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_723913853639a3481d3de89_12271568',
  ),
  'page_content' => 
  array (
    0 => 'Block_1404466670639a3481d3e343_18450166',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_418270046639a3481d3ea43_76074495',
  ),
  'page_footer' => 
  array (
    0 => 'Block_1197245377639a3481d3edf2_08172381',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1301566069639a3481d3b499_06613661', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1852648680639a3481d3db51_28091064', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_418270046639a3481d3ea43_76074495', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
