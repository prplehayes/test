<div class="claim large-9 medium-8 columns content custom_design">
    <div class="top-header claimhead">
						<h2><i class="icon-money"></i><?php echo __('Pending Claims'); ?></h2></div>
						
<div class="row-fluid show-grid">
		<div class="span12">
			<div style="text-align:right"><a href="<?php echo $this->request->webroot?>claim/batchpay" class="btn-primary btn">Batch Edit</a></div><div class="clear">&nbsp;</div>
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
            <?php foreach ($claim as $claim):
			 ?>
            <tr>
               
                <td><?= h($claim['patient']->first_name." ".$claim['patient']->last_name) ?></td>
               <td><?php echo $practice[$claim['patient']->practice_id]?></td>
			   <td><?php if($claim->user_id>1){echo $userslist[$claim->user_id];}?></td>
			   <!--<td><?php 
				/*if (!empty($claim->cpt_codes)):
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
                  <?php echo $this->Html->link(__('Pay'), ['action' => 'payclaim', $claim->id]) ?>&nbsp;
				  <?php echo $this->Html->link(__('View'), ['action' => 'view', $claim->id]) ?>
				 </td>
            </tr>
            <?php endforeach; ?>
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
</div>
<script>

$(document).ready(function(){
$("#approvedclaim .pagination a").on('click', function(e){

        var href = $(this).attr('href');
		
        
            $('#approvedclaim').load($(this).attr('href'));
       
        return false;
    });
$("#approvedclaim .sort a").on('click', function(){
        
		var href = $(this).attr('href');
		
            $('#approvedclaim').load($(this).attr('href'));
       
        return false;
    });	
    });		
</script>