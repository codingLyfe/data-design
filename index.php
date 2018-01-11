<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/style.css">
		<title>Data Design</title>
	</head>
	<body>
		<h1>Data Design</h1>
		<h2>Persona</h2>
		<p>Max Johnson</p>
			<ul>
				<li>Age: 34</li>
				<li>Gender: Male</li>
				<li>OS: macOS X</li>
			</ul>
		<p>Max is an intermediate user on Apple products. He bought a Mac in order to use the built in multimedia editors for his photography.</p>
		<p>Since Max is new to photography, he is looking for a platform to see others creativity and receive ideas for some new projects.</p>
		<img src = "images/dataDesign-markup.jpg" alt = "data design markup">
		<br>
		<h3><span id = "redColorTxt">Profile</span></h3>
		<ul>
			<li>profileName</li>
			<li>profilePass</li>
			<li>profileEmail</li>
		</ul>
		<h3><span id ="purpleColorTxt">Article</span></h3>
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