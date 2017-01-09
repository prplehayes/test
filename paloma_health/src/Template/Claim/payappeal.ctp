<div class="claim view large-9 medium-8 columns content custom_design">
<?= $this->Form->create($claim,array('method' => 'post','class'=>'form-horizontal')) ?>
<div class="row-fluid show-grid">
    <h3><?= h($claim->claim_number) ?>- Pay Appeal</h3>
	<div class="span12">
		
		<div class="span8 nomarginleft">
		
	<br>
		
        <div class="control-group">
			<div style="float:left;width:200px;"><?= __('Check Number') ?></div> <div class="span4"><?php echo $this->Form->input('check_number',array('label'=>false,'class'=>'input',"required"=>true)); ?>
			</div>
		</div>
       
        <div class="control-group">
			<div style="float:left;width:200px;"><?= __('Payment Date') ?></div> <div class="span4"><?php echo $this->Form->input('pay_date',array('label'=>false,'class'=>'datepicker',"required"=>true)); ?>
			</div>
		</div>
		<div class="control-group">
			<div style="float:left;width:200px;"><?= __('Appeal Status') ?></div> <div class="span4"><?php
			
			$options = [
    'Appeal Paid' => 'Appeal Paid'
];

			echo $this->Form->input('appeal_status',array('options' => $options,'label'=>false,'class'=>'input-large','empty'=>"select","required"=>true));
			
			?>
			</div>
		</div>
        <div class="control-group">
			<div style="float:left;width:200px;"><?= __('Original Payment Amount') ?></div> <div class="span4">$<?php
			echo $payment1->pay_amount;
			?>
			</div>
		</div>
		<div class="control-group">
			<div style="float:left;width:200px;"><?= __('Appeal Amount') ?></div> <div class="span4">$<?php
			echo $appealdata->pay_amount;
			?>
			</div>
		</div>
		<div class="control-group">
		<div style="border-top:1px solid #333;padding-top:5px;width:300px">&nbsp;</div>
			<div style="float:left;width:200px;"><?= __('Amount Owed') ?></div> <div class="span4">$<?php
			echo ($appealdata->pay_amount-$payment1->pay_amount);
			?>
			</div>
		</div>
			
		</div>
		<div class="clear"><br><br></div>
		<div>
		<div style="margin-left:300px;"><?= $this->Form->button(__('Submit'),['class'=>'btn-primary submitfrm']) ?></div>
		</div>
	</div>
<?= $this->Form->end() ?>
</div>
<script type="text/javascript">
$(document).ready(function($){
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
			
});
</script>