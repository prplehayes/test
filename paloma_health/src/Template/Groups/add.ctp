<div class="groups form large-9 medium-8 columns content custom_design">
    <?= $this->Form->create($group) ?>
   <div class="top-header">
						<h2><?php echo __('Add Group'); ?></h2></div>
	<div class="row-fluid show-grid">
        <?php
            echo $this->Form->input('name');
        ?>
    <?= $this->Form->button(__('Submit')) ?>
	</div>
    <?= $this->Form->end() ?>
</div>
