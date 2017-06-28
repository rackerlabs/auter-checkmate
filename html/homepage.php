<html lang="en">
   <head>
       <meta charset="utf-8">
       <title> PATCH STATUS REPORT </title>
   </head>
<body bgcolor="lightgray">
   <div>
   <h1>Patching Report<h2> <h3 id=refreshdate>Last updated: </h3>
   </div>
   <script>
      var d = new Date();
      document.getElementById("refreshdate").innerHTML += d.toLocaleString();
   </script> 
   <br>
   <table style='border: solid 2px black;'>
      <tr>
        <th>Host</th>
        <th>Status ID</th>
      </tr>
      <?php
         include './auter_checkmate_cred.php';
         class TableRows extends RecursiveIteratorIterator { 
             function __construct($it) { 
                 parent::__construct($it, self::LEAVES_ONLY); 
             }
         
             function current() {
                 return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
             }
         
             function beginChildren() { 
                 echo "<tr>"; 
             } 
         
             function endChildren() { 
                 echo "</tr>" . "\n";
             } 
         } 
         
         $dbname = "auter_checkmate";
         $sql = "SELECT servername,statusname from serverstatus INNER JOIN statuses ON serverstatus.statusid = statuses.statusid INNER JOIN servers ON serverstatus.serverid = servers.serverid;";
         
         try {
             $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $stmt = $conn->prepare($sql); 
             $stmt->execute();
         
             // set the resulting array to associative
             $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
             foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                 echo $v;
             }
         }
         catch(PDOException $e) {
             echo "Error: " . $e->getMessage();
         }
         $conn = null;
         echo "</table>";
      ?>
   </table>
</body>
</html>

