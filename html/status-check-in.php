<?php
include './auter_checkmate_cred.php';
$method = $_SERVER['REQUEST_METHOD'];
if ('PUT' === $method) {
    parse_str(file_get_contents('php://input'), $_put_vars);
    $sql = "SELECT * from statuses;";
    $insertsql = "UPDATE serverstatus SET statusid=:passedstatus where serverid=:passedserver";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $conn->prepare($insertsql);
        $stmt->bindValue(':passedstatus', $_put_vars['status-id'], PDO::PARAM_INT);
        $stmt->bindValue(':passedserver', $_put_vars['server-id'], PDO::PARAM_STR);
        $stmt->execute();   
	
        

}


else {
echo "<p>Please submit as a PUT request</p>";
}
?>
