 		<?php
 		
 			$db = new PDO('sqlite:../database/database.db');

 			$userCmd = "SELECT * FROM user WHERE email = '" . $_SESSION["email"] . "'";


			$stmt2 = $db->prepare($userCmd);
			$stmt2->execute();
			$user = $stmt2->fetchAll();

			$photo = $user[0]["photoPath"];
			$profilePath = "../upload/" . $photo;

			$link = "profile.php?id=" . $user[0]["id"];


 		?>

 		<header>

			<div id="logo">
				<img src="../res/images/logo.png">
			</div>

			<h1><a href="../index.php">Crasher</a></h1>

			<form class="searchForm">
				<input type="text" id="searchTextBox" name="search" placeholder="Search" autocomplete="off"/>
				<ul class="dropdown" id="searchDropdown">
				</ul>
			</form>

			<form action="" id="loutForm" enctype="multipart/form-data">
				<img id="profilePic" src=<?php echo $profilePath; ?> height="50" width="50" style="object-fit: cover; border: 1px solid white">
				<a id="user"><?php echo $_SESSION["email"]; ?></a>
				<img class="arrow" src="../res/images/down-arrow.png" height="10" width="10">
				<input type="file" name="teste" id="profilePic" class="profilePic" style="visibility: hidden; position: absolute;">
				<ul class="dropdown" id="user-dd">
					<li>
						<div onclick="window.location = '<?php echo $link; ?>'">
							<img class="icon" src="../res/images/events/owner.png" height="20" width="20"><span href="#">Profile</span>
						</div>
					</li>
					<li>
						<div id="updatePic">
							<img class="icon" src="../res/images/photograph.png" height="20" width="20"><span href="#">Update Pic</span>
						</div>

					</li>
					<li>
						<div onclick="window.location = '../actions/logout.php'">
							<img class="icon" src="../res/images/log-out.png" height="20" width="20"><span href="#">LogOut</span>
						</div>
					</li>

				</ul>
			</form>

		</header>