<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2018-11-27 02:12:46
  from "F:\wamp\www\miaosha\app\index\view\user\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-22',
  'unifunc' => 'content_5bfca81e013df4_92226940',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a8e06f4703f2147eff4c8fd4758efb59c042a013' => 
    array (
      0 => 'F:\\wamp\\www\\miaosha\\app\\index\\view\\user\\index.html',
      1 => 1543283924,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bfca81e013df4_92226940 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <title>登陆-秒杀系统</title>
        <link href="/static/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
        <?php echo '<script'; ?>
 src="/static/bootstrap/jquery.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/static/bootstrap/bootstrap.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="http://cdn.bootcss.com/holder/2.9.4/holder.min.js"><?php echo '</script'; ?>
>
        <link href="/static/css/main.css"  rel="stylesheet" type="text/css">
         
    </head>
    <body>
        <div id="container">
			<div class="col-md-4 col-md-offset-4" style="margin-top:100px">
				<form action="/index/user/login" method="post">
				  <div class="form-group">
					<label for="exampleInputEmail1">账  号</label>
					<input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="账  号" required>
				  </div>
				  <div class="form-group">
					<label for="exampleInputPassword1">密  码</label>
					<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密  码" required>
				  </div>
				  
				  <div class="col-md-4 col-md-offset-4">
					<button type="submit" class="btn btn-primary">登 &nbsp;&nbsp;&nbsp;&nbsp; 陆</button>
					<a href="/" class="btn btn-warning">返回首页</a>
				  </div>
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
	</body>
</html><?php }
}
