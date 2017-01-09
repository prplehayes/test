<div class="patient large-9 medium-8 columns content custom_design patienthead">
   <div class="top-header patienthead">
						<h2><i class="icon-child"></i><?php echo __('Export Patients'); ?></h2></div>
<?php echo $this->Form->create('patient', array('action' => '','class'=>' form-signin form-horizontal')); ?>
<?php echo $this->Form->hidden('filterx',array('value'=>1)); ?>						
<div class="row-fluid show-grid">
    <div class="span12" >
     
      <div class="span10 nomarginleft">
     <div class="nomarginleft span6" style="margin-top:10px;">
		<div><strong>Date Patient was added</strong></div>
        <div class="clear">&nbsp;</div>
        <div class="control-group">
          <div style="float:left">From :</div>
          <div class="span4"><?php echo $this->Form->input('date_fromx',array('label'=>false,'class'=>'datepicker','value'=>$passArg['date_fromx'])); ?> </div>
          <div style="float:left">&nbsp;To :</div>
          <div class="span4"><?php echo $this->Form->input('date_tox',array('label'=>false,'class'=>'datepicker','value'=>$passArg['date_tox'])); ?> </div>
        </div>
	</div>
      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary','name'=>'search','value'=>"Search"]) ?>&nbsp;<a href="javascript:void(0)"  class="btn btn-large" onClick="cancelSearch()">Clear All</a>
      </div>
	  
      </div>
  </div>
  <div class="clear">&nbsp;</div>					
							
    <div class="row-fluid show-grid">
		<div class="span12">
			
			<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('first_name',"Patient Name") ?></th>
                
                <th><?= $this->Paginator->sort('dob') ?></th>
				<th><?= $this->Paginator->sort('created',"Created") ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
            <tr>
                
                <td><?= h($patient->first_name) ?>&nbsp;<?= h($patient->last_name) ?></td>
                <td><?= h(date("m/d/Y",strtotime($patient->dob))) ?></td>
				<td><?= str_replace("-","/",$patient->created); ?></td>
                
               
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
			
			<div align="center">
        <?= $this->Form->button(__('Export'),['class'=>'btn-primary','name'=>'export','value'=>"Export"]) ?>
      </div>
	 
		</div>
	</div>
     <?php echo $this->Form->end(); ?> 
</div>
<script>
function addPatient()
{
	window.location = '<?php echo $this->request->webroot?>patient/add';
}
function cancelSearch(){
	removeUserSearchCookie();
	window.location = '<?php echo $this->request->webroot?>patient/exportlist/?clear=1';
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

</script>