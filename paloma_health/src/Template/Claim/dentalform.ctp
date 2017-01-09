<div class="claim form large-9 medium-8 columns content">
    <?= $this->Form->create($claim,array('type' => 'file','class'=>'form-horizontal')) ?>
	<div class="row-fluid show-grid borderbottom">
    <fieldset>
        <legend><?= __('Upload Medical Verification and Progress Notes') ?></legend>
        <div class="clear" style="margin:50px;"></div>
		<?php
			?><div class="input text">
			<label for="dental_verification_upload">Medical Verification Upload</label><?php echo $this->Form->file('dental_verification_upload',['label' => 'Medical Verification Upload','required'=>true]);?>
			</div>
			<div class="clear"><br></div>
			<div class="input text">
			<label for="progress_notes_upload">Progress Notes Upload</label><?php echo $this->Form->file('progress_notes_upload',['label' => 'Progress Notes Upload','required'=>true]);?>
			</div>
			
   
	<div class="clear"></div>
    <div style="float:left"><?= $this->Form->button(__('Next'),['class'=>'btn-primary']) ?></div>
	
    <?= $this->Form->end() ?>
	 </fieldset>
	 </div>
	 <br>
	 <br>
</div>