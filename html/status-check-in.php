<?php
include './auter_checkmate_cred.php';
function fetch_registered_servers($_put_vars) {
    include './auter_checkmate_cred.php';
    try {
        $query_servers_sql = "select statusid from serverstatus where serverid=:passedserver";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $conn->prepare($query_servers_sql);
	$stmt->bindValue(':passedserver', $_put_vars['server-id'], PDO::PARAM_STR);
        $stmt->execute();
	$current_status=$stmt->fetch(PDO::FETCH_OBJ);
	$current_status_int=$current_status->statusid;
            if (is_null($current_status_int)) {
	       echo "This server is not currently registered \n";
	       exit;
	    }
    }
    catch(Exception $e){
        echo "MySQL fail: " .$e->getMessage();
    }
}

function is_status_valid($_put_vars) {
    include './auter_checkmate_cred.php';
	try {
        $query_servers_sql = "select statusname from statuses where statusid=:passedstatus";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $stmt = $conn->prepare($query_servers_sql);
        $stmt->bindValue(':passedstatus', $_put_vars['status-id'], PDO::PARAM_STR);
        $stmt->execute();
        $store_status=$stmt->fetch(PDO::FETCH_OBJ);
        $current_status_txt=$store_status->statusname;
            if (is_null($current_status_txt)) {
               echo "This is not a valid status \n";
	       exit;
            }
    }
    catch(Exception $e){
        echo "MySQL fail: " .$e->getMessage();
    }

}

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
          echo "No changes made, either invalid status or no change\n";
	}
      }
      catch(Exception $e) {
        echo "Should have used MongoDB brah:  " .$e->getMessage();
      }
}


$method = $_SERVER['REQUEST_METHOD'];
if ('PUT' === $method) {
    parse_str(file_get_contents('php://input'), $_put_vars);
    fetch_registered_servers($_put_vars);
    is_status_valid($_put_vars);
    update_status($_put_vars);
}
else {
    header('Please submit a put request', true, 405);
    echo "<p>Please submit as a PUT request</p>";
}
?>
