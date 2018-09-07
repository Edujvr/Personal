<?php
error_reporting(0);
?>
<!doctype html>
<html lang="it">
	<head>
		<title>SELLECCIONA UNA FECHA</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

		<!-- Files necessari per il calendario -->
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flatpickr/4.1.4/themes/material_blue.css">
		<script src="//cdn.jsdelivr.net/npm/flatpickr"></script>

		<style>
			form {
				padding-top: 15px;
			}
			#datepicker {
				display: none;
			}
			.footer {
				margin-top: 25px;
				padding: 15px;
			}
			.flatpickr-calendar:before , .flatpickr-calendar:after {
				display: none !important;
			  }
		</style>
	</head>
	<body>
		<script type="text/javascript">
			// Estensione Javascript di Messenger: necessaria
			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.com/en_US/messenger.Extensions.js";
				fjs.parentNode.insertBefore(js, fjs);
			  }(document, 'script', 'Messenger'));
		</script>
		<form method="post" action="index.php">

			<input type="hidden" name="chatfuel_user_id" value="<?php echo $_REQUEST['chatfuel_user_id']?>" />

			<div class="container">
				<div class="row justify-content-center">
					<input name="data-selezionata" id="datepicker" type="text" readonly="readonly">
				</div>
			</div>

			<footer class="footer">
				<button type="submit" id="done-btn" class="btn btn-primary btn-block">SELECCIONAR</button>
			</footer>

		</form>

		<script type="text/javascript">
			var currentDay = new Date();
			// inizializzazione calendario
			$( '#datepicker' ).flatpickr({
				inline: true,
				defaultDate: currentDay
			});

			// al click su "CONFERMA LA DATA" invia i dati a ChatFuel e chiudi il calendario
			$("#done-btn").on("click", function(e) {
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: 'manda-data-a-chatfuel.php',
					data: $('form').serialize(),
					dataType: 'json',
					success: function(data) {
						// dopo l'invio riuscito, chiudi il calendario
						MessengerExtensions.requestCloseBrowser();
					}
				});
			});
		</script>
	</body>
</html>
