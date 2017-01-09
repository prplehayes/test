<div class="claim view large-9 medium-8 columns content">
    <h3><?= h($claim->title) ?></h3>
	<div class="span11 nomarginleft">
		<div class="span8">
		
		<div><strong><?= __('Tooth Codes') ?></strong><br><br>
			<div class="span8 nomarginleft">
				<?php if (!empty($claim->cpt_codes)): ?>
            <?php foreach ($claim->cpt_codes as $cptCodes): ?>
                <div class="span2" style="border:1px solid #ccc;padding:5px;text-align:center"><?= h($cptCodes->code) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
			</div>
		</div>
		<div class="clear"><br><br></div>
		<div><strong><?= __('ICD-10 Codes') ?></strong><br><br>
			<div class="span8 nomarginleft">
				<?php if (!empty($claim->icd10_codes)): ?>
            <?php foreach ($claim->icd10_codes as $icd10Codes): ?>
                <div class="span2" style="border:1px solid #ccc;padding:5px;text-align:center"><?= h($icd10Codes->code) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
			</div>
		</div>
		</div>
		<div class="span4"><?php
		?>
			<div><strong><?= __('Ref # ') ?> :</strong> <?= h($claim->claim_number) ?></div>
			<div><strong><?= __('Last Name ') ?> :</strong> <?= h($claim->patient->last_name) ?></div>
			<div><strong><?= __('SS ') ?> :</strong> <?= h($claim->patient->ssn) ?></div>
			<div><strong><?= __('Status ') ?> :</strong> <?= $claim->has('claim_status') ? $claim->claim_status->name : '' ?></div>
		</div>
		<div class="clear">&nbsp;</div>
		<div class="span8 nomarginleft">
			<div class="span6 nomarginleft"><strong><?= __('Denti-Cal Verification Form') ?></strong><br><br>
				<div>
				<?php if($claim->dental_verification_upload!=''){?>
        <a href="<?php echo $this->request->webroot?>uploads/<?php echo $claim->dental_verification_upload;?>" target="_blank"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
		<br><?php echo $claim->dental_verification_upload;?>
		</a>
        <?php }?>
				</div>
				
			</div>
			<div class="span6"><strong><?= __('Progress Notes') ?></strong><br><br>
				<div>
					<?php if($claim->progress_notes_upload!=''){?>
        <a href="<?php echo $this->request->webroot?>uploads/<?php echo $claim->progress_notes_upload;?>" target="_blank"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
		<br><?php echo $claim->progress_notes_upload;?>
		</a>
        <?php }?>
				</div>
			</div>
		</div>
		<div class="clear"><br><br></div>
		<div class="span8"></div>
		<div class="span4 pull-right"><?php
		?>
			<div><strong><?= __('Signature') ?> :</strong> <?= h($claim->signature) ?></div>
			<div><strong><?= __('Title ') ?> :</strong> <?= h($claim->title) ?></div>
		</div>
		<div class="clear"></div>
	</div>
    </div>
</div>