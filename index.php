<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/style.css">
		<title>Data Design</title>
	</head>
	<body>
		<h1>Data Design</h1>
		<img src = "images/dataDesign-markup.jpg" alt = "data design markup">
		<br>
		<h2><span id = "redColorTxt">Profile</span></h2>
		<ul>
			<li>profileName</li>
			<li>profilePass</li>
			<li>profileEmail</li>
		</ul>
		<h2><span id ="purpleColorTxt">Article</span></h2>
			<ul>
				<li>articleName</li>
				<li>articleId</li>
				<li>articleContent</li>
				<li>articleDate</li>
			</ul>
		<h2>Relationships</h2>
		<ul>
			<li>One profile can write many articles (1-to-n)</li>
		</ul>
	</body>
</html>