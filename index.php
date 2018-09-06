<!doctype html>

<html lang="en">
	<head>
		<title>Reservation Date</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


		<!-- Date picker files -->
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

			// required - messenger javascript extensions

			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.com/en_US/messenger.Extensions.js";
				fjs.parentNode.insertBefore(js, fjs);
			  }(document, 'script', 'Messenger'));

		</script>

		<form method="post" action="index.php">
			<input type="hidden" name="messenger_user_id" value="" />
			<input type="hidden" name="bot_id" value="" />

			<div class="container">
				<div class="row justify-content-center">
					<input name="selected_date" id="datepicker" type="text" readonly="readonly">
				</div>
			</div>
			<footer class="footer">
				<button type="submit" id="done-btn" class="btn btn-primary btn-block">Select</button>
			</footer>
		</form>

		<script type="text/javascript">
			var currentDay = new Date();
			// initial date picker
			$( '#datepicker' ).flatpickr({
				inline: true,
				defaultDate: currentDay
			});

			// on click "Done" button send data to chatfuel and close webview
			$("#done-btn").on("click", function(e) {
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: 'send-data-to-chatfuel.php',
					data: $('form').serialize(),
					dataType: 'json',
					success: function(data) {
						MessengerExtensions.requestCloseBrowser();
					}
				});
			});
		</script>
	</body>
</html>
