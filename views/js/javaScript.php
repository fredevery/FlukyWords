<?php 
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 24) . " GMT");
	header("Content-type: text/javascript");
	require("jQuery.js");
	require("flukyCore.js");
?>