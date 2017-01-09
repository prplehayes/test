<div class="practice view large-9 medium-8 columns content custom_design" style="padding:10px 30px;">
<div class="frm-head row-fluid">   <h3>&nbsp;</h3></div>
<div style="text-align:right"><?= $this->Html->link(__('Edit'), ['controller' => 'Practice', 'action' => 'editpractice'],['class' => 'btn-blue']) ?></div>
    <table class="table thborder" style="width:500px;">
        <tr>
            <th style="border:none;"><?= __('Practice Name') ?></th>
            <td style="border:none;"><?= h($practice->Identifier) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact Name') ?></th>
            <td><?= h($practice->contact_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact Phone') ?></th>
            <td><?= h($practice->contact_phone) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact Email') ?></th>
            <td><?= h($practice->contact_email) ?></td>
        </tr>
        <tr>
            <th><?= __('Website') ?></th>
            <td><?= h($practice->website) ?></td>
        </tr>
        <tr>
            <th><?= __('Mpi Number') ?></th>
            <td><?= h($practice->mpi_number) ?></td>
        </tr>
        <tr>
            <th><?= __('Practice Status') ?></th>
            <td><?= $practiceStatus[$practice->practice_status->id] ?></td>
        </tr>
        
        <tr>
            <th><?= __('Practitioner Count') ?></th>
            <td><?= $this->Number->format($practice->practitioner_count) ?></td>
        </tr>
    </table>
	<div class="top-header">
						<h2><?php echo __('Sub Providers'); ?></h2></div>
<div class="row-fluid show-grid">

       
        <?php if (!empty($prproviders)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
            <tr>
                <th><?= __('Provider') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($prproviders as $review): ?>
            <tr>
                
                <td><?= h($subproviders[$review->provider_id]) ?></td>
                <td class="actions">
                  
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>

	    </div>
    
</div>
