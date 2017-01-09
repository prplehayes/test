<div class="claim form large-9 medium-8 columns content">
    <?= $this->Form->create($patient,array('type' => 'file','class'=>'form-horizontal')) ?>
	<div class="row-fluid show-grid borderbottom">
    <fieldset>
        <legend><?= __('Upload Medical Verification and Progress Notes') ?></legend>
        <div class="clear" style="margin:50px;"></div>
		<?php
			?><div class="input text required">
			<label for="dental_verification_upload">Medical Verification Upload</label><?php echo $this->Form->file('dental_verification_upload',['label' => 'Medical Verification Upload','required'=>true,'id'=>'dental_verification_upload']);?>
			<?php echo $this->Form->hidden('h_dental_verification_upload',['value' =>$claim->dental_verification_upload,'id'=>'h_dental_verification_upload']);?>
			<?php if($claim->dental_verification_upload!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->dental_verification_upload;?>', 'Medical Verification Upload',450,450);" href="javascript:void(0);"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">&nbsp;<?php echo $claim->dental_verification_upload;?>
		</a>
        <?php }?>
			</div>
			<div class="clear"><br></div>
			<div class="input text required">
			<label for="progress_notes_upload">Progress Notes Upload</label><?php echo $this->Form->file('progress_notes_upload',['label' => 'Progress Notes Upload','required'=>true,'id'=>'progress_notes_upload']);?>
			<?php echo $this->Form->hidden('h_progress_notes_upload',['value' =>$claim->progress_notes_upload,'id'=>'h_progress_notes_upload']);?>
			<?php if($claim->progress_notes_upload!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->progress_notes_upload;?>', 'Progress Notes Upload',450,450);" href="javascript:void(0);"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">&nbsp;<?php echo $claim->progress_notes_upload;?>
		</a>
        <?php }?>
			</div>
			
    
	<div class="clear"></div>
    <div style="float:left"><?= $this->Form->button(__('Next'),['class'=>'btn-primary']) ?></div>
	<div class="clear">&nbsp;</div>
	</fieldset>
	</div>
    <?= $this->Form->end() ?>
	
	<br><br>
</div>
<script>
$(document).ready(function(){
var dval= $("#h_dental_verification_upload").val();
var pval= $("#h_progress_notes_upload").val();
if(dval!=''){
	$("#dental_verification_upload").attr("required",false);
}
else{
	$("#dental_verification_upload").attr("required",true);
}
if(pval!=''){
	$("#progress_notes_upload").attr("required",false);
}
else{
	$("#progress_notes_upload").attr("required",true);
}

});
</script>