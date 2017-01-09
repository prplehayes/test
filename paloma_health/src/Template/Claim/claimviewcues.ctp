<div class="practice  large-9 medium-8 columns content custom_design">
<div class="top-header claimhead">
<h2><i class="icon-search"></i><?php echo __('Claim Review'); ?></h2></div>     
	 <?php
	 if($currentuserlog['group_id']== 4 ){
	 ?>
	 <div class="inner-header">
	<h3><?php echo __('Review Approved Claim'); ?></h3>
	</div>
	<div class="row-fluid show-grid">
    <div class="span12" ><?php echo $this->Form->create('Claim', array('action' => '','class'=>' frmfilter form-horizontal')); ?>
      <div class="span6 nomarginleft">
        <div><strong>Date of Service</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_from',array('label'=>false,'class'=>'datepicker')); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_to',array('label'=>false,'class'=>'datepicker')); ?> </div>
        </div>
	  <div class="span nomarginleft">
        <div style="float:left;margin-right:18px;">DOB:</div>
        <div style="float:left"> <?php echo $this->Form->input('dob',array('label'=>false,'class'=>'datepicker')); ?> </div>
	  </div>
	  <div class="clear"></div>
	   <div class="span nomarginleft" style="margin-top:10px;">
		<div style="float:left;margin-right:15px;">Ref #:</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false)); ?> </div>
      </div> 
      </div>
      <div class="span6">
       <div class="clear"></div>
	   <div class="span nomarginleft">
		<div style="float:left;margin-right:20px;">Patient First Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('first_name',array('label'=>false)); ?> </div>
      </div>
	  <div class="clear"></div>
	   <div class="span nomarginleft" style="margin-top:10px;">
		<div style="float:left;margin-right:20px;">Patient Last Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false)); ?> </div>
      </div> 
      <div class="span nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Dr. Office Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('practice',array('options' => $practice,'empty'=>"All",'label'=>false,'class'=>'input-large')); ?> </div>
      </div>
      <div class="clear"></div>
	  <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">&nbsp;Doctor :</div>
        <div style="float:left"> <?php echo $this->Form->input('dentist',array('options'=>$dentistlist,'value'=>$dentistsel,'label'=>false,'empty'=>"Select",'class'=>'input-large')); ?> </div>
      </div>

      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary searchfilter','type'=>'button']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/claimviewcues"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>
	<div id="approvedclaim"></div>
<!--	<div class="inner-header">
	<h3><?php echo __('Paid Claim'); ?></h3>
	</div>-->
	<!--<div id="claimlist"></div>-->
	 	<script>
	jQuery('#approvedclaim').load("<?php echo $this->request->webroot?>claim/ajax_reviewerapproved");
$(document).ready(function() {	
	$(".searchfilter").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_reviewerapproved",type: "POST",data:$(".frmfilter").serialize(), success: function(result){
	$("#approvedclaim").html(result);         
        }});
	});	
	$("#practice").change(function(){
	$("#dentist").load("<?php echo $this->request->webroot?>claim/ajax_getdentist/"+$(this).val());
});
});
	</script>
	 <?php
	 }
	 else{
	 ?>
	 <div class="inner-header">
	<h3><?php echo __('Pending Review'); ?></h3>
	</div>
	<div class="row-fluid show-grid">
    <div class="span12" >
	<?php echo $this->Form->create('Claim', array('action' => '','class'=>' frmfilterpn form-horizontal')); ?>
      <div class="span6 nomarginleft">
        <div><strong>Date of Service</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_from',array('label'=>false,'class'=>'datepicker')); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_to',array('label'=>false,'class'=>'datepicker')); ?> </div>
        </div>
	  <div class="span nomarginleft">
        <div style="float:left;margin-right:18px;">DOB:</div>
        <div style="float:left"> <?php echo $this->Form->input('dob',array('label'=>false,'class'=>'datepicker')); ?> </div>
	  </div>
	  <div class="clear"></div>
	   <div class="span nomarginleft" style="margin-top:10px;">
		<div style="float:left;margin-right:15px;">Ref #:</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false)); ?> </div>
      </div> 
      </div>
      <div class="span6">
       <div class="clear"></div>
	   <div class="span nomarginleft">
		<div style="float:left;margin-right:20px;">Patient First Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('first_name',array('label'=>false)); ?> </div>
      </div>
	  <div class="clear"></div>
	   <div class="span nomarginleft" style="margin-top:10px;">
		<div style="float:left;margin-right:20px;">Patient Last Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false)); ?> </div>
      </div> 
      <div class="span nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Dr. Office Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('practice',array('options' => $practice,'empty'=>"All",'label'=>false,'class'=>'input-large')); ?> </div>
      </div>
      <div class="clear"></div>
	  <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">&nbsp;Doctor :</div>
        <div style="float:left"> <?php echo $this->Form->input('dentist',array('options'=>$dentistlist,'value'=>$dentistsel,'label'=>false,'empty'=>"Select",'class'=>'input-large')); ?> </div>
      </div>

      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary searchfilterpn','type'=>'button']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/claimviewcues"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>
	
	<div id="pendingreview"></div>
	<div class="inner-header">
	<h3><?php echo __('Correction Needed'); ?></h3>
	</div>
	<div class="row-fluid show-grid">
    <div class="span12" ><?php echo $this->Form->create('Claim', array('action' => '','class'=>' frmfiltercr form-horizontal')); ?>
      <div class="span6 nomarginleft">
        <div><strong>Date of Service</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_from',array('label'=>false,'class'=>'datepicker')); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_to',array('label'=>false,'class'=>'datepicker')); ?> </div>
        </div>
	  <div class="span nomarginleft">
        <div style="float:left;margin-right:18px;">DOB:</div>
        <div style="float:left"> <?php echo $this->Form->input('dob',array('label'=>false,'class'=>'datepicker')); ?> </div>
	  </div>
	  <div class="clear"></div>
	   <div class="span nomarginleft" style="margin-top:10px;">
		<div style="float:left;margin-right:15px;">Ref #:</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false)); ?> </div>
      </div> 
      </div>
      <div class="span6">
       <div class="clear"></div>
	   <div class="span nomarginleft">
		<div style="float:left;margin-right:20px;">Patient First Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('first_name',array('label'=>false)); ?> </div>
      </div>
	  <div class="clear"></div>
	   <div class="span nomarginleft" style="margin-top:10px;">
		<div style="float:left;margin-right:20px;">Patient Last Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false)); ?> </div>
      </div> 
      <div class="span nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Dr. Office Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('practice',array('options' => $practice,'empty'=>"All",'label'=>false,'class'=>'input-large')); ?> </div>
      </div>
      <div class="clear"></div>
	  <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">&nbsp;Doctor :</div>
        <div style="float:left"> <?php echo $this->Form->input('dentist',array('options'=>$dentistlist,'value'=>$dentistsel,'label'=>false,'empty'=>"Select",'class'=>'input-large')); ?> </div>
      </div>

      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary searchfiltercr','type'=>'button']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/claimviewcues"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>
	
	<div id="correctionreview"></div>
	
	<div class="inner-header">
	<h3><?php echo __('Reviewer Approved Claims'); ?></h3>
	</div>
	<div class="row-fluid show-grid">
    <div class="span12" ><?php echo $this->Form->create('Claim', array('action' => '','class'=>' frmfilterap form-horizontal')); ?>
     
      <div class="span6 nomarginleft">
        <div><strong>Date of Service</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_from',array('label'=>false,'class'=>'datepicker')); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_to',array('label'=>false,'class'=>'datepicker')); ?> </div>
        </div>
	  <div class="span nomarginleft">
        <div style="float:left;margin-right:18px;">DOB:</div>
        <div style="float:left"> <?php echo $this->Form->input('dob',array('label'=>false,'class'=>'datepicker')); ?> </div>
	  </div>
	  <div class="clear"></div>
	   <div class="span nomarginleft" style="margin-top:10px;">
		<div style="float:left;margin-right:15px;">Ref #:</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false)); ?> </div>
      </div> 
      </div>
      <div class="span6">
       <div class="clear"></div>
	   <div class="span nomarginleft">
		<div style="float:left;margin-right:20px;">Patient First Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('first_name',array('label'=>false)); ?> </div>
      </div>
	  <div class="clear"></div>
	   <div class="span nomarginleft" style="margin-top:10px;">
		<div style="float:left;margin-right:20px;">Patient Last Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false)); ?> </div>
      </div> 
      <div class="span nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Dr. Office Name:</div>
        <div style="float:left"> <?php echo $this->Form->input('practice',array('options' => $practice,'empty'=>"All",'label'=>false,'class'=>'input-large')); ?> </div>
      </div>
      <div class="clear"></div>
	  <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">&nbsp;Doctor :</div>
        <div style="float:left"> <?php echo $this->Form->input('dentist',array('options'=>$dentistlist,'value'=>$dentistsel,'label'=>false,'empty'=>"Select",'class'=>'input-large')); ?> </div>
      </div>

      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary searchfilterap','type'=>'button']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/claimviewcues"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>
	
	<div id="approvedclaim"></div>
	<script>
	jQuery('#pendingreview').load("<?php echo $this->request->webroot?>claim/ajax_pendingreview");
jQuery('#correctionreview').load("<?php echo $this->request->webroot?>claim/ajax_correctionreview");
jQuery('#approvedclaim').load("<?php echo $this->request->webroot?>claim/ajax_approvedclaim");
$(document).ready(function() {	
	$(".searchfilterap").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_approvedclaim",type: "POST",data:$(".frmfilterap").serialize(), success: function(result){
	$("#approvedclaim").html(result);         
        }});
	});	
	$(".searchfilterpn").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_pendingreview",type: "POST",data:$(".frmfilterpn").serialize(), success: function(result){
	$("#pendingreview").html(result);         
        }});
	});	
	$(".searchfiltercr").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_correctionreview",type: "POST",data:$(".frmfiltercr").serialize(), success: function(result){
	$("#correctionreview").html(result);         
        }});
	});	
	$(".frmfilterpn #practice").change(function(){
		$(".frmfilterpn #dentist").load("<?php echo $this->request->webroot?>claim/ajax_getdentist/"+$(this).val());
	});
	$(".frmfiltercr #practice").change(function(){
		$(".frmfiltercr #dentist").load("<?php echo $this->request->webroot?>claim/ajax_getdentist/"+$(this).val());
	});
	$(".frmfilterap #practice").change(function(){
		$(".frmfilterap #dentist").load("<?php echo $this->request->webroot?>claim/ajax_getdentist/"+$(this).val());
	});
});
	</script>
	<?php
	}
	?>
	
</div>

<script>
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
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