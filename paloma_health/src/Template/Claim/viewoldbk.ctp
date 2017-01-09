<div class="claim view large-9 medium-8 columns content">
    <h3><?= h($claim->title) ?></h3>
	<div class="span11 nomarginleft">
		<div class="span8">
		
		<div ><strong><?= __('Tooth Codes') ?></strong><br>
			<div>
				
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
		<div class="clear"></div>
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
		<div class="clear"></div>
		<div class="span8"></div>
		<div class="span4 pull-right"><?php
		?>
			<div><strong><?= __('Signature') ?> :</strong> <?= h($claim->signature) ?></div>
			<div><strong><?= __('Title ') ?> :</strong> <?= h($claim->title) ?></div>
		</div>
		<div class="clear"></div>
	</div>
      <div class="clear"></div>
    <div class="related">
        <h4><?= __('Related Notes') ?></h4>
        <?php if (!empty($claim->notes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Claim Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Note') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($claim->notes as $notes): ?>
            <tr>
                <td><?= h($notes->id) ?></td>
                <td><?= h($notes->claim_id) ?></td>
                <td><?= h($notes->user_id) ?></td>
                <td><?= h($notes->note) ?></td>
                <td><?= h($notes->type) ?></td>
                <td><?= h($notes->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Notes', 'action' => 'view', $notes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Notes', 'action' => 'edit', $notes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notes', 'action' => 'delete', $notes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Review') ?></h4>
        <?php if (!empty($claim->review)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Claim Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($claim->review as $review): ?>
            <tr>
                <td><?= h($review->id) ?></td>
                <td><?= h($review->claim_id) ?></td>
                <td><?= h($review->user_id) ?></td>
                <td><?= h($review->created) ?></td>
                <td><?= h($review->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Review', 'action' => 'view', $review->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Review', 'action' => 'edit', $review->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Review', 'action' => 'delete', $review->id], ['confirm' => __('Are you sure you want to delete # {0}?', $review->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Cpt Codes') ?></h4>
        <?php if (!empty($claim->cpt_codes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Group') ?></th>
                <th><?= __('Code') ?></th>
                <th><?= __('Medicare Code') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Required Upper Or Lower') ?></th>
                <th><?= __('Required Tooth Number') ?></th>
                <th><?= __('Required Surface') ?></th>
                <th><?= __('Required Quadrent 1 Code') ?></th>
                <th><?= __('Required Arch Code') ?></th>
                <th><?= __('Required Quadrent Or Arch Code') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($claim->cpt_codes as $cptCodes): ?>
            <tr>
                <td><?= h($cptCodes->id) ?></td>
                <td><?= h($cptCodes->group) ?></td>
                <td><?= h($cptCodes->code) ?></td>
                <td><?= h($cptCodes->medicare_code) ?></td>
                <td><?= h($cptCodes->description) ?></td>
                <td><?= h($cptCodes->required_upper_or_lower) ?></td>
                <td><?= h($cptCodes->required_tooth_number) ?></td>
                <td><?= h($cptCodes->required_surface) ?></td>
                <td><?= h($cptCodes->required_quadrent_1_code) ?></td>
                <td><?= h($cptCodes->required_arch_code) ?></td>
                <td><?= h($cptCodes->required_quadrent_or_arch_code) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CptCodes', 'action' => 'view', $cptCodes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CptCodes', 'action' => 'edit', $cptCodes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CptCodes', 'action' => 'delete', $cptCodes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cptCodes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Icd10 Codes') ?></h4>
        <?php if (!empty($claim->icd10_codes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Group') ?></th>
                <th><?= __('Code') ?></th>
                <th><?= __('Description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($claim->icd10_codes as $icd10Codes): ?>
            <tr>
                <td><?= h($icd10Codes->id) ?></td>
                <td><?= h($icd10Codes->group) ?></td>
                <td><?= h($icd10Codes->code) ?></td>
                <td><?= h($icd10Codes->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Icd10Codes', 'action' => 'view', $icd10Codes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Icd10Codes', 'action' => 'edit', $icd10Codes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Icd10Codes', 'action' => 'delete', $icd10Codes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $icd10Codes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
