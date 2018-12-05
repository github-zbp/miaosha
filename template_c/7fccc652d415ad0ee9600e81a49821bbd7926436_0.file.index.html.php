<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2018-12-05 09:45:26
  from "D:\wamp\www\miaosha\app\index\view\order\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-22',
  'unifunc' => 'content_5c079e36a29563_09017501',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7fccc652d415ad0ee9600e81a49821bbd7926436' => 
    array (
      0 => 'D:\\wamp\\www\\miaosha\\app\\index\\view\\order\\index.html',
      1 => 1544002952,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.html' => 1,
    'file:../common/footer.html' => 1,
  ),
),false)) {
function content_5c079e36a29563_09017501 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"秒杀商品订单列表"), 0, false);
?>

<?php echo '<script'; ?>
 src="/static/js/order.js"><?php echo '</script'; ?>
>
            <!--中间部分-->
                
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
                            <tr>
								<td><?php echo $_smarty_tpl->tpl_vars['v']->value['order_no'];?>
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
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['v']->value['sys_status'];?>
</td>
								<td>
								<?php if ($_smarty_tpl->tpl_vars['v']->value['sys_status'] == 1) {?>
								<a class="btn btn-primary pay-btn" order_id="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">付 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;款</a> 
								<a href="/index/order/cancel?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" class="btn btn-danger">取消订单</a>
								<?php } elseif ($_smarty_tpl->tpl_vars['v']->value['sys_status'] == 2) {?>
								<a class="btn btn-warning" order_id="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">退 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;款</a> &nbsp;
								<?php }?>
								
								</td>
							</tr>
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
				
				<!--模态框-->
				<div id="modal" class="modal fade" tabindex="-1" role="dialog">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						 
						  <div class="modal-body">
							
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-primary check-pay">确认付款</button>
							
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
							
						  </div>
						</div>
                        <!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!--结束-->
<?php $_smarty_tpl->_subTemplateRender("file:../common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <?php }
}
