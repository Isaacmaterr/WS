<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<script type="text/javascript">
	console.log('teste');
var conn = new WebSocket('ws://localhost:8080/?row=2');
conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onmessage = function(e) {
    console.log(e.data);
};

conn.send('Hello World!');
</script>
</body>
</html>