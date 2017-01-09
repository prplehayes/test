<div class="practice form large-9 medium-8 columns content custom_design">
<div class="top-header commonhead">
						<h2><i class="icon-files-o"></i><?= __('Review Contract') ?></h2></div>
<div class="row-fluid show-grid">
    <?= $this->Form->create($practice,array('type' => 'file','class'=>'form-horizontal')) ?>
    
        <label class="control-label"><?= __('Upload Document') ?></label><?php echo $this->Form->file('docusign_url', ['label'=>false,'div'=>false]);?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?><br><br>
    <?= $this->Form->end() ?>
</div>
</div>
