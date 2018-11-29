<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2018-11-29 12:13:50
  from "D:\wamp\www\miaosha\app\admin\view\active\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-22',
  'unifunc' => 'content_5bffd7feb8a6f9_19311209',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a0210111302b6dc8836b020a728d4c7c4231427e' => 
    array (
      0 => 'D:\\wamp\\www\\miaosha\\app\\admin\\view\\active\\index.html',
      1 => 1543493626,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.html' => 1,
    'file:../common/footer.html' => 1,
  ),
),false)) {
function content_5bffd7feb8a6f9_19311209 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"商品管理",'nav_active'=>"active"), 0, false);
?>

            <!--中间部分-->
                <div class="col-md-12"><a class="btn btn-primary" href="/admin/active/add">添加活动</a></div>
                <div class="col-md-12" style="height:10px"></div>
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-hover">
                        <tr><th>ID</th><th>活动名称</th><th>开始时间</th><th>结束时间</th><th>状态</th><th>操作</th></tr>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['actives']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                        <tr>
							<td><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</td>
							<td><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['v']->value['time_begin']);?>
</td>
							<td><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['v']->value['time_end']);?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['v']->value["sys_status"];?>
</td>
							<td><a href="/admin/active/edit?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">编辑</a> | 
								<?php if ($_smarty_tpl->tpl_vars['v']->value["sys_status"] != 1) {?><a href="/admin/active/online?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">上线</a><?php }?>
								<?php if ($_smarty_tpl->tpl_vars['v']->value["sys_status"] == 1) {?><a href="/admin/active/delete?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">下线</a><?php }?>
								
							</td>
							</tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                        
                    </table>
                </div>
                <!--结束-->
<?php $_smarty_tpl->_subTemplateRender("file:../common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                
<?php }
}
