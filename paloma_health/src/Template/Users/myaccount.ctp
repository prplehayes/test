<?php
$dashboard="cdashboard";
if($user->group->id==5){
$dashboard="dentistdash";
}
?>
<div class="users index large-9 medium-8 columns content <?php echo $dashboard?>">
   <div class="dash-header"> <h2><i class="icon-dashboard"></i><?= __('Dashboard') ?></h2></div>
    
			<div class="welcome"> <?php
			
   echo "Welcome ".ucwords($user->first_name)."";
   ?></div>
			<div class="dashboardmenu">
			<?php
			if($user->group->id==5){
			?>
			<div class="box">
			<div class="circle"><i class="icon-folder-open-o"></i></div>
			<?= $this->Html->link(__('Patient Management'), ['controller' => 'Patient', 'action' => 'index'],['class' => 'btn-blue']) ?>
			</div>
			<div class="box">
			<div class="circle"><i class="icon-files-o"></i></div>
			<?= $this->Html->link(__('Claim Management'), ['controller' => 'Claim', 'action' => 'index'],['class' => 'btn-blue']) ?>
			</div>
			<div class="box">
			<div class="circle"><i class="icon-briefcase"></i></div>
			<?= $this->Html->link(__('Accounting'), ['controller' => 'Claim', 'action' => 'reimbursementstatus'],['class' => 'btn-blue']) ?>
			</div>
			<div class="box">
			<div class="circle"><i class="icon-list"></i></div>
			<?= $this->Html->link(__('Account Details'), ['controller' => 'Practice', 'action' => 'mypractice'],['class' => 'btn-blue']) ?>
			</div>
			<?php
			}
			if($user->group->id==6){
			?>
			<div class="box">
			<div class="circle"><i class="icon-check-square-o"></i></div>
			<?= $this->Html->link(__('Paid Claims'), ['controller' => 'Claim', 'action' => 'paidclaims'],['class' => 'btn-blue']) ?>
			</div>
			<div class="box">
			<div class="circle"><i class="icon-money"></i></div>
			<?= $this->Html->link(__('Claims to be Paid'), ['controller' => 'Claim', 'action' => 'batchpay'],['class' => 'btn-blue']) ?>
			</div>
			<?php
			}
			if($user->group->id==3){
			?>
			<div><?= $this->Html->link(__('Claim Review Cues'), ['controller' => 'Claim', 'action' => 'claimviewcues'],['class' => 'btn-blue']) ?></div><br>&nbsp;
			<?php
			}
			?>
			</div>
</div>
