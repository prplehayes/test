<div class="row-fluid1 show-grid">
		<div class="span12">
			
			 <table class="table table-striped table-bordered">
        <thead>
            <tr>
               <th class="sort"><?= $this->Paginator->sort('user_id',"Doctor") ?></th>
                <th class="sort" width="135"><?= $this->Paginator->sort('date_of_service') ?></th>
				<th width="500">CPT</th>
                <th>Claim Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($claim as $claim): ?>
            <tr>
               <td><?php if($claim->user_id>1){echo $userslist[$claim->user_id];}?></td>
                <td ><?php 
				if($claim->date_of_service=='1970-01-01'){}
				else{
				echo date("m/d/Y",strtotime($claim->date_of_service));
				}
				?></td>
				<td><?php 
				
				if (!empty($claim->cpt_codes)):
				$im=1;
				foreach ($claim->cpt_codes as $cptCodes):
				$toothnumber=$cptCodes->_joinData->tooth_number;
			$surface=$cptCodes->_joinData->surface;
			$quadrent_1_code=$cptCodes->_joinData->quadrent_1_code;
			$quadrent_2_code=$cptCodes->_joinData->quadrent_2_code;
			$arch_code=$cptCodes->_joinData->arch_code;
			$upper_or_lower=$cptCodes->_joinData->upper_or_lower;
					if($im==1){echo $cptCodes->group." < ".$cptCodes->code." ".$cptCodes->description;
						
					}else{echo ", ".$cptCodes->group." < ".$cptCodes->code." ".$cptCodes->description;}
					if($toothnumber){ echo " Tooth Number: ".$toothnumber."";}
					if($surface){ echo "Surface: ".$surface."";}
					if($quadrent_1_code){ echo "Quadrent Code: ".$quadrent_1_code."";}
					//if($quadrent_2_code){ echo "Quadrent Code 2: ".$quadrent_2_code."";}
					if($arch_code){ echo "Arch Code: ".$arch_code."";}
					if($upper_or_lower){ echo "Upper/Lower: ".$upper_or_lower."";}
					$im++;
				endforeach;
				endif;
				
				 ?></td>
                <td><?= str_replace("New","Pending Review",$claim->claim_status->name); ?> | <a href="<?php echo $this->request->webroot?>claim/view/<?php echo $claim->id?>" >View</a></td>
               
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
       
    </div>
</div>
</div>
<script>

$(document).ready(function(){
$("#claimlist .pagination a").on('click', function(e){

        var href = $(this).attr('href');
		
        
            $('#claimlist').load($(this).attr('href'));
       
        return false;
    });
$("#claimlist .sort a").on('click', function(){
        
		var href = $(this).attr('href');
		
            $('#claimlist').load($(this).attr('href'));
       
        return false;
    });	
    });		
</script>