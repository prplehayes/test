<div class="patient form large-9 medium-8 columns content custom_design">
  <div class="top-header commonhead">
						<h2><i class="icon-folder-open-o"></i><?php echo __('Pending Payment'); ?></h2></div>
  <div class="row-fluid show-grid">
    <div class="span12" > <?php echo $this->Form->create('Claim', array('action' => 'batchpay','class'=>' form-signin form-horizontal')); ?>
      <div class="span6 nomarginleft">
        <div><strong>PP Date</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_from',array('label'=>false,'class'=>'datepicker')); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_to',array('label'=>false,'class'=>'datepicker')); ?> </div>
        </div>

	  
      </div>
      <div class="span6">
        
      <div class="span nomarginleft">
        <div style="float:left;margin-right:10px;width:130px;">Practice :</div>
        <div style="float:left"> <?php echo $this->Form->input('practice',array('options' => $practice,'empty'=>"All",'label'=>false,'class'=>'input-large')); ?> </div>
      </div>
      <div class="clear"></div>
      <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;margin-top:5px;">Ref Number :</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      <div class="clear"></div>
      <div class="nomarginleft" style="margin-top:5px;">
        <div style="float:left;margin-right:10px;width:130px;">Patient Last Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
	  <div class="clear"></div>
	  <div class="nomarginleft" style="margin-top:5px;">
        <div style="float:left;margin-right:10px;width:130px;">&nbsp;Doctor :</div>
        <div style="float:left"> <?php echo $this->Form->input('dentist',array('options'=>$dentistlist,'value'=>$dentistsel,'label'=>false,'empty'=>"Select",'class'=>'input-large')); ?> </div>
      </div>

      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/batchpay"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>
 
  <div class="row-fluid show-grid">
    <div class="span12">
	 <div style="text-align:right"><a href="<?php echo $this->request->webroot?>claim/exportclaim"  class="btn btn-blue btnexport">Export</a>&nbsp;<a href="#" data-toggle="modal" data-target="#myModal3" class="btn btn-blue batchedit">Batch Edit</a></div>
  <div class="clear">&nbsp;</div>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th width="80px"><input type="checkbox" name="chkall" id="chkall" value="1">
              &nbsp;All</th>
            <th class="sort"><?= $this->Paginator->sort('patient.first_name',"Patient Name") ?></th>
            <th >Dr. Office Name</th>
			<th class="sort">Doctor</th>
			<th class="sort"><?= $this->Paginator->sort('created',"Submitted Date") ?></th>
            <th class="sort"><?= $this->Paginator->sort('date_of_service',"Date of Service") ?></th>
            <th class="sort"><?= $this->Paginator->sort('claim_number',"Ref Number") ?></th>
			<th>Amount</th>
			<th>PP Date</th>
            <th class="sort"><?= $this->Paginator->sort('claim_status_id',"Status") ?></th>
            <th class="actions"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $amt=0;
			foreach ($claim as $claim):
			if($payment[$claim->id]==''){$payment[$claim->id]=0;}
			$amt=$amt+$payment[$claim->id];
			 ?>
          <tr>
            <td>
			<input type="checkbox" name="clid[]" class="chk" value="<?php echo $claim->id?>">
			<input type="hidden" name="amt[]" id="amt_<?php echo $claim->id;?>" class="amt" value="<?php echo $payment[$claim->id]?>">
			</td>
            <td><?= h($claim['patient']->first_name." ".$claim['patient']->last_name) ?></td>
			<td><?php echo $practice[$claim['patient']->practice_id]?></td>
            <td><?php if($claim->user_id>1){echo $userslist[$claim->user_id];}?></td>
			<td><?php echo str_replace("-","/",$claim->created);?></td>
            <td><?php echo date("m/d/Y",strtotime($claim->date_of_service));?></td>
            <td><?php echo $claim->claim_number;?></td>
			<td>$<?php if($payment[$claim->id]==''){$payment[$claim->id]=0;}
			   echo $payment[$claim->id]?></td>
			   <td><?php echo str_replace("-","/",$ppdate[$claim->id]);?></td>
            <td><?php echo $claim->claim_status->name?></td>
			
            <td class="actions"><?php echo $this->Html->link(__('Pay'), ['action' => 'payclaim', $claim->id]) ?> | <?php echo $this->Html->link(__('View'), ['action' => 'view', $claim->id]) ?> </td>
          </tr>
          <?php endforeach; ?>
		  <tr><td colspan="7" style="text-align:right;"> Total</td><td>$<?php echo $amt?></td><td colspan="3"></td></tr>
        </tbody>
      </table>
      <div class="paginator">
        <ul class="pagination">
          <?= $this->Paginator->prev('< ' . __('previous')) ?>
          <?= $this->Paginator->numbers() ?>
          <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p>
          <?= $this->Paginator->counter() ?>
        </p>
      </div>
    </div>
	  
  </div>
<div class="clear"></div>

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
                <h3>
                  <?= h($claim->claim_number) ?>
                  - Pay Claim</h3>
                <div class="span12 nomarginleft">
                  <div class="span12 nomarginleft"> <br>
                    <div class="control-group">
                      <div style="float:left;width:150px;">
                        <?= __('Check Number') ?>
                      </div>
                      <div class="span4"><?php echo $this->Form->input('check_number',array('label'=>false,'class'=>'input')); ?> </div>
                    </div>
                    <div class="control-group">
                      <div style="float:left;width:150px;">
                        <?= __('Payment Date') ?>
                      </div>
                      <div class="span4"><?php echo $this->Form->input('pay_date',array('label'=>false,'class'=>'datepicker')); ?> </div>
                    </div>
                    <div class="control-group">
                      <div style="float:left;width:150px;">
                        <?= __('Claim Status') ?>
                      </div>
                      <div class="span4">
                        <?php
			echo $this->Form->input('claim_status_id',array('options' => $claimStatus,'label'=>false,'class'=>'input-large'));
			?>
                      </div>
                    </div>
					<div class="control-group">
                      <div style="float:left;width:150px;">
                        <?= __('Amount') ?>
                      </div>
                      <div class="span4 dueamt">$0.00</div>
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

$(document).ready(function() {
//jQuery('#allappealclaimpaid').load("<?php echo $this->request->webroot?>claim/ajax_allappealclaimpaidlist");	
$(".submitfrm2").click(function(){
var claimlist='';
var amtdata=0;
	$(".chk").each(function(){
		if($(this).attr("checked")=='checked'){
		var vl=$("#amt_"+$(this).val()).val();
		amtdata=amtdata + parseFloat(vl);
			if(claimlist==''){
				claimlist=$(this).val();
				
			}
			else{claimlist+=","+$(this).val();}
			
		}
		//alert(amtdata);
	});
	$(".dueamt").html("$"+parseFloat(amtdata));
	if(claimlist==''){
	alert("Please select at least one claim record.");
	return false;
	}
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_payclaim",type: "POST",data:{claim_status_id:$("#claim-status-id").val(),check_number:$("#check-number").val(),pay_date:$("#pay-date").val(),claim_id:claimlist}, success: function(result){
	$("#resdiv").html(result);
	setTimeout("window.location='<?php echo $this->request->webroot?>claim/batchpay'",2000);          
        }});
});
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
$("#chkall").change(function () {
    $(".chk").prop('checked', $(this).prop("checked"));
	var amtdata=0;
	$(".chk").each(function(){
		var vl=$("#amt_"+$(this).val()).val();
		amtdata=amtdata + parseFloat(vl);
	});
	$(".dueamt").html("$"+amtdata);
});
$(".chk").change(function () {
    var amtdata=0;
	$(".chk").each(function(){
		if($(this).attr("checked")=='checked'){
		var vl=$("#amt_"+$(this).val()).val();
		amtdata=amtdata + parseFloat(vl);
			
		}
	});
	$(".dueamt").html("$"+amtdata);
});
$("#practice").change(function(){
	$("#dentist").load("<?php echo $this->request->webroot?>claim/ajax_getdentist/"+$(this).val());
});
//$("#practice").change();

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
