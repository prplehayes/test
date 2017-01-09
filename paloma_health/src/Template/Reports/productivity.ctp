<div class="claim large-9 medium-8 columns content custom_design">
<div class="top-header claimhead">
	<h2><i class="icon-files-o"></i><?php echo __('Productivity Report'); ?></h2>
</div>
<div class="row-fluid show-grid">
	<div class="span12">
		<?php echo $this->Form->create('reports', array('action' => '','class'=>' form-signin form-horizontal')); ?>
		<div class="span10 nomarginleft">
     <div class="nomarginleft span6" style="margin-top:10px;">
		<div><strong>Date of Service</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_froms',array('label'=>false,'class'=>'datepicker')); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_tos',array('label'=>false,'class'=>'datepicker')); ?> </div>
        </div>
	</div>
      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Run Report'),['class'=>'btn-primary','name'=>'search','value'=>"Run Report"]) ?>
      </div>
	  
      </div>
<?php echo $this->Form->end(); ?> 	  
	</div>
</div>
</div>
<script>
function cancelSearch(){
	removeUserSearchCookie();
	window.location = '<?php echo $this->request->webroot?>reports/production';
}
$(document).ready(function() {	
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
	
});

</script>