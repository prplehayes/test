<div class="practice form large-9 medium-8 columns content custom_design">
   <div class="top-header commonhead">
						<h2><i class="icon-files-o"></i><?= __('Add Practice') ?></h2></div>
<div class="row-fluid show-grid">
    <?= $this->Form->create($practice) ?>
    
        <?php
            echo $this->Form->input('Identifier',['label'=>"Practice Name"]);
            echo $this->Form->input('practice_number');
			echo $this->Form->input('contact_name');
            echo $this->Form->input('contact_phone');
            echo $this->Form->input('contact_email');
            echo $this->Form->input('website');
            echo $this->Form->input('practitioner_count');
            echo $this->Form->input('mpi_number');
            //echo $this->Form->input('practice_status_id', ['options' => $practiceStatus]);
        ?>
    <?= $this->Form->button(__('Next')) ?><br><br>
    <?= $this->Form->end() ?>
</div>
</div>
