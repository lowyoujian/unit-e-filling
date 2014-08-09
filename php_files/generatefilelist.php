<?php

if (!file_exists("upload/UECS2094/$semester")) {
	mkdir("upload/UECS2094//$semester", 0777, true);
}
if(!file_exists("upload/UECS2094//$semester/$unitcode.txt")){
	$file = fopen("upload/UECS2094//$semester/$unitcode.txt","w"); 
	

	for ($x=1; $x<=$assignments; $x++) {
		fwrite($file,  "assignment".$x. ".pdf\r\n");
	}
	for ($x=1; $x<=$lectures; $x++) {
		fwrite($file,  "lecture".$x. ".pdf\r\n");
	} 


	for ($x=1; $x<=$practicals; $x++) {
		fwrite($file,  "practical".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$practicals; $x++) {
		fwrite($file,  "practical_solution".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$quizzes; $x++) {
	fwrite($file,  "quiz_solution".$x. ".pdf\r\n");		
	} 
	for ($x=1; $x<=$quizzes; $x++) {
		fwrite($file,  "quiz".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$tests; $x++) {
		fwrite($file,  "test".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$tests; $x++) {
		fwrite($file,  "test_solution".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$tutorials; $x++) {
		fwrite($file,  "tutorial".$x. ".pdf\r\n");
	} 
	for ($x=1; $x<=$tutorials; $x++) {
		fwrite($file,  "tutorial_solution".$x. ".pdf\r\n");	
	} 

	fwrite($file,"main". "\r\n");
	fwrite($file, "unit matrix ". $unitcode.".pdf". "\r\n");
	fwrite($file, "academic report ". $unitcode.".pdf". "\r\n");
	fwrite($file, "misc". $unitcode.".pdf"."\r\n");
	fwrite($file, "syllabus"."\r\n"); 
	fwrite($file, "teaching plan"."\r\n");

	fclose($file); 
}




?>






