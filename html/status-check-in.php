<?php
include './auter_checkmate_cred.php';

function update_status($_put_vars) {
    include './auter_checkmate_cred.php';
      try {
        $insertsql = "UPDATE serverstatus SET statusid=:passedstatus where serverid=:passedserver";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $conn->prepare($insertsql);
        $stmt->bindValue(':passedstatus', $_put_vars['status-id'], PDO::PARAM_INT);
        $stmt->bindValue(':passedserver', $_put_vars['server-id'], PDO::PARAM_STR);
        $stmt->execute();
        $no_update = $stmt->rowCount();
	if ($no_update === 0) {
	  header('No change', true, 501);
          echo "No changes made, either not registered, invalid status or no change\n";
	}
      }
      catch(Exception $e) {
        echo "Should have used MongoDB brah:  " .$e->getMessage();
      }
}
$method = $_SERVER['REQUEST_METHOD'];
if ('PUT' === $method) {
    parse_str(file_get_contents('php://input'), $_put_vars);
    update_status($_put_vars);
}
else {
    header('Please submit a put request', true, 405);
    echo "<p>Please submit as a PUT request</p>";
}
?>
