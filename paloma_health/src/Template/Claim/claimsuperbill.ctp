<div class="claim form large-9 medium-8 columns content custom_design">
  <?= $this->Form->create($patient,array('method' => 'post','class'=>'form-horizontal')) ?>
  <div class="top-header superbillhead">
						<h2><i class="icon-files-o"></i><?php echo __('Super Bill'); ?></h2></div>
						<br/>
 <br/>
 <div class="holder offset1">
  <?php
            echo $this->Form->hidden('patient_id', ['value' => $patient->id]);
           // echo $this->Form->input('claim_number');
			?>
			<div class="field_wrapper">
			<?php if (!empty($claim->cpt_codes)):
			$cpt=0; 
	  	foreach ($claim->cpt_codes as $cptCodes1):
		
		$sel1=0;
			foreach($cptCodes as $ckey=>$valc){
				if($valc==$cptCodes1->group){
					$sel1=$ckey;
				}
			}
			$cptCodes2=$cptmodel->find('all',array('fields'=>array('group'=>'CptCodes.group')))->where(['CptCodes.id'=>$sel1])->toArray();
		$cptCodes3 = $cptmodel->find('all')->where(['CptCodes.group'=>$cptCodes2[0]['group']]);
			
			?>
    <div class="input select cptlist cptlistexists_<?php echo $cptCodes1->id?>">
      <label for="cpt-codes-ids">Select Procedure Codes</label>
	  <?php
            echo $this->Form->input('cpt_codes._ids[]',['options' => $cptCodes,'empty'=>true,'value'=>$sel1,'required'=>true,'label'=>false,'class'=>'cptcodes']);
			?>
		
		<div class="subcpt">
			<?php 
$randno=mt_rand(1,20);
if (!empty($cptCodes3)): ?>
            <?php foreach ($cptCodes3 as $cptCode4):
			$chkcheck='';
			if($cptCodes1->_joinData->cpt_code_id==$cptCode4->id){
				$chkcheck='checked="checked"';
				$toothnumber=$cptCodes1->_joinData->tooth_number;
				$surface=$cptCodes1->_joinData->surface;
				$surface2=$cptCodes1->_joinData->surface2;
				$surface3=$cptCodes1->_joinData->surface3;
				$surface4=$cptCodes1->_joinData->surface4;
				$quadrent_1_code=$cptCodes1->_joinData->quadrent_1_code;
				$quadrent_2_code=$cptCodes1->_joinData->quadrent_2_code;
				$arch_code=$cptCodes1->_joinData->arch_code;
				$upper_or_lower=$cptCodes1->_joinData->upper_or_lower;
				$quadrent_or_arch_code=$cptCodes1->_joinData->quadrent_or_arch_code;
				
			}
			else{
				$toothnumber='';
				$surface='';
				$surface2='';
				$surface3='';
				$surface4='';
				$quadrent_1_code='';
				$quadrent_2_code='';
				$arch_code='';
				$upper_or_lower='';
				$quadrent_or_arch_code='';
			}
			 ?>
                <div class="cptoption"><input type="radio" required="required" data-code="<?= h($cptCode4->code) ?>" name="cptcode[<?php echo $randno?>]" value="<?= h($cptCode4->id) ?>" <?php echo $chkcheck;?>>&nbsp;<?= h($cptCode4->description) ?> (<?= h($cptCode4->code) ?>)	    
				&nbsp;&nbsp;&nbsp;&nbsp;<div class="addfld"><?php           
				if($cptCode4->required_tooth_number==1){
					
					?>
					TOOTH # : <input type="text" name="tooth_number<?php echo $randno?>_<?php echo $cptCode4->id?>[]" value="<?php echo $toothnumber;?>">
					<br>
					<?php
				}
				if($cptCode4->required_upper_or_lower==1){
					?>
					Upper or Lower : <select name="upper_or_lower<?php echo $randno?>_<?php echo $cptCode4->id?>[]"><option value="">Select</option>
					<option value="Upper" <?php if($upper_or_lower=='Upper'){ echo "selected='selected'";}?>>Upper</option>
					<option value="Lower" <?php if($upper_or_lower=='Lower'){ echo "selected='selected'";}?>>Lower</option>
					</select>
					<br>
					<?php
				}
				if($cptCode4->required_surface==1){
					?>
					<span>Surface : <select name="surface<?php echo $randno?>_<?php echo $cptCode4->id?>[]"><option value="">Select</option>
					<option value="M" <?php if($surface=='M'){ echo "selected='selected'";}?> >M</option>
					<option value="O" <?php if($surface=='O'){ echo "selected='selected'";}?> >O</option>
					<option value="D" <?php if($surface=='D'){ echo "selected='selected'";}?> >D</option>
					<option value="F" <?php if($surface=='F'){ echo "selected='selected'";}?> >F</option>
					<option value="L" <?php if($surface=='L'){ echo "selected='selected'";}?> >L</option>
					<option value="I" <?php if($surface=='I'){ echo "selected='selected'";}?> >I</option>
					</select></span>
					<br>
					<?php
				}
				if($cptCode4->required_surface2==1){
					?>
					<span>Surface 2 : <select name="surface2<?php echo $randno?>_<?php echo $cptCode4->id?>[]"><option value="">Select</option>
					<option value="M" <?php if($surface2=='M'){ echo "selected='selected'";}?>>M</option>
					<option value="O" <?php if($surface2=='O'){ echo "selected='selected'";}?>>O</option>
					<option value="D" <?php if($surface2=='D'){ echo "selected='selected'";}?>>D</option>
					<option value="F" <?php if($surface2=='F'){ echo "selected='selected'";}?>>F</option>
					<option value="L" <?php if($surface2=='L'){ echo "selected='selected'";}?>>L</option>
					<option value="I" <?php if($surface2=='I'){ echo "selected='selected'";}?>>I</option>
					</select></span>
					<br>
					<?php
				}
				if($cptCode4->required_surface3==1){
					?>
					<span>Surface 3 : <select name="surface3<?php echo $randno?>_<?php echo $cptCode4->id?>[]"><option value="">Select</option>
					<option value="M" <?php if($surface3=='M'){ echo "selected='selected'";}?>>M</option>
					<option value="O" <?php if($surface3=='O'){ echo "selected='selected'";}?>>O</option>
					<option value="D" <?php if($surface3=='D'){ echo "selected='selected'";}?>>D</option>
					<option value="F" <?php if($surface3=='F'){ echo "selected='selected'";}?>>F</option>
					<option value="L" <?php if($surface3=='L'){ echo "selected='selected'";}?>>L</option>
					<option value="I" <?php if($surface3=='I'){ echo "selected='selected'";}?>>I</option>
					</select></span>
					<br>
					<?php
				}
				if($cptCode4->required_surface4==1){
					?>
					<span>Surface 4 : <select name="surface4<?php echo $randno?>_<?php echo $cptCode4->id?>[]"><option value="">Select</option>
					<option value="M" <?php if($surface4=='M'){ echo "selected='selected'";}?>>M</option>
					<option value="O" <?php if($surface4=='O'){ echo "selected='selected'";}?>>O</option>
					<option value="D" <?php if($surface4=='D'){ echo "selected='selected'";}?>>D</option>
					<option value="F" <?php if($surface4=='F'){ echo "selected='selected'";}?>>F</option>
					<option value="L" <?php if($surface4=='L'){ echo "selected='selected'";}?>>L</option>
					<option value="I" <?php if($surface4=='I'){ echo "selected='selected'";}?>>I</option>
					</select></span>
					<br>
					<?php
				}
				if($cptCode4->required_quadrent_1_code==1){
					?>
					QUADRANT : <input type="text" name="quadrent_1_code<?php echo $randno?>_<?php echo $cptCode4->id?>[]" value="<?php echo $quadrent_1_code?>">
					<br>
					<?php
				}
				if($cptCode4->required_arch_code==1){
					?>
					Arch Code : <input type="text" name="arch_code<?php echo $randno?>_<?php echo $cptCode4->id?>[]" value="<?php echo $arch_code?>">
					<br>
					<?php
				}
				if($cptCode4->required_quadrent_or_arch_code==1){
					?>
					Quadrent or Arch code : <input type="text" name="quadrent_or_arch_code<?php echo $randno?>_<?php echo $cptCode4->id?>[]" value="<?php echo $quadrent_or_arch_code?>" >
					<br>
					<?php
				}
				?></div>
				</div>
				
				<div class="clear"></div>
            <?php 
			
			endforeach; ?>
			
<?php endif; ?>
		</div>
		<?php
				
				if($cpt>0){
			?>
			<a href="javascript:void(0);" class="remove_button" title="Remove field">X</a>
			<?php
			}
			?>
		</div>
		
		<?php 
		
		$cpt++;
		endforeach; ?>	
	  <?php else:?>
	   <div class="input select cptlist">
      <label for="cpt-codes-ids">Select Procedure Codes</label>
	   <?php
            echo $this->Form->input('cpt_codes._ids[]',['options' => $cptCodes,'empty'=>true,'value'=>'','required'=>true,'label'=>false,'class'=>'cptcodes']);
			?>
			<div class="subcpt"></div>
			</div>
	  <?php endif; ?>
  </div>
  
  <div class="clear"><a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field">Add CPT</a></div>
  <br>
  </div>		
<div class="greybg" style="padding-left:8.382978723%">
  <div class="field_wrapper2">
  <?php
  if (!empty($claim->icd10_codes)):
  foreach ($claim->icd10_codes as $cptCodes1):
  $sel1=0;
			foreach($icd10Codes as $ckey=>$valc){
				if($valc==$cptCodes1->group){
					$sel1=$ckey;
				}
			}
			
  ?>
    <div class="input select icd10list">
      <label for="icd10-codes-ids">Select ICD 10 Codes</label>
      <?php
            echo $this->Form->input('icd10_codes._ids[]',['options' => $icd10Codes,'empty'=>true,'value'=>$sel1,'required'=>true,'label'=>false,'class'=>'icd10codes']);
			?>
    <div class="subicd10">
	<?php
	$cptCodes12 = $icdmodel->find('all',array('fields'=>array('group'=>'Icd10Codes.group')))->where(['Icd10Codes.id'=>$sel1])->toArray();
		$icd10Codes2 = $icdmodel->find('all')->where(['Icd10Codes.group'=>$cptCodes12[0]['group']]);
		 
$randno=mt_rand(1,20);
if (!empty($icd10Codes2)): ?>
            <?php foreach ($icd10Codes2 as $icd10Code3):
			$chkcheck='';
			if($cptCodes1->_joinData->icd10_code_id==$icd10Code3->id){
				$chkcheck='checked="checked"';
			}	
			 ?>
                <div class="icdoption"><input type="radio" data-code="<?= h($icd10Code3->code) ?>" name="icd10code[<?php echo $randno?>]" value="<?= h($icd10Code3->id) ?>" required="required" <?php echo $chkcheck;?>>&nbsp;<?= h($icd10Code3->description) ?> (<?= h($icd10Code3->code) ?>)	    
				</div>
				<div class="clear"></div>
            <?php endforeach; ?>
<?php endif; ?>
	</div>
	</div>
	 <?php endforeach; ?>
	 <?php else: ?>
		 <div class="input select icd10list">
		  <label for="icd10-codes-ids">Select ICD 10 Codes</label>
		  <?php
				echo $this->Form->input('icd10_codes._ids[]',['options' => $icd10Codes,'empty'=>true,'value'=>'','required'=>true,'label'=>false,'class'=>'icd10codes']);
				?>
		<div class="subicd10">
		</div>
		</div>
	 <?php endif; ?>
  </div>
  <div class="clear"><a href="javascript:void(0);" class="add_button2 btn btn-primary" title="Add field">Add ICD10</a></div>
  
  <br>
    <div class="input select">	
  <label for="icd10-codes-ids">Super Bill Notes</label> 
  <?php echo $this->Form->input('comments', ['label'=>false,'div'=>false,'class'=>'input','type'=>'textarea']);?>
  </div>
   <br>
	  Date of Service : <?php echo date("m/d/Y",strtotime($claim->date_of_service));?><br>
	  <br>
  <?php
			
            
           /// echo $this->Form->file('progress_notes_upload',['label' => 'Progress Notes Upload']);
           // echo $this->Form->input('title');
           // echo $this->Form->input('signature');
            echo $this->Form->hidden('date_of_service',['value'=>date("m/d/Y",strtotime($claim->date_of_service))]);
           // echo $this->Form->input('comments');
			?>
  
  <div class="clear"></div>
  <div style="float:left;"><?= $this->Form->button(__('Next'),['class'=>'btn-primary submitfrm']) ?></div>
  </div>
  
  <br><br>
  <div class="clear">&nbsp;</div>
  <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
$(document).ready(function($){

    var maxField = 10; //Input fields increment limitation
	var maxField2 = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
	var addButton2 = $('.add_button2'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
	 var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    var fieldHTML = '<div class="input select cptlist"><label>CPT Codes</label><?php echo $this->Form->input('cpt_codes._ids[]', ['options' => $cptCodes,'empty'=>true,'label'=>false,'class'=>'cptcodes']);?><div class="subcpt"></div><a href="javascript:void(0);" class="remove_button" title="Remove field">X</a></div>';
	var fieldHTML2 = '<div class="input select icd10list"><label>ICD10 Codes</label><?php echo $this->Form->input('icd10_codes._ids[]',['options' => $icd10Codes,'empty'=>true,'label'=>false,'class'=>'icd10codes']);?><div class="subicd10"></div><a href="javascript:void(0);" class="remove_button2" title="Remove field">X</a></div>';
    var x = 1; //Initial field counter is 1
	var y = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
       
		if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
	$(addButton2).click(function(){ //Once add button is clicked
       
		if(y < maxField2){ //Check maximum number of input fields
            y++; //Increment field counter
            $(wrapper2).append(fieldHTML2); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
	    e.preventDefault();
		var obj=$(this);
		obj.parent('div').remove(); //Remove field html
        x--; //Decrement field counter
			});
	$(wrapper2).on('click', '.remove_button2', function(e){ //Once remove button is clicked
	    e.preventDefault();
		var obj=$(this);
		obj.parent('div').remove(); //Remove field html
        y--; //Decrement field counter
			});		
$(".cptcodes").live("change",function(){
	$(this).parents().next(".subcpt").load("<?php echo $this->request->webroot?>claim/ajax_listcptcode/"+$(this).val())
});
$(".icd10codes").live("change",function(){
	$(this).parents().next(".subicd10").load("<?php echo $this->request->webroot?>claim/ajax_listicdcode/"+$(this).val())
});
//$(".cptcodes").change();
$(".cptoption").live("click",function(){
	var result='';
	$(".addfld input").removeAttr('required');
	$(".addfld select").removeAttr('required');
	$('.cptoption input:checked').each(function () {
	$(".cptoption input").removeAttr('required');
		var nxt_too = $(this).next('.addfld');
		nxt_too.find('input').attr('required','required');
		nxt_too.find('select').attr('required','required');
        result += "&nbsp;&nbsp;" + $(this).attr("data-code");
    });
});
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
});
</script>