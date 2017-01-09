<div class="claim large-9 medium-8 columns content custom_design">
<?php if($currentloguser['group_id']==5){
?>
<div class="top-header claimhead">
						<h2><i class="icon-files-o"></i><?php echo __('Manage Claim'); ?></h2></div>
<div class="inner-header">
	<h3><?php echo __('Pending Review'); ?></h3>
	</div>
	<div class="row-fluid show-grid">
    <div class="span12" ><?php echo $this->Form->create('claim', array('action' => '','class'=>' frmfilterpr form-horizontal')); ?>
     
      <div class="span10 nomarginleft">
        
      <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Patient First Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('first_name',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
	  <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Patient Last Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
	  <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;margin-top:10px;">Last 4 SS:</div>
        <div style="float:left"> <?php echo $this->Form->input('ssn1',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;margin-top:10px;">Ref #:</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      <div class="clear"></div>
     
      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary btnpr','type'=>'button']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>					
		
	<div id="pendingreviewclaim"></div>
	<div class="inner-header">
	<h3><?php echo __('Correction Needed'); ?></h3>
	</div>
	<div class="row-fluid show-grid">
    <div class="span12" ><?php echo $this->Form->create('claim', array('action' => '','class'=>' frmfiltercrc form-horizontal')); ?>
     
      <div class="span10 nomarginleft">
       <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Patient First Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('first_name',array('label'=>false,'class'=>'input')); ?> </div>
      </div> 
      <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Patient Last Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
	  <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;margin-top:10px;">Last 4 SS:</div>
        <div style="float:left"> <?php echo $this->Form->input('ssn1',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;margin-top:10px;">Ref #:</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      <div class="clear"></div>
     
      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary btncrc','type'=>'button']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>
	<div id="correctionclaim"></div>
	
	<div class="inner-header">
	<h3><?php echo __('Denied Claims'); ?></h3>
	</div>
	<div class="row-fluid show-grid">
    <div class="span12" ><?php echo $this->Form->create('claim', array('action' => '','class'=>' frmfilterdn form-horizontal')); ?>
     
      <div class="span10 nomarginleft">
        <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Patient First Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('first_name',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;">Patient Last Name :</div>
        <div style="float:left"> <?php echo $this->Form->input('last_name',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
	  <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;margin-top:10px;">Last 4 SS:</div>
        <div style="float:left"> <?php echo $this->Form->input('ssn1',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      <div class="nomarginleft span5" style="margin-top:10px;">
        <div style="float:left;margin-right:10px;width:130px;margin-top:10px;">Ref #:</div>
        <div style="float:left"> <?php echo $this->Form->input('claim_number',array('label'=>false,'class'=>'input')); ?> </div>
      </div>
      <div class="clear"></div>
     
      </div>
      <div class="clear">&nbsp;</div>
      <div style="float:left">
        <?= $this->Form->button(__('Search'),['class'=>'btn-primary btndn','type'=>'button']) ?>&nbsp;<a href="<?php echo $this->request->webroot?>claim"  class="btn btn-large">Clear All</a>
      </div>
      <?php echo $this->Form->end(); ?> </div>
  </div>
  <div class="clear">&nbsp;</div>
	<div id="deniedclaim"></div>
	<script>
	jQuery('#pendingreviewclaim').load("<?php echo $this->request->webroot?>claim/ajax_claimpendingreview");
jQuery('#correctionclaim').load("<?php echo $this->request->webroot?>claim/ajax_claimforcorrection");
jQuery('#deniedclaim').load("<?php echo $this->request->webroot?>claim/ajax_deniedclaim");
$(document).ready(function() {	
	$(".btnpr").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_claimpendingreview",type: "POST",data:$(".frmfilterpr").serialize(), success: function(result){
	$("#pendingreviewclaim").html(result);         
        }});
	});	
	$(".btncrc").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_claimforcorrection",type: "POST",data:$(".frmfiltercrc").serialize(), success: function(result){
	$("#correctionclaim").html(result);         
        }});
	});	
	$(".btndn").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_deniedclaim",type: "POST",data:$(".frmfilterdn").serialize(), success: function(result){
	$("#deniedclaim").html(result);         
        }});
	});	
});
	</script>
<?php
}else{?>
    <div class="top-header claimhead">
						<h2><i class="icon-files-o"></i><?php echo __('Manage Claim'); ?></h2></div>
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
				<td><?php echo date("m/d/Y",strtotime($claim->date_of_service));?></td>
				<td><?php echo str_replace("-","/",$claim->created);?></td>
				<!--<td><?php //echo $practice[$claim->patient->practice_id];?></td>-->
				<td><?= h($claim->claim_number) ?></td>
                <td>
				<?php if($claim->claim_status->name=='New'){$claim->claim_status->name="Pending Review";}?>
				<?= $claim->claim_status->name ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $claim->id]) ?> | 
                   <?php /*?> <?= $this->Html->link(__('Edit'), ['action' => 'edit', $claim->id]) ?><?php */?>
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
<?php }?>
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