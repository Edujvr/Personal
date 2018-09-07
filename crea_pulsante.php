<?php
require_once 'config.php';

$chatfuel_user_id = $_REQUEST['chatfuel_user_id']; // ottieni {{chatfuel_user_id}} da ChatFuel
$web_url = $MAIN_URL.'?chatfuel_user_id='.$chatfuel_user_id; // aggiunge $chatfuel_user_id alla url del pulsante

$json = array(
	'messages' =>
	array(
		0 =>
		array(
			'attachment' =>
			array(
				'type' => 'template',
				'payload' =>
				array(
					'template_type' => 'button',
					'text' => 'Toca el botón de abajo para seleccionar la fecha de reserva.',
					'buttons' =>
					array(
						0 =>
						array(
							'type' => 'web_url',
							'url' => $web_url,
							'title' => 'Selecciona el día',
							'messenger_extensions' => true,
							'webview_height_ratio' => 'tall'
						),
					),
				),
			),
		),
	),
);
header('Content-Type: application/json');
echo json_encode($json); // visualizza il pulsante su ChatFuel
?>
