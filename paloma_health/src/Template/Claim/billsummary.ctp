<div class="claim form large-9 medium-8 columns content custom_design">
<div class="top-header summaryhead">
						<h2><i class="icon-folder-open"></i><?php echo __('Bill Summary'); ?></h2></div>
<?= $this->Form->create($patient,array('method' => 'post', 'type' => 'file','class'=>'form-horizontal')) ?>
<div class="billview1" style="float:left;padding:10px;width:100%;">
    <h3><?= h($patient->first_name) ?></h3>
	<div class="span12 nomarginleft">
		<div class="span8">
		
		<div><strong><?= __('CPT Codes') ?></strong><br><br>
			<div class="span8 nomarginleft">
				<?php if (!empty($cptCodes)): ?>
            <?php 
			$newcptdata=array();
			foreach ($cptCodes as $cptCode=>$val): 
				$newcptdata[$val->id]=$val;
			endforeach;
			 foreach ($claimdata['cptcode']['_ids'] as $j=>$val): 
			$cptCode=$newcptdata[$val];
			$toothnumber=$claimdata['cptcode']['tooth_number'][$j];
			$surface=$claimdata['cptcode']['surface'][$j];
			$surface2=$claimdata['cptcode']['surface2'][$j];
			$surface3=$claimdata['cptcode']['surface3'][$j];
			$surface4=$claimdata['cptcode']['surface4'][$j];
			$quadrent_1_code=$claimdata['cptcode']['quadrent_1_code'][$j];
			$quadrent_2_code=$claimdata['cptcode']['quadrent_2_code'][$j];
			$arch_code=$claimdata['cptcode']['arch_code'][$j];
			$upper_or_lower=$claimdata['cptcode']['upper_or_lower'][$j];
			?>
                 <div class="cptbox">
				<div class="inlinebox">
					<?= h($cptCode->group) ?> < <?= h($cptCode->code) ?> < <?= h($cptCode->description) ?>
				</div>
				
				<?php if($toothnumber|| $surface || $surface2 || $surface3 || $surface4 ||$quadrent_1_code || $quadrent_2_code ||$arch_code||$upper_or_lower){?>
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
            <?php  endforeach; ?>
        <?php endif; ?>
			</div>
		</div>
		<div class="clear"><br><br></div>
		<div><strong><?= __('ICD-10 Codes') ?></strong><br><br>
			<div class="span8 nomarginleft">
				<?php if (!empty($icd10Codes)): ?>
            <?php foreach ($icd10Codes as $icd10Code): ?>
                <div class="icd10box">
				<div class="inlinebox"><?= h($icd10Code->group) ?> < <?= h($icd10Code->code) ?> - <?= h($icd10Code->description) ?></div></div>
            <?php endforeach; ?>
        <?php endif; ?>
			</div>
		</div>
		</div>
		<div class="span4"><?php
		?>
			<div><strong><?= __('Ref # ') ?> :</strong> <?= h($claimdata['claim_number']) ?></div>
			<div><strong><?= __('Last Name ') ?> :</strong> <?= h($patient->last_name) ?></div>
			<div><strong><?= __('SS ') ?> :</strong> <?= h(substr(str_replace("-","",$patient->ssn), -4)) ?></div>
			<div><strong><?= __('Status ') ?> :</strong> Pending Review</div>
		</div>
</div>		
<div class="greybg">		
		<div class="clear">&nbsp;</div>
		<div class="span8 nomarginleft">
			<div class="span6 nomarginleft"><strong><?= __('Medical Verification Form') ?></strong><br><br>
				<div>
				<?php if($claimdata['dental_verification_upload']!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claimdata['dental_verification_upload'];?>', 'Medical Verification Form',450,450);" href="javascript:void(0);" title="Medical Verification Form"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
		<br><?php echo $claimdata['dental_verification_upload'];?>
		</a>
        <?php }?>
				</div>
				
			</div>
			<div class="span6"><strong><?= __('Progress Notes') ?></strong><br><br>
				<div>
					<?php if($claimdata['progress_notes_upload']!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claimdata['progress_notes_upload'];?>', 'Progress Notes',450,450);" href="javascript:void(0);" title="Progress Notes"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
		<br><?php echo $claimdata['progress_notes_upload'];?>
		</a>
        <?php }?>
				</div>
			</div>
		</div>
		<div class="clear"><br><br></div>
		<div class="span8 nomarginleft"><strong>Super Bill Notes :</strong> <?php echo $claimdata['comments'];?></div><br/>
		<div class="span8 nomarginleft"><strong>Date of Service :</strong> <?php echo $claimdata['date_of_service'];?></div>
		<div class="span4 pull-right"><?php
		?>
			<div><strong><?= __('Signature') ?> :</strong> <div class="controls"><?php echo $this->Form->file('signature', ['label'=>false,'div'=>false,'required'=>true]);?></div> </div>
			<div><strong><?= __('Title ') ?> :</strong> <?php echo $claimusers['first_name']." ".$claimusers['last_name']; ?></div>
		</div>
</div>
		<div class="clear"><br><br></div>
		<div>
		<div style="margin-left:300px;"><?= $this->Form->button(__('Submit'),['class'=>'btn-primary submitfrm']) ?></div>
		</div>
	</div>
<?= $this->Form->end() ?>
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