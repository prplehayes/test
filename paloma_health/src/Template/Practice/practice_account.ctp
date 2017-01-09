<div class="practice form large-9 medium-8 columns content custom_design">
<div class="top-header commonhead">
						<h2><i class="icon-files-o"></i><?= __('Practice Account') ?></h2></div>
<div class="row-fluid show-grid">
    <?= $this->Form->create($practice) ?>
	
    
        <?php
           echo $this->Form->input('first_name',['required'=>'required']);
			echo $this->Form->input('last_name',['required'=>'required']);
            echo $this->Form->input('password',['required'=>'required']);
            echo $this->Form->input('r_password',['label'=>"Retype Password",'type'=>'password','required'=>'required']);
            echo $this->Form->input('email',['label'=>"Email Address",'required'=>'required']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Next')) ?><br><br>
    <?= $this->Form->end() ?>
</div></div>
