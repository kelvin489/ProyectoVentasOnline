<?php
$dsn = 'mysql:dbname=vent;host=localhost';
$user = 'root';
$pass = '';

        try {
            
            $pdo = new PDO($dsn,$user,$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch (PDOException $e) {
            echo "PDO error".$e->getMessage();
            die();
        }
?>