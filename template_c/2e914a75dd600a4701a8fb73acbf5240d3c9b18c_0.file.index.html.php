<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2018-11-28 06:35:25
  from "D:\wamp\www\miaosha\app\index\view\index\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-22',
  'unifunc' => 'content_5bfe372dd1fc32_87832716',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e914a75dd600a4701a8fb73acbf5240d3c9b18c' => 
    array (
      0 => 'D:\\wamp\\www\\miaosha\\app\\index\\view\\index\\index.html',
      1 => 1543386866,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.html' => 1,
    'file:../common/footer.html' => 1,
  ),
),false)) {
function content_5bfe372dd1fc32_87832716 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"秒杀商品列表"), 0, false);
?>

<?php echo '<script'; ?>
 src="/static/js/main.js"><?php echo '</script'; ?>
>
            <!--中间部分-->
                
                <div class="col-md-12" style="height:10px"></div>
                <div class="col-md-12">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['goods']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                    <div class="col-md-3"  style="margin-top:10px">
                        <div>
                            <img src="<?php echo __STATIC__;?>
/images/<?php echo $_smarty_tpl->tpl_vars['v']->value['img'];?>
" class="col-md-12">
                        </div>
                        <br/>
                        <p>活动:<?php echo $_smarty_tpl->tpl_vars['active']->value[$_smarty_tpl->tpl_vars['v']->value["active_id"]]["title"];?>
</p>
                        <p>商品:<?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</p>
                        <p>价格:<?php echo $_smarty_tpl->tpl_vars['v']->value['price_normal'];?>
</p>
                        <p>原价:<?php echo $_smarty_tpl->tpl_vars['v']->value['price_discount'];?>
</p>
                        <p>库存:<?php echo $_smarty_tpl->tpl_vars['v']->value['num_left'];?>
</p>
						<?php if ($_smarty_tpl->tpl_vars['v']->value["sys_status"] == $_smarty_tpl->tpl_vars['status']->value["online"]) {?>
							<?php if ($_smarty_tpl->tpl_vars['v']->value["num_left"] > 0) {?>
							<p><a class='btn btn-primary buy-btn' aid="<?php echo $_smarty_tpl->tpl_vars['v']->value['active_id'];?>
" gid="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" max-num="<?php echo $_smarty_tpl->tpl_vars['v']->value['num_user'];?>
">立即抢购</a>  <a class='btn btn-warning cart-btn' aid="<?php echo $_smarty_tpl->tpl_vars['v']->value['active_id'];?>
" gid="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">加入购物车</a></p>
							<?php } else { ?>
							<p><a class="btn btn-danger" style="width:70%">该商品已无库存</a></p>
							<?php }?>
						<?php } elseif ($_smarty_tpl->tpl_vars['v']->value["sys_status"] == $_smarty_tpl->tpl_vars['status']->value["to_be_online"]) {?>
						<p><a class="btn btn-danger" style="width:70%">该商品待上线</a></p>
						<?php } else { ?>
						<p><a class="btn btn-danger" style="width:70%">该商品已下线</a></p>
						<?php }?>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                </div>
                <!--结束-->
				
				<!--模态框-->
				<div id="modal" class="modal fade" tabindex="-1" role="dialog">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <form method="post" action="/index/buy/order">
						  <div class="modal-body">
							
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
							<button type="button" class="btn btn-primary submit-order">提交</button>
						  </div>
						</div>
                        </form><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!--结束-->
<?php $_smarty_tpl->_subTemplateRender("file:../common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                
                
                
                
            <?php }
}
