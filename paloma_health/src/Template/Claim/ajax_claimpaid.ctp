<div class="row-fluid show-grid">
		<div class="span12">
			
			 <table class="table table-striped table-bordered">
        <thead>
            <tr>
               
                <th class="sort"><?= $this->Paginator->sort('patient.first_name',"Patient Name") ?></th>
                <th class="sort"><?= $this->Paginator->sort('user_id',"Doctor") ?></th>
				<th class="sort"><?= $this->Paginator->sort('patient.ssn',"Last 4 SS") ?></th>
                <th class="sort"><?= $this->Paginator->sort('created',"Date of Service") ?></th>
				<th class="sort"><?= $this->Paginator->sort('claim_number',"Ref #") ?></th>
				<th class="sort"><?= $this->Paginator->sort('created',"Date Paid") ?></th>
				<th >Amount Paid</th>
                <th class="sort"><?= $this->Paginator->sort('claim_status_id',"Claim Status") ?></th>
            </tr>
        </thead>
        <tbody>
            <?php 
			$amt=0;
			foreach ($claim as $claim):
			$amt=$amt+$payment[$claim->id];
			 ?>
            <tr>
               
                <td><?= h($claim['patient']->first_name." ".$claim['patient']->last_name) ?></td>
				<td><?php if($claim->user_id>1){echo $userslist[$claim->user_id];}?></td>
                <td><?= h(substr(str_replace("-","",$claim['patient']->ssn), -4)) ?></td>
                <td><?php echo date("m/d/Y",strtotime($claim->date_of_service));?></td>
				 <td><?= h($claim->claim_number) ?></td>
				<td><?php echo str_replace("-","/",$claim->created);?></td>
               <td>$<?php if($payment[$claim->id]==''){$payment[$claim->id]=0;}
			   echo $payment[$claim->id]?></td>
                <td class="actions">
                 <a href="<?php echo $this->request->webroot?>claim/view/<?php echo $claim->id?>" target="_blank"><?php echo str_replace("New","Pending Review",$claim->claim_status->name)?></a> | 
				 <a href="#" data-id="<?php echo $claim->id?>" data-toggle="modal" data-target="#myModal3" onclick="javascript:$('#claim-id').val('<?php echo $claim->id?>');">Appeal</a>
				 <?php
				 if($loguser['group_id']==1){
				 ?> |
				 	<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $claim->id], ['confirm' => __('Are you sure you want to delete # {0}?', $claim->id)]) ?>
				 <?php
				 }
				 ?>
				 </td>
            </tr>
            <?php endforeach; ?>
			<tr><td colspan="6" style="text-align:right;"> Total</td><td>$<?php echo $amt?></td><td></td></tr>
        </tbody>
    </table>
	<p>
				<?php
				echo $this->Paginator->counter(array(
	'format' => __('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}')
	));
	?></p>
    <div class="pagination">
        <ul class="">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        
    </div>
</div>
</div>
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:500px;min-height:300px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="modal-body">
          <div id="myform">
            <div id="example" role="application">
              <div class="demo-section">
                <?= $this->Form->create($claim,array('method' => 'post','class'=>'form-horizontal')) ?>
				<?php echo $this->Form->hidden('claim_id',array("id"=>"claim-id")); ?>
                <div >
                  <div class="span12 nomarginleft">
                    <div class="span12 nomarginleft"> <br>
                      <div class="control-group">
                        <div style="float:left;width:200px;">
                          <?= __('Appeal Amount') ?>
                        </div>
                        <div class="span4"><?php echo $this->Form->input('pay_amount',array('label'=>false,'class'=>'input')); ?> </div>
                      </div>
                      <div class="control-group">
                        <div style="float:left;width:200px;">
                          <?= __('Reason for Appeal') ?>
                        </div>
                        <div class="span4"><?php echo $this->Form->input('reason_notes',array('type'=>'textarea','label'=>false,'class'=>'input')); ?> </div>
                      </div>
                    </div>
                    <div class="clear"><br>
                      <br>
                    </div>
                    <div>
                      <div style="margin-left:100px;">
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

$(document).ready(function(){
$(".submitfrm2").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_claimappeal",type: "POST",data:{claim_id:$("#claim-id").val(),payment_amount:$("#pay-amount").val(),reason_note:$("#reason-notes").val()}, success: function(result){
	$("#resdiv").html(result);
	setTimeout("window.location='<?php echo $this->request->webroot?>claim/reimbursementstatus'",2000);          
        }});
});
$("#claimlist .pagination a").on('click', function(e){

        var href = $(this).attr('href');
		
        $.ajax({url:href,type: "POST",data:$(".frmfilterpaid").serialize(), success: function(result){
			$("#claimlist").html(result);         
        }});
           // $('#claimlist').load($(this).attr('href'));
       
        return false;
    });
$("#claimlist .sort a").on('click', function(){
        
		var href = $(this).attr('href');
		$.ajax({url:href,type: "POST",data:$(".frmfilterpaid").serialize(), success: function(result){
			$("#claimlist").html(result);         
        }});
           // $('#claimlist').load($(this).attr('href'));
       
        return false;
    });	
    });		
</script>