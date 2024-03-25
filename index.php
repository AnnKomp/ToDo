<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
</head>
<body onload="fetchTasks()">

    <h1>Ajouter une tâche</h1>
    <form action="" method="POST">
        <label for="tache">Tâche :</label>
        <input type="text" id="tache" name="tache">
        <button type="submit">Valider</button>
    </form>
    
    <script>
        function addTask(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way

            var formData = new FormData();
            formData.append('tache', document.getElementById('tache').value);

            fetch('', { // Current page
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(html => {
                // Optionally, you can return something from your PHP after inserting a task
                // For now, we'll just re-fetch and update the task list
                fetchTasks();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function fetchTasks() {
            fetch('fetch_tasks.php') // Assuming you have a PHP script to fetch tasks
            .then(response => response.json())
            .then(tasks => {
                var taskList = document.querySelector('ul');
                taskList.innerHTML = ''; // Clear current list
                tasks.forEach(task => {
                    var li = document.createElement('li');
                    li.textContent = task.tache; // Assuming your tasks are objects with a 'tache' property
                    taskList.appendChild(li);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        document.querySelector('form').addEventListener('submit', addTask);
    </script>


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
