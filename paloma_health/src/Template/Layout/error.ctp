<?php
$loguser = $this->request->session()->read('Auth.User');
if(empty($loguser)){
	$bodyclass="class='singin'";
}
else{
$bodyclass="";
}
?>
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Premier Health';
?>
<!DOCTYPE html>
<html>
<head>
<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
<?= $cakeDescription ?>
:
<?= $this->fetch('title') ?>
</title>
<?= $this->Html->meta('icon') ?>
<?= $this->Html->css('base.css') ?>
<?= $this->Html->css('cake.css') ?>
<?= $this->fetch('meta') ?>
<?= $this->fetch('css') ?>
<?= $this->fetch('script') ?>
<link href="<?php echo $this->request->webroot?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $this->request->webroot?>css/template.css" rel="stylesheet">
<link href="<?php echo $this->request->webroot?>bootstrap-modal/css/animate.min.css" rel="stylesheet">
<link href="<?php echo $this->request->webroot?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
<link href="<?php echo $this->request->webroot?>jquery/jquery-loadmask/jquery.loadmask.css" rel="stylesheet">
<script src="<?php echo $this->request->webroot?>jquery/jquery-1.8.2.min.js"></script>
<script src="<?php echo $this->request->webroot?>js/jquery-ui-1.10.0.custom.min.js"></script>
<script src="<?php echo $this->request->webroot?>js/jquery-ui-timepicker-addon.js"></script>
<script src="<?php echo $this->request->webroot?>jquery/jquery-loadmask/jquery.loadmask.js"></script>
<script src="<?php echo $this->request->webroot?>jquery/jquery.cookie.js"></script>
<script src="<?php echo $this->request->webroot?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $this->request->webroot?>bootstrap-modal/js/bootstrap.modal.js"></script>
<script src="<?php echo $this->request->webroot?>bootstrap-modal/js/jquery.easing.1.3.js"></script>

<style>
table>thead>tr>th {
	cursor: default;
	text-align: center;
	color: #333333;
	text-shadow: 0 1px 0 #FFFFFF;
	background-color: #e6e6e6;
}
table>thead>tr>th>a {
	color: black;
}
</style>
</head>
<body>
<div class="navbar navbar-top" id="mnu_admin_top">
  <div class="navbar-inner">
    <div class="container">
      <a href="<?php echo $this->request->webroot?>users/myaccount"><div class="loginlogo">&nbsp;</div></a>
      <button type="button" class="btn btn-navbar" data-toggle="collapse"
					data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span> </button>
      <div class="nav-no-collapse header-nav">
       
	   <?php
	if(!empty($loguser))
	{
	?>
		<ul class="nav pull-right"><li><?= $this->Html->link($loguser['email'], ['controller' => 'Users', 'action' => 'myaccount']) ?></li>
		<li><?= $this->Html->link(__('Logout <i class="logout"></i>'), ['controller' => 'Users', 'action' => 'logout'],array('escape'=>false)) ?></li></ul>
	<?php
	}
	?>
      </div>
    </div>
  </div>
</div>

<!-- container -->
<div class="container-fluid-full">
  <div class="row-fluid" id="container">
    <div id="maincontainer">
      <?= $this->Flash->render() ?>
      <div id="content">
	   <?php
	if(!empty($loguser))
	{
	?>
	    <?php echo $this->element('sidebar'); ?>
		<div class="large-9 medium-8 columns content">	
   <?php }else{?>
  	<div class="large-12 medium-8 columns content">	
   <?php
   }
   ?>
   		<div class="row-fluid show-grid errorpage">	
        <?= $this->fetch('content') ?><br><br>
		<div style="text-align:center;"><span style="font-size:18px;"><strong>Please Go back to Refresh</strong></span><br><br>
		<div><?php
	if(!empty($loguser))
	{?><a href="<?php echo $this->request->webroot?>users/myaccount" class="btn btn-large btn-primary"><strong>BACK TO DASHBOARD</strong></a>
	 <?php
   }
   ?>
	</div>
		</div>
		</div>
      </div>
	  </div>
    </div>
  </div>
</div>
<div style="clear:both;"></div>
<script src="<?php echo $this->request->webroot?>js/common.js"></script>
<script>
	
	function removeUserSearchCookie() {
		$.cookie.raw = true;
		$.removeCookie('CakeCookie[srcPassArg]', {
			path : '/'
		});
	}
</script>
</body>
</html>