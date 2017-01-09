<div class="claim form large-9 medium-8 columns content">
  <?= $this->Form->create($patientclaim,array('type' => 'file','class'=>'form-horizontal')) ?>
  <fieldset>
  <legend>
  <?= __('Add Claim') ?>
  </legend>
  <?php
            echo $this->Form->hidden('patient_id', ['value' => $patient_id]);
            echo $this->Form->input('claim_number');
            echo $this->Form->input('claim_status_id', ['options' => $claimStatus]);
			?>
  <div class="input text">
    <label for="dental_verification_upload">Dental Verification Upload</label>
    <?php echo $this->Form->file('dental_verification_upload',['label' => 'Dental Verification Upload']);?> </div>
  <div class="input text">
    <label for="progress_notes_upload">Progress Notes Upload</label>
    <?php echo $this->Form->file('progress_notes_upload',['label' => 'Progress Notes Upload']);?> </div>
  <?php
			
            
           /// echo $this->Form->file('progress_notes_upload',['label' => 'Progress Notes Upload']);
            echo $this->Form->input('title');
            echo $this->Form->input('signature');
            echo $this->Form->input('date_of_service',['type'=>'text','class'=>'datepicker']);
            echo $this->Form->input('comments');
			?>
  <div class="field_wrapper">
    <div class="input select">
      <label for="icd10-codes-ids">CPT Codes</label>
      <?php
            echo $this->Form->select('cpt_codes._ids[]',['options' => $cptCodes],['class'=>'cptcodes']);
			?>
    </div>
  </div>
  <div class="clear"><a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field">Add CPT</a></div>
  <div class="field_wrapper2">
    <div class="input select">
      <label for="icd10-codes-ids">ICD10 Codes</label>
      <?php
            echo $this->Form->select('icd10_codes._ids[]',['options' => $icd10Codes],['class'=>'icd10codes']);
			?>
    </div>
  </div>
  <div class="clear"><a href="javascript:void(0);" class="add_button2 btn btn-primary" title="Add field">Add ICD10</a></div>
  </fieldset>
  <?= $this->Form->button(__('Submit')) ?>
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
    var fieldHTML = '<div class="input select"><label>CPT Codes</label><?php echo $this->Form->select('cpt_codes._ids[]', ['options' => $cptCodes],['class'=>'cptcodes']);?><a href="javascript:void(0);" class="remove_button" title="Remove field">X</a></div>';
	var fieldHTML2 = '<div class="input select"><label>ICD10 Codes</label><?php echo $this->Form->select('icd10_codes._ids[]', ['options' => $icd10Codes],['class'=>'icd10codes']);?><a href="javascript:void(0);" class="remove_button2" title="Remove field">X</a></div>';
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

$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
			
});
</script>