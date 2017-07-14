<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>line bot</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://www.gstatic.com/firebasejs/3.6.4/firebase.js"></script>
		<script>
			var config = {
				apiKey : "AIzaSyDNe5Uppcicpa9UJvmOUWWfDgv1uEVjoLU",
				authDomain : "muayhooapp-753f2.firebaseapp.com",
				databaseURL : "https://muayhooapp-753f2.firebaseio.com",
				storageBucket : "muayhooapp-753f2.appspot.com",
				messagingSenderId : "533110254739"
			};
			firebase.initializeApp(config);
			var refAppSetting = firebase.database().ref('app_setting');
		</script>
	</head>
	<body>
		<input id="txtHost" type="text"/>
		<input id="btnSend" type="button" value="Send" />
	</body>
	<script>
		$(document).ready(function() {
			refAppSetting.on('value', function(snapshot) {
				var value = snapshot.val();
				$('#txtHost').value(value.bot_host);
			});
			$('#btnSend').click(function() {
				refAppSetting.update({
					bot_host : $('#txtHost').value()
				});
			});
		});
	</script>
</html>