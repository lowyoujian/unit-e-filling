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
						<label for="unitcodes" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitcode'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="unitcodes" required class="form-control" id="unitcodes" value="UECS 3333" placeholder="UECS3333">
						</div>
					</div>
					<div class="form-group">
						<label for="unitnames" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitname'] ?></label>
						<div class="col-sm-5">
							<input type="text" name="unitnames" class="form-control" id="unitnames" value="Web Engineering" placeholder="Web Engineering">
						</div>
					</div>
					<div class="form-group">
						<label for="yearandtrimester" class="col-sm-2 control-label"><?php echo $upload_form_fields['trimester'] ?></label>
						<div class="col-sm-3">
						    <select name="yearandtrimester">
					        <option value="102020" >Oct/2020</option>
							<option value="052020" >May/2020</option>
							<option value="012020" >Jan/2020</option>
							<option value="102019" >Oct/2019</option>
							<option value="052019" >May/2019</option>
							<option value="012019" >Jan/2019</option>
							<option value="102018" >Oct/2018</option>
							<option value="052018" >May/2018</option>
							<option value="012018" >Jan/2018</option>
							<option value="102017" >Oct/2017</option>
							<option value="052017" >May/2017</option>
							<option value="012017" >Jan/2017</option>
							<option value="102016" >Oct/2016</option>
							<option value="052016" >May/2016</option>
							<option value="012016" >Jan/2016</option>
							<option value="102015" >Oct/2015</option>
							<option value="052015" >May/2015</option>
						    <option value="012015" >Jan/2015</option>
							<option value="102014" >Oct/2014</option>
							<option value="052014" selected="selected">May/2014</option>							
			                <option value="012014" >Jan/2014</option>
							</select>							
						</div>
					</div>
					<div class="form-group">
						<label for="programme" class="col-sm-2 control-label"><?php echo $upload_form_fields['programme'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="programme" value="Software Engineering" placeholder="Software Engineering">
						</div>
					</div>
					<div class="form-group">
						<label for="moderator" class="col-sm-2 control-label"><?php echo $upload_form_fields['moderator'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="moderator" required class="form-control" id="moderator" value="ooieh@utar.my" placeholder="ooieh@utar.my">
						</div>
					</div>
					<div class="form-group">
						<label for="lecture" class="col-sm-2 control-label"><?php echo $upload_form_fields['lectures'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="lecture" required class="form-control" id="lecture" value="1" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="tutorial" class="col-sm-2 control-label"><?php echo $upload_form_fields['tutorials'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="tutorial" required class="form-control" id="tutorial" value="1" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="quiz" class="col-sm-2 control-label"><?php echo $upload_form_fields['quizzes'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="quiz" required class="form-control" id="quiz" value="1" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="test" class="col-sm-2 control-label"><?php echo $upload_form_fields['tests'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="test" required class="form-control" id="test" value="2" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="practical" class="col-sm-2 control-label"><?php echo $upload_form_fields['practicals'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="practical" required class="form-control" id="practical" value="3" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="assignment" class="col-sm-2 control-label"><?php echo $upload_form_fields['assignments'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="assignment" required class="form-control" id="assignment" value="4" placeholder="">
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


