
<div class="uploadDatas view large-9 medium-8 columns content" style="padding:20px">

<div id="res"></div>
    
</div>

<script>
$(document).ready(function() {
var startfrom='<?php echo $_GET['start']?>';
$("#res").html("Please wait...");
$.ajax({url: "<?php echo $this->request->webroot?>upload-datas/ajax_process/<?php echo $uploadData->id;?>/?start=<?php echo $_GET['start']?>",dataType:'json', success: function(result){
	        //$("#res").html(result);
			if(result.status=='DONE' ||result.status=='ERROR'){
				$("#res").html(result.data);
			}
			else{
				if(result.start){
					window.location="<?php echo $this->request->webroot?>upload-datas/process/<?php echo $uploadData->id;?>/?start="+result.start;
				}
			}	
        }});
});		
</script>
