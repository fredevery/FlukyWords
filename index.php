<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>FlukyWords - Your go to place for random sentences.</title>		
		<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.1.2/build/cssreset/reset-min.css">
		<link rel="stylesheet" href="views/css/main.css" type="text/css" media="screen" />
	</head>
	<body>
		<div id="main_wrapper">
			<img src="views/images/logo.flukywords.png" alt="FlukyWords - Your go to place for random sentences." />
			<h1>Here's a random sentence for you.</h1>
			<div id="sentence_wrapper">
				<div id="sentence">
					<span>This</span>
					<span>is</span>
					<span>a</span>
					<span>random</span>
					<span>sentence.</span>
				</div>
				<p id="warning">You can only change two words in this sentence. You can, however, edit a word you've changed :)</p>
				<input id="save_btn" type="button" value="save your sentence" />
			</div>			
			<p id="instructions"><b>Wanna Randomize?</b> Click on a word to change it. (You can only change 2 words, so pick wisely)</p>
			<h1>All the other random sentences that have been created.</h1>
			<div id="all_sentences">
				
			</div>			
		</div>
		
		<!-- Javascript -->
		<script type="text/javascript" src="views/js/javaScript.php"></script>
		<!-- Testing git -->
	</body>
</html>
