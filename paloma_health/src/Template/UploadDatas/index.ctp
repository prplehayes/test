<div class="uploadDatas  large-9 medium-8 columns content custom_design">
	<div class="top-header commonhead">
	<h2><i class="icon-files-o"></i><?php echo __('Upload Datas'); ?></h2>
</div>
<div class="row-fluid show-grid">
	<div class="span12">
	<div><a class="btn btn-primary" href="<?php echo $this->request->webroot?>upload-datas/add">+ Upload Data</a><br></div><div class="clear">&nbsp;</div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('dentist_office_name') ?></th>
                <th><?= $this->Paginator->sort('file_name') ?></th>
                
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($uploadDatas as $uploadData): ?>
            <tr>
                
                <td><?= h($uploadData->dentist_office_name) ?></td>
                <td><?= h($uploadData->file_name) ?></td>
                
                <td class="actions">
                    <?= $this->Html->link(__('Process'), ['action' => 'process', $uploadData->id]) ?> | 
					<?= $this->Html->link(__('Download'), ['action' => 'download', $uploadData->id]) ?> | 
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $uploadData->id], ['confirm' => __('Are you sure you want to delete # {0}?', $uploadData->id)]) ?>
                </td>
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
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
 </div>
</div>
