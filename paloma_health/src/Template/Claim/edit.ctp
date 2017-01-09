<div class="claim form large-9 medium-8 columns content">
    <?= $this->Form->create($claim) ?>
    <fieldset>
        <legend><?= __('Edit Claim') ?></legend>
        <?php
            echo $this->Form->input('patient_id', ['options' => $patient, 'empty' => true]);
            echo $this->Form->input('claim_number');
            echo $this->Form->input('claim_status_id', ['options' => $claimStatus]);
            echo $this->Form->input('dental_verification_upload');
			echo $this->Form->hidden('h_dental_verification_upload', ['value'=>$claim->dental_verification_upload]);
            echo $this->Form->input('progress_notes_upload');
			echo $this->Form->hidden('h_progress_notes_upload', ['value'=>$claim->progress_notes_upload]);
            echo $this->Form->input('title');
            echo $this->Form->input('signature');
            echo $this->Form->input('date_of_service');
            echo $this->Form->input('comments');
            echo $this->Form->input('cpt_codes._ids', ['options' => $cptCodes]);
            echo $this->Form->input('icd10_codes._ids', ['options' => $icd10Codes]);
			
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
