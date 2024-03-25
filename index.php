<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
</head>
<body>
    <h1>Ajouter une tâche</h1>
    <form action="">
        <label for="nom">Tâche :</label>
        <input type="text">

        <button type="submit">Valider</button>
    </form>
    
    <h1>Liste des Tâches</h1>
    <ul>
    <?php
        try {
            // Connect to the PostgreSQL database
            $pdo = new PDO('pgsql:host=pgsql;port=5432;dbname=dbtaches', 'user', 'password');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Execute a query to fetch all tasks
            $stmt = $pdo->query('SELECT tache FROM taches');

            // Fetch and display each task
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>" . htmlspecialchars($row['tache']) . "</li>";
            }
        } catch (PDOException $e) {
            // Handle any errors
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
    </ul>
<!-- faire une liste des taches (lié à une DB)-->

<!-- faire un form pour rajouter une tâche -->

<!-- (OPT) faire une possibilité de suppression d'une tâche -->

</body>
</html>