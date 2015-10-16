<?php
  $db = new PDO('sqlite:news.db');
  $stmt = $db->prepare('SELECT * FROM news');
  $stmt->execute();  
  $result = $stmt->fetchAll();
  
  foreach( $result as $row) {
    echo '<h1>' . $row['title'] . '</h1>';
    echo '<p>' . $row['introduction'] . '</p>';
  }
  
?>