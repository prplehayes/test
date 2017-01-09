<div class="users view large-9 medium-8 columns content custom_design">
    <div class="row-fluid show-grid">
	<h3><?= h($user->id) ?></h3>
    <table class="table thborder">
       
      
	    <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
		<tr>
            <th><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Group') ?></th>
            <td><?= $user->has('group') ? $this->Html->link($user->group->name, ['controller' => 'Groups', 'action' => 'view', $user->group->id]) : '' ?></td>
        </tr>
       
        
    </table>
    <div class="related1">
        <h3><?= __('Related Notes') ?></h3>
        <?php if (!empty($user->notes)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Claim Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Note') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->notes as $notes): ?>
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
    <div class="related1">
        <h3><?= __('Related Review') ?></h3>
        <?php if (!empty($user->review)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Claim Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->review as $review): ?>
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
	    </div>
</div>
