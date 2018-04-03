<?php
##################################
/*********************************
 *  search.php - API Endpoint
 *********************************/
##################################
ini_set('display_errors', 'on');

##################################
##################################
# INCLUDES                       #
##################################
##################################
include_once('../includes/utils.php');

##################################
##################################
# SEARCH                         #
##################################
##################################
$product = get_val('product');

// Your Access Key ID, as taken from the Your Account page
$access_key_id = "AKIAJUCBHRTUO6B4JWJQ";

// Your Secret Key corresponding to the above ID, as taken from the Your Account page
$secret_key = "vKUFho/Tgv8zpEgqBMh3L55UzfN3TZwiCBWgFuRM";

// The region you are interested in
$endpoint = "webservices.amazon.com";

// uri used with the endpoint
$uri = "/onca/xml";

$params = array(
    "Service" => "AWSECommerceService",
    "Operation" => "ItemSearch",
    "AWSAccessKeyId" => "AKIAJUCBHRTUO6B4JWJQ",
    "AssociateTag" => "mobilea0ece0a-20",
    "SearchIndex" => "All",
    "Keywords" => $product,
    "ResponseGroup" => "Images,ItemAttributes"
);

// Set current timestamp if not set
if (!isset($params["Timestamp"])) {
    $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
}

// Sort the parameters by key
ksort($params);

$pairs = array();
foreach ($params as $key => $value) {
    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
}

// Generate the canonical query
$canonical_query_string = join("&", $pairs);

// Generate the string to be signed
$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

// Generate the signature required by the Product Advertising API
$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $secret_key, true));

// Generate the signed URL
$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

// create curl resource 
$ch = curl_init(); 

// set url 
curl_setopt($ch, CURLOPT_URL, $request_url); 

//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

// $output contains the output string 
$output = curl_exec($ch); 

// close curl resource to free up system resources 
curl_close($ch); 

// parse the xml object into a PHP array
$products_xml = simplexml_load_string($output) or die("Error: Cannot create object");

// encode the php array as json and return the object
echo json_encode($products_xml);

?>