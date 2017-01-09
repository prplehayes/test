<div class="row-fluid show-grid">
		<div class="span12">
			
			 <table class="table table-striped table-bordered">
        <thead>
           <tr>
               
                <th class="sort"><?= $this->Paginator->sort('patient.first_name',"Patient Name") ?></th>
				<th >Dr. Office Name</th>
				<th class="sort"><?= $this->Paginator->sort('user_id',"Doctor") ?></th>
				<!--<th>CPT</th>-->
                <th class="sort"><?= $this->Paginator->sort('created',"Submitted Date") ?></th>
				<th class="sort"><?= $this->Paginator->sort('date_of_service',"Date of Service") ?></th>
				<th class="sort"><?= $this->Paginator->sort('claim_number',"Ref Number") ?></th>
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
			  <!-- <td><?php 
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
                <td><?php echo $claim->claim_status->name?></td>
				   <td class="actions">
                  <?= $this->Html->link(__('Review'), ['action' => 'claimreview', $claim->id]) ?> <?php if($cloguser['group_id']==2){?>| <?= $this->Html->link(__('View'), ['action' => 'view', $claim->id]) ?><?php }?>
				  <?php
				 if($cloguser['group_id']==1){
				 ?> |
				 	<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $claim->id], ['confirm' => __('Are you sure you want to delete # {0}?', $claim->id)]) ?>
				 <?php
				 }
				 ?>
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
<script>

$(document).ready(function(){
$("#correctionreview .pagination a").on('click', function(e){

        var href = $(this).attr('href');
		
        $.ajax({url:href,type: "POST",data:$(".frmfiltercr").serialize(), success: function(result){
	$("#correctionreview").html(result);         
        }});
            //$('#correctionreview').load($(this).attr('href'));
       
        return false;
    });
$("#correctionreview .sort a").on('click', function(){
        
		var href = $(this).attr('href');
		$.ajax({url:href,type: "POST",data:$(".frmfiltercr").serialize(), success: function(result){
	$("#correctionreview").html(result);         
        }});
           // $('#correctionreview').load($(this).attr('href'));
       
        return false;
    });	
    });		
</script>