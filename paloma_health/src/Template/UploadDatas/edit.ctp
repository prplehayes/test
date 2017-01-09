<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $uploadData->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $uploadData->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Upload Datas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="uploadDatas form large-9 medium-8 columns content">
    <?= $this->Form->create($uploadData) ?>
    <fieldset>
        <legend><?= __('Edit Upload Data') ?></legend>
        <?php
            echo $this->Form->input('dentist_office_name');
            echo $this->Form->input('file_name');
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
