<div class="row-fluid show-grid">
		<div class="span12">
			
			<table class="table table-striped table-bordered">
        <thead>
		
            <tr>
                <th class="sort"><?= $this->Paginator->sort('id','Id',array('url'=>array('controller'=>'practiceAps','action'=>'ajax_practice'))) ?></th>
                <th class="sort"><?= $this->Paginator->sort('Identifier',"Practice Name",array('url'=>array('controller'=>'practiceAps','action'=>'ajax_practice'))) ?></th>
                <th class="sort"><?= $this->Paginator->sort('contact_name',"Practice Contact Name",array('url'=>array('controller'=>'practiceAps','action'=>'ajax_practice'))) ?></th>
                <th class="sort"><?= $this->Paginator->sort('contact_phone',"Contact Number",array('url'=>array('controller'=>'practiceAps','action'=>'ajax_practice'))) ?></th>
                <th class="actions"><?= __('Review') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($practice as $practice): ?>
            <tr>
                <td><?= $this->Number->format($practice->id) ?></td>
                <td><?= h($practice->Identifier) ?></td>
                <td><?= h($practice->contact_name) ?></td>
                <td><?= h($practice->contact_phone) ?></td>
                <td class="actions">
                    
                    <?= $this->Html->link(__('Review'), ['controller'=>'practice','action' => 'view', $practice->id]) ?>
                    
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
<script>

$(document).ready(function(){
$("#practice_pagination .pagination a").on('click', function(e){

        var href = $(this).attr('href');
		
        
            $('#practice_pagination').load($(this).attr('href'));
       
        return false;
    });
$("#practice_pagination .sort a").on('click', function(){
        
		var href = $(this).attr('href');
		
            $('#practice_pagination').load($(this).attr('href'));
       
        return false;
    });
    });		
</script>