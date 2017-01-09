<div class="practice form large-6 medium-8 columns content registerp">
    <?= $this->Form->create($practice) ?>
    <fieldset>
        <legend><?= __('Account Information') ?></legend>
        <?php
			echo $this->Form->input('first_name',['required'=>'required']);
			echo $this->Form->input('last_name',['required'=>'required']);
            echo $this->Form->input('password',['required'=>'required']);
            echo $this->Form->input('r_password',['label'=>"Retype Password",'type'=>'password','required'=>'required']);
            echo $this->Form->input('email',['label'=>"Email Address",'required'=>'required']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Next')) ?>
    <?= $this->Form->end() ?>
</div>
