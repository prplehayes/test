<div class="users form large-12 medium-12 columns content">
<div class="large-5 medium-5 columns" style="background:#fff;margin:5% auto;float:none;padding:20px;">
   <?= $this->Form->create('User', ['action' => 'login']) ?>
    <div class="headerbg"><?= __('Login') ?></div><br><br>
    <?= $this->Form->input('email') ?>
    <?= $this->Form->input('password') ?>
    <?= $this->Form->submit(__('Login'),array('class'=>'btn-primary btn')) ?>
	<div style="text-align:center;"><a href="<?php echo $this->request->webroot?>users/forgot">Forgot Password?</a><br>
	<a href="<?php echo $this->request->webroot?>practice/signup">Don't have an accout ? Sign up Now!</a></div>
<?= $this->Form->end() ?>
</div>
</div>
