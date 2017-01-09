<div class="claim large-9 medium-8 columns content custom_design">
<div class="top-header claimhead">
<h2><i class="icon-check-square-o"></i><?php echo __('Paid Claims'); ?></h2></div>	
<div class="row-fluid show-grid">
    <div class="span12" ><?php echo $this->Form->create('Claim', array('action' => 'paidclaims','class'=>' form-signin form-horizontal')); ?>
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
        
      <div class="span nomarginleft">
        <div style="float:left;margin-right:10px;width:130px;">Dr. Office Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('practice',array('options' => $practice,'empty'=>"All",'label'=>false,'class'=>'input-large')); ?> </div>
      </div>
      <div class="clear"></div>
      <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;margin-top:10px;">Ref Number :</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      <div class="clear"></div>
      <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Patient Last Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
	  <div class="clear"></div>
	  <div class="nomarginleft" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">&nbsp;Doctor :</div>
        <div style="float:left"> <?php echo $this->Form->input('dentist',array('options'=>$dentistlist,'value'=>$dentistsel,'label'=>false,'empty'=>"Select",'class'=>'input-large')); ?> </div>
      </div>

      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim/paidclaims"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>					
<div class="row-fluid show-grid">
		<div class="span12">
			
			 <table class="table table-striped table-bordered">
        <thead>
            <tr>
               
                <th class="sort"><?= $this->Paginator->sort('patient.first_name',"Patient Name") ?></th>
				<th >Dr. Office Name</th>
				<th class="sort"><?= $this->Paginator->sort('user_id',"Doctor") ?></th>
				
               <th class="sort"><?= $this->Paginator->sort('created',"Submitted Date") ?></th>
				<th class="sort"><?= $this->Paginator->sort('date_of_service',"Date of Service") ?></th>
				<th class="sort"><?= $this->Paginator->sort('claim_number',"Ref Number") ?></th>
				<th>Amount</th>
                 <th class="sort"><?= $this->Paginator->sort('claim_status_id',"Status") ?></th>
				 <th class="actions"><?= __('Actions') ?></th>
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
               <td><?php echo $practice[$claim['patient']->practice_id]?></td>
			   <td><?php if($claim->user_id>1){echo $userslist[$claim->user_id];}?></td>
			   <!--<td><?php /*
				if (!empty($claim->cpt_codes)):
				$im=1;
				foreach ($claim->cpt_codes as $cptCodes):
					if($im==1){echo $cptCodes->code;}else{echo ", ".$cptCodes->code;}
					$im++;
				endforeach;
				endif;
				*/
				 ?></td>-->
                <td><?php echo str_replace("-","/",$claim->created);?></td>
				<td><?php echo date("m/d/Y",strtotime($claim->date_of_service));?></td>
				<td><?php echo $claim->claim_number;?></td>
				<td>$<?php if($payment[$claim->id]==''){$payment[$claim->id]=0;}
			   echo $payment[$claim->id]?></td>
                <td><?php echo $claim->claim_status->name?></td>
				   <td class="actions">
                  <?php echo $this->Html->link(__('View'), ['action' => 'view', $claim->id]) ?>
				 </td>
            </tr>
            <?php endforeach; ?>
			<tr><td colspan="6" style="text-align:right;"> Total</td><td>$<?php echo $amt?></td><td colspan="2"></td></tr>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
</div>
<div class="clear"></div>

</div>
<script>

$(document).ready(function(){
//jQuery('#allappealclaimpaidlist').load("<?php echo $this->request->webroot?>claim/ajax_allappealpaidlist");
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
$("#practice").change(function(){
	$("#dentist").load("<?php echo $this->request->webroot?>claim/ajax_getdentist/"+$(this).val());
	//$("#dentist").val('<?php echo $dentistsel?>').prop('selected', true);
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