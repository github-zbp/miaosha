<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2018-12-05 09:43:36
  from "D:\wamp\www\miaosha\app\admin\view\order\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-22',
  'unifunc' => 'content_5c079dc8107e57_03817092',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0ab28234deb65e65b81930f4ddc2db3f581e3eab' => 
    array (
      0 => 'D:\\wamp\\www\\miaosha\\app\\admin\\view\\order\\index.html',
      1 => 1544002998,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.html' => 1,
    'file:../common/footer.html' => 1,
  ),
),false)) {
function content_5c079dc8107e57_03817092 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"商品管理"), 0, false);
?>

            <!--中间部分-->
                <div class="col-md-12">
                <div class="col-md-12" style="height:10px"></div>
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-hover" id="order-table">
                            <?php if ($_smarty_tpl->tpl_vars['orders']->value) {?>
							<tr><th>订单号</th><th>商品图片</th><th>商品描述</th><th>总金额</th><th>总件数</th><th>下单时间</th><th>状态</th><th>操作</th></tr>
                            <?php }?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['orders']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                            <tr><td><?php echo $_smarty_tpl->tpl_vars['v']->value['order_no'];?>
</td><td width="200"><img src="/static/images/<?php echo $_smarty_tpl->tpl_vars['v']->value['goods_info'][0]['img'];?>
"  height="200"></td>
							<td style="line-height:18px">
							<?php if ($_smarty_tpl->tpl_vars['description']->value) {?>
								<?php echo $_smarty_tpl->tpl_vars['description']->value[$_smarty_tpl->tpl_vars['k']->value];?>

							<?php }?>
							</td>
							<td><?php echo $_smarty_tpl->tpl_vars['v']->value['price_discount'];?>
 / <?php echo $_smarty_tpl->tpl_vars['v']->value['price_total'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['v']->value['num_total'];?>
</td><td><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['v']->value['time_confirm']);?>
</td><td><?php echo $_smarty_tpl->tpl_vars['v']->value['sys_status'];?>
</td>
							<td>
							<?php if ($_smarty_tpl->tpl_vars['v']->value['sys_status'] == 2) {?>
							<a href="/admin/order/sent" class="btn  btn-primary">发 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;货</a>  &nbsp;
							<?php } elseif ($_smarty_tpl->tpl_vars['v']->value['sys_status'] == 5) {?> <!-- 支付了但发现没有库存了 -->
							<button class="btn  btn-danger">订单已取消</button>&nbsp;
							<?php } elseif ($_smarty_tpl->tpl_vars['v']->value['sys_status'] == 1) {?>
							<button class="btn  btn-default">待支付中</button>&nbsp;
							<?php }?>
							</td></tr>
						<?php
}
} else {
?>

							<center><h3>暂无订单</h3></center>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>
    
                            
                        </table>
						
						<div><?php echo $_smarty_tpl->tpl_vars['links']->value;?>
</div>
                </div>
                <!--结束-->
<?php $_smarty_tpl->_subTemplateRender("file:../common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                
                
             <?php }
}
