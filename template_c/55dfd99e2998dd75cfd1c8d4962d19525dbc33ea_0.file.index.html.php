<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2018-11-29 03:29:15
  from "F:\wamp\www\miaosha\app\index\view\order\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-22',
  'unifunc' => 'content_5bff5d0be40427_15814517',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55dfd99e2998dd75cfd1c8d4962d19525dbc33ea' => 
    array (
      0 => 'F:\\wamp\\www\\miaosha\\app\\index\\view\\order\\index.html',
      1 => 1543462151,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.html' => 1,
    'file:../common/footer.html' => 1,
  ),
),false)) {
function content_5bff5d0be40427_15814517 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"秒杀商品列表"), 0, false);
?>

<?php echo '<script'; ?>
 src="/static/js/order.js"><?php echo '</script'; ?>
>
            <!--中间部分-->
                
                <div class="col-md-12" style="height:10px"></div>
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-hover">
                            <tr><th>ID</th><th>活动名称</th><th>开始时间</th><th>结束时间</th><th>状态</th><th>操作</th></tr>
                            <tr><td>1</td><td>360手机N5s抢购</td><td>2017-07-10 10:00:00</td><td>2018-07-30 12:00:00</td><td>已上线</td><td><a href="/admin/active/edit">编辑</a> | <a href="/admin/active/delete">下线</a></td></tr>
                            
                            
                        </table>
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
