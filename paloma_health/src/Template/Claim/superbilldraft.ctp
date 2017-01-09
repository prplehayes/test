<div class="claim form large-9 medium-8 columns content custom_design">
  <?= $this->Form->create($patient,array('method' => 'post','class'=>'form-horizontal')) ?>
   <div class="top-header superbillhead">
						<h2><i class="icon-clipboard"></i><?php echo __('Super Bill'); ?></h2></div>

 <br/>
 <br/>
  <?php
            echo $this->Form->hidden('patient_id', ['value' => $patient->id]);
           // echo $this->Form->input('claim_number');
			?>
            <div class="holder offset1 ">
			<div class="field_wrapper">
			
    <div class="input select cptlist">
      <label for="icd10-codes-ids">Select Procedure Codes</label>
      <?php
            echo $this->Form->input('cpt_codes._ids[]',['options' => $cptCodes,'empty'=>true,'value'=>'','div' => false,'label'=>false,'required'=>false,'class'=>'cptcodes']);
			?>
    <div class="subcpt span11 nomarginleft"></div>
	</div>
  </div>
  <div class="clear"><a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field">Add CPT</a></div>
  <br/>
  <br/>
  </div>		
<div class="greybg" style="padding-left:8.382978723%">
  <div class="field_wrapper2">
    <div class="input select icd10list">
      <label for="icd10-codes-ids">Select ICD 10 Codes</label>
      <?php
            echo $this->Form->input('icd10_codes._ids[]',['options' => $icd10Codes,'empty'=>true,'value'=>'','label'=>false,'required'=>false,'class'=>'icd10codes']);
			?>
    <div class="subicd10 span11 nomarginleft"></div>
	</div>
  </div>
  <div class="clear"><a href="javascript:void(0);" class="add_button2 btn btn-primary" title="Add field">Add ICD10</a></div>
  <br>
    <br>
	 <div class="input select">	
  <label for="icd10-codes-ids">Super Bill Notes</label> 
  <?php echo $this->Form->input('comments', ['label'=>false,'div'=>false,'class'=>'input','type'=>'textarea']);?>
  </div>
	  <br>
	  
  <?php
			
            
           /// echo $this->Form->file('progress_notes_upload',['label' => 'Progress Notes Upload']);
           // echo $this->Form->input('title');
           // echo $this->Form->input('signature');
            echo $this->Form->input('date_of_service',['type'=>'text','required'=>false,'class'=>'datepicker']);
           // echo $this->Form->input('comments');
			?>
  </div>
  <div class="clear"> &nbsp;</div>
  
  <div style="float:left;margin-left:40px;"><?= $this->Form->button(__('Next'),['class'=>'btn-primary submitfrm']) ?></div>
  
  <br>
  <br>
  </div>
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