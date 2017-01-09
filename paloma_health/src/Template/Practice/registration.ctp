<div class="practice form large-8 medium-8 columns content">
    <fieldset>
        <legend><?= __('Registration') ?></legend>



    <div class="practice form large-4 medium-4 columns content">
        <fieldset>
            <legend><?= __('Practice Information') ?></legend>
            <?php
                echo $this->Form->input('Identifier',['label' => 'Practice Name']);
                echo $this->Form->input('contact_name');
                echo $this->Form->input('contact_phone');
                echo $this->Form->input('contact_email');
                echo $this->Form->input('website');
                //echo $this->Form->input('practitioner_count');

        echo $this->Form->select(
            'practitioner_count',
            [1, 2, 3, 5, 10, 15,  20, 25, 30, 35, 40, 45, 50, 100, 500, 1000],
            ['empty' => '(choose one)'],
            ['label' => 'Practitioner Count']
        );

                    echo $this->Form->input('mpi_number');

                ?>
            </fieldset>

        </div>


    <div class="users form large-4 medium-4 columns content">
        <fieldset>
            <legend><?= __('User Account Setup') ?></legend>
            <?php
                //echo $this->Form->input('practice_id', ['options' => $practice, 'empty' => true]);
               // echo $this->Form->input('username');
                echo $this->Form->input('email');
                echo $this->Form->input('password');
                //echo $this->Form->input('group_id', ['options' => $groups]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>



        </fieldset>

    </div>
