<div class="users form large-12 medium-12 columns content">
<div class="large-5 medium-5 columns" style="background:#fff;margin:5% auto;float:none;padding:20px;">
   <?= $this->Form->create('User', ['action' => 'forgot']) ?>
    <div class="headerbg"><?= __('Forgot Password') ?></div><br><br>
    <?= $this->Form->input('email') ?>
    <?= $this->Form->submit(__('Submit'),array('class'=>'btn-primary btn')) ?>
	<div style="text-align:center;">
	<a href="<?php echo $this->request->webroot?>users/login">Back to Login Now</a></div>
<?= $this->Form->end() ?>
</div>
</div>
