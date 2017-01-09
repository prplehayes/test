<div class="claim large-9 medium-8 columns content custom_design">

    <div class="top-header claimhead">
						<h2><i class="icon-files-o"></i><?php echo __('All Pending Claims Review'); ?></h2></div>
<div class="row-fluid show-grid">
		<div class="span12">
		<?php echo $this->Form->create('Claim', array('action' => '','class'=>' frmfilterpn form-horizontal')); ?>
      <div class="span6 nomarginleft">
        <div><strong>Date of Service</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left;width:65px;">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_from',array('label'=>false,'class'=>'datepicker')); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_to',array('label'=>false,'class'=>'datepicker')); ?> </div>
        </div>
	  <div class="span nomarginleft">
        <div style="float:left;margin-right:18px;width:61px;">DOB:</div>
        <div style="float:left"> <?php echo $this->Form->input('dob',array('label'=>false,'class'=>'datepicker')); ?> </div>
	  </div>
	  <div class="clear"></div>
	   <div class="span nomarginleft" style="margin-top:10px;">
		<div style="float:left;margin-right:15px;width:63px;">Ref #:</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false)); ?> </div>
      </div>
	  <div class="clear"></div>
	  <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;">&nbsp;Reviewer :</div>
        <div style="float:left"> <?php echo $this->Form->input('reviewer_ids',array('options'=>$reviewers,'value'=>$reviewersel,'label'=>false,'empty'=>"Select",'class'=>'input-large')); ?> </div>
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
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary searchfilterpn','type'=>'button']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/allclaimreview"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> 
	  </div>
		<div style="text-align:right"><a href="#" data-toggle="modal" data-target="#myModal3" class="btn btn-blue batchedit">Assign</a></div>
		<div class="clear">&nbsp;</div>
		<div id="allpendingreview"></div>
</div>

<div class="clear"></div>
<div class="top-header claimhead">
						<h2><i class="icon-files-o"></i><?php echo __('All Correction Needed Claims Review'); ?></h2></div>
<div class="row-fluid show-grid">
		<div class="span12">
		<?php echo $this->Form->create('Claim', array('action' => '','class'=>' frmfiltercr form-horizontal')); ?>
      <div class="span6 nomarginleft">
        <div><strong>Date of Service</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left;width:65px;">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_from',array('label'=>false,'class'=>'datepicker')); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_to',array('label'=>false,'class'=>'datepicker')); ?> </div>
        </div>
	  <div class="span nomarginleft">
        <div style="float:left;margin-right:18px;width:61px;">DOB:</div>
        <div style="float:left"> <?php echo $this->Form->input('dob',array('label'=>false,'class'=>'datepicker')); ?> </div>
	  </div>
	  <div class="clear"></div>
	   <div class="span nomarginleft" style="margin-top:10px;">
		<div style="float:left;margin-right:15px;width:63px;">Ref #:</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false)); ?> </div>
      </div>
	  <div class="clear"></div>
	  <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;">&nbsp;Reviewer :</div>
        <div style="float:left"> <?php echo $this->Form->input('reviewer_ids',array('options'=>$reviewers,'value'=>$reviewersel,'label'=>false,'empty'=>"Select",'class'=>'input-large')); ?> </div>
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
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary searchfiltercr','type'=>'button']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/allclaimreview"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> 
	  </div>
		<div style="text-align:right"><a href="#" data-toggle="modal" data-target="#myModal4" class="btn btn-blue batchedit">Assign</a></div>
		<div class="clear">&nbsp;</div>
		<div id="allcorrectionreview"></div>
</div>

<div class="clear"></div>
<div class="top-header claimhead">
						<h2><i class="icon-files-o"></i><?php echo __('All Approved Claims Review'); ?></h2></div>
<div class="row-fluid show-grid">
		<div class="span12">
		<?php echo $this->Form->create('Claim', array('action' => '','class'=>' frmfilterap form-horizontal')); ?>
      <div class="span6 nomarginleft">
        <div><strong>Date of Service</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left;width:65px;">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_from',array('label'=>false,'class'=>'datepicker')); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_to',array('label'=>false,'class'=>'datepicker')); ?> </div>
        </div>
	  <div class="span nomarginleft">
        <div style="float:left;margin-right:18px;width:61px;">DOB:</div>
        <div style="float:left"> <?php echo $this->Form->input('dob',array('label'=>false,'class'=>'datepicker')); ?> </div>
	  </div>
	  <div class="clear"></div>
	   <div class="span nomarginleft" style="margin-top:10px;">
		<div style="float:left;margin-right:15px;width:63px;">Ref #:</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false)); ?> </div>
      </div>
	  <div class="clear"></div>
	  <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;">&nbsp;Reviewer :</div>
        <div style="float:left"> <?php echo $this->Form->input('reviewer_ids',array('options'=>$reviewers,'value'=>$reviewersel,'label'=>false,'empty'=>"Select",'class'=>'input-large')); ?> </div>
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
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary searchfilterap','type'=>'button']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/allclaimreview"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> 
	  </div>
		<div style="text-align:right"><a href="#" data-toggle="modal" data-target="#myModal5" class="btn btn-blue batchedit">Assign</a></div>
		<div class="clear">&nbsp;</div>
		<div id="allapprovedclaim"></div>
</div>
<div class="clear"></div>
<div class="top-header claimhead">
						<h2><i class="icon-files-o"></i><?php echo __('All Appealed Claims Review'); ?></h2></div>

		<div id="allappealclaim"></div>
		
</div>
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:450px;min-height:300px;">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <div class="modal-body">
        <div id="myform">
          <div id="example" role="application">
            <div class="demo-section">
              <?= $this->Form->create($claim,array('method' => 'post','class'=>'form-horizontal')) ?>
              <div >
                
                <div class="span12 nomarginleft">
                  <div class="span12 nomarginleft"> <br> <br> <br>
                    <div class="control-group">
                      
                      <div align="center"><?php echo $this->Form->input('previewer_id',array('options'=>$reviewers,'empty'=>'Select Reviewer','label'=>false,'class'=>'select')); ?> </div>
                    </div>
                   
                  <div>
                    <div align="center">
                      <?= $this->Form->button(__('Submit'),['class'=>'btn-primary submitfrm2','type'=>"button"]) ?>
                    </div>
                    <div id="resdiv"></div>
                  </div>
                </div>
                <?= $this->Form->end() ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:450px;min-height:300px;">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <div class="modal-body">
        <div id="myform">
          <div id="example" role="application">
            <div class="demo-section">
              <?= $this->Form->create($claim,array('method' => 'post','class'=>'form-horizontal')) ?>
              <div >
                
                <div class="span12 nomarginleft">
                  <div class="span12 nomarginleft"> <br> <br> <br>
                    <div class="control-group">
                      
                      <div align="center"><?php echo $this->Form->input('creviewer_id',array('options'=>$reviewers,'empty'=>'Select Reviewer','label'=>false,'class'=>'select')); ?> </div>
                    </div>
                   
                  <div>
                    <div align="center">
                      <?= $this->Form->button(__('Submit'),['class'=>'btn-primary submitfrm4','type'=>"button"]) ?>
                    </div>
                    <div id="resdiv"></div>
                  </div>
                </div>
                <?= $this->Form->end() ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:450px;min-height:300px;">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <div class="modal-body">
        <div id="myform">
          <div id="example" role="application">
            <div class="demo-section">
              <?= $this->Form->create($claim,array('method' => 'post','class'=>'form-horizontal')) ?>
              <div >
                
                <div class="span12 nomarginleft">
                  <div class="span12 nomarginleft"> <br> <br> <br>
                    <div class="control-group">
                      
                      <div align="center"><?php echo $this->Form->input('areviewer_id',array('options'=>$reviewers,'empty'=>'Select Reviewer','label'=>false,'class'=>'select')); ?> </div>
                    </div>
                   
                  <div>
                    <div align="center">
                      <?= $this->Form->button(__('Submit'),['class'=>'btn-primary submitfrm5','type'=>"button"]) ?>
                    </div>
                    <div id="resdiv"></div>
                  </div>
                </div>
                <?= $this->Form->end() ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<script>
$(document).ready(function() {

jQuery('#allpendingreview').load("<?php echo $this->request->webroot?>claim/ajax_allpendingreview");
jQuery('#allcorrectionreview').load("<?php echo $this->request->webroot?>claim/ajax_allcorrectionreview");
jQuery('#allapprovedclaim').load("<?php echo $this->request->webroot?>claim/ajax_allapprovedclaim");
jQuery('#allappealclaim').load("<?php echo $this->request->webroot?>claim/ajax_allappealclaimlist");
$(document).ready(function() {	
	$(".searchfilterap").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_allapprovedclaim",type: "POST",data:$(".frmfilterap").serialize(), success: function(result){
	$("#allapprovedclaim").html(result);         
        }});
	});	
	$(".searchfilterpn").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_allpendingreview",type: "POST",data:$(".frmfilterpn").serialize(), success: function(result){
	$("#allpendingreview").html(result);         
        }});
	});	
	$(".searchfiltercr").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_allcorrectionreview",type: "POST",data:$(".frmfiltercr").serialize(), success: function(result){
	$("#allcorrectionreview").html(result);         
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
$(".frmfilterpn #practice").change(function(){
		$(".frmfilterpn #dentist").load("<?php echo $this->request->webroot?>claim/ajax_getdentist/"+$(this).val());
	});	
$("#chkalla").change(function () {
    $(".chka").prop('checked', $(this).prop("checked"));
});
$("#chkallp").change(function () {
    $(".chkp").prop('checked', $(this).prop("checked"));
});
$("#chkallc").change(function () {
    $(".chkc").prop('checked', $(this).prop("checked"));
});
$(".submitfrm2").click(function(){
var claimlist='';
	$(".chkp").each(function(){
		if($(this).attr("checked")=='checked'){
			if(claimlist==''){
				claimlist=$(this).val();
				
			}
			else{claimlist+=","+$(this).val();}
			
		}
	});
	if(claimlist==''){
	alert("Please select at least one claim record.");
	return false;
	}
	if($("#previewer-id").val()==''){
		alert("Please select at Reviewer from list.");
	return false;
	}

	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_assignreviewer",type: "POST",data:{reviewer_id:$("#previewer-id").val(),claim_id:claimlist}, success: function(result){
	$(".frmfilterpn #resdiv").html(result);
			setTimeout("window.location='<?php echo $this->request->webroot?>claim/allclaimreview'",2000);          
        }});
});
$(".submitfrm4").click(function(){
var claimlist='';
	$(".chkc").each(function(){
		if($(this).attr("checked")=='checked'){
			if(claimlist==''){
				claimlist=$(this).val();
				
			}
			else{claimlist+=","+$(this).val();}
			
		}
	});
	if(claimlist==''){
	alert("Please select at least one claim record.");
	return false;
	}
	if($("#creviewer-id").val()==''){
		alert("Please select at Reviewer from list.");
	return false;
	}
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_assignreviewer",type: "POST",data:{reviewer_id:$(".frmfiltercr #creviewer-id").val(),claim_id:claimlist}, success: function(result){
	$(".frmfiltercr #resdiv").html(result);
	setTimeout("window.location='<?php echo $this->request->webroot?>claim/allclaimreview'",2000);          
        }});
});
$(".submitfrm5").click(function(){
var claimlist='';
	$(".chka").each(function(){
		if($(this).attr("checked")=='checked'){
			if(claimlist==''){
				claimlist=$(this).val();
				
			}
			else{claimlist+=","+$(this).val();}
			
		}
	});
	if(claimlist==''){
	alert("Please select at least one claim record.");
	return false;
	}
	if($("#areviewer-id").val()==''){
		alert("Please select at Reviewer from list.");
	return false;
	}
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_assignreviewer",type: "POST",data:{reviewer_id:$(".frmfilterap #areviewer-id").val(),claim_id:claimlist}, success: function(result){
	$(".frmfilterap #resdiv").html(result);
	setTimeout("window.location='<?php echo $this->request->webroot?>claim/allclaimreview'",2000);          
        }});
});
});
</script>
<script type="text/javascript">
$(document).ready(function($){
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
			
});
</script>