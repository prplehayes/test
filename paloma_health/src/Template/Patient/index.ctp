<div class="patient large-9 medium-8 columns content custom_design patienthead">
   <div class="top-header patienthead">
						<h2><i class="icon-child"></i><?php echo __('Manage Patients'); ?></h2></div>
<div class="row-fluid show-grid">
    <div class="span12" ><?php echo $this->Form->create('patient', array('action' => '','class'=>' form-signin form-horizontal')); ?>
      <?php echo $this->Form->hidden('filter',array('value'=>1)); ?>
      <div class="span10 nomarginleft">
        
      <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Patient Last Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false,'class'=>'input','value'=>$passArg['last_name'])); ?> </div>
      </div>
      <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;margin-top:10px;">Last 4 SS :</div>
        <div style="float:left"> <?php echo $this->Form->input('ssn1',array('label'=>false,'class'=>'input','value'=>$passArg['ssn1'])); ?> </div>
      </div>
      <div class="clear"></div>
     <div class="nomarginleft span6" style="margin-top:10px;">
		<div><strong>DOB</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_from',array('label'=>false,'class'=>'datepicker','value'=>$passArg['date_from'])); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_to',array('label'=>false,'class'=>'datepicker','value'=>$passArg['date_to'])); ?> </div>
        </div>
	</div>
      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary']) ?>&nbsp;<a href="javascript:void(0)"  class="btn btn-large" onClick="cancelSearch()">Clear All</a>
      </div>
	  <div class="input-append cust-btn-bx" style="float:right;">
				<button class="btn btn-success btn-blue" type="button"
				onclick="addPatient();">
				<i class="icon-white"></i>
				<?php echo __('+ Add Patient'); ?>
			</button>
			</div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>					
							
    <div class="row-fluid show-grid">
		<div class="span12">
			
			<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('first_name',"Patient Name") ?></th>
                <th><?= $this->Paginator->sort('ssn',"Last 4 SS") ?></th>
                <th><?= $this->Paginator->sort('dob') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patient as $patient): ?>
            <tr>
                
                <td><?= h($patient->first_name) ?>&nbsp;<?= h($patient->last_name) ?></td>
                <td><?= h(substr(str_replace("-","",$patient->ssn), -4)) ?></td>
                <td>
				<?php
				if(strlen($patient->dob)==6||strlen($patient->dob)==7||strlen($patient->dob)==8){
					$newdate=explode("/",$patient->dob);
					$patient->dob=$newdate[0]."/".$newdate[1]."/19".$newdate[2];
				}
				?>
				<?= h(date("m/d/Y",strtotime($patient->dob))) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $patient->id]) ?> |
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $patient->id]) ?> |
                    <?php if($loguser['group_id']==1){?>
					<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $patient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patient->id)]) ?> | <?php }?>
					<?= $this->Html->link(__('File Claim'), ['controller'=>'claim','action' => 'patientclaim', $patient->id]) ?> |
					<?= $this->Html->link(__('File Draft Claim'), ['controller'=>'claim','action' => 'patientdraftclaim', $patient->id]) ?>
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
function addPatient()
{
	window.location = '<?php echo $this->request->webroot?>patient/add';
}
function cancelSearch(){
	
	window.location = '<?php echo $this->request->webroot?>patient/?clear=1';
}
$(document).ready(function() {	
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
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
/*$(window).on('beforeunload', function(e) {
  console.log('page navigation captured');
  return 'By leaving this page you will lose the data you have entered here.';
});
window.onbeforeunload = function()
{
    return "Are you sure want to close";
}*/				  
</script>