<div class="practice form large-9 medium-8 columns content custom_design">
<div class="top-header commonhead">
						<h2><i class="icon-money"></i><?= __('Payment Information') ?></h2></div>
<div class="row-fluid show-grid">
    <?= $this->Form->create($practice,array('id' => 'payment-form','class'=>'form-horizontal'));
	
	$paymentinfo=$practice->practice_payment_info[0];
	 ?>
   <div class="span6 nomarginleft">
		   <strong>Billing Address</strong><br><br>
		   <?php 
		   echo $this->Form->input('first_name',['required'=>'required','value'=>$paymentinfo->first_name]);
            echo $this->Form->input('last_name',['required'=>'required','value'=>$paymentinfo->last_name]);
		   echo $this->Form->input('address_1', ['value'=>$paymentinfo->address_1,'label'=>'Street Address','div'=>false,'type'=>'text','Placeholder'=>'Street Address','required'=>'required']);?>
			<?php echo $this->Form->input('address_2', ['label'=>'Apt/Suite','value'=>$paymentinfo->address_2,'div'=>false,'type'=>'text','Placeholder'=>'Apt/Suite','required'=>'required']);?>
			<?php echo $this->Form->input('city', ['label'=>'City','value'=>$paymentinfo->city,'div'=>false,'type'=>'text','Placeholder'=>'City','required'=>'required']);?>
			<?php echo $this->Form->input('state', ['label'=>'State','value'=>$paymentinfo->state,'div'=>false,'type'=>'text','Placeholder'=>'State','required'=>'required']);?>
			<?php echo $this->Form->input('zip', ['label'=>'Zip Code','value'=>$paymentinfo->zip,'div'=>false,'type'=>'text','Placeholder'=>'Zip Code','required'=>'required']);?>    </fieldset>
			</div>
		<div class="span6"><br><br>
		<?php
            
            echo $this->Form->input('token',['label'=>'Card Number','required'=>'required','value'=>$paymentinfo->token]);
			?><div class="input text">
			<label for="exp-name">Expiry Date</label><input type="text" id="expiration-month" name="expiration_month" style="width:30px;" required="required" value="<?php echo $paymentinfo->expiration_month?>"> / <input type="text" id="expiration-year" name="expiration_year" style="width:30px;" required="required" value="<?php echo $paymentinfo->expiration_year?>">
			</div>
			<?php
           
            echo $this->Form->input('cvv',['label'=>'CVV Code','type'=>"password",'value'=>$paymentinfo->cvv]);
           ?>
		  </div>	
			<div class="clear"></div>
			
			<div class="clear"><br></div>
   <div style="float:left"><?= $this->Form->button(__('Save'),['class'=>'submit-button btn-primary']) ?></div>
    <?= $this->Form->end() ?>
<br><br>	</div>
</div>
