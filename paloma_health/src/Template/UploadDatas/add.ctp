<div class="uploadDatas form large-9 medium-8 columns content custom_design">
    <?= $this->Form->create($uploadData,array('type' => 'file','class'=>'form-horizontal')) ?>
   <div class="row-fluid show-grid">
	<div class="span12">
    <fieldset>
        <legend><?= __('Add Upload Data') ?></legend>
        <?php
            
			?><br><br>
			<div class="input text required span4">
			<label for="file_name">Upload file</label><?php echo $this->Form->file('file_name',['label' => 'upload file','required'=>true]);?>
			</div>
			<div class="input text required span4">
			<label for="dentist_office_name">Dentist Office Name</label><?php echo $this->Form->input('dentist_office_name',['label'=>false]);?>
			</div>
			
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
</div>
