<?php

if (!file_exists("upload/$unit_code/$trimester")) {
	mkdir("upload/$unit_code/$trimester", 0777, true);
}
if(!file_exists("upload/$unit_code/$trimester/$unit_code.txt")){
	$file = fopen("upload/$unit_code/$trimester/$unit_code.txt","w"); 
	

	for ($x=1; $x<=$num_assignment; $x++) {
		fwrite($file,  "assignment".$x. ".pdf\r\n");
	}
	for ($x=1; $x<=$num_lecture; $x++) {
		fwrite($file,  "lecture".$x. ".pdf\r\n");
	} 


	for ($x=1; $x<=$num_practical; $x++) {
		fwrite($file,  "practical".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$num_practical; $x++) {
		fwrite($file,  "practical_solution".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$num_quiz; $x++) {
	fwrite($file,  "quiz_solution".$x. ".pdf\r\n");		
	} 
	for ($x=1; $x<=$num_quiz; $x++) {
		fwrite($file,  "quiz".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$num_test; $x++) {
		fwrite($file,  "test".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$num_test; $x++) {
		fwrite($file,  "test_solution".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$num_tutorial; $x++) {
		fwrite($file,  "tutorial".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$num_tutorial; $x++) {
		fwrite($file,  "tutorial_solution".$x. ".pdf\r\n");	
	} 

	fwrite($file,"main".".pdf". "\r\n");
	fwrite($file, "unit matrix ". $unit_code.".pdf". "\r\n");
	fwrite($file, "academic report ". $unit_code.".pdf". "\r\n");
	fwrite($file, "misc". $unit_code.".pdf"."\r\n");
	fwrite($file, "syllabus"."pdf"."\r\n"); 
	fwrite($file, "teaching plan"."pdf"."\r");

	fclose($file); 
}




?>






