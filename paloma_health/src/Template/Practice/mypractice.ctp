<div class="practice view large-9 medium-8 columns content custom_design" style="padding:10px 30px;">
	<div style="margin:100px auto;max-width:300px;">
		
			<div><?= $this->Html->link(__('Practice Info'), ['controller' => 'Practice', 'action' => 'practiceinfo'],['class' => 'btn-blue']) ?></div><br>
			<div>
			<?= $this->Html->link(__('Practice Payment Info'), ['controller' => 'Practice', 'action' => 'paymentinfo'],['class' => 'btn-blue']) ?>
			</div>
	</div>
</div>
