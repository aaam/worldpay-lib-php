
 <?php include("header.php"); ?>
        <script src="https://cdn.worldpay.com/v1/worldpay.js"></script>
        <h1>PHP Library Create Order Example</h1>
        <form method="post" action="create_order.php" id="my-payment-form">
            <div class="payment-errors"></div>
            <div class="header">Checkout</div>

            <div class="form-row">
                <label>
                    Name
                </label>
                <input type="text" id="name" name="name" placeholder="Example Name" />
            </div>

            <div class="form-row">
                <label>
                    Token
                </label>
                <input type="text" id="token" data-worldpay="token" value="" />

            </div>


            <div class="form-row">
                <label>
                    CVC
                </label>
                <input type="text" id="cvc" size="4" data-worldpay="cvc" placeholder="321" />
            </div>


            <div class="form-row">
                <label>
                    Amount
                </label>
                <input type="text" id="amount" size="4" name="amount" value="15.23" />
            </div>

            <div class="form-row">
                <label>
                    Currency
                </label>
                <input type="text" id="currency" name="currency" value="GBP" />
            </div>

            <div class="form-row">
                <label>Settlement Currency</label>
                 <select id="order-type" name="settlement-currency">
                    <option value="USD" selected>USD</option>
                    <option value="GBP">GBP</option>
                    <option value="EUR">EUR</option>
                    <option value="CAD">CAD</option>
                    <option value="NOK">NOK</option>
                    <option value="SEK">SEK</option>
                    <option value="SGD">SGD</option>
                    <option value="HKD">HKD</option>
                    <option value="DKK">DKK</option>
                </select>
            </div>

            <div class="form-row">
                <label>Order Type</label>
                 <select id="order-type" name="order-type">
                    <option value="ECOM" selected>ECOM</option>
                    <option value="MOTO">MOTO</option>
                </select>
            </div>

            <div class="form-row">
                <label>Use 3DS </label>
                <input type="checkbox" id="chk3Ds" name="3ds" />
            </div>

            <div class="form-row">
                <label>Authorise Only</label>
                <input type="checkbox" id="chkAuthoriseOnly" name="authoriseOnly" />
            </div>

            <div class="header">Billing address</div>

            <div class="form-row">
                <label>
                    Address 1
                </label>
                <input type="text" id="address1" name="address1" value="123 House Road" />
            </div>

            <div class="form-row">
                <label>
                    Address 2
                </label>
                <input type="text" id="address2" name="address2" value="A village" />
            </div>

            <div class="form-row">
                <label>
                    Address 3
                </label>
                <input type="text" id="address3" name="address3" value="" />
            </div>

            <div class="form-row">
                <label>
                    City
                </label>
                <input type="text" id="city" name="city" value="London" />
            </div>

            <div class="form-row">
                <label>
                    Postcode
                </label>
                <input type="text" id="postcode" name="postcode" value="EC1 1AA" />
            </div>

            <div class="form-row">
                <label>
                    Country Code
                </label>
                <input type="text" id="country-code" name="countryCode" value="GB" />
            </div>

            <div class="header">Delivery address</div>

            <div class="form-row">
                <label>
                    First Name
                </label>
                <input type="text" id="delivery-first-name" name="delivery-firstName" value="John" />
            </div>
            <div class="form-row">
                <label>
                    Last Name
                </label>
                <input type="text" id="delivery-last-name" name="delivery-lastName" value="Doe" />
            </div>
            <div class="form-row">
                <label>
                    Address 1
                </label>
                <input type="text" id="delivery-address1" name="delivery-address1" value="123 House Road" />
            </div>

            <div class="form-row">
                <label>
                    Address 2
                </label>
                <input type="text" id="delivery-address2" name="delivery-address2" value="A village" />
            </div>

            <div class="form-row">
                <label>
                    Address 3
                </label>
                <input type="text" id="delivery-address3" name="delivery-address3" value="" />
            </div>

            <div class="form-row">
                <label>
                    City
                </label>
                <input type="text" id="delivery-city" name="delivery-city" value="London" />
            </div>

            <div class="form-row">
                <label>
                    Postcode
                </label>
                <input type="text" id="delivery-postcode" name="delivery-postcode" value="EC1 1AA" />
            </div>

            <div class="form-row">
                <label>
                    Country Code
                </label>
                <input type="text" id="delivery-country-code" name="delivery-countryCode" value="GB" />
            </div>

            <div class="header">Other</div>

            <div class="form-row">
                <label>
                    Description
                </label>
                <input type="text" id="description" name="description" value="My test order" />
            </div>

            <div class="form-row">
                <label>
                    Statement Narrative
                </label>
                <input type="text" id="statement-narrative" maxlength="24" name="statement-narrative" value="Statement Narrative" />
            </div>


                <input type="submit" id="place-order" value="Place Order" />
            </div>

            <div class="token"></div>

        </form>

    </div>

<small>
    
</small>

    <script type="text/javascript">
        if (!window['Worldpay']) {
            document.getElementById('place-order').disabled = true;
        }
        else {
            // Set client key
            Worldpay.setClientKey("your-client-key");
            // Get form element
            var form = $('#my-payment-form')[0];
            Worldpay.useForm(form, function (status, response) {
                if (response.error) {
                    Worldpay.handleError(form, $('#my-payment-form .payment-errors')[0], response.error);
                } else if (status != 200) {
                    Worldpay.handleError(form, $('#my-payment-form .payment-errors')[0], response);
                } else {
                    var token = $('#token').val();
                    Worldpay.formBuilder(form, 'input', 'hidden', 'token', token);
                    form.submit();
                }
            }, true);

            $('#chkReusable').change(function(){
                if ($(this).is(':checked')) {
                    Worldpay.reusable = true;
                }
                else {
                    Worldpay.reusable = false;
                }
            });
        }
        $('#chkReusable').prop('checked', false);
    </script>

</body>
</html>
