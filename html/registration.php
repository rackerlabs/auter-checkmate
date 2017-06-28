<html>
<title> sample </title>
<body>
<?php
include './auter_checkmate_cred.php';
$method = $_SERVER['REQUEST_METHOD'];
if ('PUT' === $method) {
    parse_str(file_get_contents('php://input'), $_put_vars);
    $client_ip = $_SERVER['REMOTE_ADDR'];
    echo $_put_vars['server-id']." is serverid\n";
    echo $_put_vars['hostname']." is server hostname\n";
    $insertsql = "INSERT into servers (serverid,servername,IP) values (:passedid,:passedhostname,:passedip)";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $conn->prepare($insertsql);
        echo $_put_vars['server-id']." is serverid\n";
        $stmt->bindValue(':passedid', $_put_vars['server-id'], PDO::PARAM_STR);
        $stmt->bindValue(':passedhostname', $_put_vars['hostname'], PDO::PARAM_STR);
	$stmt->bindValue(':passedip', $client_ip, PDO::PARAM_STR);
        $stmt->execute();   
    $updatestatussql = "INSERT into serverstatus (serverid,statusid) VALUES (:passedid,'1')";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $conn->prepare($updatestatussql);
        $stmt->bindValue(':passedid', $_put_vars['server-id'], PDO::PARAM_STR);
	$stmt->execute();
	
        

}


else {
echo "<p>Please submit as a PUT request</p>";
}
?>
</body>
</html>

