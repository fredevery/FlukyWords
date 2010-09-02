<?php 
	require("class.inputs.php");
	require("db/core.db.php");
	
	$fluky_db = new fluky_db();
	
	switch($inputs['action']){
		case "load_random_sentence":
			echo $fluky_db->get_random_sentence();
			break;
		case "save_new_sentence":
			echo $fluky_db->save_new_sentence($inputs['sentence']);
			break;
		case "get_all_sentences":
			echo $fluky_db->get_all_sentences();
			break;
		case "load_last_sentence":
			echo $fluky_db->get_last_sentence();
			break;
	}	
?>