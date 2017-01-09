<div class="practice form large-6 medium-8 columns content registerp">
    <?= $this->Form->create($practice) ?>
    <fieldset>
        <legend><?= __('Practice Information') ?></legend><br>
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
    </fieldset>
    <?= $this->Form->button(__('Next')) ?>
    <?= $this->Form->end() ?>
</div>
