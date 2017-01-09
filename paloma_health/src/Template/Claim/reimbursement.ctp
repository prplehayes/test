<div class="patient large-9 medium-8 columns content custom_design">
   <div class="top-header patienthead">
						<h2><i class="icon-child"></i><?php echo __('Existing Patients'); ?></h2></div>
						<div class="row-fluid show-grid">
		
		<div class="span6">
		<div class="input-append cust-btn-bx">
				<button class="btn btn-success btn-blue" type="button"
				onclick="addPatient();">
				<i class="icon-white"></i>
				<?php echo __('+ Add Patient'); ?>
			</button>
			</div>
		</div>
		<div class="span6" style="text-align:right;">
		<?php echo $this->Form->create('Claim', array('action' => 'reimbursement','class'=>' form-signin form-horizontal')); ?>
			<div class="input-append searchbox" style="margin-right:20px;">
				<?php echo $this->Form->input('filter',array('div' => false,'label'=>false,'placeholder'=>"Search Patient",'class'=>'input-xlarge')); ?>
				<button class="btn searchbtn" type="submit">
					<?php echo __('Search'); ?>
				</button>
				<button class="btn cancelbtn" type="button" onclick="cancelSearch();">
					<i class="icon-remove-sign"></i>
				</button>
			</div>
			<?php echo $this->Form->end(); ?>
         </div>	
	</div>
	
    <div class="row-fluid show-grid">
		<div class="span12">
			
			<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('first_name',"Patient Name") ?></th>
                <th><?= $this->Paginator->sort('ssn',"Last 4 SS") ?></th>
                <th><?= $this->Paginator->sort('dob') ?></th>
                <th class="actions"><?= __('File Request') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patient as $patient): ?>
            <tr>
                <td><?= $this->Number->format($patient->id) ?></td>
                
                <td><?= h($patient->first_name) ?>&nbsp;<?= h($patient->last_name) ?></td>
                <td><?= h($patient->ssn) ?></td>
                <td><?= h(date("m/d/Y",strtotime($patient->dob))) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('File Request'), ['action' => 'verifypatient', $patient->id]) ?>
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
function addPatient()
{
	window.location = '<?php echo $this->request->webroot?>patient/add';
}
function cancelSearch(){
	removeUserSearchCookie();
	window.location = '<?php echo $this->request->webroot?>patient';
}
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