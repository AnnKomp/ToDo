
<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Page page</title>
</head>
 
<body>
        <?php
 
        $pdo = new PDO('pgsql:host=pgsql;port=5432;dbname=dbtaches', getenv('DB2_USER'), getenv('DB2_PASS'));

         
        $tache =  $_REQUEST['tache'];
         
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['tache'])) {
            $newTache = $_POST['tache'];
            $stmt = $pdo->prepare('INSERT INTO taches (tache) VALUES (:tache)');
            $stmt->execute(['tache' => $newTache]);
        }

        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO taches  VALUES ('$tache')";
         
        $stmt = $pdo->query('INSERT INTO taches  VALUES ('$tache')');
         
        // Close connection
        mysqli_close($conn);
        ?>
</body>
 
</html>
