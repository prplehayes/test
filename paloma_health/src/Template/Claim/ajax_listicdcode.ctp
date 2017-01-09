<?php 
$randno=mt_rand(1,20);
if (!empty($icd10Codes)): ?>
            <?php foreach ($icd10Codes as $icd10Code): ?>
                <div class="icdoption"><input type="radio" data-code="<?= h($icd10Code->code) ?>" name="icd10code[<?php echo $randno?>]" value="<?= h($icd10Code->id) ?>" required="required">&nbsp;<?= h($icd10Code->description) ?> (<?= h($icd10Code->code) ?>)	    
				</div>
				<div class="clear"></div>
            <?php endforeach; ?>
<?php endif; ?>