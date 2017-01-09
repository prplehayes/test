<div class="patient form large-9 medium-8 columns content custom_design patienthead">
<div class="top-header patienthead">
						<h2><i class="icon-user-plus"></i><?php echo __('Add Patient'); ?></h2></div>
						<div class="row-fluid show-grid">
    <?= $this->Form->create($patient,array('type' => 'file','class'=>'form-horizontal')) ?>
    
        
		<div class="span12">
		<div class="frm-head row-fluid">
<div class="span8"><h2>PI - Patient Information</h2></div>
<div class="frm-bt span4"></div>
</div>

		<div class="control-group">
			<div class="span2 required"><label class="control-label"><?= __('Practice') ?></label></div>
			<div class="controls span4">
			<?php 
	  if($practice_id>0){
	  $pp=$practice->toArray();
	  echo $pp[$practice_id];
	  	 echo $this->Form->hidden('practice_id', ['value' =>$practice_id]);
	  }
	  else{
	 	 echo $this->Form->input('practice_id', ['options' => $practice,'label'=>false,'div'=>false,'class'=>'input']);
	  }
	  ?>
			</div>
			<div class="span1 required"><label class="control-label"><?= __('Gender') ?></label></div>
			<div class="controls span4 inline-radio"><?php echo $this->Form->radio('gender',[['value' => 'Male', 'text' => ' Male'],
        ['value' => 'Female', 'text' => ' Female']]);?></div>
		</div>
		<div class="clear"></div>
		<div class="control-group">
			<div class="span2 required"><label class="control-label"><?= __('First Name') ?></label></div>
			<div class="controls span4"><?php echo $this->Form->input('first_name', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'First Name','required'=>true]);?></div>
		</div>
		<div class="clear"></div>
		<div class="control-group">
			<div class="span2"><label class="control-label"><?= __('Middle Name') ?></label></div>
			<div class="controls span4"><?php echo $this->Form->input('middle_name', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'Middle Name']);?></div>
		</div>
		<div class="clear"></div>
		<div class="control-group">
			<div class="span2 required"><label class="control-label"><?= __('Last Name') ?></label></div>
			<div class="controls span4"><?php echo $this->Form->input('last_name', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'Last Name','required'=>true]);?></div>
		</div>
		<div class="clear"></div>
		<div class="control-group">
			<div class="span2"><label class="control-label"><?= __('SSN') ?></label></div>
			<div class="controls span4"><?php echo $this->Form->input('ssn', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'Social Security Number','required'=>false]);?></div>
			<div class="span2 "><label class="control-label"><?= __('Medical Number') ?></label></div>
			<div class="controls span4"><?php echo $this->Form->input('medicare_number', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'Medical Number','required'=>false]);?></div>
		</div>
		<div class="clear"></div>
		<div class="control-group">
			<div class="span2 required"><label class="control-label"><?= __('DOB') ?></label></div>
			<div class="controls span4"><?php echo $this->Form->input('dob', ['label'=>false,'div'=>false,'type'=>'text','class'=>'datepicker input','Placeholder'=>'Date of birth','required'=>true]);?>
			<strong><span id="ageTextBox"></span></strong>
			</div>
			<div class="span2 "><label class="control-label"><?= __('Patient Id') ?></label></div>
			<div class="controls span4"><?php 
			echo $this->Form->hidden('patient_id', ['value' =>$patientId]);
			echo $patientId;?></div>
		</div>
		<div class="clear"></div>
		<div class="control-group">
			<div class="span2 "><label class="control-label"><?= __('Street Address') ?></label></div>
			<div class="controls span3"><?php echo $this->Form->input('address_1', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Street Address']);?></div>
			<div class="span1 "><label class="control-label"><?= __('Apt/Suite ') ?></label></div>
			<div class="controls span2"><?php echo $this->Form->input('address_2', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Apt/Suite']);?></div>
			<div class="span1 "><label class="control-label"><?= __('PO Box') ?></label></div>
			<div class="controls span2"><?php echo $this->Form->input('po_box', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'PO Box']);?></div>
		</div>
		<div class="clear"></div>
		<div class="control-group">
			<div class="span2 "><label class="control-label"><?= __('City') ?></label></div>
			<div class="controls span3"><?php echo $this->Form->input('city', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'City']);?></div>
			<div class="span1 "><label class="control-label"><?= __('State ') ?></label></div>
			<div class="controls span2"><?php echo $this->Form->input('state', ['options'=>$states,'empty'=>"select",'label'=>false,'div'=>false,'class'=>' input','Placeholder'=>'State']);?></div>
			<div class="span1 "><label class="control-label"><?= __('Zip Code') ?></label></div>
			<div class="controls span2"><?php echo $this->Form->input('zip', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','maxlength'=>5,'Placeholder'=>'Zip Code']);?></div>
		</div>
		<div class="clear"></div>
		<div class="control-group">
			<div class="span2 "><label class="control-label"><?= __('Home Phone') ?></label></div>
			<div class="controls span3"><?php echo $this->Form->input('home_phone', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Home Phone']);?></div>
						<div class="span1"><label class="control-label"><?= __('Email') ?></label></div>
			<div class="controls span3"><?php echo $this->Form->input('email', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Email']);?></div>
			
		</div>
		<div class="clear"></div>
		<div class="control-group">

			<div class="span2"><label class="control-label"><?= __('Cell Phone') ?></label></div>
			<div class="controls span3"><?php echo $this->Form->input('cell', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Cell Phone']);?></div>
			<div class="span2"><label class="control-label"><?= __('Text Messages ?') ?></label></div>
			<div class="controls span3"><?php 
			$options = [
    '0' => 'No',
    '1' => 'Yes'
];
echo $this->Form->select('text_messages_active', $options, [
    'dis'=>false
]);
			?></div>
		</div>
		<div class="clear"></div>
		<div class="clear"></div>
    <div class="frm-head row-fluid">
      <div class="span8">
        <h2>RP - Responsible Party/Guarantor</h2>
      </div>
      <div class="frm-bt span4"><?php echo $this->Form->checkbox('sameadd' , ['label'=>'Same as Personal Address','div'=>false,'Placeholder'=>'Same as Personal Address']); ?> Same as Personal Address</div>
    </div>
    <div class="control-group">
    <div class="span6">
      <div class="control-group">
        <div class="span4 ">
          <label class="control-label">
          <?= __('First Name') ?>
          </label>
        </div>
        <div class="controls span6"><?php echo $this->Form->input('RP.first_name',['label'=>false,'div'=>false,'class'=>'input','required'=>false,'Placeholder'=>'First Name']);?></div>
      </div>
      <div class="clear"></div>
      <div class="control-group">
        <div class="span4">
          <label class="control-label">
          <?= __('Middle Name') ?>
          </label>
        </div>
        <div class="controls span6"><?php echo $this->Form->input('RP.middle_name', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'Middle Name']);?></div>
      </div>
      <div class="clear"></div>
      <div class="control-group">
        <div class="span4">
          <label class="control-label">
          <?= __('Last Name') ?>
          </label>
        </div>
        <div class="controls span6"><?php echo $this->Form->input('RP.last_name', ['label'=>false,'div'=>false,'class'=>'input','required'=>false,'Placeholder'=>'Last Name']);?></div>
      </div>
      <div class="clear"></div>
      <div class="control-group">
        <div class="span4">
          <label class="control-label">
          <?= __('DOB') ?>
          </label>
        </div>
        <div class="controls span6"><?php echo $this->Form->input('RP.dob', ['label'=>false,'div'=>false,'type'=>'text','required'=>false,'class'=>'datepicker input','Placeholder'=>'Date of birth']);?>
		<strong><span id="rpageTextBox"></span></strong>
		</div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="span6">
      <div class="control-group">
        <div class="span2">
          <label class="control-label">
          <?= __('Gender') ?>
          </label>
        </div>
        <div class="controls span10"><?php echo $this->Form->radio('RP.gender',[['value' => 'Male', 'text' => ' Male'],
        ['value' => 'Female', 'text' => ' Female']],['required'=>false]);?></div>
      </div>
      <div class="clear"></div>
      <div class="control-group">
        <div class="span2 ">
          <label class="control-label">
          <?= __('Relationship') ?>
          </label>
        </div>
		<div class="clear"></div>
        <div class="controls span10 inline-radio"><?php echo $this->Form->radio('RP.relationship',[['value' => 'Self', 'text' => ' Self'],['value' => 'Sibling', 'text' => ' Sibling'],
        ['value' => 'Parent', 'text' => ' Parent'],['value' => 'Grandparent', 'text' => ' Grandparent'],['value' => 'Aunt/Uncle', 'text' => ' Aunt/Uncle'],['value' => 'Neighbor', 'text' => ' Neighbor'],['value' => 'Friend', 'text' => ' Friend'],['value' => 'Other', 'text' => ' Other']]);?></div>
      </div>
    </div>
    </div>
    <div class="control-group">
      <div class="span2 ">
        <label class="control-label">
        <?= __('Street Address') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('RP.address_1', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Street Address']);?></div>
      <div class="span1 ">
        <label class="control-label">
        <?= __('Apt/Suite ') ?>
        </label>
      </div>
      <div class="controls span2"><?php echo $this->Form->input('RP.address_2', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Apt/Suite']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2 ">
        <label class="control-label">
        <?= __('City') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('RP.city', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'City']);?></div>
      <div class="span1 ">
        <label class="control-label">
        <?= __('State ') ?>
        </label>
      </div>
      <div class="controls span2"><?php echo $this->Form->input('RP.state', ['options'=>$states,'empty'=>"select",'label'=>false,'div'=>false,'class'=>' input','Placeholder'=>'State']);?></div>
      <div class="span1 ">
        <label class="control-label">
        <?= __('Zip Code') ?>
        </label>
      </div>
      <div class="controls span2"><?php echo $this->Form->input('RP.zip', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','maxlength'=>5,'Placeholder'=>'Zip Code']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2 ">
        <label class="control-label">
        <?= __('Home Phone') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('RP.home_phone', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Home Phone']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Cell Phone') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('RP.cell', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Cell Phone']);?></div>
    </div>
    <div class="clear"></div>
    
		<div class="frm-head row-fluid">
<div class="span8"><h2>VI - Verification Information</h2></div>
<div class="frm-bt span4"></div>
</div>
<div class="control-group">

			<div class="span2 "><label class="control-label"><?= __('Photo Id') ?></label></div>
			<div class="controls span3"><?php echo $this->Form->file('img_photo_id_upload', ['label'=>false,'required'=>false,'div'=>false]);?></div>
			
		</div>
		<div class="clear"></div>
<div class="control-group">

			<div class="span2 "><label class="control-label"><?= __('Medical Card') ?></label></div>
			<div class="controls span3"><?php echo $this->Form->file('img_medicare_card', ['label'=>false,'required'=>false,'div'=>false]);?></div>
			
		</div>
		<div class="clear"></div>
<div class="control-group">

			<div class="span2 "><label class="control-label"><?= __('Consent Form') ?></label></div>
			<div class="controls span3"><?php echo $this->Form->file('consent_form_upload', ['label'=>false,'required'=>false,'div'=>false]);?></div>
			
		</div>
		<div class="clear"></div>		
		<div class="control-group">

			<div class="span2 "><label class="control-label"><?= __('Registration Form') ?></label></div>
			<div class="controls span3"><?php echo $this->Form->file('registration_form_upload', ['label'=>false,'required'=>false,'div'=>false]);?></div>
			
		</div>
		<div class="clear"></div>		
        <div class="frm-head row-fluid">
      <div class="span8">
        <h2>API - Additional Patient Information</h2>
      </div>
      <div class="frm-bt span4"></div>
    </div>
	<div class="control-group">
      <div class="span3 ">
        <label class="control-label">
        <?= __('Average Household Income') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PI.average_household_income', ['label'=>false,'required'=>false,'div'=>false,'type'=>'text','class'=>' input']);?></div>
      <div class="clear"></div>
	  
      <div class="controls inline-radio span4 nomarginleft ">
        <?php 
			$options = [
    'Weekly' => ' Weekly',
    'Bi-Weekly' => ' Bi-Weekly',
	'Twice a Month' => ' Twice a Month',
	'Monthly' => ' Monthly',
	'Quarterly' => ' Quarterly',
	'Yearly' => ' Yearly',
	'Refused to Report' => ' Refused to Report'
];
echo $this->Form->radio('PI.pay_frequency', $options, ['div'=>false,'required'=>false
]);
			?>
      </div>
    </div>
	<div class="clear"></div>
	<div class="control-group">
      <div class="span3 ">
        <label class="control-label">
        <?= __('No of household Members') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PI.number_of_household_members', ['label'=>false,'div'=>false,'required'=>false,'type'=>'text','class'=>' input']);?></div>
     <div class="clear"><br></div>
	  <div class="span5 nomarginleft ">
	  <label class="control-label">
        <?= __('Housing Status') ?>
        </label>
		 <div class="clear"></div>
      <div class="controls inline-radio nomarginleft">
        <?php 
			$options = [
    'Not Homeless' => ' Not Homeless',
    'Homeless' => ' Homeless',
	'Shelter' => ' Shelter',
	'Doubling Up'=>' Doubling Up',
	'Street'=>' Street',
	'Transitional'=>' Transitional',
	'Unknown'=>' Unknown',
	'Other' => ' Other'
];
echo $this->Form->radio('PI.housing_status', $options, ['div'=>false,'required'=>false
]);
			?>
      </div>
	  </div>
	  <div class="span5 ">
	  <label class="control-label">
        <?= __('Primary Language') ?>
        </label>
		 <div class="clear"></div>
      <div class="controls inline-radio">
        <?php 
			$options = [
    'English' => ' English',
    'Spanish' => ' Spanish',
	'Arabic' => ' Arabic',
	'Chinese' => ' Chinese',
	'French' => ' French',
	'German' => ' German',
	'Italian' => ' Italian',
	'Japanese' => ' Japanese',
	'Portuguese' => ' Portuguese',
	'Sign Language' => ' Sign Language',
	'Unreported/refused to report' => ' Unreported/refused to report',
	'Other' => ' Other'
];
echo $this->Form->select('PI.primary_language', $options, ['div'=>false,'required'=>false
]);
			?>
      </div>
	  </div>
    </div>
	<div class="clear"></div>
	<div class="control-group">
      <div class="span3 ">
        <label class="control-label">
        <?= __('Race') ?>
        </label>
      </div>
	   <div class="clear"></div>
      <div class="controls inline-radio nomarginleft race">
        <?php 
			$options = [
    'White' => ' White',
    'American Indian/Alaskan Native' => ' American Indian/Alaskan Native',
	'Black African American' => ' Black African American',
	'Asian' => ' Asian',
	'Native Hawaiian' => ' Native Hawaiian',
	'Other Pacific Islander' => ' Other Pacific Islander',
	'Refused to Report/Unreported' => ' Refused to Report/Unreported',
	
];
echo $this->Form->radio('PI.race', $options, ['div'=>false,'required'=>false
]);
			?>
      </div>
	</div>  
	<div class="clear"></div>
	<div class="control-group">
      <div class="span3 ">
        <label class="control-label">
        <?= __('Ethnicity') ?>
        </label>
      </div>
	   <div class="clear"></div>
      <div class="controls inline-radio1 nomarginleft ethnicity">
        <?php 
			$options = [
    'Hispanic or Latino' => ' Hispanic or Latino',
    'Not Hispanic or Latino' => ' Not Hispanic or Latino',
	'Refused to Report/Unreported' => ' Refused to Report/Unreported'
];
echo $this->Form->radio('PI.ethnicity', $options, ['div'=>false,'required'=>false
]);
			?>
      </div>
	</div> 
	<div class="clear"></div>
	<div class="control-group">
      <div class="span5 ">
        <label class="control-label">
        <?= __('Are you or is anyone in your family a:') ?>
        </label>
      </div>
	   <div class="clear"></div>
      <div class="controls inline-radio nomarginleft chkrequired1">
       <div class="chkbox"><?php 
			echo $this->Form->checkbox('PI.is_migtant_worker',[
    'value' =>1,
    'hiddenField' =>0,
]);?>&nbsp;Migrant Worker&nbsp;&nbsp;
</div><div class="chkbox">
<?php 
			echo $this->Form->checkbox('PI.is_dependent_of_a_migrant_worker',[
    'value' =>1,
    'hiddenField' =>0,
]);?>&nbsp;Dependent of a migrant worker&nbsp;&nbsp;</div>
<div class="chkbox">
<?php 
			echo $this->Form->checkbox('PI.is_seasonal_migrant_worker',[
    'value' =>1,
    'hiddenField' =>0,
]);?>&nbsp;Seasonal migrant worker&nbsp;&nbsp;
</div><div class="chkbox">
<?php 
			echo $this->Form->checkbox('PI.is_depemdent_of_a_seasonal_migrant_worker',[
    'value' =>1,
    'hiddenField' =>0,
]);?>&nbsp;Dependent of a seasonal migrant worker&nbsp;&nbsp;
</div><div class="chkbox">
<?php 
			echo $this->Form->checkbox('PI.non_agricultural_worker',[
    'value' =>1,
    'hiddenField' =>0,
]);?>&nbsp;Non agricultural worker&nbsp;&nbsp;</div>
<div class="chkbox">
<?php 
			echo $this->Form->checkbox('PI.refused_unreported',[
    'value' =>1,
    'hiddenField' =>0,
]);?>&nbsp;Refused unreported</div>
      </div>
	</div> 
  <div class="clear"></div>
    <div class="frm-head row-fluid">
      <div class="span8">
        <h2>PPP - Primary Physician & Pharmacy</h2>
      </div>
      <div class="frm-bt span4"></div>
    </div>
	 <div class="clear"></div>
    <div class="control-group">
    
        <div class="span2">
          <label class="control-label">
          <?= __('First Name') ?>
          </label>
        </div>
        <div class="controls span3"><?php echo $this->Form->input('PPP.first_name',['label'=>false,'required'=>false,'div'=>false,'class'=>'input','Placeholder'=>'First Name']);?></div>
      
        <div class="span2">
          <label class="control-label">
          <?= __('Last Name') ?>
          </label>
        </div>
        <div class="controls span3"><?php echo $this->Form->input('PPP.last_name', ['label'=>false,'div'=>false,'required'=>false,'class'=>'input','Placeholder'=>'Last Name']);?></div>
    </div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Street Address') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.address_1', ['label'=>false,'div'=>false,'required'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Street Address']);?></div>
      <div class="span2">
        <label class="control-label">
        <?= __('City') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.city', ['label'=>false,'div'=>false,'required'=>false,'type'=>'text','class'=>' input','Placeholder'=>'City']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      
      <div class="span2">
        <label class="control-label">
        <?= __('State ') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.state', ['options'=>$states,'label'=>false,'div'=>false,'required'=>false,'empty'=>"Select",'class'=>' input','Placeholder'=>'State']);?></div>
      <div class="span2">
        <label class="control-label">
        <?= __('Zip Code') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.zip', ['label'=>false,'div'=>false,'required'=>false,'maxlength'=>5,'type'=>'text','class'=>' input','Placeholder'=>'Zip Code']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Phone') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.phone', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Phone']);?></div>
	  <div class="span2">
        <label class="control-label">
        <?= __('FAX') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.fax', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'FAX']);?></div>
	      <div class="clear"><br></div>
    <strong>Preferred Pharmacy</strong><br><br>
	<div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Phone') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PP.phone', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Phone']);?></div>
	  <div class="span2">
        <label class="control-label">
        <?= __('FAX') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PP.fax', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'FAX']);?></div>
    </div>
	
    <div class="clear"></div>
		</div>
    
	<div class="clear"></div>
    <div style="float:left"><?= $this->Form->button(__('Submit'),['class'=>'btn-primary btnsavepatient']) ?></div>
	
    <?= $this->Form->end() ?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function($){
$('#rp-gender-male').attr("required",false);
$('#rp-gender-female').attr("required",false);
$(".chkrequired input[type=checkbox]").change(function(){
/*
if($(this).is(":checked")){
$(".chkrequired input[type=checkbox]").prop("required",false);
}
else{
$(".chkrequired input[type=checkbox]").prop("required",true);
}
*/
});
$(".btnsavepatient").click(function(){
	/*var chk=0;
	$(".chkrequired input[type=checkbox]").each(function(){
		if($(this).is(":checked")){
		chk=1;
		}
	});
	if(chk==1){
		$(".chkrequired input[type=checkbox]").prop("required",false);
	}
	else{
		$(".chkrequired input[type=checkbox]").prop("required",true);
		return false;
	}
	*/
});

$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1900:nn-" });
			
});
$('#dob').change(function() { 
var age1=getAge(new Date($('#dob').val()))   
    $("#ageTextBox").html(age1+ " yrs");
});
$('#rp-dob').change(function() { 
/*var age1=getAge(new Date($('#rp-dob').val()))   
    $("#rpageTextBox").html(age1+ " yrs");*/
});
$('#dob').change();
//$('#rp-dob').change();
function getAge(birthDate) {
  var now = new Date();

  function isLeap(year) {
    return year % 4 == 0 && (year % 100 != 0 || year % 400 == 0);
  }

  // days since the birthdate    
  var days = Math.floor((now.getTime() - birthDate.getTime())/1000/60/60/24);
  var age = 0;
  // iterate the years
  for (var y = birthDate.getFullYear(); y <= now.getFullYear(); y++){
    var daysInYear = isLeap(y) ? 366 : 365;
    if (days >= daysInYear){
      days -= daysInYear;
      age++;
      // increment the age only if there are available enough days for the year.
    }
  }
  return age;
}
$('input[name=sameadd]').click(function() {
    //alert('Using the same address');  
    if ($("input[name=sameadd]:checked").is(':checked')) { 
      $('#rp-first-name').val($('#first-name').val());
      $('#rp-middle-name').val($('#middle-name').val());
      $('#rp-last-name').val($('#last-name').val());
      $('#rp-dob').val($('#dob').val());
      $('#rp-address-1').val($('#address-1').val());             
      var state = $('#state option:selected').val(); 
      $('#rp-state option[value=' + state + ']').attr('selected','selected');     
      $('#rp-city').val($('#city').val());
	  $('#rp-home-phone').val($('#home-phone').val());
	  $('#rp-cell').val($('#cell').val());
	  $('#rp-address-2').val($('#address-2').val());
	  $('#rp-zip').val($('#zip').val());
	  $('#rp-relationship-self').prop('checked', true);
	  	if($('#gender-male').is(':checked')) {
	  	$('#rp-gender-male').prop('checked', true);
	  }
	  if($('#gender-female').is(':checked')) {
	  	$('#rp-gender-female').prop('checked', true);
	  }
      };              
    });
</script>