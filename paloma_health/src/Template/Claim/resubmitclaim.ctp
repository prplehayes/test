<div class="patient form view large-9 medium-8 columns content custom_design">
  <?= $this->Form->create($patient,array('type' => 'file','class'=>'form-horizontal')) ?>
  <div class="top-header claimhead">
<h2><i class="icon-folder-open-o"></i><?php echo __('Patient Information'); ?></h2></div>
  
  <div class="span11">
    <div class="frm-head row-fluid">
      <div class="span8">
        <h2>PI - Patient Information</h2>
      </div>
      <div class="frm-bt span4"></div>
    </div>
    <div class="control-group">
      <div class="span2 required">
        <label class="control-label">
        <?= __('Practice') ?>
        </label>
      </div>
      <div class="controls span4"><?php 
	  $pp=$practice->toArray();
	  echo $pp[$patient->practice_id];
	  echo $this->Form->hidden('practice_id', ['value' => $patient->practice_id]);?></div>
      <div class="span1 required">
        <label class="control-label">
        <?= __('Gender') ?>
        </label>
      </div>
      <div class="controls span4 inline-radio"><?php echo $this->Form->radio('gender',[['value' => 'Male', 'text' => ' Male'],
        ['value' => 'Female', 'text' => ' Female']]);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2 required">
        <label class="control-label">
        <?= __('First Name') ?>
        </label>
      </div>
      <div class="controls span4"><?php echo $this->Form->input('first_name', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'First Name']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Middle Name') ?>
        </label>
      </div>
      <div class="controls span4"><?php echo $this->Form->input('middle_name', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'Middle Name']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2 required">
        <label class="control-label">
        <?= __('Last Name') ?>
        </label>
      </div>
      <div class="controls span4"><?php echo $this->Form->input('last_name', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'Last Name']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('SSN') ?>
        </label>
      </div>
      <div class="controls span4"><?php echo $this->Form->input('ssn', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'Social Security Number']);?></div>
      <div class="span2">
        <label class="control-label">
        <?= __('Medical Number') ?>
        </label>
      </div>
      <div class="controls span4"><?php echo $this->Form->input('medicare_number', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'Medical Number']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2 required">
        <label class="control-label">
        <?= __('DOB') ?>
        </label>
      </div>
      <div class="controls span4"><?php 
	  if($patient->dob!='' && $patient->dob!='0000-00-00'){
			$patient->dob=strtotime($patient->dob);
		}?>
	  <?php echo $this->Form->input('dob', ['value'=>date("m/d/Y",$patient->dob),'label'=>false,'div'=>false,'type'=>'text','class'=>'datepicker input','Placeholder'=>'Date of birth']);?></div>
	  <div class="span2 ">
        <label class="control-label">
        <?= __('Patient Id') ?>
        </label>
      </div>
	  <div class="controls span4">
	  <?php 

	  if($patient->patient_id==''){
			$patient->patient_id=$patientId;
			echo $this->Form->input('patient_id', ['value'=>$patient->patient_id,'label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Patient Id']);
		}
		else
		{
			echo $patient->patient_id;
			echo $this->Form->hidden('patient_id', ['value' => $patient->patient_id]);
		}
		?>
	  </div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Street Address') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('address_1', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Street Address']);?></div>
      <div class="span1">
        <label class="control-label">
        <?= __('Apt/Suite ') ?>
        </label>
      </div>
      <div class="controls span2"><?php echo $this->Form->input('address_2', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Apt/Suite']);?></div>
      <div class="span1">
        <label class="control-label">
        <?= __('PO Box') ?>
        </label>
      </div>
      <div class="controls span2"><?php echo $this->Form->input('po_box', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'PO Box']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('City') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('city', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'City']);?></div>
      <div class="span1">
        <label class="control-label">
        <?= __('State ') ?>
        </label>
      </div>
      <div class="controls span2"><?php echo $this->Form->input('state', ['options'=>$states,'empty'=>"Select",'label'=>false,'div'=>false,'class'=>' input','Placeholder'=>'State']);?></div>
      <div class="span1">
        <label class="control-label">
        <?= __('Zip Code') ?>
        </label>
      </div>
      <div class="controls span2"><?php echo $this->Form->input('zip', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','maxlength'=>5,'Placeholder'=>'Zip Code']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Home Phone') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('home_phone', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Home Phone']);?></div>
      <div class="span1">
        <label class="control-label">
        <?= __('Email') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('email', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Email']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Cell Phone') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('cell', ['label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Cell Phone']);?></div>
      <div class="span2">
        <label class="control-label">
        <?= __('Text Messages ?') ?>
        </label>
      </div>
      <div class="controls span3">
        <?php 
			$options = [
    '0' => 'No',
    '1' => 'Yes'
];
echo $this->Form->select('text_messages_active', $options, ['div'=>false
]);
			?>
      </div>
    </div>
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
        <div class="span4">
          <label class="control-label">
          <?= __('First Name') ?>
          </label>
        </div>
        <div class="controls span6"><?php echo $this->Form->input('RP.first_name',['value'=>$RP['first_name'],'label'=>false,'div'=>false,'class'=>'input','required'=>false,'Placeholder'=>'First Name']);?></div>
      </div>
      <div class="clear"></div>
      <div class="control-group">
        <div class="span4">
          <label class="control-label">
          <?= __('Middle Name') ?>
          </label>
        </div>
        <div class="controls span6"><?php echo $this->Form->input('RP.middle_name', ['value'=>$RP['middle_name'],'label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'Middle Name']);?></div>
      </div>
      <div class="clear"></div>
      <div class="control-group">
        <div class="span4">
          <label class="control-label">
          <?= __('Last Name') ?>
          </label>
        </div>
        <div class="controls span6"><?php echo $this->Form->input('RP.last_name', ['value'=>$RP['last_name'],'label'=>false,'div'=>false,'class'=>'input','required'=>false,'Placeholder'=>'Last Name']);?></div>
      </div>
      <div class="clear"></div>
      <div class="control-group">
        <div class="span4">
          <label class="control-label">
          <?= __('DOB') ?>
          </label>
        </div>
        <div class="controls span6"><?php if($RP['dob']!='' && $RP['dob']!='0000-00-00'){
			$RP['dob']=strtotime($RP['dob']);
		}?>
	  <?php echo $this->Form->input('RP.dob', ['value'=>date("m/d/Y",$RP['dob']),'label'=>false,'div'=>false,'type'=>'text','class'=>'datepicker input','required'=>false,'Placeholder'=>'Date of birth']);?></div>
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
        <div class="controls span10 inline-radio"><?php echo $this->Form->radio('RP.gender',[['value' => 'Male', 'text' => ' Male'],
        ['value' => 'Female', 'text' => ' Female']],['value'=>$RP['gender']],['required'=>false]);?></div>
      </div>
      <div class="clear"></div>
      <div class="control-group">
        <div class="span2">
          <label class="control-label">
          <?= __('Relationship') ?>
          </label>
        </div>
		<div class="clear"></div>
        <div class="controls span10 inline-radio"><?php echo $this->Form->radio('RP.relationship',[['value' => 'Sibling', 'text' => ' Sibling'],
        ['value' => 'Parent', 'text' => ' Parent'],['value' => 'Grandparent', 'text' => ' Grandparent'],['value' => 'Aunt/Uncle', 'text' => ' Aunt/Uncle'],['value' => 'Neighbor', 'text' => ' Neighbor'],['value' => 'Friend', 'text' => ' Friend'],['value' => 'Other', 'text' => ' Other']],['value'=>$RP['relationship']]);?></div>
      </div>
    </div>
    </div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Street Address') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('RP.address_1', ['value'=>$RP['address_1'],'label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Street Address']);?></div>
      <div class="span1">
        <label class="control-label">
        <?= __('Apt/Suite ') ?>
        </label>
      </div>
      <div class="controls span2"><?php echo $this->Form->input('RP.address_2', ['value'=>$RP['address_2'],'label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Apt/Suite']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('City') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('RP.city', ['value'=>$RP['city'],'label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'City']);?></div>
      <div class="span1">
        <label class="control-label">
        <?= __('State ') ?>
        </label>
      </div>
      <div class="controls span2"><?php echo $this->Form->input('RP.state', ['options'=>$states,'value'=>$RP['state'],'label'=>false,'div'=>false,'empty'=>"Select",'class'=>' input','Placeholder'=>'State']);?></div>
      <div class="span1">
        <label class="control-label">
        <?= __('Zip Code') ?>
        </label>
      </div>
      <div class="controls span2"><?php echo $this->Form->input('RP.zip', ['value'=>$RP['zip'],'label'=>false,'div'=>false,'maxlength'=>5,'type'=>'text','class'=>' input','Placeholder'=>'Zip Code']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Home Phone') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('RP.home_phone', ['value'=>$RP['home_phone'],'label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Home Phone']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Cell Phone') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('RP.cell', ['value'=>$RP['cell'],'label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Cell Phone']);?></div>
    </div>
    <div class="clear"></div>
    <div class="frm-head row-fluid">
      <div class="span8">
        <h2>VI - Verification Information</h2>
      </div>
      <div class="frm-bt span4"></div>
    </div>
    <div class="control-group">
      <div class="span2 required1">
        <label class="control-label">
        <?= __('Photo Id') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->file('img_photo_id_upload', ['label'=>false,'div'=>false]);?> <?php echo $this->Form->hidden('h_img_photo_id_upload', ['value'=>$patient->img_photo_id_upload]);?> </div>
      <div class="span3">
        <?php if($patient->img_photo_id_upload!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $patient->img_photo_id_upload;?>', 'Photo Id',450,450);" href="javascript:void(0);"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
		<?php echo $patient->img_photo_id_upload;?>
		</a>
		
        <?php }
		else{
			?>
			<img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
			<?php
		}
		?>
      </div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2 required1">
        <label class="control-label">
        <?= __('Medical Card Upload') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->file('img_medicare_card', ['label'=>false,'div'=>false]);?> <?php echo $this->Form->hidden('h_img_medicare_card', ['value'=>$patient->img_medicare_card]);?> </div>
      <div class="span3">
        <?php if($patient->img_medicare_card!=''){?>
         <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $patient->img_medicare_card;?>', 'Medical Card Upload',450,450);" href="javascript:void(0);"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
		 <?php echo $patient->img_medicare_card;?>
		 </a>
        <?php }else{
			?>
			<img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
			<?php
		}?>
      </div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2 required1">
        <label class="control-label">
        <?= __('Consent Form') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->file('consent_form_upload', ['label'=>false,'div'=>false]);?> <?php echo $this->Form->hidden('h_consent_form_upload', ['value'=>$patient->consent_form_upload]);?> </div>
      <div class="span3">
        <?php if($patient->consent_form_upload!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $patient->consent_form_upload;?>', 'Consent Form',450,450);" href="javascript:void(0);"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
		<?php echo $patient->consent_form_upload;?>
		</a>
        <?php }else{
			?>
			<img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
			<?php
		}?>
      </div>
    
	<div class="clear"></div>
		 <div class="control-group">
      <div class="span2 ">
        <label class="control-label">
        <?= __('Registration Form') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->file('registration_form_upload', ['label'=>false,'div'=>false]);?> <?php echo $this->Form->hidden('h_registration_form_upload', ['value'=>$patient->registration_form_upload]);?> </div>
      <div class="span3">
        <?php if($patient->registration_form_upload!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $patient->registration_form_upload;?>', 'Registration Form',450,450);" href="javascript:void(0);" title="Consent Form"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
		<?php echo $patient->registration_form_upload;?>
		</a>
        <?php }
		else{
			?>
			<img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
			<?php
		}?>
      </div>
    </div>
	</div>
<div class="clear"></div>
	 <div class="frm-head row-fluid">
      <div class="span8">
        <h2>API - Additional Patient Information</h2>
      </div>
      <div class="frm-bt span4"></div>
    </div>
	<div class="control-group">
      <div class="span3">
        <label class="control-label">
        <?= __('Average Household Income') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PI.average_household_income', ['value'=>$PI['average_household_income'],'label'=>false,'required'=>false,'div'=>false,'type'=>'text','class'=>' input']);?></div>
      <div class="clear"></div>
	  
      <div class="controls inline-radio span4 nomarginleft">
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
echo $this->Form->radio('PI.pay_frequency', $options, ['div'=>false
,'required'=>false,'value'=>$PI['pay_frequency']]);
			?>
      </div>
    </div>
	<div class="clear"></div>
	<div class="control-group">
      <div class="span3">
        <label class="control-label">
        <?= __('No of household Members') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PI.number_of_household_members', ['value'=>$PI['number_of_household_members'],'label'=>false,'required'=>false,'div'=>false,'type'=>'text','class'=>' input']);?></div>
      <div class="clear"><br></div>
	  <div class="span5 nomarginleft">
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
	'Other' => ' Other'
];
echo $this->Form->radio('PI.housing_status', $options, ['value'=>$PI['housing_status'],'div'=>false,'required'=>false
]);
			?>
      </div>
	  </div>
	  <div class="span5">
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
echo $this->Form->select('PI.primary_language', $options, ['value'=>$PI['primary_language'],'div'=>false,'required'=>false
]);
			?>
      </div>
	  </div>
    </div>
	<div class="clear"></div>
	<div class="control-group">
      <div class="span3">
        <label class="control-label">
        <?= __('Race') ?>
        </label>
      </div>
	   <div class="clear"></div>
      <div class="controls inline-radio race nomarginleft">
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
echo $this->Form->radio('PI.race', $options, ['value'=>$PI['race'],'div'=>false,'required'=>false
]);
			?>
      </div>
	</div>  
	<div class="clear"></div>
	<div class="control-group">
      <div class="span3">
        <label class="control-label">
        <?= __('Ethnicity') ?>
        </label>
      </div>
	   <div class="clear"></div>
      <div class="controls inline-radio1 nomarginleft">
        <?php 
			$options = [
    'Hispanic or Latino' => ' Hispanic or Latino',
    'Not Hispanic or Latino' => ' Not Hispanic or Latino',
	'Refused to Report/Unreported' => ' Refused to Report/Unreported'
];
echo $this->Form->radio('PI.ethnicity', $options, ['value'=>$PI['ethnicity'],'div'=>false,'required'=>false
]);
			?>
      </div>
	</div> 
	<div class="clear"></div>
	<div class="control-group">
      <div class="span5">
        <label class="control-label">
        <?= __('Are you or is anyone in your family a:') ?>
        </label>
      </div>
	   <div class="clear"></div>
      <div class="controls inline-radio nomarginleft">
       <?php
	   $is_migtant_worker='';
	   $is_dependent_of_a_migrant_worker='';
	   $is_seasonal_migrant_worker='';
	   $is_depemdent_of_a_seasonal_migrant_worker='';
	   $non_agricultural_worker='';
	   $refused_unreported='';
	   if($PI['is_migtant_worker']==1){
	   		$is_migtant_worker='checked';
	   }
	   if($PI['is_dependent_of_a_migrant_worker']==1){
	   		$is_dependent_of_a_migrant_worker='checked';
	   }
	   if($PI['is_seasonal_migrant_worker']==1){
	   		$is_seasonal_migrant_worker='checked';
	   }
	   if($PI['is_depemdent_of_a_seasonal_migrant_worker']==1){
	   		$is_depemdent_of_a_seasonal_migrant_worker='checked';
	   }
	   if($PI['non_agricultural_worker']==1){
	   		$non_agricultural_worker='checked';
	   }
	   if($PI['refused_unreported']==1){
	   		$refused_unreported='checked';
	   }
	   ?>
	   <div class="chkbox">
	   <?php 
			echo $this->Form->checkbox('PI.is_migtant_worker',[
    'value' =>1,
    'hiddenField' =>0,'class'=>$is_migtant_worker],['value'=>$PI['is_migtant_worker']]);?>&nbsp;Migrant Worker&nbsp;&nbsp;
	</div><div class="chkbox">
<?php 
			echo $this->Form->checkbox('PI.is_dependent_of_a_migrant_worker',[
    'value' =>1,
    'hiddenField' =>0,'class'=>$is_dependent_of_a_migrant_worker
],['value'=>$PI['is_dependent_of_a_migrant_worker']]);?>&nbsp;Dependent of a migrant worker&nbsp;&nbsp;
</div><div class="chkbox">
<?php 
			echo $this->Form->checkbox('PI.is_seasonal_migrant_worker',[
    'value' =>1,
    'hiddenField' =>0,'class'=>$is_seasonal_migrant_worker
],['value'=>$PI['is_seasonal_migrant_worker']]);?>&nbsp;Seasonal migrant worker&nbsp;&nbsp;
</div><div class="chkbox">
<?php 
			echo $this->Form->checkbox('PI.is_depemdent_of_a_seasonal_migrant_worker',[
    'value' =>1,
    'hiddenField' =>0,'class'=>$is_depemdent_of_a_seasonal_migrant_worker
],['value'=>$PI['is_depemdent_of_a_seasonal_migrant_worker']]);?>&nbsp;Depemdent of a seasonal migrant worker&nbsp;&nbsp;
</div><div class="chkbox">
<?php 
			echo $this->Form->checkbox('PI.non_agricultural_worker',[
    'value' =>1,
    'hiddenField' =>0,'class'=>$non_agricultural_worker
],['value'=>$PI['non_agricultural_worker']]);?>&nbsp;Non agricultural worker&nbsp;&nbsp;
</div><div class="chkbox">
<?php 
			echo $this->Form->checkbox('PI.refused_unreported',[
    'value' =>1,
    'hiddenField' =>0,'class'=>$refused_unreported
],['value'=>$PI['refused_unreported']]);?>&nbsp;Refused unreported

</div>
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
        <div class="controls span3"><?php echo $this->Form->input('PPP.first_name',['value'=>$PPP['first_name'],'label'=>false,'div'=>false,'class'=>'input','required'=>false,'Placeholder'=>'First Name']);?></div>
      
        <div class="span2">
          <label class="control-label">
          <?= __('Last Name') ?>
          </label>
        </div>
        <div class="controls span3"><?php echo $this->Form->input('PPP.last_name', ['value'=>$PPP['last_name'],'label'=>false,'div'=>false,'required'=>false,'class'=>'input','Placeholder'=>'Last Name']);?></div>
    </div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Street Address') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.address_1', ['value'=>$PPP['address_1'],'label'=>false,'required'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Street Address']);?></div>
      <div class="span2">
        <label class="control-label">
        <?= __('City') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.city', ['value'=>$PPP['city'],'label'=>false,'div'=>false,'required'=>false,'type'=>'text','class'=>' input','Placeholder'=>'City']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      
      <div class="span2">
        <label class="control-label">
        <?= __('State ') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.state', ['value'=>$PPP['state'],'label'=>false,'div'=>false,'required'=>false,'type'=>'text','class'=>' input','Placeholder'=>'State']);?></div>
      <div class="span2">
        <label class="control-label">
        <?= __('Zip Code') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.zip', ['value'=>$PPP['zip'],'label'=>false,'div'=>false,'required'=>false,'maxlength'=>5,'type'=>'text','class'=>' input','Placeholder'=>'Zip Code']);?></div>
    </div>
    <div class="clear"></div>
    <div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Phone') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.phone', ['value'=>$PPP['phone'],'label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Phone']);?></div>
	  <div class="span2">
        <label class="control-label">
        <?= __('FAX') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PPP.fax', ['value'=>$PPP['fax'],'label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'FAX']);?></div>
	      <div class="clear"><br></div>
    <strong>Preferred Pharmacy</strong><br><br>
	<div class="control-group">
      <div class="span2">
        <label class="control-label">
        <?= __('Phone') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PP.phone', ['value'=>$PP['phone'],'label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'Phone']);?></div>
	  <div class="span2">
        <label class="control-label">
        <?= __('FAX') ?>
        </label>
      </div>
      <div class="controls span3"><?php echo $this->Form->input('PP.fax', ['value'=>$PP['fax'],'label'=>false,'div'=>false,'type'=>'text','class'=>' input','Placeholder'=>'FAX']);?></div>
    </div>
	
    <div class="clear"></div>
  </div>

  <div class="clear"></div>
  <div style="float:left">
<div style="float:left">
    <?= $this->Form->button(__('Verify'),['class'=>'btn-primary btnsavepatient']) ?>
  </div>
  </div>
  </div>
  <?= $this->Form->end() ?>
  <div class="clear">&nbsp;</div>
  <br>
  <br>
  <br>
</div>
<script type="text/javascript">
$(document).ready(function($){
$('#rp-gender-male').attr("required",false);
$('#rp-gender-female').attr("required",false);
$(".btnsavepatient").click(function(){
/*
var valid=1;
$(".input input, select.input").each(function(){
 	if($(this).attr("required")=='required'){
	if($(this).val()==''){
	valid=0;
		
	}
	
	}
});
if(valid==0){
	$(".input input").focus();
		return false;
}
*/
});
$(".checked").attr("checked",true);
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
			
});
$(function(){    
    $('.view-pdf').on('click',function(){
        var pdf_link = $(this).attr('href');
		var mod_title = $(this).attr('title');
		if(mod_title == ''){
			mod_title = 'My Title';
		}
        var iframe = '<div class="iframe-container"><iframe src="'+pdf_link+'"></iframe></div>'
        $.createModal({
        title:mod_title,
        message: iframe,
        closeButton:true,
        scrollable:false
        });
        return false;        
    });    
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