<?php // API Setup parameters
$gatewayURL = 'https://paymentdepot.transactiongateway.com/api/v2/three-step';
$APIKey = '2F822Rw39fx762MaV7Yy86jXGTC7sCDy';


// If there is no POST data or a token-id, print the initial shopping cart form to get ready for Step One.
if (empty($_POST['DO_STEP_1']) && empty($_GET['token-id'])) {

    print '
      <style>
            .error  {
                border:1px solid red;
            }
            .warningDiv {
                display:none;
                color:red;
            }
      </style>
      <p><h2>Please enter all information below.<br /></h2></p>
      <h4> Billing Details</h4>
      <div class="outerSubmit">
        <form id="myForm" action="" method="post" onsubmit="event.preventDefault(); validateMyForm();">
          <div class="innerSumbmit">
          <div class="formContainer"><span class="describeContainer">First Name</span><input type="text" name="billing-address-first-name" value="John"></div>
          <div class="formContainer"><span class="describeContainer">Last Name</span><input type="text" name="billing-address-last-name" value="Smith"></div>
          <div class="formContainer"><span class="describeContainer">Address 1</span><input type="text" name="billing-address-address1" value="1234 Main St."></div>
          <div class="formContainer"><span class="describeContainer">Address 2 </span><textarea rows="1" type="text" name="billing-address-address2" value="Suite 205"></textarea></div>
          <div class="formContainer"><span class="describeContainer">City </span><input type="text" name="billing-address-city" value="Beverly Hills"></div>
          <div class="formContainer"><span class="describeContainer">State/Province </span><input type="text" name="billing-address-state" value="CA"></div>
          <div class="formContainer"><span class="describeContainer">Zip/Postal </span><input type="text" name="billing-address-zip" value="90210"></div>
          <div class="formContainer"><span class="describeContainer">Country </span><input type="text" name="billing-address-country" value="US"></div>
          <div class="formContainer"><span class="describeContainer">Phone Number </span><input type="text" name="billing-address-phone" value="555-555-5555"></div>

          <div class="formContainer"><span class="describeContainer">Email Address </span><input type="text" name="billing-address-email" value="test@example.com"></div>
         
          <div class="formContainer"><span class="describeContainer">Invoice #</span><input type="text" name="customer-id" value="12345"></div>
          <div class="formContainer"><span class="describeContainer">Payment Amount</span><input type="text"  value="23" name="payment-amount" value=""></div>
           
            <div>
          <input type="submit" value="Submit Step One"><input type="hidden" name ="DO_STEP_1" value="true"></div>
     
          <div class="warningDiv">
          Please fill in all fields
          </div>

        </form>
        </div>
        <script>
        function validateMyForm() {
          var outer = Array.from(document.getElementsByClassName("outerSubmit"));
          var submit = true;
            var inputs = Array.from(outer[0].getElementsByTagName("input"));
            var selects= Array.from(outer[0].getElementsByTagName("select"));
            var allInputs = inputs.concat(selects);
            for (i=0; i < allInputs.length ; i++) { 
                debugger
                if(allInputs[i].value == ""){
                     document.getElementsByClassName("warningDiv")[0].style.display = "block";
                    
                    allInputs[i].parentNode.classList.add("error");
                    submit = false;
                }
            }
                if (submit == true){
    document.getElementById("myForm").submit();
}
}

        </script>

    ';
}else if (!empty($_POST['DO_STEP_1'])) {

    // Initiate Step One: Now that we've collected the non-sensitive payment information, we can combine other order information and build the XML format.
    $xmlRequest = new DOMDocument('1.0','UTF-8');

    $xmlRequest->formatOutput = true;
    $xmlSale = $xmlRequest->createElement('sale');

    // Amount, authentication, and Redirect-URL are typically the bare minimum.
    appendXmlNode($xmlRequest, $xmlSale,'api-key',$APIKey);
    appendXmlNode($xmlRequest, $xmlSale,'redirect-url',$_SERVER['HTTP_REFERER']);
    appendXmlNode($xmlRequest, $xmlSale, 'amount', $_POST['payment-amount']);
    appendXmlNode($xmlRequest, $xmlSale, 'ip-address', $_SERVER["REMOTE_ADDR"]);
    //appendXmlNode($xmlRequest, $xmlSale, 'processor-id' , 'processor-a');
    appendXmlNode($xmlRequest, $xmlSale, 'currency', 'USD');

    // Some additonal fields may have been previously decided by user
    appendXmlNode($xmlRequest, $xmlSale, 'customer-id', $_POST['customer-id']);
    appendXmlNode($xmlRequest, $xmlSale, 'order-description', 'Bill for Assisting Hands');

    // Set the Billing and Shipping from what was collected on initial shopping cart form
    $xmlBillingAddress = $xmlRequest->createElement('billing');
    appendXmlNode($xmlRequest, $xmlBillingAddress,'first-name', $_POST['billing-address-first-name']);
    appendXmlNode($xmlRequest, $xmlBillingAddress,'last-name', $_POST['billing-address-last-name']);
    appendXmlNode($xmlRequest, $xmlBillingAddress,'address1', $_POST['billing-address-address1']);
    appendXmlNode($xmlRequest, $xmlBillingAddress,'city', $_POST['billing-address-city']);
    appendXmlNode($xmlRequest, $xmlBillingAddress,'state', $_POST['billing-address-state']);
    appendXmlNode($xmlRequest, $xmlBillingAddress,'postal', $_POST['billing-address-zip']);
    //billing-address-email
    appendXmlNode($xmlRequest, $xmlBillingAddress,'country', $_POST['billing-address-country']);
    appendXmlNode($xmlRequest, $xmlBillingAddress,'email', $_POST['billing-address-email']);
    appendXmlNode($xmlRequest, $xmlBillingAddress,'phone', $_POST['billing-address-phone']);
    appendXmlNode($xmlRequest, $xmlBillingAddress,'address2', $_POST['billing-address-address2']);
    $xmlSale->appendChild($xmlBillingAddress);


    $xmlRequest->appendChild($xmlSale);

    // Process Step One: Submit all transaction details to the Payment Gateway except the customer's sensitive payment information.
    // The Payment Gateway will return a variable form-url.
    $data = sendXMLviaCurl($xmlRequest,$gatewayURL);

    // Parse Step One's XML response
    $gwResponse = @new SimpleXMLElement($data);
    if ((string)$gwResponse->result ==1 ) {
        // The form url for used in Step Two below
        $formURL = $gwResponse->{'form-url'};
    } else {
        throw New Exception(print " Error, received " . $data);
    }

    // Initiate Step Two: Create an HTML form that collects the customer's sensitive payment information
    // and use the form-url that the Payment Gateway returns as the submit action in that form.



    // Uncomment the line below if you would like to print Step One's response
    // print '<pre>' . (htmlentities($data)) . '</pre>';
    print '
          <style>
            .error  {
                border:1px solid red;
            }
            .warningDiv {
                color:red;
                display:none;
            }
      </style>
        <p><h2>Step Two: Collect sensitive payment information and POST directly to payment gateway<br /></h2></p>
<div class="outerSubmit">
        <form id="myForm" action="'.$formURL. '" method="POST" onsubmit="event.preventDefault(); validateMyForm();">
        <div class="innerSumbmit">
        <h3> Payment Information</h3>

                <div class="formContainer"><span class="describeContainer">Billing Account Name</span><INPUT  value"gene eric" type ="text" name="billing-account-name" value=""> </div>
                <div class="formContainer"><span class="describeContainer">billing-account-number</span><INPUT type ="text" name="billing-account-number" value="  123123123"> </div>
                <div class="formContainer"><span class="describeContainer">billing-routing-number</span><INPUT type ="text" name="billing-routing-number" value="  123123123"> </div>
                <div class="formContainer"><span class="describeContainer">billing-routing-number</span>
                <select name="billing-account-type">
                <option disabled selected value> -- select an option -- </option>
                <option>checking</option>
                <option>savings</option>
                </select></div>

                <div class="formContainer"><span class="describeContainer">billing-routing-number</span>
                <select name="billing-entity-type">
                <option disabled selected value> -- select an option -- </option>
                <option>personal</option>
                <option>business</option>
                </select></div>

              
                <div><INPUT type ="submit" value="Submit Step Two"></div>
                      <div class="warningDiv ">
          Please fill in all fields
          </div>
         
            </div>
        </form>
        </div>
         <script>
         function validateMyForm() {
          var outer = Array.from(document.getElementsByClassName("outerSubmit"));
          var submit = true;
            var inputs = Array.from(outer[0].getElementsByTagName("input"));
            var selects= Array.from(outer[0].getElementsByTagName("select"));
            var allInputs = inputs.concat(selects);
            for (i=0; i < allInputs.length ; i++) { 
                debugger
                if(allInputs[i].value == ""){
                    document.getElementsByClassName("warningDiv")[0].style.display = "block";
                    
                    allInputs[i].parentNode.classList.add("error");
                    submit = false;
                }
            }
                if (submit == true){
    document.getElementById("myForm").submit();
}
}

        </script>

        ';

} elseif (!empty($_GET['token-id'])) {

    // Step Three: Once the browser has been redirected, we can obtain the token-id and complete
    // the transaction through another XML HTTPS POST including the token-id which abstracts the
    // sensitive payment information that was previously collected by the Payment Gateway.
    $tokenId = $_GET['token-id'];
    $xmlRequest = new DOMDocument('1.0','UTF-8');
    $xmlRequest->formatOutput = true;
    $xmlCompleteTransaction = $xmlRequest->createElement('complete-action');
    appendXmlNode($xmlRequest, $xmlCompleteTransaction,'api-key',$APIKey);
    appendXmlNode($xmlRequest, $xmlCompleteTransaction,'token-id',$tokenId);
    $xmlRequest->appendChild($xmlCompleteTransaction);


    // Process Step Three
    $data = sendXMLviaCurl($xmlRequest,$gatewayURL);


    $gwResponse = @new SimpleXMLElement((string)$data);


    if ((string)$gwResponse->result == 1 ) {
        print "<p><h3> Transaction was Approved</h3></p>\n";
        print "<p><a href=#><button onclick='window.print()'>Print</button></p>";
        print"<a href='http://www.assistinghands.com/22/newjersey/livingston/'>please click here to go back to the main page</a>";
        print"<h4>Summary: </h4>";
        print '<div><ul>';
        print "<li>Invoice #: " . ((string) $gwResponse->{'customer-id'}[0]) . "</li>";
        print "<li>Transaction ID: " . ((string) $gwResponse->{'transaction-id'}[0]) . "</li>";
        print "<li>Amount: " . ((string) $gwResponse->{'amount'}[0]) . "</li>";
        print '</ul></div>';
        print '<p>Billing Info</p><div><ul>';
        print "<li>First Name: " . ((string) $gwResponse->billing->{'first-name'}[0]) . "</li>";
        print "<li>Last Name: " . ((string) $gwResponse->billing->{'last-name'}[0]) . "</li>";
        print "<li>Address 1: " . ((string) $gwResponse->billing->{'address1'}[0]) . "</li>";
        print "<li>Address 2: " . ((string) $gwResponse->billing->{'address2'}[0]) . "</li>";
        print "<li>City: " . ((string) $gwResponse->billing->{'city'}[0]) . "</li>";
        print "<li>State: " . ((string) $gwResponse->billing->{'state'}[0]) . "</li>";
        print "<li>Postal: " . ((string) $gwResponse->billing->{'postal'}[0]) . "</li>";
        print "<li>Country: " . ((string) $gwResponse->billing->{'country'}[0]) . "</li>";
        print "<li>Phone: " . ((string) $gwResponse->billing->{'phone'}[0]) . "</li>";
        print "<li>Email: " . ((string) $gwResponse->billing->{'email'}[0]) . "</li>";
        print "<li>Account Number: " . ((string) $gwResponse->billing->{'account-number'}[0]) . "</li>";
        print "<li>Routing Number: " . ((string) $gwResponse->billing->{'routing-number'}[0]) . "</li>";
        print "<li>Account Type: " . ((string) $gwResponse->billing->{'account-type'}[0]) . "</li>";
        print "<li>Entity Type: " . ((string) $gwResponse->billing->{'entity-type'}[0]) . "</li>";
        print '</ul></div>';

    } elseif((string)$gwResponse->result == 2)  {
        print " <p><h3> Transaction was Declined.</h3>\n";
        print " Decline Description : " . (string)$gwResponse->{'result-text'} ." </p>";
        print " <p><h3>XML response was:</h3></p>\n";
        print '<pre>' . (htmlentities($data)) . '</pre>';
    } else {
        print " <p><h3> Transaction caused an Error.</h3>\n";
        print " Error Description: " . (string)$gwResponse->{'result-text'} ." </p>";
        print " <p><h3>XML response was:</h3></p>\n";
        print '<pre>' . (htmlentities($data)) . '</pre>';
    }



} else {
  print "ERROR IN SCRIPT<BR>";
}


  function sendXMLviaCurl($xmlRequest,$gatewayURL) {
   // helper function demonstrating how to send the xml with curl


    $ch = curl_init(); // Initialize curl handle
    curl_setopt($ch, CURLOPT_URL, $gatewayURL); // Set POST URL

    $headers = array();
    $headers[] = "Content-type: text/xml";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Add http headers to let it know we're sending XML
    $xmlString = $xmlRequest->saveXML();
    curl_setopt($ch, CURLOPT_FAILONERROR, 1); // Fail on errors
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Allow redirects
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return into a variable
    curl_setopt($ch, CURLOPT_PORT, 443); // Set the port number
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Times out after 30s
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString); // Add XML directly in POST

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);


    // This should be unset in production use. With it on, it forces the ssl cert to be valid
    // before sending info.
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    if (!($data = curl_exec($ch))) {
        print  "curl error =>" .curl_error($ch) ."\n";
        throw New Exception(" CURL ERROR :" . curl_error($ch));

    }
    curl_close($ch);

    return $data;
  }

  // Helper function to make building xml dom easier
  function appendXmlNode($domDocument, $parentNode, $name, $value) {
        $childNode      = $domDocument->createElement($name);
        $childNodeValue = $domDocument->createTextNode($value);
        $childNode->appendChild($childNodeValue);
        $parentNode->appendChild($childNode);
  }
  ?>