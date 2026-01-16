<?php
// Connect to the database
try {
   $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
} catch (Exception $e) {
   die('Erreur : ' . $e->getMessage());
}

// Retrieve the last 5 blog posts
$statement = $bdd->query("SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5");
$posts = [];
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
   $post = [
      'title' => $row['titre'],
      'french_creation_date' => $row['date_creation_fr'],
      'content' => $row['contenu'],
   ];
   $posts[] = $post;
}

require('templates/homepage.php');
?>

