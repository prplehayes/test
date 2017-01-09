<div class="practice  large-9 medium-8 columns content custom_design">
     <div class="top-header accounthead">
	<h2><i class="icon-briefcase"></i><?php echo __('Accounting'); ?></h2>
	</div>
	
	 <div class="inner-header">
	<h3><?php echo __('Pending Reimbursement Status'); ?></h3>
	</div>
	<div class="row-fluid show-grid">
    <div class="span12" ><?php echo $this->Form->create('Claim', array('action' => '','class'=>' frmfilterpnr form-horizontal')); ?>
      <div class="span6 nomarginleft">
        <div><strong>Date of Service</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_from',array('label'=>false,'class'=>'datepicker')); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_to',array('label'=>false,'class'=>'datepicker')); ?> </div>
        </div>

	  
      </div>
      <div class="span6">
      <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;margin-top:10px;">Ref Number :</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      <div class="clear"></div>
      <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Last Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary btnpnr','type'=>"button"]) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/reimbursementstatus"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>					
	<div id="claimlistpending"></div>
	<div class="inner-header">
	<h3><?php echo __('Paid Claim'); ?></h3>
	</div>
	<div class="row-fluid show-grid">
    <div class="span12" ><?php echo $this->Form->create('Claim', array('action' => '','class'=>' frmfilterpaid form-horizontal')); ?>
      <div class="span6 nomarginleft">
      <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;margin-top:10px;">Ref Number :</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      <div class="clear"></div>
      <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Last Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
	  </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary btnpaid','type'=>'button']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/reimbursementstatus"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>				
	
	<div id="claimlist"></div>
	 <div class="clear">&nbsp;</div>
	<!--<div class="inner-header">
	<h3><?php echo __('Appeals'); ?></h3>
	</div>
	<div id="appealclaimlist"></div>
	<div class="clear"></div>
<div class="top-header claimhead">
						<h2><i class="icon-files-o"></i><?php echo __('Paid Appeals'); ?></h2></div>

		<div id="dentistappealclaimpaidlist"></div>-->
</div>

<script>
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
//jQuery('#dentistappealclaimpaidlist').load("<?php echo $this->request->webroot?>claim/ajax_dentistappealpaidlist");			
jQuery('#claimlistpending').load("<?php echo $this->request->webroot?>claim/ajax_claimpending");
jQuery('#claimlist').load("<?php echo $this->request->webroot?>claim/ajax_claimpaid");
//jQuery('#appealclaimlist').load("<?php echo $this->request->webroot?>claim/ajax_claimappeallist");
$(document).ready(function() {	
	$(".btnpnr").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_claimpending",type: "POST",data:$(".frmfilterpnr").serialize(), success: function(result){
	$("#claimlistpending").html(result);         
        }});
	});	
	$(".btnpaid").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_claimpaid",type: "POST",data:$(".frmfilterpaid").serialize(), success: function(result){
	$("#claimlist").html(result);         
        }});
	});
});
function claimsummary(cid){
		var mId = $.sModal({
            header:'',
			width:780,
            animate:'fadeDown',
            content :$('<div></div>').load("<?php echo $this->request->webroot?>claim/ajax_claimsummary/"+cid),
            buttons:[
                {
                    text:'&nbsp; <?php echo __('Back'); ?> &nbsp;',
                    addClass:'btn-primary',
                    click:function(id){}
                }
            ]
        });
	}
</script>