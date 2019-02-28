<?php
require_once(BASEPATH . '../application/third_party/Google/Client.php');
require_once(BASEPATH . '../application/third_party/Google/Service/Analytics.php');

session_start();

$client_id = '<YOUR_CLIENT_ID>'; //Client ID
$service_account_name = '<YOUR_CLIENT_EMAIL>'; //Email Address 
$key_file_location = BASEPATH . '../application/third_party/Google/<YOUR KEY.p12>'; //key.p12

$client = new Google_Client();
$client->setApplicationName("ApplicationName");
$service = new Google_Service_Analytics($client);

if (isset($_SESSION['service_token'])) {
  $client->setAccessToken($_SESSION['service_token']);
}

$key = file_get_contents($key_file_location);
$cred = new Google_Auth_AssertionCredentials(
    $service_account_name,
    array(
        'https://www.googleapis.com/auth/analytics',
    ),
    $key,
    'notasecret'
);
$client->setAssertionCredentials($cred);
if($client->getAuth()->isAccessTokenExpired()) {
  $client->getAuth()->refreshTokenWithAssertion($cred);
}
$_SESSION['service_token'] = $client->getAccessToken();


The code below is for getting sessions (page visits) from the last 31 days

$analytics = new Google_Service_Analytics($client);

$profileId = "ga:<YOUR_PROFILE_ID>";
$startDate = date('Y-m-d', strtotime('-31 days')); // 31 days from now
$endDate = date('Y-m-d'); // todays date

$metrics = "ga:sessions";

$optParams = array("dimensions" => "ga:date");
$results = $analytics->data_ga->get($profileId, $startDate, $endDate, $metrics, $optParams);

$data['report'] = $results->rows; //To send it to the view later

The code below is for getting sessions (page visits) from the last 31 days

$analytics = new Google_Service_Analytics($client);

$profileId = "ga:<YOUR_PROFILE_ID>";
$startDate = date('Y-m-d', strtotime('-31 days')); // 31 days from now
$endDate = date('Y-m-d'); // todays date

$metrics = "ga:sessions";

$optParams = array("dimensions" => "ga:date");
$results = $analytics->data_ga->get($profileId, $startDate, $endDate, $metrics, $optParams);

$data['report'] = $results->rows; //To send it to the view later

$this->view->load('your_view', $data);