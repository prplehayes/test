<div class="claim large-9 medium-8 columns content custom_design">
    <div class="top-header claimhead">
						<h2><i class="icon-files-o"></i><?php echo __('Draft Claim'); ?></h2></div>
<div class="row-fluid show-grid">
		<div class="span12">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
               
                <th><?= $this->Paginator->sort('first_name',"Patient Name") ?></th>
				<th ><?= $this->Paginator->sort('user_id',"Doctor") ?></th>
                <th width="120"><?= $this->Paginator->sort('ssn',"Last 4 SS") ?></th>
				<th><?= $this->Paginator->sort('date_of_service',"Date of Service") ?></th>
				<th class="sort"><?= $this->Paginator->sort('created',"Submitted Date") ?></th>
				<th width="140"><?= $this->Paginator->sort('claim_number',"Ref #") ?></th>
                <th><?= $this->Paginator->sort('claim_status_id',"Claim Status") ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($claim as $claim):
			 ?>
            <tr>
               
                <td><?= $claim->has('patient') ? $this->Html->link($claim->patient->first_name." ".$claim->patient->last_name, ['controller' => 'Patient', 'action' => 'view', $claim->patient->id]) : '' ?></td>
                <td><?php if($claim->user_id>1){echo $userslist[$claim->user_id];} ?></td>
				<td><?= h(substr(str_replace("-","",$claim->patient->ssn), -4)) ?></td>
				<td><?php 
				if($claim->date_of_service=='1970-01-01'){}
				else{
				echo date("m/d/Y",strtotime($claim->date_of_service));
				}
				?></td>
				<td><?php echo str_replace("-","/",$claim->created);?></td>
				<!--<td><?php //echo $practice[$claim->patient->practice_id];?></td>-->
				<td><?= h($claim->claim_number) ?></td>
                <td>
				<?php if($claim->claim_status->name=='New'){$claim->claim_status->name="Pending Review";}?>
				<?= $claim->claim_status->name ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $claim->id]) ?> | 
                   <?= $this->Html->link(__('Process'), ['action' => 'processdraft', $claim->id]) ?> | 
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $claim->id], ['confirm' => __('Are you sure you want to delete # {0}?', $claim->id)]) ?>
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
window.onhashchange = function() {

}
</script>