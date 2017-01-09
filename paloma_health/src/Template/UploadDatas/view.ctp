<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Upload Data'), ['action' => 'edit', $uploadData->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Upload Data'), ['action' => 'delete', $uploadData->id], ['confirm' => __('Are you sure you want to delete # {0}?', $uploadData->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Upload Datas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Upload Data'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="uploadDatas view large-9 medium-8 columns content">
    <h3><?= h($uploadData->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Dentist Office Name') ?></th>
            <td><?= h($uploadData->dentist_office_name) ?></td>
        </tr>
        <tr>
            <th><?= __('File Name') ?></th>
            <td><?= h($uploadData->file_name) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $uploadData->has('user') ? $this->Html->link($uploadData->user->id, ['controller' => 'Users', 'action' => 'view', $uploadData->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($uploadData->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($uploadData->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($uploadData->modified) ?></td>
        </tr>
    </table>
</div>
