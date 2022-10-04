<?php
//loen sisse konfiguratsioonifaili
	require_once "../config.php";
	$author_name = "Christine";
	//echo $author_name;
	
	$comment_error= null;
	$grade = 7;
	//tegeleme päevale antud hinde ja kommentaariga
	if(isset($_POST["comment_submit"])) {
		if(isset($_POST ["comment_input"]) and !empty ($_POST["comment_input"])){
			$comment =$_POST["comment_input"];
		} else {
			$comment_error= "Kommentaar jäi lisamata!";
		}
		$grade = $_POST ["grade_input"];
		
		if(empty ($comment_error)) {
			echo $server_user_name;
			
			//loome andmebaasiühenduse
			
			$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
			//määrame suhtlemisel kasutatava koodi tabeli
			$conn->set_charset("utf8");
			//valmistame ette SQL keeles päringu
			$stmt = $conn->prepare("INSERT INTO vp_daycomment (comment, grade) VALUES (?,?)");
			echo $conn->error;
			//seome SQL päringu päris andmetega
			//määrata andmetüübid i-integer (täisarv), d -decimal (murdarv), s-string (tekst)
			$stmt->bind_param("si", $comment, $grade);
			if($stmt->execute()){
					$grade = 7;
			}
			echo $stmt->error;
			//sulgeme päringu
			$stmt->close();
			//sulgeme andmebaasiühenduse 
			$conn->close();
			}
	}
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?> programmeerib veebi</title>
</head>
<body>
	<h1>Christine, veebiprogrammeerimine</h1>
	<p>See leht on loodud õppetöö raames ja ei sisalda tõsist infot!</p>
	<p>Õppetöö toimus <a href="https://www.tlu.ee">Tallinna Ülikoolis</a>.</p> Digitehnoloogiate instituudis </p>
	<a href="https://www.tlu.ee">
		<img src="pics/tlu_37.jpg" alt="Tallinna Ülikooli Astra õppehoone">
	</a>
	//!--päeva kommentaaride lisamise vorm-->
	<form method="POST"
	<label for="comment_input"> Kommentaar tänase päeva kohta:</label>
	<br>
	<hr>
	<textarea id="comment_input" name="comment_input" colls="70" rows="2" placeholder="kommentaar"></textarea>
	<br>
	<label for="grade_input"> Hinne tänasele päevale (0...10):</label>
	<input type="number" id="grade_input" name="grade_input" min="0" max="10" step="1"
	value="<?php echo $grade;?>">
	<br>
	<input type="submit" id="comment_submit" name="comment_submit" value="Salvesta">
	<span><?php echo $comment_error;?>
	<hr>
</body>
</html>
