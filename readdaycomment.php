<?php
	$author_name = "Christine";
	//echo $author_name;
	require_once "../config.php";
	
	//loome andmebaasiühenduse
		
	$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
	//määrame suhtlemisel kasutatava koodi tabeli
	$conn->set_charset("utf8");
	//valmistame ette SQL keeles päringu
	$stmt = $conn->prepare("SELECT comment, grade, added FROM vp_daycomment");
	echo $conn->error;
	//seome loetavad andmed muutujatega
	$stmt->bind_result($comment_from_db, $grade_from_db, $added_from_db);
	//täidame käsu
	$stmt->execute();
	echo $stmt->error;
	$comments_html = null;
	//kui on oodata mitut aga teadmata arv
	while($stmt->fetch()){
		//<p> kommentaar, hinne päevale: x, lisatud yyyy.</p>
		$comments_html .= "<p>" .$comment_from_db ."hinne päevale: " . $grade_from_db . "lisatud" . $added_from_db .".<p>\n";
	}
	//sulgeme päringu
	$stmt->close();
	//sulgeme andmebaasiühenduse 
	$conn->close();
	
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
	<?php echo $comments_html;?>
</body>
</html>
