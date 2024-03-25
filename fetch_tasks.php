<?php
// fetch_tasks.php

header('Content-Type: application/json');

$pdo = new PDO('pgsql:host=pgsql;port=5432;dbname=dbtaches', getenv('DB2_USER'), getenv('DB2_PASS'));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->query('SELECT tache FROM taches');
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($tasks);
