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
				<th class="sort"><?= $this->Paginator->sort('pay_date',"Date Paid") ?></th>
				<th >Appeal Amount</th>
                <th><?= $this->Paginator->sort('claim_status_id',"Claim Status") ?></th>
            </tr>
        </thead>
        <tbody>
            <?php 
			$amt=0;
			foreach ($claim as $claim):
			$amt=$amt+$claimlist['pay_amount'][$claim->id];
			 ?>
            <tr>
               
                <td><?= h($claim['patient']->first_name." ".$claim['patient']->last_name) ?></td>
				<td><?php if($claim->user_id>1){echo $userslist[$claim->user_id];}?></td>
                <td><?= h(substr(str_replace("-","",$claim['patient']->ssn), -4)) ?></td>
                <td><?php echo date("m/d/Y",strtotime($claim->date_of_service));?></td>
				 <td><?= h($claim->claim_number) ?></td>
				<td><?php echo str_replace("-","/",$claim->created);?></td>
               <td>$<?php if($claimlist['pay_amount'][$claim->id]==''){$claimlist['pay_amount'][$claim->id]=0;}
			   echo $claimlist['pay_amount'][$claim->id]?></td>
                <td class="actions">
                 <a href="<?php echo $this->request->webroot?>claim/view/<?php echo $claim->id?>" target="_blank"><?php echo str_replace("New","Pending Review",$claim->claim_status->name)?></a>
				 
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
<script>

$(document).ready(function(){
$("#approvedappeallist .pagination a").on('click', function(e){

        var href = $(this).attr('href');
		
       /* $.ajax({url:href,type: "POST",data:$(".frmfilterpaid").serialize(), success: function(result){
			$("#approvedappeallist").html(result);         
        }});*/
           $('#approvedappeallist').load($(this).attr('href'));
       
        return false;
    });
$("#approvedappeallist .sort a").on('click', function(){
        
		var href = $(this).attr('href');
		/*$.ajax({url:href,type: "POST",data:$(".frmfilterpaid").serialize(), success: function(result){
			$("#approvedappeallist").html(result);         
        }});*/
           $('#approvedappeallist').load($(this).attr('href'));
       
        return false;
    });	
    });		
</script>