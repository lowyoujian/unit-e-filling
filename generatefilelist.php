<?php

if (!file_exists("upload/UECS2094/$semester")) {
	mkdir("upload/UECS2094//$semester", 0777, true);
}
if(!file_exists("upload/UECS2094//$semester/$unitcode.txt")){
	$file = fopen("upload/UECS2094//$semester/$unitcode.txt","w"); 
	fwrite($file, "syllabus"."\r\n"); 
	fwrite($file, "teaching plan"."\r\n");

	for ($x=1; $x<=$lectures; $x++) {
		fwrite($file,  "lecture".".pdf". "$x\r\n");
	} 

	for ($x=1; $x<=$tutorials; $x++) {
		fwrite($file,  "tutorial". "$x\r\n");
		fwrite($file,  "tutorial_solution".".pdf". "$x\r\n");
	} 

	for ($x=1; $x<=$assignments; $x++) {
		fwrite($file,  "assignment".".pdf". "$x\r\n");
	}

	for ($x=1; $x<=$practicals; $x++) {
		fwrite($file,  "practical". "$x\r\n");
		fwrite($file,  "practical_solution".".pdf". "$x\r\n");
	} 

	for ($x=1; $x<=$quizzes; $x++) {
		fwrite($file,  "quiz". "$x\r\n");
		fwrite($file,  "quiz_solution".".pdf". "$x\r\n");
	} 

	for ($x=1; $x<=$tests; $x++) {
		fwrite($file,  "test". "$x\r\n");
		fwrite($file,  "test_solution".".pdf". "$x\r\n");
	} 

	fwrite($file,"main". "\r\n");
	fwrite($file, "unit matrix ". $unitcode.".pdf". "\r\n");
	fwrite($file, "academic report ". $unitcode.".pdf". "\r\n");
	fwrite($file, "misc".".pdf". $unitcode);

	fclose($file); 
}




?>






