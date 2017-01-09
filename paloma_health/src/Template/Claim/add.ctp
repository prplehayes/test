<div class="claim form large-9 medium-8 columns content">
    <?= $this->Form->create($claim,array('type' => 'file','class'=>'form-horizontal')) ?>
    <fieldset>
        <legend><?= __('Add Claim') ?></legend>
        <?php
            echo $this->Form->input('patient_id', ['options' => $patient, 'empty' => true]);
            echo $this->Form->input('claim_number');
            echo $this->Form->input('claim_status_id', ['options' => $claimStatus]);
			?><div class="input text">
			<label for="dental_verification_upload">Dental Verification Upload</label><?php echo $this->Form->file('dental_verification_upload',['label' => 'Dental Verification Upload']);?>
			</div>
			<div class="input text">
			<label for="progress_notes_upload">Progress Notes Upload</label><?php echo $this->Form->file('progress_notes_upload',['label' => 'Progress Notes Upload']);?>
			</div>
			<?php
			
            
           /// echo $this->Form->file('progress_notes_upload',['label' => 'Progress Notes Upload']);
            echo $this->Form->input('title');
            echo $this->Form->input('signature');
            echo $this->Form->input('date_of_service',['type'=>'text','class'=>'datepicker']);
            echo $this->Form->input('comments');
            echo $this->Form->input('cpt_codes._ids', ['options' => $cptCodes]);
            echo $this->Form->input('icd10_codes._ids', ['options' => $icd10Codes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
$(document).ready(function($){
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
			
});
</script>