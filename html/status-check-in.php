<html>
<title> sample </title>
<body>
<?php
$method = $_SERVER['REQUEST_METHOD'];
if ('PUT' === $method) {
    parse_str(file_get_contents('php://input'), $_put_vars);
    echo $_put_vars['server-id']." is serverid\n";
    echo $_put_vars['status-id']." is server status\n";

    $servername = "localhost";
    $username = "auter-checkmate";
    $password = "access";
    $dbname = "auter_checkmate";
    $sql = "SELECT * from statuses;";
    $insertsql = "UPDATE serverstatus SET statusid=:passedstatus where serverid=:passedserver";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $conn->prepare($insertsql);
        echo $_put_vars['server-id']." is serverid\n";
        $stmt->bindValue(':passedstatus', $_put_vars['status-id'], PDO::PARAM_INT);
        $stmt->bindValue(':passedserver', $_put_vars['server-id'], PDO::PARAM_STR);
        $stmt->execute();   
	
        

}


else {
echo "<p>Please submit as a PUT request</p>";
}
?>
</body>
</html>

