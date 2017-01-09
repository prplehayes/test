<div class="groups form large-9 medium-8 columns content custom_design">
    
   <div class="row-fluid show-grid">
   <h3><?= h($group->name) ?></h3>
    <table class="table thborder">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($group->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($group->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($group->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($group->modified) ?></td>
        </tr>
    </table>
    <div class="related1">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($group->users)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
            <tr>
                <th><?= __('Id') ?></th>

                <th><?= __('Email') ?></th>

                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($group->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>

                <td><?= h($users->email) ?></td>

                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
	    </div>
</div>
