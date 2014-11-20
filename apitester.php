<!DOCTYPE HTML>

<html>
	<head>
		<title>WHMCS API VALIDATOR</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.onvisible.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
		</noscript>
	</head>
	<body class="homepage">

		<!-- Header -->
			<div id="header">
						
				<!-- Inner -->
					<div class="inner">
						<header>
							<h1><a href="apitester.php" id="logo">WHMCS TESTING</a></h1>
							<hr />
							<p>WHMCS TEST API VALIDATOR</p>
						</header>
						<footer>
							<a href="#banner" class="button circled scrolly">Start</a>
						</footer>
					</div>
				</div>
			
		<!-- Banner -->
			<section id="banner">
				<header>
					<h2>This is the WHMCS API Validation script by <strong>Chance</strong>.</h2>
					<p>
						Feel free to use at your leisure as I will be adding more calls as time permits.
					</p>
                    <p>
                        If they do not provide you with access key, you will need to whitelist the IP: 192.254.75.66
                    </p>
                    <p>
                        Besure to remove afterwards!
                    </p>
				</header>
			</section>
			
		<!-- Main -->
			<div class="wrapper style2">

			<article id="main" class="container special">

    	<script type="text/javascript">
        // Lets use jquery since its very cross platform
        $(document).ready(function() {
            
            $('#clientfields').hide();
            $('#clientfieldsid').hide();
            $('#idfields').hide();
            $('#updateclient').hide();
            $('#whoisinfo').hide();
            $(document).on("change","#api",function() {
                if ($("#api").val() == "addclient"){
                    $('#clientfields').show();
                    $('#clientfieldsid').hide();
                    $('#idfields').hide();
                    $('#updateclient').hide();
                    $('#whoisinfo').hide();
                } else if ($("#api").val() == "getclientsproducts"){
                    $('#clientfields').hide();
                    $('#clientfieldsid').show();
                    $('#idfields').hide();
                    $('#updateclient').hide();
                    $('#whoisinfo').hide();
                } else if ($("#api").val() == "getproducts"){
                    $('#clientfields').hide();
                    $('#clientfieldsid').hide();
                    $('#idfields').show();
                    $('#updateclient').hide();
                    $('#whoisinfo').hide();
                } else if ($("#api").val() == "getinvoice"){
                    $('#clientfields').hide();
                    $('#clientfieldsid').hide();
                    $('#idfields').show();
                    $('#updateclient').hide();
                    $('#whoisinfo').hide();
                } else if ($("#api").val() == "updateclient"){
                    $('#clientfields').hide();
                    $('#clientfieldsid').show();
                    $('#idfields').hide();
                    $('#updateclient').show();
                    $('#whoisinfo').hide();
                } else if ($("#api").val() == "getclientsdetails"){
                    $('#clientfields').hide();
                    $('#clientfieldsid').show();
                    $('#idfields').hide();
                    $('#updateclient').hide();
                    $('#whoisinfo').hide();
                } else if ($("#api").val() == "domainwhois"){
                    $('#clientfields').hide();
                    $('#clientfieldsid').hide();
                    $('#idfields').hide();
                    $('#updateclient').hide();
                    $('#whoisinfo').show();
                } else if ($("#api").val() == "getinvoices"){
                    $('#clientfields').hide();
                    $('#clientfieldsid').show();
                    $('#idfields').hide();
                    $('#updateclient').hide();
                    $('#whoisinfo').hide();
                } else {
                    $('#clientfields').hide();
                    $('#clientfieldsid').hide();
                    $('#idfields').hide();
                    $('#updateclient').hide();
                    $('#whoisinfo').hide();
                }
            });
        });
    </script>
<style type="text/css">
    .error {color: #FF0000;}
</style>

<body>

<?php    

/* Use this if putting in your WHMCS directory 

if(file_exists("init.php")) {
    // Always use require once to avoid conflicts
    require_once("init.php");
} elseif(file_exists("../init.php")) {
    // Same as above
    require_once("../init.php");
} else {
    // Die, it was required
    die("Init Not Found");
/* */

// define vars and set to empty values
$userErr = $passErr = $apiurlErr = $responseErr = "";
$user = $pass = $apikey = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["user"])) $userErr = "User is required";
    else $user = test_input ($_POST["user"]);
    if (empty($_POST["pass"])) $passErr = "Password is required";
    else $pass = test_input ($_POST["pass"]);
    if (!empty($_POST["apikey"])) $apikey = test_input ($_POST["apikey"]);

    if (empty($_POST["apiurl"])) $apiurlErr = "API URL is required";
    else $apiurl = (($_POST["apiurltype"]=="https") ? "https://" : "http://") .test_input ($_POST["apiurl"]);
    #else $apiurl = ((stripos($_POST["apiurltype"], 'https') !== false) ? "https://" : "http://") .test_input ($_POST["apiurl"]);
    if (empty($_POST["api"])) $api = "";
    else $api = test_input ($_POST["api"]);
    if (empty($_POST["responsetype"])) $responseErr = "json or xml...json recommended";
    else $responsetype = test_input ($_POST["responsetype"]);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// me testing the apiurl protocol
#die("'$apiurl'");
#die("'$_POST[apiurltype]'");

foreach ($_REQUEST as $k=>$v) $$k = $v;
?>

<h2>API TEST VALIDATION</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    User: <input type="text" name="user" value="<?php echo $user;?>">
    <span class="error">* <?php echo $userErr;?></span>
    <br><br>
    Pass: <input type="password" name="pass">
    <span class="error">* <?php echo $passErr;?></span>
    <br><br>
    API Key: <input type="text" name="apikey" value="<?php echo $apikey;?>">
    <br><br>
    API URL: <!--<select id="apiurltype" name="apiurltype"><option value = "https">https://</option>
        <option value = "http">http://</option></select>--><input type="text" name="apiurl" value="<?php echo $apiurl;?>">
    <span class="error">* <?php echo $apiurlErr;?></span>
    <br><br>
    <div class="responsetype">
        <label class="responsetype">Response Type: </label>
        <select id="responsetype" name="responsetype">
            <option value = "json" selected>JSON **Recommended**</option>
            <option value = "xml">XML</option>
        </select>
    </div>
    <br>
    <div class="apicall">
        <label class="apicall">API CALL: </label>
        <select id="api" name="api"> <!-- Make sure to keep them alphabetic just cause lol -->
            <option value = "none" selected>-- Select A Call --</option>
            <option value = "addclient">Add Client</option>
            <option value = "updateclient">Update Client</option>
            <option value = "getclients">Get Clients</option>
            <option value = "getclientsdetails">Get Clients Details</option>
            <option value = "getclientsproducts">Get Clients Products</option>
            <option value = "getadmindetails">Get Admin Details</option>
            <option value = "getproducts">Get Products</option>
            <option value = "getinvoice">Get Invoice</option>
            <option value = "getinvoices">Get Invoices</option>
            <option value = "domainwhois">WHOIS</option>
            <option value = "getactivitylog">Activity Log</option>
            <option value = "gettickets">Get Tickets</option>
        </select>
    </div>
    <br>
<!-- These are the additional fields for API calls -->
    <div id="clientfields">
        <label class="clientfn">Client First Name: </label>
        <input type="text" name="clientfn" class="clientfn">
        <br>
        <label class="clienln">Client Last Name: </label>
        <input type="text" name="clientln" class="clientln">
        <br>
        <label class="email">Client Email: </label>
        <input type="text" name="clientemail" class="clientemail">
        <br>
        <label class="address1">Address 1: </label>
        <input type="text" name="address1" class="address1">
        <br>
        <label class="city">City: </label>
        <input type="text" name="city" class="city">
        <br>
        <label class="state">State: </label>
        <input type="text" name="state" class="state">
        <br>
        <label class="postcode">ZipCode: </label>
        <input type="text" name="postcode" class="postcode">
        <br>
        <label class="country">Country: </label>
        <input type="text" name="country" class="country" value="2 letter ISO code">
        <br>
        <label class="phonenumber">Phone: </label>
        <input type="text" name="phonenumber" class="phonenumber">
        <br>
        <label class="password2">Password: </label>
        <input type="text" name="password2" class="password2">
    </div>
    <div id="clientfieldsid">
        <h3>If testing Get Clients Details...Use XML as your response type to show stats for client.</h3>
        <label class="clientid">Client ID: </label>
        <input type="text" name="clientid" class="clientid">
    </div>
    <div id="idfields">
        <h3>***Input is numerical value type...***</h3>
        <label class="idtype">ID Type: </label>
        <input type="text" name="idtype" class="idtype">
    </div>
    <div id="updateclient">
        <h3>Input the action and the value...</h3>
        <label class="attribute">Attribute: </label>
        <input type="text" name="attribute" class="attribute">
        <br>
        <label class="value">Value: </label>
        <input type="text" name="value" class="value">
    </div>
    <div id="whoisinfo">
        <label class="whois">WHOIS: </label>
        <input type="text" name="whois" class="whois">
    </div>
    <br><br>
        
    <input type="submit" name="submit" value="Test The API">
</form>

<?php
$url = $apiurl;
if($url) {
    #Only try curl when URL is submitted
    echo "<h2>Your Values:</h2>";
    echo $user;
    echo "<br>";
    echo $apikey;
    echo "<br>";
    echo $apiurl;
    echo "<br>"; 
    //echo $api; // Commented this out, seems redundant when the stuff below shows it as well
    $postfields = array();
    $postfields["username"] = $user;
    $postfields["password"] = md5($pass);
    if($apikey) $postfields["accesskey"] = $apikey;
    $postfields["responsetype"] = "$responsetype"; #Valid options are json or xml. json recommended.
    if ($api == "getclients") $postfields["action"] = "getclients";
    elseif ($api == "getadmindetails") $postfields["action"] = "getadmindetails";
    elseif ($api == "addclient") {
        $postfields["action"] = "addclient";
        $postfields["firstname"] = "$clientfn";
        $postfields["lastname"] = "$clientln";
        $postfields["email"] = "$clientemail";
        $postfields["address1"] = "$address1";
        $postfields["city"] = "$city";
        $postfields["state"] = "$state";
        $postfields["postcode"] = "$postcode";
        $postfields["country"] = "$country";
        $postfields["phonenumber"] = "$phonenumber";
        $postfields["password2"] = "$password2";
        $postfields["currency"] = "1"; // adding this manually as everyone should be on the base currency
    }
    elseif ($api == "getproducts") {
        $postfields["action"] = "getproducts";
        $postfields["pid"] = "$idtype";
    }
    elseif ($api == "getclientsproducts") {
        $postfields["action"] = "getclientsproducts";
        $postfields["clientid"] = "$clientid";
    }
    elseif ($api == "getinvoice") {
        $postfields["action"] = "getinvoice";
        $postfields["invoiceid"] = "$idtype";
    }
    elseif ($api == "updateclient") {
        $postfields["action"] = "updateclient";
        $postfields["clientid"] = "$clientid";
        $postfields["$attribute"] = "$value";
    }
    elseif ($api == "getclientsdetails") {
        $postfields["action"] = "getclientsdetails";
        $postfields["clientid"] = "$clientid";
    }
    elseif ($api == "domainwhois") {
        $postfields["action"] = "domainwhois";
        $postfields["domain"] = "$whois";
    }
    elseif ($api == "getactivitylog") {
        $postfields["action"] = "getactivitylog";
    }
    elseif ($api == "gettickets") {
        $postfields["action"] = "gettickets";
    }
    elseif ($api == "getinvoices") {
        $postfields["action"] = "getinvoices";
        $postfields["userid"] = "$clientid";
    }
    $query_string = "";
    foreach ($postfields as $k=>$v) $query_string .= "$k=".urlencode($v)."&";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $data = curl_exec($ch);
    if(curl_error($ch)){
        $error = curl_errno($ch).' - '.curl_error($ch);
    }
    if($postfields["responsetype"]=="xml"){
        if($error){
            $xml = '<whmcsapi><result>error</result>'.
     '<message>Connection Error</message><curlerror>'.$error.'</curlerror></whmcsapi>';
        }
        $arr = whmcsapi_xml_parser($data); # Parse XML
    }elseif($postfields["responsetype"]=="json"){
        if($error) $arr = array("error" => "A connection error occurred: $error");
        else $arr = json_decode($data,true);
    }else $arr = array("error" => "Unsupported responsetype");
    curl_close($ch);
    
    echo "<textarea rows=50 cols=100>Request: $url\n\n".print_r($postfields,true);
    echo "\nResponse: ".htmlentities($data). "\n\nArray: ".print_r($arr,true);
    echo "</textarea>";
}

function whmcsapi_xml_parser($rawxml) {
     $xml_parser = xml_parser_create();
     xml_parse_into_struct($xml_parser, $rawxml, $vals, $index);
     xml_parser_free($xml_parser);
     $params = array();
     $level = array();
     $alreadyused = array();
     $x=0;
     foreach ($vals as $xml_elem) {
       if ($xml_elem['type'] == 'open') {
          if (in_array($xml_elem['tag'],$alreadyused)) {
              $x++;
              $xml_elem['tag'] = $xml_elem['tag'].$x;
          }
          $level[$xml_elem['level']] = $xml_elem['tag'];
          $alreadyused[] = $xml_elem['tag'];
       }
       if ($xml_elem['type'] == 'complete') {
        $start_level = 1;
        $php_stmt = '$params';
        while($start_level < $xml_elem['level']) {
          $php_stmt .= '[$level['.$start_level.']]';
          $start_level++;
        }
        $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
        @eval($php_stmt);
       }
     }
     return($params);
 }
?>
			</div>

		<!-- Footer -->
			<div id="footer">
					<div class="row">
						<div class="12u">
							
							<!-- Contact -->
								<section class="contact">
									<header>
										<h3>Have suggestions and requests? <a href="mailto:chance@whmcs.com?Subject=Suggestions%20and%20Requests">Click here and let me know!</a></h3>
									</header>
									
							
							<!-- Copyright -->
								<div class="copyright">
									<ul class="menu">
										<li>&copy; Chance. All rights reserved.</li>
                                        <li>Last Update: Sunday Sept 7, 2014</li>
									</ul>
								</div>
							
						</div>
					
					</div>
				</div>
			</div>

	</body>
</html>
