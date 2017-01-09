<div class="claim view large-9 medium-8 columns content custom_design">
<?= $this->Form->create($claim,array('method' => 'post','class'=>'form-horizontal')) ?>
<div class="row-fluid show-grid">
    <h3><?= h($claim->claim_number) ?>- Pay Claim</h3>
	<div class="span12">
		
		<div class="span8 nomarginleft">
		
	<br>
		
        <div class="control-group">
			<div style="float:left;width:150px;"><?= __('Check Number') ?></div> <div class="span4"><?php echo $this->Form->input('check_number',array('label'=>false,'class'=>'input')); ?>
			</div>
		</div>
       
        <div class="control-group">
			<div style="float:left;width:150px;"><?= __('Payment Date') ?></div> <div class="span4"><?php echo $this->Form->input('pay_date',array('label'=>false,'class'=>'datepicker')); ?>
			</div>
		</div>
		<div class="control-group">
			<div style="float:left;width:150px;"><?= __('Claim Status') ?></div> <div class="span4"><?php
			echo $this->Form->input('claim_status_id',array('options' => $claimStatus,'label'=>false,'class'=>'input-large'));
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