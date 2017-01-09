<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
        <!-- jQuery is used only for this example; it isn't required to use Stripe -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">
            // this identifies your website in the createToken call below
            Stripe.setPublishableKey('pk_test_u0iitabJ6uG4HuLNy9X3mglA');
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
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
					
                    return false;
					
                });
				
            });
        </script>
<div class="claim large-9 medium-8 columns content custom_design">
<h1>Charge $10 with Stripe</h1>
        <!-- to display errors returned by createToken -->
        <span class="payment-errors"><?= $error ?></span>
        <span class="payment-success"><?= $success ?></span>
        <?= $this->Form->create($claim,array('id' => 'payment-form','class'=>'form-horizontal')) ?>
            <div class="form-row">
                <label>Card Number</label>
                <?php echo $this->Form->input('card-number', ['label'=>false,'div'=>false,'type'=>'text','class'=>' card-number']);?>

            </div>
            <div class="form-row">
                <label>CVC</label>
				<?php echo $this->Form->input('card-cvc', ['label'=>false,'div'=>false,'type'=>'text','class'=>'card-cvc']);?>
            </div>
            <div class="form-row">
                <label>Expiration (MM/YYYY)</label>
				<?php echo $this->Form->input('card-expiry-month', ['label'=>false,'div'=>false,'type'=>'text','class'=>'card-expiry-month']);?>
                <span> / </span>
				<?php echo $this->Form->input('card-expiry-year', ['label'=>false,'div'=>false,'type'=>'text','class'=>'card-expiry-year']);?>
            </div>
            <button type="submit" class="submit-button">Submit Payment</button>
          <?= $this->Form->end() ?>
</div>
<script>
$(document).ready(function() {	
});
</script>