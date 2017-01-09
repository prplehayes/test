
<div class="row-fluid show-grid">
		<div class="span12">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
               
                <th class="sort"><?= $this->Paginator->sort('first_name',"Patient Name") ?></th>
				<th class="sort"><?= $this->Paginator->sort('user_id',"Doctor") ?></th>
                <th width="120" class="sort"><?= $this->Paginator->sort('ssn',"Last 4 SS") ?></th>
				<th class="sort"><?= $this->Paginator->sort('date_of_service',"Date of Service") ?></th>
				<th class="sort"><?= $this->Paginator->sort('created',"Submitted Date") ?></th>
				<th width="140" class="sort"><?= $this->Paginator->sort('claim_number',"Ref #") ?></th>
                <th class="sort"><?= $this->Paginator->sort('claim_status_id',"Claim Status") ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($claim as $claim):
			 ?>
            <tr>
               
                <td><?= $claim->has('patient') ? $this->Html->link($claim->patient->first_name." ".$claim->patient->last_name, ['controller' => 'Patient', 'action' => 'view', $claim->patient->id]) : '' ?></td>
				<td><?php if($claim->user_id>1){echo $userslist[$claim->user_id];}?></td>
                <td><?= h(substr(str_replace("-","",$claim->patient->ssn), -4)) ?></td>
				<td><?php echo date("m/d/Y",strtotime($claim->date_of_service));?></td>
				<td><?php echo str_replace("-","/",$claim->created);?></td>
				<!--<td><?php //echo $practice[$claim->patient->practice_id];?></td>-->
				<td><?= h($claim->claim_number) ?></td>
                <td>
				<?php if($claim->claim_status->name=='New'){$claim->claim_status->name="Pending Review";}?>
				<?= $claim->claim_status->name ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $claim->id]) ?>
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
$("#deniedclaim .pagination a").on('click', function(e){

        var href = $(this).attr('href');
		
        $.ajax({url:href,type: "POST",data:$(".frmfilterdn").serialize(), success: function(result){
			$("#deniedclaim").html(result);         
        }});
           // $('#deniedclaim').load($(this).attr('href'));
       
        return false;
    });
$("#deniedclaim .sort a").on('click', function(){
        
		var href = $(this).attr('href');
		$.ajax({url:href,type: "POST",data:$(".frmfilterdn").serialize(), success: function(result){
			$("#deniedclaim").html(result);         
        }});
           // $('#deniedclaim').load($(this).attr('href'));
       
        return false;
    });	
    });		
</script>