<div class="practice  large-9 medium-8 columns content custom_design">
     <div class="top-header accounthead">
	<h2><i class="icon-briefcase"></i><?php echo __('Claim Appeals Dashboard'); ?></h2>
	</div>
 
	<div class="inner-header">
	<h3><?php echo __('Pending Appeals'); ?></h3>
	</div>
	<div id="appealclaimlist"></div>
	<div class="clear"></div>
	<div class="inner-header">
	<h3><?php echo __('Approved Appeals'); ?></h3>
	</div>
	<div id="approvedappeallist"></div>
	<div class="clear"></div>
<div class="inner-header">
						<h3><?php echo __('Paid Appeals'); ?></h3></div>

		<div id="dentistappealclaimpaidlist"></div>
		<div class="clear"></div>
<div class="inner-header">
						<h3><?php echo __('Denied Appeals'); ?></h3></div>

		<div id="deniedappeals"></div>
</div>

<script>

jQuery('#dentistappealclaimpaidlist').load("<?php echo $this->request->webroot?>claim/ajax_dentistappealpaidlist");			
jQuery('#deniedappeals').load("<?php echo $this->request->webroot?>claim/ajax_deniedappeals");

jQuery('#approvedappeallist').load("<?php echo $this->request->webroot?>claim/ajax_approvedappeallist");
jQuery('#appealclaimlist').load("<?php echo $this->request->webroot?>claim/ajax_claimappeallist");
$(document).ready(function() {	
	$(".btnpnr").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_claimpending",type: "POST",data:$(".frmfilterpnr").serialize(), success: function(result){
	$("#claimlistpending").html(result);         
        }});
	});	
	$(".btnpaid").click(function(){
	$.ajax({url: "<?php echo $this->request->webroot?>claim/ajax_claimpaid",type: "POST",data:$(".frmfilterpaid").serialize(), success: function(result){
	$("#claimlist").html(result);         
        }});
	});
});
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
</script>