<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
</head>
<body>
    <h1>Ajouter une tâche</h1>
    <form action="ajout()" method="POST">
        <label for="tache">Tâche :</label>
        <input type="text" id="tache" name="tache">
        <input type="submit" value="submit">
    </form>
    
    <h1>Liste des Tâches</h1>
    <ul>
    <?php
        $pdo = new PDO('pgsql:host=pgsql;port=5432;dbname=dbtaches', getenv('DB2_USER'), getenv('DB2_PASS'));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        function ajout() {
                $newTache = $_POST['tache'];
                $stmt = $pdo->prepare('INSERT INTO taches (tache) VALUES (:tache)');
                $stmt->execute(['tache' => $newTache]);
                debug_to_console($newTache);
        }


        function debug_to_console($data) {
            $output = $data;
            if (is_array($output))
                $output = implode(',', $output);
        
            echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
        }

        $stmt = $pdo->query('SELECT tache FROM taches');

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>" . htmlspecialchars($row['tache']) . "</li>";
        }
    ?>
    </ul>

</body>
</html>
