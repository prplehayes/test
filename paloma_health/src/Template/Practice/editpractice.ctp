<div class="practice form large-9 medium-8 columns content custom_design" style="padding:10px 30px;">
    <?= $this->Form->create($practice) ?>
    <fieldset>
        <legend><?= __('Edit Practice') ?></legend><br><br>
        <?php
            echo $this->Form->input('Identifier',['label'=>"Practice Name"]);
            echo $this->Form->input('contact_name');
            echo $this->Form->input('contact_phone');
            echo $this->Form->input('contact_email');
            echo $this->Form->input('website');
            echo $this->Form->input('practitioner_count',['label'=>"Practitioner"]);
            echo $this->Form->input('mpi_number');
            echo $this->Form->hidden('practice_status_id');
           
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
