<div class="practice large-9 medium-8 columns content custom_design">
    <div class="top-header">
						<h2><?php echo __('Practice'); ?></h2></div>
<div class="row-fluid show-grid">
		<div class="span12">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
               
                <th><?= $this->Paginator->sort('Identifier',"Practice name") ?></th>
                <th><?= $this->Paginator->sort('contact_name') ?></th>
                <th><?= $this->Paginator->sort('contact_phone') ?></th>
                <th><?= $this->Paginator->sort('contact_email') ?></th>
                <th><?= $this->Paginator->sort('website') ?></th>
                <th><?= $this->Paginator->sort('practitioner_count') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($practice as $practice): ?>
            <tr>
                
                <td><?= h($practice->Identifier) ?></td>
                <td><?= h($practice->contact_name) ?></td>
                <td><?= h($practice->contact_phone) ?></td>
                <td><?= h($practice->contact_email) ?></td>
                <td><?= h($practice->website) ?></td>
                <td><?= $this->Number->format($practice->practitioner_count) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $practice->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $practice->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $practice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $practice->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>
				<?php
				echo $this->Paginator->counter(array(
	'format' => __('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}')
	));
	?>
			</p>

			<div class="pagination">
				<ul>
					<?php
					echo $this->Paginator->prev('&larr; ' . __('previous'),array('tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag'=>'li'));
					echo $this->Paginator->next(__('next') . ' &rarr;', array('tag' => 'li','escape' => false));
					?>
				</ul>
			</div>
</div>
</div>
</div>
<script>
removeUserSearchCookie();
$(document).ready(function() {	
	$('.pagination > ul > li').each(function() {
		if ($(this).children('a').length <= 0) {
			var tmp = $(this).html();
			if ($(this).hasClass('prev')) {
				$(this).addClass('disabled');
			} else if ($(this).hasClass('next')) {
				$(this).addClass('disabled');
			} else {
				$(this).addClass('active');
			}
			$(this).html($('<a></a>').append(tmp));
		}
	});
});
</script>