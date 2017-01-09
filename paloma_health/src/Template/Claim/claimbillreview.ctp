<div class="patient form view large-9 medium-8 columns content custom_design">
<?= $this->Form->create($patient,array('type' => 'file','class'=>'form-horizontal')) ?>
<div class="top-header commonhead">
<h2><i class="icon-folder-open"></i><?php echo __('Patient Information'); ?></h2></div>
<div class="row-fluid show-grid">
<div class="span12 nomarginleft"> <?php echo $this->Form->hidden('practice_id', ['value' => $patient->practice_id]);?>
  <div class="clear"></div>
  <div class="control-group">
    <div class="span2">
      <label class="control-label">
      <?= __('First Name') ?>
      </label>
    </div>
    <div class="controls span4"><?php echo $patient->first_name;?></div>
    <div class="span1">
      <label class="control-label">
      <?= __('Gender') ?>
      </label>
    </div>
    <div class="controls span4 inline-radio"><?php echo $patient->gender;?></div>
  </div>
  <div class="clear"></div>
  <div class="control-group">
    <div class="span2">
      <label class="control-label">
      <?= __('Middle Name') ?>
      </label>
    </div>
    <div class="controls span4">
	<?php echo $patient->middle_name;?>
	</div>
  </div>
  <div class="clear"></div>
  <div class="control-group">
    <div class="span2">
      <label class="control-label">
      <?= __('Last Name') ?>
      </label>
    </div>
    <div class="controls span4"><?php echo $patient->last_name;?></div>
  </div>
  <div class="clear"></div>
  <div class="control-group">
    <div class="span2">
      <label class="control-label">
      <?= __('SSN') ?>
      </label>
    </div>
    <div class="controls span4">
	<?php echo $patient->ssn;?>
	</div>
    <div class="span2">
      <label class="control-label">
      <?= __('Medical Number') ?>
      </label>
    </div>
    <div class="controls span4">
	<?php echo $patient->medicare_number;?>
	</div>
  </div>
  <div class="clear"></div>
  <div class="control-group">
    <div class="span2">
      <label class="control-label">
      <?= __('DOB') ?>
      </label>
    </div>
    <div class="controls span4">
      <?php 
	  if($patient->dob!='' && $patient->dob!='0000-00-00'){
			$patient->dob=strtotime($patient->dob);
		}?>
		<?php echo $this->Form->hidden('dob', ['id'=>'dob','value'=>date("m/d/Y",$patient->dob)]);?>
          <?php echo date("m/d/Y",$patient->dob);?><br>
		  <strong><span id="ageTextBox"></span></strong>
     </div>
	   <div class="span4">
      <label class="control-label">
      <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>claim/ajaxviewpatient/<?php echo $claim->id; ?>', 'Patient',600,600);" href="javascript:void(0);" style="text-decoration:underline;"><?= __('See Complete Patient Record') ?></a>
      </label>
    </div>
  </div>
  </div>
</div> 
  <div class="clear"></div>
  <div class="greybg">
  <div class="frm-head row-fluid">
    <div class="span8">
      <h3>VI - Verification Information</h3>
    </div>
    <div class="frm-bt span4"></div>
  </div>
  <div class="control-group">
    <div class="span4">
     <strong>
      <?= __('Photo Id') ?>
      </strong>
    <br><br>
      <?php if($patient->img_photo_id_upload!=''){?>
      <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $patient->img_photo_id_upload;?>', 'Photo Id',450,450);" href="javascript:void(0);"  title="Photo Id"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50"> <br><?php echo $patient->img_photo_id_upload;?> </a>
      <?php }else{
	  ?>
	  <img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
	  <?php
	  }?>
    </div>
  
    <div class="span4">
      <strong>
      <?= __('Medical Card') ?>
      </strong>
    <br><br>
      <?php if($patient->img_medicare_card!=''){?>
      <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $patient->img_medicare_card;?>', 'Medical Card',450,450);" href="javascript:void(0);" title="Medical Card"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50"> <br><?php echo $patient->img_medicare_card;?> </a>
      <?php }else{
	  ?>
	  <img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
	  <?php
	  }?>
    </div>
  
    <div class="span4">
      <strong>
      <?= __('Consent Form') ?>
     </strong>
    <br><br>
      <?php if($patient->consent_form_upload!=''){?>
      <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $patient->consent_form_upload;?>', 'Consent Form',450,450);" href="javascript:void(0);" title="Consent Form"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50"><br> <?php echo $patient->consent_form_upload;?> </a>
      <?php }else{
	  ?>
	  <img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
	  <?php
	  }?>
    </div>
  </div>
  <div class="clear">&nbsp;</div>
  <div class=" nomarginleft">
    <div class="span4 nomarginleft"><strong>
      <?= __('Medical Verification Form') ?>
      </strong><br>
      <br>
      <div>
        <?php
		
		 if($claim->dental_verification_upload!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->dental_verification_upload;?>', 'Medical Verification Form',450,450);" title="Medical Verification Form" href="javascript:void(0);"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50"> <br>
        <?php echo $claim->dental_verification_upload;?> </a>
        <?php }else{
	  ?>
	  <img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
	  <?php
	  }?>
      </div>
    </div>
   
	<div class="span4"><strong>
      <?= __('Registration Form') ?>
      </strong><br>
      <br>
      <div>
       <?php if($patient->registration_form_upload!=''){?>
        <a onclick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $patient->registration_form_upload;?>', 'Registration Form ',450,450);"  href="javascript:void(0);" title="Registration Form "><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50"> <br>
        <?php echo $patient->registration_form_upload;?> </a>
        <?php }else{
	  ?>
	  <img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50">
	  <?php
	  }?>
      </div>
    </div>
  </div>
 </div>
  <div class="clear"><br>&nbsp;</div>
   <div class="row-fluid show-grid">
  <div class="clear">
    <h3>Past Filed Claim</h3>
  </div>
  <div id="claimlist"></div>
   </div>
  <div class="clear"></div>
  <div class="greybg">
 <div class="span6 nomarginleft">
  <div class="clear">
    <h3>Billing Code Information</h3>
  </div>
  <div class="bilingcode">
    <div class="span12 nomarginleft">
      <div class="span12">
        <div>
		<div style="margin:10px auto;"><strong><?= __('CPT Codes') ?></strong></div>
		
          <div class="span12 nomarginleft">
				<?php if (!empty($claim->cpt_codes)): ?>
            <?php 
			foreach ($claim->cpt_codes as $cptCodes): 
			$toothnumber=$cptCodes->_joinData->tooth_number;
			$surface=$cptCodes->_joinData->surface;
			$surface2=$cptCodes->_joinData->surface2;
			$surface3=$cptCodes->_joinData->surface3;
			$surface4=$cptCodes->_joinData->surface4;
			$quadrent_1_code=$cptCodes->_joinData->quadrent_1_code;
			$quadrent_2_code=$cptCodes->_joinData->quadrent_2_code;
			$arch_code=$cptCodes->_joinData->arch_code;
			$upper_or_lower=$cptCodes->_joinData->upper_or_lower;
			?>
                <div class="cptbox">
				<div class="inlinebox"><?= h($cptCodes->group) ?> < <?= h($cptCodes->code) ?> < <?= h($cptCodes->description) ?> </div>
				<?php if($toothnumber|| $surface || $surface2 || $surface3 || $surface4 ||$quadrent_1_code || $quadrent_2_code ||$arch_code||$upper_or_lower){?>
				<div class="inlinebox"><?php
					if($toothnumber){ echo "<span>Tooth Number: ".$toothnumber."</span>&nbsp;";}
					if($surface){ echo "<span>Surface ".$surface."</span>&nbsp;";}
					if($surface2){ echo "<span>Surface 2: ".$surface2."</span>&nbsp;";}
					if($surface3){ echo "<span>Surface 3: ".$surface3."</span>&nbsp;";}
					if($surface4){ echo "<span>Surface 4: ".$surface4."</span>&nbsp;";}
					if($quadrent_1_code){ echo "<span>Quadrent Code: ".$quadrent_1_code."</span>&nbsp;";}
					//if($quadrent_2_code){ echo "<span>Quadrent Code 2: ".$quadrent_2_code."</span>&nbsp;";}
					if($arch_code){ echo "<span>Arch Code: ".$arch_code."</span>&nbsp;";}
					if($upper_or_lower){ echo "<span>Upper/Lower: ".$upper_or_lower."</span>&nbsp;";}
				?>
				</div>
				<?php }?>
				</div>
            <?php endforeach; ?>
        <?php endif; ?>
			</div>
        </div>
        <div class="clear">
         
        </div>
        <div>
		<div style="margin:10px auto;"><strong><?= __('ICD-10 Codes') ?></strong></div>
          
         <div class="span12 nomarginleft">
				<?php if (!empty($claim->icd10_codes)): ?>
            <?php foreach ($claim->icd10_codes as $icd10Codes): ?>
                <div class="inlinebox"><?= h($icd10Codes->group) ?> < <?= h($icd10Codes->code) ?> <?= h($icd10Codes->description) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
			</div>
			<div class="clear">&nbsp;</div>
			<div><strong><?= __('Date Submitted ') ?></strong> <?= h(str_replace("-","/",$claim->created)) ?></div>
        </div>
      </div>
    
      <div class="clear">&nbsp;
      </div>
	   </div>
	      
	  <div class="clear">&nbsp; </div>
          <div class="span12 nomarginleft bordertop">
              <div class="span4"> <strong>Date of Service</strong> <br><br><?php echo date("m/d/Y",strtotime($claim->date_of_service));?> </div>
              <div class="span4"> <strong>Super Bill Notes</strong> <br><br><?php echo $claim->comments; ?></div>
              <div class="span4"><strong>Name</strong> <br><br><?php echo $claimusers['first_name']." ".$claimusers['last_name']; ?> </div>
          </div>
		  <div class="clear"><br><br></div>
      <div class="span12 nomarginleft bordertop">
          
          <br><br>
          <?php if($claim->signature!=''){?>
             <div class="span4"> <a title="Signature" onClick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->signature;?>', 'Signature',450,450);"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50"></a></div>
              <?php }?>
          	<div class="span4">
            <strong>
            <?= __('Signature') ?>
            </strong>
            <?php if($claim->signature!=''){?><br><br>
              <a title="Signature" onClick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->signature;?>', 'Signature',450,450);">
              <?php echo $claim->signature;?> </a>
              <?php }?>
              </div>
			  <div class="clear">&nbsp;&nbsp;</div>
			  <?php if($claim->progress_notes_upload!=''){?>
             <div class="span4"><a onClick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->progress_notes_upload;?>', 'Progress Notes',450,450);"  href="javascript:void(0);" title="Progress Notes"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50"></a></div>
              <?php }else{?>
			  <div class="span4"><img src="<?php echo $this->request->webroot?>img/user-bg.png" width="50" height="50"></div>
			  <?php }?>
          	<div class="span4">
            <strong>
            <?= __('Progress Notes') ?>
            </strong>
            <?php if($claim->progress_notes_upload!=''){?><br><br>
              <a onClick="PopupCenterDual('<?php echo $this->request->webroot?>uploads/<?php echo $claim->progress_notes_upload;?>', 'Progress Notes',450,450);"  href="javascript:void(0);" title="Progress Notes"><?php echo $claim->progress_notes_upload;?> </a>
              <?php }?>
              </div>
          </div>
    </div>
</div>
<div class="span6">
  <div class="clear">
  <h3 style="margin-bottom:5px;">Reviewer Notes</h3>
  <div class="input_fields_wrap">

 <div class="clear"></div>
  
  <?php foreach($reviewnote as $reviewn){ ?>
  <div class="clear">
<strong>Option:</strong> <?php echo $reviewn->option1; ?>
</div>
  <div class="clear">
<strong>Reviewer Notes:</strong> <?php echo $reviewn->note; ?>
</div>
<br/>
<?php } ?>
  
 </div>
 
   </div>
<div class="clear"><h3 style="margin-bottom:5px;">Billing Notes</h3></div>
  <div class="reviewnotes">
  <div class="clear">
  <div class="span3 nomarginleft">
  <?php 
			$options = [
    'Pending Payment' => 'Pending Payment',
	'Missing/Wrong Info' => 'Missing/Wrong Info',
	'Denied' =>'Denied',
	'DOB Error' =>'DOB Error',
	'Wrong ICD10' => 'Wrong ICD10',
    'Wrong CPT' => 'Wrong CPT',
	'Corrupted File' => 'Corrupted File',
	'Other' =>'Other'
	
];
echo $this->Form->select('notes.option1', $options, ['empty'=>'Select Option',
    'div'=>false
]);
			?>
  </div>
  </div>
  <div class="clear"></div>
  <div style="margin-top:10px;margin-bottom:10px;"><strong>Biller Note</strong></div><?php echo $this->Form->input('notes.note', ['label'=>false,'div'=>false,'class'=>'input','type'=>'textarea']);?>
  <div class="clear"><br></div>
  <div><strong>Claim Status</strong> :&nbsp;&nbsp; 
  <?php 
echo $this->Form->select('claim_status_id', $claimStatus,['label'=>false,'class'=>'claim_status_id']);
			?>
</div>
<div class="clear"><br></div>
  <div id="pay_estimated_div" class="pay_estimated_div" style="display:none;">
  <div>
  <strong>Estimated Payment Amount</strong> :&nbsp;&nbsp; 
<?php echo $this->Form->input('payment_amount', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'Estimated Payment']);?>
</div>
<div>
  <strong>EHS Number</strong> :&nbsp;&nbsp; 
<?php echo $this->Form->input('ehs_number', ['label'=>false,'div'=>false,'class'=>'input','Placeholder'=>'EHS Number']);?>
</div>
</div>
<div class="clear"><br><br></div>
  <div style="float:left">
<div style="float:left">
    <?= $this->Form->button(__('Submit'),['class'=>'btn-primary']) ?>&nbsp;&nbsp;
	<?php if($cloguser['group_id']==9){
			?>
			<a href="<?php echo $this->request->webroot?>claim/allclaimbillreview" class="btn-blue button btn-large backbtn">Back</a>
			<?php
			}else{?>
			<a href="<?php echo $this->request->webroot?>claim/claimviewcues" class="btn-blue button btn-large backbtn">Back</a>
			<?php
			}
			?>
  </div>
  <br><br>
  </div>
  </div>
</div>
</div>
<div class="clear"></div>
<div style="float:left">
  <div style="float:left"> </div>
</div>
<?= $this->Form->end() ?>
<br>
<br>
<div style="padding-left:15px;"></div>
  <br>
  <br>
</div>
<script type="text/javascript">
function claimsummary(cid){
		var mId = $.sModal({
            header:'',
			width:780,
            animate:'fadeDown',
            content :$('<div></div>').load("<?php echo $this->request->webroot?>claim/ajax_claimsummary/"+cid),
            buttons:[
                {
                    text:'&nbsp; <?php echo __('Back'); ?> &nbsp;',
                    addClass:'btn-primary',
                    click:function(id){}
                }
            ]
        });
	}
$(document).ready(function($){
$(".checked").attr("checked",true);
$('.datepicker').datepicker({ dateFormat: "mm/dd/yy",maxDate: 0,changeMonth: true,
			changeYear: true,yearRange: "1960:nn-" });
			
});
$(function(){ 
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
$('#dob').change(function() { 
var age1=getAge(new Date($('#dob').val()))   
    $("#ageTextBox").html(age1+ " yrs");
});
//$('#dob').change();
var age1=getAge(new Date($('#dob').val()))   
    $("#ageTextBox").html(age1+ " yrs");  
$('.claim_status_id').change(function(){
 	if($(this).val() == 8){
 	$('#pay_estimated_div').show();
		}else{
	$('#pay_estimated_div').hide();	
		}
 }); 
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
jQuery('#claimlist').load("<?php echo $this->request->webroot?>claim/ajax_patientclaim/<?php echo $patient->id?>/<?php echo $claim->id?>");
</script>
<script src="<?php echo $this->request->webroot?>js/backfix.min.js"></script>
<script type="text/javascript">
	$(".loginlogo").parents("a").click(function(){
		bajb_backdetect.OnBack();
	});
	$(".claimreview").parents("a").click(function(){
		bajb_backdetect.OnBack();
	});
	bajb_backdetect.OnBack = function()
	{
				if (confirm('Are you sure you want to leave this page?')) {
					$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_unassignbillclaim/<?php echo $claim->id?>",type: "POST",data:{}, success: function(result){
			       alert(8);return false
				}});
				} else {
					return false;
				}
				
	}
	</script>