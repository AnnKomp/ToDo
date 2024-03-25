<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
</head>
<body>
    <h1>Ajouter une tâche</h1>
    <form action="insert.php" method="POST">
        <label for="tache">Tâche :</label>
        <input type="text" id="tache" name="tache">
        <input type="submit" value="submit">
    </form>
    
    <h1>Liste des Tâches</h1>
    <ul>
    <?php
        $pdo = new PDO('pgsql:host=pgsql;port=5432;dbname=dbtaches', getenv('DB2_USER'), getenv('DB2_PASS'));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['tache'])) {
            $newTache = $_POST['tache'];
            $stmt = $pdo->prepare('INSERT INTO taches (tache) VALUES (:tache)');
            $stmt->execute(['tache' => $newTache]);
        }

        // Execute a query to fetch all tasks
        $stmt = $pdo->query('SELECT tache FROM taches');

        // Fetch and display each task
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>" . htmlspecialchars($row['tache']) . "</li>";
        }
    ?>
    </ul>

</body>
</html>
