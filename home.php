<!DOCTYPE HTML>
<html>

<?php 
include('upload.php');
include('uploadedlist.php');


?>

<head>
	<title>Unit e-Filling</title>	

	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	
	<script>
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
							<input type="text" name="unitcodes" required class="form-control" id="inputEmail3" value="UECS 3333" placeholder="UECS3333">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitname'] ?></label>
						<div class="col-sm-5">
							<input type="text" name="unitnames" class="form-control" id="inputEmail3" value="Web Engineering" placeholder="Web Engineering">
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
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['lectures'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="lecture" required class="form-control" id="inputEmail3" value="1" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['tutorials'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="tutorial" required class="form-control" id="inputEmail3" value="1" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['quizzes'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="quiz" required class="form-control" id="inputEmail3" value="1" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['tests'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="test" required class="form-control" id="inputEmail3" value="2" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['practicals'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="practical" required class="form-control" id="inputEmail3" value="3" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['assignments'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="assignment" required class="form-control" id="inputEmail3" value="4" placeholder="">
						</div>
						<div class="row">
							
							<button type="submit" class="btn btn-default">Save number of files</button>
							
						</div>	
					</div>
					<div id="uploadfilepart" style="visibility: none;" class="form-group">
						<label for="exampleInputFile" class="col-sm-2 control-label">File input:</label>
						<div class="col-sm-6">
							<input type="file" multiple="multiple" name="file[]" class="form-control" id="files">
							<div id="drop_zone">Drop files here</div>
							<output id="list"></output>
						</div>
						<div class="row">
							
							<button  name="action" type="submit" value="uploadFiles" class="btn btn-default">Submit</button>
							
						</div>				
					</div>
					<script>
					var output = [];
						function makeVisible(){
							console.log ("asd");
							document.getElementById(uploadfilepart).style.visibility="visible";

						}

						function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    

    for (var i = 0, f; f = files[i]; i++) {

    	
    	output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
    		f.size, ' bytes, last modified: ',
    		f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
    		'</li>');
    }
    document.getElementById('uploadfilepanel').innerHTML = '<ul>' + output.join('') + '</ul>';
}

document.getElementById('files').addEventListener('change', handleFileSelect, true);
</script>


</form>
</div>
</div>

<div   class="panel panel-default">
	<div class="panel-heading">Uploading file</div>
	<div id="uploadfilepanel" class="panel-body">
		


	</div>
</div>

<div   class="panel panel-default">
	<div class="panel-heading">Needed Files</div>
	<?php 
	$file = file_get_contents('test.txt', true);
	echo $file;

	?>
	<div id="uploadfilepanel" class="panel-body">
		


	</div>
</div>





</body>
</html>


