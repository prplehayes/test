<div class="practice  large-9 medium-8 columns content custom_design">
<div class="top-header commonhead">
<h2><i class="icon-list-alt"></i><?php echo __('Application Cue'); ?></h2></div>
     <div class="inner-header">
	<h3><?php echo __('Pending Applications'); ?></h3>
	</div>
	<div id="practice_pagination"></div>
	<div class="inner-header">
	<h3><?php echo __('Active Customers'); ?></h3>
	</div>
	<div id="customer_pagination"></div>
</div>

<script>
jQuery('#practice_pagination').load("<?php echo $this->request->webroot?>practiceAps/ajax_practice");
jQuery('#customer_pagination').load("<?php echo $this->request->webroot?>practiceAps/ajax_customer");
</script>