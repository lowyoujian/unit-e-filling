function generateTextFile(){
			<?php 
			
			$file = fopen("test.txt","w"); 
			fwrite($file, "1-syllabus\syllabus ".$_POST["unitcodes"]. "\r\n"); 
			fwrite($file, "2-teaching planteaching plan ".$_POST["unitcodes"]. "\r\n");
			
			for ($x=1; $x<=$_POST["lecture"]; $x++) {
				fwrite($file,  "lecture". "$x\r\n");
			} 

			for ($x=1; $x<=$_POST["quiz"]; $x++) {
				fwrite($file,  "tutorial". "$x\r\n");
				fwrite($file,  "tutorial_solution". "$x\r\n");
			} 

			for ($x=1; $x<=$_POST["assignment"]; $x++) {
				fwrite($file,  "assignment". "$x\r\n");
				fwrite($file,  "assignment_solution". "$x\r\n");
			} 

			for ($x=1; $x<=$_POST["practical"]; $x++) {
				fwrite($file,  "practical". "$x\r\n");
				fwrite($file,  "practical_solution". "$x\r\n");
			} 

			for ($x=1; $x<=$_POST["quiz"]; $x++) {
				fwrite($file,  "quiz". "$x\r\n");
				fwrite($file,  "quiz_solution". "$x\r\n");
			} 

			for ($x=1; $x<=$_POST["test"]; $x++) {
				fwrite($file,  "test". "$x\r\n");
				fwrite($file,  "test_solution". "$x\r\n");
			} 

			fwrite($file,"main". "\r\n");
			fwrite($file, "unit matrix ". $_POST["unitcodes"]. "\r\n");
			fwrite($file, "academic report ". $_POST["unitcodes"]. "\r\n");
			fwrite($file, "misc". $_POST["unitcodes"]. "\r\n");

			fclose($file); 

			
			

			?>
		}			