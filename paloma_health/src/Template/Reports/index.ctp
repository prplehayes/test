<div class="users index large-9 medium-8 columns content">
   
    
			<div class="dashboardmenu" style="padding-top:100px;">
			<?php
			if($cloguser['group_id']==7){
			?>
			<div class="box">
			<div class="circle"><i class="icon-files-o"></i></div>
			<?= $this->Html->link(__('Production Reports'), ['controller' => 'Reports', 'action' => 'production'],['class' => 'btn-blue']) ?>
			</div>
			<div class="box">
			<div class="circle"><i class="icon-files-o"></i></div>
			<?= $this->Html->link(__('Productivity Reports'), ['controller' => 'Reports', 'action' => 'productivity'],['class' => 'btn-blue']) ?>
			</div>
			<?php
			}
			
			?>
			</div>
</div>