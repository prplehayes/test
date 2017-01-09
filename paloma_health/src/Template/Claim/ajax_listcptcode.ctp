<?php 
$randno=mt_rand(1,20);
if (!empty($cptCodes)): ?>
            <?php foreach ($cptCodes as $cptCode): ?>
                <div class="cptoption"><input type="radio" required="required" data-code="<?= h($cptCode->code) ?>" name="cptcode[<?php echo $randno?>]" value="<?= h($cptCode->id) ?>">&nbsp;<?= h($cptCode->description) ?> (<?= h($cptCode->code) ?>)	    
				&nbsp;&nbsp;&nbsp;&nbsp;<div class="addfld"><?php           
				if($cptCode->required_tooth_number==1){
					
					?>
					TOOTH # : <input type="text" name="tooth_number<?php echo $randno?>_<?php echo $cptCode->id?>[]">
					<br>
					<?php
				}
				if($cptCode->required_upper_or_lower==1){
					?>
					Upper or Lower : <select name="upper_or_lower<?php echo $randno?>_<?php echo $cptCode->id?>[]"><option value="">Select</option>
					<option value="Upper">Upper</option>
					<option value="Lower">Lower</option>
					</select>
					<br>
					<?php
				}
				if($cptCode->required_surface==1){
					?>
					<span>Surface : <select name="surface<?php echo $randno?>_<?php echo $cptCode->id?>[]"><option value="">Select</option>
					<option value="M">M</option>
					<option value="O">O</option>
					<option value="D">D</option>
					<option value="F">F</option>
					<option value="L">L</option>
					<option value="I">I</option>
					</select></span>
					<br>
					<?php
				}
				if($cptCode->required_surface2==1){
					?>
					<span>Surface 2 : <select name="surface2<?php echo $randno?>_<?php echo $cptCode->id?>[]"><option value="">Select</option>
					<option value="M">M</option>
					<option value="O">O</option>
					<option value="D">D</option>
					<option value="F">F</option>
					<option value="L">L</option>
					<option value="I">I</option>
					</select></span>
					<br>
					<?php
				}
				if($cptCode->required_surface3==1){
					?>
					<span>Surface 3 : <select name="surface3<?php echo $randno?>_<?php echo $cptCode->id?>[]"><option value="">Select</option>
					<option value="M">M</option>
					<option value="O">O</option>
					<option value="D">D</option>
					<option value="F">F</option>
					<option value="L">L</option>
					<option value="I">I</option>
					</select></span>
					<br>
					<?php
				}
				if($cptCode->required_surface4==1){
					?>
					<span>Surface 4 : <select name="surface4<?php echo $randno?>_<?php echo $cptCode->id?>[]"><option value="">Select</option>
					<option value="M">M</option>
					<option value="O">O</option>
					<option value="D">D</option>
					<option value="F">F</option>
					<option value="L">L</option>
					<option value="I">I</option>
					</select></span>
					<br>
					<?php
				}
				if($cptCode->required_quadrent_1_code==1){
					?>
					QUADRANT : <input type="text" name="quadrent_1_code<?php echo $randno?>_<?php echo $cptCode->id?>[]">
					<br>
					<?php
				}
				if($cptCode->required_arch_code==1){
					?>
					Arch Code : <input type="text" name="arch_code<?php echo $randno?>_<?php echo $cptCode->id?>[]">
					<br>
					<?php
				}
				if($cptCode->required_quadrent_or_arch_code==1){
					?>
					Quadrent or Arch code : <input type="text" name="quadrent_or_arch_code<?php echo $randno?>_<?php echo $cptCode->id?>[]">
					<br>
					<?php
				}
				?></div>
				</div>
				<div class="clear"></div>
            <?php endforeach; ?>
<?php endif; ?>