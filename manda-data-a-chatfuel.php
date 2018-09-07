<?php
require_once 'config.php';

$chatfuel_user_id = $_REQUEST['chatfuel_user_id'];

// setup data to send back to Chatfuel
$params = array();
$params['chatfuel_token'] = $CHATFUEL_BROADCAST_TOKEN; // imposta il token per invio
$params['chatfuel_block_name'] = $CHATFUEL_RETURN_BLOCK_NAME; // nome del blocco a cui inviare l'utente
$params['data-selezionata'] = $_POST['data-selezionata']; // imposta attributo da salvare su ChatFuel
$_x = request('https://api.chatfuel.com/bots/'.$CHATFUEL_BOT_ID.'/users/'.$chatfuel_user_id.'/send', $params); // manda i dati a ChatFuel

echo json_encode(array('ok' => true)); // manda i dati a index.php, in modo che si chiuda il calendario


function request ($url, $params = array()) {

	$url = $url.'?'.http_build_query($params);

	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

	$resp = curl_exec($ch);
	curl_close($ch);
	return $resp;
}
?>