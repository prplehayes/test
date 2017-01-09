<div class="claim view large-9 medium-8 columns content custom_design">
    <!-- <h3><?= h($claim->title) ?></h3> -->
	<div class="top-header claimhead">
						<h2><i class="icon-clipboard"></i><?php echo __('Claim'); ?></h2></div>
	<div class="row-fluid show-grid">
	<div class="span12">
		<div class="span8">
		
		<div>
		<div style="margin-bottom:10px;"><strong><?= __('CPT Codes') ?></strong></div>
			<div class="span12 nomarginleft">
				<?php if (!empty($claim->cpt_codes)): ?>
            <?php 
			foreach ($claim->cpt_codes as $cptCodes): 
			$toothnumber=$cptCodes->_joinData->tooth_number;
			$surface=$cptCodes->_joinData->surface;
			$surface2=$cptCodes->_joinData->surface2;
			$surface3=$cptCodes->_joinData->surface3;
			$surface4=$cptCodes->_joinData->surface4;
			$quadrent_1_code=$cptCodes->_joinData->quadrent_1_code;
			$quadrent_2_code=$cptCodes->_joinData->quadrent_2_code;
			$arch_code=$cptCodes->_joinData->arch_code;
			$upper_or_lower=$cptCodes->_joinData->upper_or_lower;
			?>
                <div class="cptbox">
				<div class="inlinebox"><?= h($cptCodes->group) ?> < <?= h($cptCodes->code) ?> < <?= h($cptCodes->description) ?> </div>
				<?php if($toothnumber|| $surface || $surface2 || $surface3 || $surface4 ||$quadrent_1_code || $quadrent_2_code || $arch_code||$upper_or_lower){?>
				<div class="inlinebox"><?php
					if($toothnumber){ echo "<span>Tooth Number: ".$toothnumber."</span>&nbsp;";}
					if($surface){ echo "<span>Surface ".$surface."</span>&nbsp;";}
					if($surface2){ echo "<span>Surface 2: ".$surface2."</span>&nbsp;";}
					if($surface3){ echo "<span>Surface 3: ".$surface3."</span>&nbsp;";}
					if($surface4){ echo "<span>Surface 4: ".$surface4."</span>&nbsp;";}
					if($quadrent_1_code){ echo "<span>Quadrent Code: ".$quadrent_1_code."</span>&nbsp;";}
					//if($quadrent_2_code){ echo "<span>Quadrent Code 2: ".$quadrent_2_code."</span>&nbsp;";}
					if($arch_code){ echo "<span>Arch Code: ".$arch_code."</span>&nbsp;";}
					if($upper_or_lower){ echo "<span>Upper/Lower: ".$upper_or_lower."</span>&nbsp;";}
				?>
				</div>
				<?php }?>
				</div>
            <?php endforeach; ?>
        <?php endif; ?>
			</div>
		</div>
		<div class="clear">&nbsp;</div>
		<div><div style="margin-bottom:10px;">
		<strong><?= __('ICD-10 Codes') ?></strong></div>
			<div class="span12 nomarginleft">
				<?php if (!empty($claim->icd10_codes)): ?>
            <?php foreach ($claim->icd10_codes as $icd10Codes): ?>
                <div class="inlinebox"><?= h($icd10Codes->group) ?> < <?= h($icd10Codes->code) ?> <?= h($icd10Codes->description) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
			</div><div class="clear">&nbsp;</div>
			<div><strong><?= __('Date Submitted ') ?></strong> <?= h(str_replace("-","/",$claim->created)) ?></div>
		</div>
		</div>
		<div class="span4"><?php
		?>
			<div class="leftbox"><strong><?= __('Ref # ') ?> </strong></div><div class="rightbox"> <?= h($claim->claim_number) ?></div>
			<div class="leftbox"><strong><?= __('Last Name ') ?> </strong></div><div class="rightbox"> <?= h($claim->patient->last_name) ?></div>
			<div class="leftbox"><strong><?= __('SS ') ?> </strong></div><div class="rightbox"> <?= h(substr(str_replace("-","",$claim->patient->ssn), -4)) ?></div>
			<div class="leftbox"><strong><?= __('Status ') ?> </strong> </div><div class="rightbox"><?= $claim->has('claim_status') ? $claim->claim_status->name : '' ?></div>
		</div>
		<div class="clear">&nbsp;<br><br></div>
	</div>
</div>		
<div class="greybg">		
		<div class="span12 nomarginleft bordertop"><br><br>
			<div class="span4 nomarginleft">
				<div>
				<?php if($claim->dental_verification_upload!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->dental_verification_upload;?>', 'Medical Verification Form',450,450);" href="javascript:void(0);" title="Medical Verification Form"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
		</a>
		

		
        <?php }else{
		?>
        <img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
        <?php
		}?>
        <br><br>
        <strong><?= __('Medical Verification Form') ?></strong>
        <br><br><?php if($claim->dental_verification_upload!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->dental_verification_upload;?>', 'Medical Verification Form',450,450);" href="javascript:void(0);" title="Medical Verification Form">
		<?php echo $claim->dental_verification_upload;?>
		</a>
		
        <?php }?>
		
				</div>
				
			</div>
			<div class="span4">
				<div>
					<?php if($claim->progress_notes_upload!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->progress_notes_upload;?>', 'Progress Notes',450,450);" href="javascript:void(0);" title="Progress Notes"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
		</a>
		 <?php }else{
		?>
        <img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
        <?php
		}?>
        <br><br>
		<strong><?= __('Progress Notes') ?></strong>
		<?php if($claim->progress_notes_upload!=''){?>
        <br><br><a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->progress_notes_upload;?>', 'Progress Notes',450,450);" href="javascript:void(0);" title="Progress Notes"><?php echo $claim->progress_notes_upload;?>
		</a>
        <?php }?>
				</div>
			</div>
			<div class="span4">
				<div>
					<?php if($claim->signature!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->signature;?>', 'Signature',450,450);" href="javascript:void(0);" title="Signature"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
		</a>
		 <?php }else{
		?>
        <img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
        <?php
		}?>
        <br><br>
		<strong><?= __('Signature') ?></strong>
		<?php if($claim->signature!=''){?>
        <br><br><a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->signature;?>', 'Signature',450,450);" href="javascript:void(0);" title="Signature"><?php echo $claim->signature;?>
		</a>
        <?php }?>
				</div>
			</div>
		</div>
		<div class="clear"><br>&nbsp;</div>
		<div class="span4 nomarginleft"><strong>Date of Service</strong><div><br> <?php 
				if($claim->date_of_service=='1970-01-01'){}
				else{
				echo date("m/d/Y",strtotime($claim->date_of_service));
				}
				?></div></div>
		<div class="span4"><strong>Super Bill Notes</strong><div><br><?php echo $claim->comments;?></div></div>

		<div class="span4"><strong><?= __('Title ') ?></strong><div><br><?= h($claimusers['first_name']." ".$claimusers['last_name']) ?></div></div>
	</div>
	
	<div class="clear"><br><br></div>
<div class="row-fluid show-grid">	
    <div class="related1">
	<div class="frm-head row-fluid">
    
        <h3><?= __('Review Notes') ?></h3>
    </div>
<br>
        <?php if (!empty($claim->notes)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
            <tr>
                
                <th><?= __('User') ?></th>
                <th><?= __('Note') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Created') ?></th>
                
            </tr>
            <?php foreach ($claim->notes as $notes): ?>
            <tr>
                <td><?= h($users[$notes->user_id]) ?></td>
                <td><?= h($notes->note) ?></td>
                <td><?= h($notes->option1) ?></td>
                <td><?= h(str_replace("-","/",$notes->created)) ?></td>
                
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related1"><br>
        <div class="frm-head row-fluid">
    
        <h3><?= __('Reviewed By') ?></h3>
    </div><br>
        <?php if (!empty($claim->review)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
            <tr>
               
                <th><?= __('User Id') ?></th>
                <th><?= __('Created') ?></th>
                
            </tr>
            <?php foreach ($claim->review as $review): ?>
            <tr>
               
                <td><?= h($users[$review->user_id]) ?></td>
                <td><?= h(str_replace("-","/",$review->created)) ?></td>
                
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
	<div class="clear"></div>
	<?php if($claim->claim_status_id==4):?>
	<div class="related1"><br>
        <div class="frm-head row-fluid">
    
        <h3><?= __('Payment History') ?></h3>
    </div><br>
        <?php if (!empty($payments)): ?>
        <table  class="table table-striped table-bordered">
		<thead>
            <tr>
               
                <th><?= __('Check Number') ?></th>
				<th><?= __('EHS Number') ?></th>
                <th><?= __('Amount Paid') ?></th>
				<th><?= __('Paid Date') ?></th>
                
            </tr>
			 </thead>
        <tbody>
            <?php foreach ($payments as $payment): ?>
            <tr>
               
                <td><?= h($payment->check_number) ?></td>
				<td><?= h($payment->ehs_number) ?></td>
                <td>$<?= h($payment->pay_amount) ?></td>
				<td><?= h(date("m/d/Y",strtotime($payment->pay_date))) ?></td>
                
            </tr>
            <?php endforeach; ?>
			</tbody>
        </table>
        <?php endif; ?>
    </div>
	<?php endif; ?>
	<div class="clear"></div>
	<?php if($claim->claim_status_id==4):?>
	<div class="related1"><br>
        <div class="frm-head row-fluid">
    
        <h3><?= __('Appeal History') ?></h3>
    </div><br>
        <?php if (!empty($appeals)): ?>
        <table  class="table table-striped table-bordered">
		<thead>
            <tr>
               
                <th><?= __('Check Number') ?></th>
				<!--<th><?= __('EHS Number') ?></th>-->
                <th><?= __('Amount Paid') ?></th>
				
				 <th><?= __('Reason') ?></th>
				 <th><?= __('Paid Date') ?></th>
                
            </tr>
			 </thead>
        <tbody>
            <?php foreach ($appeals as $appeal): ?>
            <tr>
               
                <td><?= h($appeal->check_number) ?></td>
				<!--<td><?= h($appeal->ehs_number) ?></td>-->
                <td>$<?= h($appeal->pay_amount) ?></td>
				<td><?= h($appeal->reason_notes) ?></td>
				<td><?= h(date("m/d/Y",strtotime($appeal->pay_date))) ?></td>
				
                
            </tr>
            <?php endforeach; ?>
			</tbody>
        </table>
        <?php endif; ?>
    </div>
	<?php endif; ?>
	
	<div class="clear">&nbsp;</div>
	<div style="text-align:center;"><?php
	if($claim->claim_status_id==1){
	?><a href="<?php echo $this->request->webroot?>claim/resubmitclaim/<?php echo $claim->id?>" class="btn-large btn-primary">Correct Error</a>
	<?php }?>
	</div>
    </div>
	
</div>
</div>
<script type="text/javascript">
$(function(){    
    $('.view-pdf').on('click',function(){
        var pdf_link = $(this).attr('href');
		var mod_title = $(this).attr('title');
		if(mod_title == ''){
			mod_title = 'My Title';
		}
        var iframe = '<div class="iframe-container"><iframe src="'+pdf_link+'"></iframe></div>'
        $.createModal({
        title:mod_title,
        message: iframe,
        closeButton:true,
        scrollable:false
        });
        return false;        
    });    
});
</script>