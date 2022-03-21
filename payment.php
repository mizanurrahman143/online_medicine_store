<?php
require_once "dbconfig.php";

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<style>
    body {
        margin-top: 20px;
    }

    /* CSS for Credit Card Payment form */
    .credit-card-box .panel-title {
        display: inline;
        font-weight: bold;
    }

    .credit-card-box .form-control.error {
        border-color: red;
        outline: 0;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
    }

    .credit-card-box label.error {
        font-weight: bold;
        color: red;
        padding: 2px 8px;
        margin-top: 2px;
    }

    .credit-card-box .payment-errors {
        font-weight: bold;
        color: red;
        padding: 2px 8px;
        margin-top: 2px;
    }

    .credit-card-box label {
        display: block;
    }

    /* The old "center div vertically" hack */
    .credit-card-box .display-table {
        display: table;
    }

    .credit-card-box .display-tr {
        display: table-row;
    }

    .credit-card-box .display-td {
        display: table-cell;
        vertical-align: middle;
        width: 50%;
    }
    .cashDelivary {
        width: 500px;
        margin: 0 auto;
    }
    /* Just looks nicer */
    .credit-card-box .panel-heading img {
        min-width: 180px;
    }
    .delivary-title{
        text-align: center!important;
    }
</style>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    var $form = $('#payment-form');
    $form.find('.subscribe').on('click', payWithStripe);

    /* If you're using Stripe for payments */
    function payWithStripe(e) {
        e.preventDefault();

        /* Abort if invalid form data */
        if (!validator.form()) {
            return;
        }

        /* Visual feedback */
        $form.find('.subscribe').html('Validating <i class="fa fa-spinner fa-pulse"></i>').prop('disabled', true);

        var PublishableKey = 'pk_test_6pRNASCoBOKtIshFeQd4XMUh'; // Replace with your API publishable key
        Stripe.setPublishableKey(PublishableKey);

        /* Create token */
        var expiry = $form.find('[name=cardExpiry]').payment('cardExpiryVal');
        var ccData = {
            number: $form.find('[name=bkashNumber]').val().replace(/\s/g, ''),
            cvc: $form.find('[name=address]').val(),
            exp_month: expiry.month,
            exp_year: expiry.year
        };

        Stripe.card.createToken(ccData, function stripeResponseHandler(status, response) {
            if (response.error) {
                /* Visual feedback */
                $form.find('.subscribe').html('Try again').prop('disabled', false);
                /* Show Stripe errors on the form */
                $form.find('.payment-errors').text(response.error.message);
                $form.find('.payment-errors').closest('.row').show();
            } else {
                /* Visual feedback */
                $form.find('.subscribe').html('Processing <i class="fa fa-spinner fa-pulse"></i>');
                /* Hide Stripe errors on the form */
                $form.find('.payment-errors').closest('.row').hide();
                $form.find('.payment-errors').text("");
                // response contains id and card, which contains additional card details            
                console.log(response.id);
                console.log(response.card);
                var token = response.id;
                // AJAX - you would send 'token' to your server here.
                $.post('/account/stripe_card_token', {
                        token: token
                    })
                    // Assign handlers immediately after making the request,
                    .done(function(data, textStatus, jqXHR) {
                        $form.find('.subscribe').html('Payment successful <i class="fa fa-check"></i>');
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        $form.find('.subscribe').html('There was a problem').removeClass('success').addClass('error');
                        /* Show Stripe errors on the form */
                        $form.find('.payment-errors').text('Try refreshing the page and trying again.');
                        $form.find('.payment-errors').closest('.row').show();
                    });
            }
        });
    }
    /* Fancy restrictive input formatting via jQuery.payment library*/
    $('input[name=bkashNumber]').payment('formatBkashNumber');
    $('input[name=address]').payment('formatAddress');
    $('input[name=cardExpiry').payment('formatCardExpiry');

    /* Form validation using Stripe client-side validation helpers */
    jQuery.validator.addMethod("bkashNumber", function(value, element) {
        return this.optional(element) || Stripe.card.validateBkashNumber(value);
    }, "Please specify a valid credit card number.");

    jQuery.validator.addMethod("cardExpiry", function(value, element) {
        /* Parsing month/year uses jQuery.payment library */
        value = $.payment.cardExpiryVal(value);
        return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
    }, "Invalid expiration date.");

    jQuery.validator.addMethod("address", function(value, element) {
        return this.optional(element) || Stripe.card.validateCVC(value);
    }, "Invalid CVC.");

    validator = $form.validate({
        rules: {
            bkashNumber: {
                required: true,
                bkashNumber: true
            },
            cardExpiry: {
                required: true,
                cardExpiry: true
            },
            address: {
                required: true,
                address: true
            }
        },
        highlight: function(element) {
            $(element).closest('.form-control').removeClass('success').addClass('error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-control').removeClass('error').addClass('success');
        },
        errorPlacement: function(error, element) {
            $(element).closest('.form-group').append(error);
        }
    });

    paymentFormReady = function() {
        if ($form.find('[name=bkashNumber]').hasClass("success") &&
            $form.find('[name=cardExpiry]').hasClass("success") &&
            $form.find('[name=address]').val().length > 1) {
            return true;
        } else {
            return false;
        }
    }

    $form.find('.subscribe').prop('disabled', true);
    var readyInterval = setInterval(function() {
        if (paymentFormReady()) {
            $form.find('.subscribe').prop('disabled', false);
            clearInterval(readyInterval);
        }
    }, 250);

    // const cashOnDelivary = document.getElementById("cashOnDelivary").style.display = "none";
    // cashOnDelivary.style.display = "none";

    function hideForm () {
       const form = document.getElementById("bkashPayment");
       const numberInfo = document.getElementById("numberInfo");
       form.style.display = "none";
       numberInfo.style.display = "none";
       const cashOnDelivary = document.getElementById("cashOnDelivarySection");
       cashOnDelivary.style.display = "block";
   }
   function payOnDelivary() {
       console.log('click');
       hideForm();
       
   }
   

</script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>

<!-- If you're using Stripe for payments -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<div class="container">
    <div class="row">
        <!-- You can make it whatever width you want. I'm making it full width
             on <= small devices and 4/12 page width on >= medium devices -->
        <div class="col-xs-4 col-md-4"></div>
        <div class="col-xs-4 col-md-4">

        <h4 id="numberInfo">Send Money To <strong>01756008955</strong>  And Complete Your Payment by fill up this form. We will notify you within 30 minites</h4> <br>
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box" id="bkashPayment">
                <div class="panel-heading display-table">
                    <div class="row display-tr">
                        <h3 class="panel-title display-td">Payment Details</h3>
                        <div class="display-td">
                            <img class="img-responsive pull-right" src="">
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="POST" id="form">
                        <div class="row">
                           
                            <div class="col-xs-12">
                               
                                <div class="form-group">
                                    <label for="bkashNumber">Bkash Number</label>
                                    <div class="">
                                        <input type="tel" class="form-control" name="bkashnumber" placeholder="Bkash Number" autocomplete="cc-number" required autofocus />
                                      <!--  <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs">Transection ID</span><span class="visible-xs-inline"></span></label>
                                    <input type="tel" class="form-control" name="cardex" placeholder="Transection ID" autocomplete="cc-exp" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">

                                    <label for="couponCode">Amount In TK</label>
                                    <input type="text" class="form-control" value="<?php echo $_REQUEST['price'] ?>" name="amount" />
                                </div>
                            </div>
                        </div>
                         
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="address"> Address</label>
                                    <!-- <input type="textarea" class="form-control" name="cvc" placeholder="Address" autocomplete="cc-csc" required /> -->
                                    <textarea name="cvc" id="" cols="6" rows="4"class="form-control" name="cvc" placeholder="Address" autocomplete="cc-csc" required></textarea>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="submit" class="btn btn-success btn-lg btn-block" name="payment" value="Payment">
                                <br>
                            </div>
                            
                            <div class="col-md-12">
                                <a class="btn-primary btn-lg btn-block text-center" onclick="payOnDelivary()">Cash On Delivary</a>
                            </div>
                            <br>
                        </div>
                        <br>
                        
                        <div class="row" style="display:none;">
                            <div class="col-xs-12">
                                <p class="payment-errors"></p>
                            </div>
                        </div>
                    </form>
                </div>
               

                    <?php
                    if (isset($_REQUEST['payment'])) {

                        extract($_REQUEST);
                        $p = $_SESSION['userid'];
                        $q = "INSERT INTO `payment`(`bkashnumber`, `transId`, `address`, `amount`, `userid`)
					VALUES ('$bkashnumber','$cardex','$cvc','$amount','$p')";
                        $n = iud($q);
                        if ($n == 1) {
                            echo '<script>alert("Payment Successful");
						window.location="index.php";
						</script>';
                        } else {
                            echo '<script>alert("Something Wrong");
						</script>';
                        }
                    }

                    if (isset($_REQUEST['cashondelivary'])) {

                        extract($_REQUEST);
                        // $p = $_SESSION['userid'];
                        $q = "INSERT INTO `cashondelivarydb`(`name`, `phone`, `email`, `address`)
					VALUES ('$name','$phone','$email','$address')";
                        $n = iud($q);
                        if ($n == 1) {
                            echo '<script>alert("Cash On Delivary is On Progress");
						window.location="index.php";
						</script>';
                        } else {
                            echo '<script>alert("Something Wrong");
						</script>';
                        }
                    }

                    ?>
                </div>
            </div>
            <!-- CREDIT CARD FORM ENDS HERE -->
            <div class="cashDelivary">
                    <form method="POST">
                        
                    <div class="">
                        
                            <div class="pay-on-delivary" id="cashOnDelivarySection" style="display:none;">
                            <h1>Cash On Delivary</h1>
                                <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
                                <br>
                                
                                <input type="phone" name="phone" class="form-control" placeholder="Enter Phone Number" required>
                                <br>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
                                <br>
                                <textarea class="form-control" placeholder="Address" name="address" id="" cols="10" rows="5" required></textarea>
                                <br>
                                <input name="cashondelivary" type="submit" value="SUBMIT" class="form-control btn btn-primary">
                            </div>
                         </div>
                    </form>
                </div>

        </div>

<!-- editing -->
<!-- card_expairy -->

    </div>
</div>