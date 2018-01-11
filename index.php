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
				<li>Intermediate user with macOS</li>
				<li>New MacBook with external keyboard and mouse</li>
				<li>Wanting to view and post ideas for new photography hobby</li>
				<li>Wants a variety of content all in one place</li>
			</ul>

		<h2>User Story</h2>
		<p>As a weekly user, I want to see many different ideas</p>

		<h2>Uses Case</h2>
		<p>Max Johnson @maxJohnson</p>

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