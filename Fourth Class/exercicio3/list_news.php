
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
	$stmt = $db->prepare('SELECT * FROM news');
	$stmt->execute();  
	$result = $stmt->fetchAll();
  
	foreach( $result as $row) {
		$link = "http://gnomo.fe.up.pt/~up201303095/exercicio3/news_item.php?id=" . $row['id'];
		?>
		<div class="news-item">
			<h3><?php echo $row['title'] ?></h3>
			<img src="http://ipsumimage.appspot.com/300x200,ff7700" alt="300x200">
			<p class="introduction"><?php echo $row['introduction'] ?></p>
			<ul>
				<li><a href= <?php echo $link ?>>see more</a></li>
				<li><a href="comentarios1.html">comments (2)</a></li>
				<li><a href="partilhar1.html">share</a></li>
			</ul>
		</div>	
	<?php } ?>
	</div>
	<div id="footer">
		<p>CSS Exercises @ FEUP - 2013</p>
	</div>
</body>
</html>

