<?php

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