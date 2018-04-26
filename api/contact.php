<?php
##################################
/*********************************
 *  contact.php - API Endpoint
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
# CONTACT                        #
##################################
##################################
$companies = get_val('companies');
$companies = explode (';', $companies);

$file_rows = array();
$company_names = array();

foreach($companies as $company){
  $result = getContact($company);
  $name = get_val('name', $result);
  
  if(!in_array($name, $company_names)){
    $company_names[] = $name;
    $file_rows[] = $result;
  }// end if we havent seen this company

}// end foreach over companies

array_to_csv($file_rows, "export.csv");

exit;

##################################
##################################
# FUNCTIONS                      #
##################################
##################################

function getContact($company){
  // Your Access Key ID, as taken from the Your Account page
  $api_key = "sk_b0948e1550717376303dcda241b117e5";

  // The region you are interested in
  $endpoint = "company.clearbit.com/v1";

  // uri used with the endpoint
  $uri = "/domains/find";

  $params = array(
    "name" => $company
  );

  $pairs = array();
  foreach ($params as $key => $value) {
    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
  }

  // Generate the canonical query
  $canonical_query_string = join("&", $pairs);

  // Generate the URL
  $request_url = 'https://'.$endpoint.$uri.'?'.$canonical_query_string;

  // create curl resource 
  $ch = curl_init(); 

  // set url 
  curl_setopt($ch, CURLOPT_URL, $request_url); 

  // return the transfer as a string 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

  // authenticate our api request
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$api_key
  ));

  // $output contains the output string 
  $result = curl_exec($ch);
  
  // convert the result into a php array
  $result = json_decode($result, true);

  // close curl resource to free up system resources 
  curl_close($ch); 

  if(get_val('error', $result) != null){
    return 'company not found';
  }// end if we have an error

  // wait for a short amount of time between requests
  usleep(250000);

  // The region you are interested in
  $endpoint = "company.clearbit.com/v2";

  // uri used with the endpoint
  $uri = "/companies/find";

  $params = array(
    "domain" => get_val('domain', $result)
  );

  $pairs = array();
  foreach ($params as $key => $value) {
    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
  }

  // Generate the canonical query
  $canonical_query_string = join("&", $pairs);

  // Generate the URL
  $request_url = 'https://'.$endpoint.$uri.'?'.$canonical_query_string;

  // create curl resource 
  $ch = curl_init(); 

  // set url 
  curl_setopt($ch, CURLOPT_URL, $request_url); 

  // return the transfer as a string 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

  // authenticate our api request
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$api_key
  ));

  // $output contains the output string 
  $result = curl_exec($ch);
  
  // convert the result into a php array
  $result = json_decode($result, true);

  // close curl resource to free up system resources 
  curl_close($ch); 

  // parse the xml object into a PHP array
  return $result;
}// end function getProducts

function array_to_csv($array, $filename = "export.csv", $delimiter=";") {
  // open raw memory as file so no temp files needed, you might run out of memory though
  $f = fopen('php://memory', 'w');
  
  // loop over the input array
  $first_line = true;
  foreach ($array as $line) {
    $line = format_csv_line($line);
    
    if($first_line){
      fputcsv($f, array_keys($line), $delimiter);
      $first_line = false; 
    }// end if first line

    if(get_val('name', $line) != null){
      // generate csv lines from the inner arrays
      fputcsv($f, $line, $delimiter); 
    }
  }// end foreach

  // reset the file pointer to the start of the file
  fseek($f, 0);
  // tell the browser it's going to be a csv file
  header('Content-Type: application/csv');
  // tell the browser we want to save it instead of displaying it
  header('Content-Disposition: attachment; filename="'.$filename.'";');
  // make php send the generated csv lines to the browser
  fpassthru($f);
}// end function

function format_csv_line($line){
  $site = get_val('site', $line);
  $phoneNumbers = get_val('phoneNumbers', $site);
  $geo = get_val('geo', $line);
  $twitter = get_val('twitter', $line);

  return array(
    'name' => get_val('name', $line),
    'phone1' => get_val(0, $phoneNumbers),
    'phone2' => get_val(1, $phoneNumbers),
    'phone3' => get_val(2, $phoneNumbers),
    'phone4' => get_val(3, $phoneNumbers),
    'address' => get_val('streetNumber', $geo) . ' ' . get_val('streetName', $geo) . ', ' . get_val('city', $geo) . ', '. get_val('state', $geo),
    'domain' => get_val('domain', $line),
    'twitter' => get_val('handle', $twitter),
    'description' => get_val('description', $line)
  );
}// end function

