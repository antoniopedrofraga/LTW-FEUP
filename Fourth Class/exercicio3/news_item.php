
<!DOCTYPE html>
<html>
<head>
	<title>CSS Exercise</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div id="header">
		<h1>Online Newspaper</h1>
		<h2>CSS Exercise</h2>
	</div>
	<div id="menu">
		<ul>
			<li><a href="">Politics</a></li>
			<li><a href="">Sports</a></li>
			<li><a href="">World</a></li>
			<li><a href="">Education</a></li>
			<li><a href="">Society</a></li>
		</ul>
	</div>
	<div id="content">
	<?php
	  $db = new PDO('sqlite:news.db');
	  $stmt = $db->prepare('SELECT * FROM news WHERE id = :id');
	  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	  $stmt->execute();
      $result = $stmt->fetch();
	?>
		<div class="news-item">
			<h3><?php echo $result['title'] ?></h3>
			<img src="http://ipsumimage.appspot.com/300x200,ff7700" alt="300x200">
			<p class="introduction"><?php echo $result['introduction'] ?></p>
			<ul>
				<li><a href="noticia1.html">see more</a></li>
				<li><a href="comentarios1.html">comments (2)</a></li>
				<li><a href="partilhar1.html">share</a></li>
			</ul>
		</div>	
	</div>
	<div id="footer">
		<p>CSS Exercises @ FEUP - 2013</p>
	</div>
</body>
</html>