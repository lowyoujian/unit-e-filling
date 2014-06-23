<!DOCTYPE HTML>
<html>

<?php 
include('upload.php');

?>

<head>
	<title>Unit e-Filling</title>	

	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	
	<script>
		function file_generate(){
			<?php 
			
			$file = fopen("test.txt","w"); 
			fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "1-syllabus\syllabus ". $_POST["unitcodes"]. "\r\n"); 
			fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "2-teaching plan\teaching plan ". $_POST["unitcodes"]. "\r\n");
			
			for ($x=1; $x<=$_POST["lecture"]; $x++) {
				fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "3-lecture\lecture". "$x\r\n");
			} 

			for ($x=1; $x<=$_POST["quiz"]; $x++) {
				fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "4-tutorial\\tutorial". "$x\r\n");
				fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "4-tutorial\solution". "$x\r\n");
			} 

			for ($x=1; $x<=$_POST["assignment"]; $x++) {
				fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "5-assignment\assignment". "$x\r\n");
				fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "5-assignment\solution". "$x\r\n");
			} 

			for ($x=1; $x<=$_POST["practical"]; $x++) {
				fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "6-practical\practical". "$x\r\n");
				fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "6-practical\solution". "$x\r\n");
			} 

			for ($x=1; $x<=$_POST["quiz"]; $x++) {
				fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "7-quiz\quiz". "$x\r\n");
				fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "7-quiz\solution". "$x\r\n");
			} 

			for ($x=1; $x<=$_POST["test"]; $x++) {
				fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "8-test\\test". "$x\r\n");
				fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "8-test\solution". "$x\r\n");
			} 

			fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "9-exam\main". "$x\r\n");
			fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "10-unit matrix\unit matrix ". $_POST["unitcodes"]. "\r\n");
			fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "11-academic report\academic report ". $_POST["unitcodes"]. "\r\n");
			fwrite($file, $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "12-misc\misc ". $_POST["unitcodes"]. "\r\n");

			fclose($file); 

			
			

			?>
		}			
	</script>
</head>
<body>

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">e-Unitfile</div>
			<div class="panel-body">

				<form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="unitcode" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitcode'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="unitcode" required class="form-control" id="inputEmail3" value="UECS 3333" placeholder="UECS 3333">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitname'] ?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="inputEmail3" value="Web Engineering" placeholder="Web Engineering">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['trimester'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="May/2014" placeholder="May/2014">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['programme'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="Software Engineering" placeholder="Software Engineering">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['moderator'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="ooieh@utar.my" placeholder="ooieh@utar.my">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['quizzes'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="1" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['tests'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="2" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['labs'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="3" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['assignments'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="4" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputFile" class="col-sm-2 control-label">File input:</label>
						<div class="col-sm-6">
							<input type="file" multiple="multiple" required name="files[]" class="form-control" id="files">
							<div id="drop_zone">Drop files here</div>
							<output id="list"></output>
						</div>
						<div class="row">
							
							<button type="submit" class="btn btn-default">Submit</button>
							
						</div>				
					</div>
					<script>
						function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
    	output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
    		f.size, ' bytes, last modified: ',
    		f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
    		'</li>');
    }
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
}

document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>


</form>
</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Uploaded file</div>
	<div class="panel-body">
		


	</div>
</div>





</body>
</html>


