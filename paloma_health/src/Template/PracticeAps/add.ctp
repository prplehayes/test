<div class="practice form large-9 medium-8 columns content">
    <?= $this->Form->create($practice) ?>
    <fieldset>
        <legend><?= __('Add Practice') ?></legend>
        <?php
            echo $this->Form->input('Identifier');
            echo $this->Form->input('contact_name');
            echo $this->Form->input('contact_phone');
            echo $this->Form->input('contact_email');
            echo $this->Form->input('website');
            echo $this->Form->input('practitioner_count');
            echo $this->Form->input('mpi_number');
            echo $this->Form->input('practice_status_id', ['options' => $practiceStatus]);
            echo $this->Form->input('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
