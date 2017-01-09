<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <div class="row-fluid show-grid">
	<fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('practice_id', ['options' => $practice, 'empty' => true]);
           // echo $this->Form->input('username');
			echo $this->Form->input('email');
			echo $this->Form->input('first_name');
			echo $this->Form->input('last_name');
            echo $this->Form->input('password');
            echo $this->Form->input('group_id', ['options' => $groups]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
	</div>
    <?= $this->Form->end() ?>
</div>
