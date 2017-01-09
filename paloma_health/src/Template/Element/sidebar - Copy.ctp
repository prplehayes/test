<?php
$loguser = $this->request->session()->read('Auth.User');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="nav nav-tabs nav-stacked main-menu">
        <li class="menutitle"><?= __('Dashboard') ?></li>
        <?php
		if($loguser['group_id']==1){
		?>
		<li><?= $this->Html->link(__('<i class="icon-user"></i> <span class="hidden-tablet"> Manage Users</span>'), ['controller' => 'Users', 'action' => 'index'],array('escape'=>false)) ?></li>
		<li><?= $this->Html->link(__('<i class="icon-plus"></i> <span class="hidden-tablet"> Add User</span>'), ['controller' => 'Users', 'action' => 'add'],array('escape'=>false)) ?></li>
        <li><?= $this->Html->link(__('<i class="icon-group"></i> <span class="hidden-tablet"> Manage Groups</span>'), ['controller' => 'Groups', 'action' => 'index'],array('escape'=>false)) ?></li>
		<li><?= $this->Html->link(__('<i class="icon-plus"></i> <span class="hidden-tablet"> Add Group</span>'), ['controller' => 'Groups', 'action' => 'add'],array('escape'=>false)) ?></li>
		<li><?= $this->Html->link(__('<i class="icon-tasks"></i> <span class="hidden-tablet"> Manage Practice</span>'), ['controller' => 'Practice', 'action' => 'index'],array('escape'=>false)) ?></li>
		<li><?= $this->Html->link(__('<i class="icon-plus"></i> <span class="hidden-tablet"> Add Practice</span>'), ['controller' => 'Practice', 'action' => 'add'],array('escape'=>false)) ?></li>
		<li><?= $this->Html->link(__('<i class="icon-plus"></i> <span class="hidden-tablet"> Add Claim</span>'), ['controller' => 'Claim', 'action' => 'add'],array('escape'=>false)) ?></li>
		<?php
		}
		?>
		<?php
		if(in_array($loguser['group_id'],array(1,5))){
		?>
		
		
		<li><?= $this->Html->link(__('<i class="icon-user"></i> <span class="hidden-tablet"> Manage Patient</span>'), ['controller' => 'Patient', 'action' => 'index'],array('escape'=>false)) ?> </li>		
		<li><?= $this->Html->link(__('<i class="icon-list"></i> <span class="hidden-tablet"> Manage Claim</span>'), ['controller' => 'Claim', 'action' => 'index'],array('escape'=>false)) ?></li>
		<li><?= $this->Html->link(__('<i class="icon-list"></i> <span class="hidden-tablet"> Accounting</span>'), ['controller' => 'Claim', 'action' => 'reimbursementstatus'],array('escape'=>false)) ?></li>
		<li><?= $this->Html->link(__('<i class="icon-list"></i> <span class="hidden-tablet">Account Details</span>'), ['controller' => 'Practice', 'action' => 'mypractice'],array('escape'=>false)) ?></li>
		 <?php
		}
		?>
		<?php
		if(in_array($loguser['group_id'],array(1,3))){
		?>
		<li><?= $this->Html->link(__('<i class="icon-list"></i> <span class="hidden-tablet"> File Reimbursement Request</span>'), ['controller' => 'Claim', 'action' => 'reimbursement'],array('escape'=>false)) ?></li>
		<li><?= $this->Html->link(__('<i class="icon-list-alt"></i> <span class="hidden-tablet"> Application Cue</span>'), ['controller' => 'PracticeAps', 'action' => 'index'],array('escape'=>false)) ?></li>
		<li><?= $this->Html->link(__('<i class="icon-list-alt"></i> <span class="hidden-tablet"> Claim Review</span>'), ['controller' => 'Claim', 'action' => 'claimviewcues'],array('escape'=>false)) ?></li>
        <?php
		}
		?>
    </ul>
</nav>