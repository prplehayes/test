<div class="claim large-9 medium-8 columns content custom_design">
    <div class="top-header claimhead">
						<h2><i class="icon-files-o"></i><?php echo __('All Claims Review'); ?></h2></div>
<div class="row-fluid show-grid">
		<div class="span12">
		<?php echo $this->Form->create('Claim', array('action' => '','class'=>' frmfilter form-horizontal')); ?>
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
	  <div class="clear"></div>
	  <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;">&nbsp;Biller :</div>
        <div style="float:left"> <?php echo $this->Form->input('biller_ids',array('options'=>$billers,'value'=>$billersel,'label'=>false,'empty'=>"Select",'class'=>'input-large')); ?> </div>
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
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary searchfilter','type'=>'submit']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/allclaimbillreview"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
		<div style="text-align:right"><a href="#" data-toggle="modal" data-target="#myModal3" class="btn btn-blue batchedit">Assign</a></div>
		<div class="clear">&nbsp;</div>
<table class="table table-striped table-bordered">
        <thead>
           <tr>
                <th width="80px"><input type="checkbox" name="chkall" id="chkall" value="1">
              &nbsp;All</th>
                <th ><?= $this->Paginator->sort('patient.first_name',"Patient Name") ?></th>
				<th >Dr. Office Name</th>
				<th ><?= $this->Paginator->sort('user_id',"Doctor") ?></th>
				<th>Biller</th>
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
               <td>
			<input type="checkbox" name="clid[]" class="chk" value="<?php echo $claim->id?>" >
			</td>
                <td><?= h($claim['patient']->first_name." ".$claim['patient']->last_name) ?></td>
               <td><?php echo $practice[$claim['patient']->practice_id]?></td>
			   <td><?php if($claim->user_id>1){echo $userslist[$claim->user_id];}?></td>
			   <td><?php 
			   if($claim->review_by>1){echo $billers[$claim->review_by];}
				/*if (!empty($claim->cpt_codes)):
				$im=1;
				foreach ($claim->cpt_codes as $cptCodes):
					if($im==1){echo $cptCodes->code;}else{echo ", ".$cptCodes->code;}
					$im++;
				endforeach;
				endif;
				*/
				 ?></td>
                <td><?php echo str_replace("-","/",$claim->created);?></td>
				<td><?php echo date("m/d/Y",strtotime($claim->date_of_service));?></td>
				<td><?php echo $claim->claim_number;?></td>
                <td><?php echo $claim->claim_status->name?></td>
				   <td class="actions">
                  <?php echo $this->Html->link(__('Review'), ['action' => 'claimbillreview', $claim->id]) ?>
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
<div class="clear"></div>
<div class="top-header claimhead">
						<h2><i class="icon-files-o"></i><?php echo __('All Appealed Claims Review'); ?></h2></div>

		<div id="allappealclaimbill"></div>
		
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
                      
                      <div align="center"><?php echo $this->Form->input('biller_id',array('options'=>$billers,'empty'=>'Select Biller','label'=>false,'class'=>'select')); ?> </div>
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
<script>
$(document).ready(function() {	
jQuery('#allappealclaimbill').load("<?php echo $this->request->webroot?>claim/ajax_allappealclaimbilllist");
$("#chkall").change(function () {
    $(".chk").prop('checked', $(this).prop("checked"));
});
$("#practice").change(function(){
	$("#dentist").load("<?php echo $this->request->webroot?>claim/ajax_getdentist/"+$(this).val());
});
$(".submitfrm2").click(function(){
var claimlist='';
	$(".chk").each(function(){
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
	if($("#biller-id").val()==''){
		alert("Please select at Biller from list.");
	return false;
	}
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_assignbiller",type: "POST",data:{biller_id:$("#biller-id").val(),claim_id:claimlist}, success: function(result){
	$("#resdiv").html(result);
	setTimeout("window.location='<?php echo $this->request->webroot?>claim/allclaimbillreview'",2000);          
        }});
});
	$('.pagination > ul > li').each(function() {
		if ($(this).children('a').length <= 0) {
			var tmp = $(this).html();
			if ($(this).hasClass('prev')) {
				$(this).addClass('disabled');
			} else if ($(this).hasClass('next')) {
				$(this).addClass('disabled');
			} else {
				$(this).addClass('active');
			}
			$(this).html($('<a></a>').append(tmp));
		}
	});
});
</script>
<script type="text/javascript">
$(document).ready(function($){
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
			
});
</script>