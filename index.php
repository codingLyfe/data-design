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

		<h2>Use Case</h2>
		<p>Max Johnson views an article and "claps" to show his support after finding it gave him inspiration for his own project.</p>
		<p>Precondition: Max has logged into his account</p>
		<p>Post condition(s): Max logs out of his account feeling inspired to take some pictures!</p>

		<div>
			<ol>
				<li>Max clicks on an article</li>
				<li>The article loaded on Max's screen</li>
				<li>Max clicks "clap" after reading the article</li>
				<li>The site presents a message:
					<blockquote>"Thanks for showing your support!"
					<em>Click and hold to continue the applause.</em>
					</blockquote>
				</li>
				<li>Max decides to hold the clap button for 10 seconds</li>
				<li>The site shows how much applause Max gave</li>
				<li>Satisfied, Max logs off</li>
			</ol>
		</div>

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
			<li>One profile can clap many times for each article (1-to-n)</li>
			<li>Many profiles can "clap" for many articles (n-to-m)</li>
		</ul>
	</body>
</html>