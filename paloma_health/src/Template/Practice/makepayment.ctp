<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
        <!-- jQuery is used only for this example; it isn't required to use Stripe -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">
            // this identifies your website in the createToken call below
            Stripe.setPublishableKey('<?php echo $publickey?>');
            function stripeResponseHandler(status, response) {
			    if (response.error) {
                    // re-enable the submit button
                    $('.submit-button').removeAttr("disabled");
                    // show the errors on the form
                    $(".payment-errors").html(response.error.message);
                } else {
                    var form$ = $("#payment-form");
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                    // and submit
                    form$.get(0).submit();
                }
            }
            $(document).ready(function() {
                $("#payment-form").submit(function(event) {

                    // disable the submit button to prevent repeated clicks
                    //$('.submit-button').attr("disabled", "disabled");
                    Stripe.createToken({
                        number: $('#token').val(),
                        cvc: $('#cvv').val(),
                        exp_month: $('#expiration-month').val(),
                        exp_year: $('#expiration-year').val()
                    }, stripeResponseHandler);
					
                    return false;
					
                });
				
            });
        </script>
<div class="practice form large-6 medium-8 columns content registerp">
    <?= $this->Form->create($practice,array('id' => 'payment-form','class'=>'form-horizontal')) ?>
    <fieldset>
        <legend><?= __('Payment Information') ?></legend>
        <span class="payment-errors"><?= $error ?></span>
        <span class="payment-success"><?= $success ?></span>
		
		<?php
            echo $this->Form->input('first_name',['required'=>'required']);
            echo $this->Form->input('last_name',['required'=>'required']);
            echo $this->Form->input('token',['label'=>'Credit Card Number','required'=>'required']);
			?><div class="input text">
			<label for="exp-name">Expiry Date</label><input type="text" id="expiration-month" name="expiration_month" style="width:30px;" required="required"> / <input type="text" id="expiration-year" name="expiration_year" style="width:30px;" required="required">
			</div>
			<?php
           
            echo $this->Form->input('cvv',['label'=>'CVV Code','required'=>'required']);
           ?>
		   <br>
		   <strong>Billing Address</strong><br>
		   <?php echo $this->Form->input('address_1', ['label'=>'Street Address','div'=>false,'type'=>'text','Placeholder'=>'Street Address','required'=>'required']);?>
			<?php echo $this->Form->input('address_2', ['label'=>'Apt/Suite','div'=>false,'type'=>'text','Placeholder'=>'Apt/Suite','required'=>'required']);?>
			<?php echo $this->Form->input('city', ['label'=>'City','div'=>false,'type'=>'text','Placeholder'=>'City','required'=>'required']);?>
			<?php echo $this->Form->input('state', ['label'=>'State','div'=>false,'type'=>'text','Placeholder'=>'State','required'=>'required']);?>
			<?php echo $this->Form->input('zip', ['label'=>'Zip Code','div'=>false,'type'=>'text','Placeholder'=>'Zip Code','required'=>'required']);?>    </fieldset>
			<div class="clear"></div>
			<div><strong>Charge :</strong> $<?php echo $amount?>/Month</div>
			<div class="clear"><br></div>
   <div style="float:left"><?= $this->Form->button(__('Submit and Pay'),['class'=>'submit-button btn-primary']) ?></div>
    <?= $this->Form->end() ?>
</div>
