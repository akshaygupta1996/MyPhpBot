<?php
$access_token = "EAAZA9ubG2IzEBAEv8J3EZAmo5konmIZAC7rbcZCy2xReh1Yt6E7nmoCnzgJnZBc6U54ACtn3i6fl0y1Vm9Kj1juQHadS1chWt6EEM02YvqsD5lk1MDCKEPqrpZCbqSNAEor7xa9JEdNp1L5fJW1kr697IIhLHBXmEogq6sTxZA1dgZDZD";
$verify_token = "planyourtour";
$hub_verify_token = null;
 
if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}
 
 if ($hub_verify_token === $verify_token) {
    echo $challenge;
}

$input = json_decode(file_get_contents('php://input'), true);

$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];

$data= array(
		'recipient' => array('id'=>"$sender"),
		'message'=>array('text'=>"$message")
	);

$options = array(
	'http' => array(
				'method' => 'POST',
				'content' => json_encode($data),
				'header'=>"Content-Type: application/json\n"
			)
	);

$context = stream_context_create($options);
file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$access_token",false,$context);
?>