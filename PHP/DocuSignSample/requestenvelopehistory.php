<?php 
/**
 * @copyright Copyright (C) DocuSign, Inc.  All rights reserved.
 *
 * This source code is intended only as a supplement to DocuSign SDK
 * and/or on-line documentation.
 * This sample is designed to demonstrate DocuSign features and is not intended
 * for production use. Code and policy for a production application must be
 * developed to meet the specific data and security requirements of the
 * application.
 *
 * THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY
 * KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A
 * PARTICULAR PURPOSE.
 */

/*
 * Request Envelope History html page url. 
 * See: https://www.docusign.net/api/3.0/api.asmx?op=RequestEnvelopeHistoryToken
 */

//========================================================================
// Includes
//========================================================================
include_once 'include/session.php'; // initializes session and provides
include_once 'api/APIService.php';
include 'include/utils.php';

//========================================================================
// Functions
//========================================================================

function get_envelope_history($envelope_id, $return_url){
	// Start API
	$api = getAPI();
	
	// Create parameters for RequestEnvelopeHistoryToken
	$arg = new RequestEnvelopeHistoryTokenArg();
	$arg->EnvelopeId = $envelope_id;
	$arg->ReturnURL = $return_url;

	$req = new RequestEnvelopeHistoryToken();
	$req->Arg = $arg;
	$result = $api->RequestEnvelopeHistoryToken($req);
	
	return $result;
}

//========================================================================
// Main
//========================================================================
loginCheck();

// Get Envelope ID
if(empty($_GET['envelopeid'])){
	echo "Unable to find Envelope ID";
	exit;
}
$envelope_id = $_GET['envelopeid'];
$return_url = "http://google.com"; // for example

// Call function that returns Envelope History Token
$response = get_envelope_history($envelope_id, $return_url);

echo "<h3>Response: see the <a target='_blank' href='" . $response->RequestEnvelopeHistoryTokenResult . "'>Envelope Status Page</a></h3>";

// Print out the result ("function pr" in include/utils.php)
pr($response);
exit;

?>