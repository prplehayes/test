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
	 else{?>
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
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary searchfilterpn','type'=>'submit']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/claimviewcues"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> 
	  </div>
	  <div class="clear">&nbsp;</div>
<table class="table table-striped table-bordered">
        <thead>
           <tr>
               
                <th ><?= $this->Paginator->sort('patient.first_name',"Patient Name") ?></th>
				<th >Dr. Office Name</th>
				<th ><?= $this->Paginator->sort('user_id',"Doctor") ?></th>
                <th ><?= $this->Paginator->sort('created',"Submitted Date") ?></th>
				<th ><?= $this->Paginator->sort('date_of_service',"Date of Service") ?></th>
				<th ><?= $this->Paginator->sort('claim_number',"Ref Number") ?></th>
                 <th ><?= $this->Paginator->sort('claim_status_id',"Status") ?></th>
				 <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($claim as $claim):
			 ?>
            <tr>
             
                <td><?= h($claim['patient']->first_name." ".$claim['patient']->last_name) ?></td>
               <td><?php echo $practice[$claim['patient']->practice_id]?></td>
			   <td><?php if($claim->user_id>1){echo $userslist[$claim->user_id];}?></td>
                <td><?php echo str_replace("-","/",$claim->created);?></td>
				<td><?php echo date("m/d/Y",strtotime($claim->date_of_service));?></td>
				<td><?php echo $claim->claim_number;?></td>
                <td><?php echo $claim->claim_status->name?></td>
				   <td class="actions">
                  <?= $this->Html->link(__('Review'), ['action' => 'claimreview', $claim->id]) ?> <?php if($currentuserlog['group_id']==2){?>| <?= $this->Html->link(__('View'), ['action' => 'view', $claim->id]) ?><?php }?>
				 </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <p>
				<?php
				echo $this->Paginator->counter(array(
	'format' => __('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}')
	));
	?>
			</p>

			<div class="pagination">
				<ul>
					<?php
					echo $this->Paginator->prev('&larr; ' . __('previous'),array('tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag'=>'li'));
					echo $this->Paginator->next(__('next') . ' &rarr;', array('tag' => 'li','escape' => false));
					?>
				</ul>
			</div>
</div>
	 <?php }
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