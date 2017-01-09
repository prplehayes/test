			 <table class="table table-striped table-bordered">
        <thead>
           <tr>
               <th width="80px"><input type="checkbox" name="chkalla" id="chkalla" value="1">
              &nbsp;All</th>
                <th class="sort"><?= $this->Paginator->sort('patient.first_name',"Patient Name") ?></th>
				<th >Dr. Office Name</th>
				<th class="sort"><?= $this->Paginator->sort('user_id',"Doctor") ?></th>
				<th>Reviewer</th>
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
               <td>
			<input type="checkbox" name="clid[]" class="chka" value="<?php echo $claim->id?>">
			</td>
                <td><?= h($claim['patient']->first_name." ".$claim['patient']->last_name) ?></td>
               <td><?php echo $practice[$claim['patient']->practice_id]?></td>
			   <td><?php if($claim->user_id>1){echo $userslist[$claim->user_id];}?></td>
			   <td><?php  if($claim->modify_by>1){echo $reviewers[$claim->modify_by];}
				/*if (!empty($claim->cpt_codes)):
				$im=1;
				foreach ($claim->cpt_codes as $cptCodes):
					if($im==1){echo $cptCodes->code;}else{echo ", ".$cptCodes->code;}
					$im++;
				endforeach;
				endif;*/
				
				 ?></td>
                <td><?php echo str_replace("-","/",$claim->created);?></td>
				<td><?php echo date("m/d/Y",strtotime($claim->date_of_service));?></td>
				<td><?php echo $claim->claim_number;?></td>
                <td><?php echo $claim->claim_status->name?></td>
				   <td class="actions">
                  <?= $this->Html->link(__('Review'), ['action' => 'claimreview', $claim->id]) ?> <?php if($cloguser['group_id']==2){?>| <?= $this->Html->link(__('View'), ['action' => 'view', $claim->id]) ?><?php }?>
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
<script>

$(document).ready(function(){
$("#allapprovedclaim .pagination a").on('click', function(e){

        var href = $(this).attr('href');
		
        $.ajax({url:href,type: "POST",data:$(".frmfilterap").serialize(), success: function(result){
			$("#allapprovedclaim").html(result);         
        }});
            //$('#allapprovedclaim').load($(this).attr('href'));
       
        return false;
    });
$("#allapprovedclaim .sort a").on('click', function(){
        
		var href = $(this).attr('href');
		$.ajax({url:href,type: "POST",data:$(".frmfilterap").serialize(), success: function(result){
			$("#allapprovedclaim").html(result);         
        }});
            //$('#allapprovedclaim').load($(this).attr('href'));
       
        return false;
    });	
    });		
</script>