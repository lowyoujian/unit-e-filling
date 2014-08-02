<!DOCTYPE HTML>
<html>
<?php 
include('upload.php');
include('uploadedlist.php');
session_start();
//Explode the unit code and unit name to individual variable
$result = $_GET['unitcodeslist'];
$result_explode = explode('|', $result);
$unitcodez=$result_explode[0];
$unitdescriptionz=$result_explode[1];
?>

<head>
	<title>Unit e-Filling</title>	

	<link rel="stylesheet" href="css/bootstrap.min.css"/>

	<script src="jquery-2.1.1.js"></script>
	<script>
		$(document).ready(function(){

			$("#divSaveChange").hide();
			$("#btnSaveChange").click(function(){
				$("#tutorial").prop("readonly",true);
				$("#lecture").prop("readonly",true);
				$("#quiz").prop("readonly",true);
				$("#test").prop("readonly",true);
				$("#practical").prop("readonly",true);
				$("#assignment").prop("readonly",true);
				$(this).prop("class",'btn btn-success');
				$("#btnSaveChange").text("Success");
			})	;

			$("#editNumFiles").click(function(){
				$(this).hide();
				$("#divSaveChange").show();
				$("#tutorial").removeAttr("readonly");
				$("#lecture").removeAttr("readonly");
				$("#quiz").removeAttr("readonly");
				$("#test").removeAttr("readonly");
				$("#practical").removeAttr("readonly");
				$("#assignment").removeAttr("readonly");
			});
		});
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
							<input type="text" readonly name="unitcodes" required class="form-control" id="unitcodes" value="<?php echo $unitcodez?>" placeholder="UECS3333">
						</div>
					</div>
					<div class="form-group">
						<label for="unitnames" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitname'] ?></label>
						<div class="col-sm-5">
							<input type="text" name="unitnames" readonly class="form-control" id="unitnames" value="<?php echo $unitdescriptionz ?>" placeholder="Web Engineering">
						</div>
					</div> 
					<div class="form-group">
						<label for="yearandtrimester" class="col-sm-2 control-label"><?php echo $upload_form_fields['trimester'] ?></label>
						<div class="col-sm-3">
							<select name="yearandtrimester">
								<option value="102014" >Oct/2014</option>
								<option value="052014" selected="selected">May/2014</option>							
								<option value="012014" >Jan/2014</option>
							</select>							
						</div>
					</div>
					<div class="form-group">
						<label for="programme" class="col-sm-2 control-label"><?php echo $upload_form_fields['programme'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" readonly required class="form-control" id="programme" value="Software Engineering" placeholder="Software Engineering">
						</div>
					</div>
					<div class="form-group">
						<label for="moderator" class="col-sm-2 control-label"><?php echo $upload_form_fields['moderator'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="moderator" required class="form-control" id="moderator" value="ooieh@utar.my" placeholder="ooieh@utar.my">
						</div>
					</div>
					
					<div class="panel panel-default">
						<div class="panel-heading">Number of Files	</div>
						<div class="panel-body">
							<div class="form-group">
								<label for="lecture" class="col-sm-2 control-label"><?php echo $upload_form_fields['lectures'] ?></label>
								<div class="col-sm-3">
									<input type="text"  readonly="readonly" name="lecture" required class="form-control" id="lecture" value="14" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="tutorial" class="col-sm-2 control-label"><?php echo $upload_form_fields['tutorials'] ?></label>
								<div class="col-sm-3">
									<input type="text" readonly="readonly" name="tutorial" required class="form-control" id="tutorial" value="14" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="quiz" class="col-sm-2 control-label"><?php echo $upload_form_fields['quizzes'] ?></label>
								<div class="col-sm-3">
									<input type="text" readonly="readonly" name="quiz" required class="form-control" id="quiz" value="2" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="test" class="col-sm-2 control-label"><?php echo $upload_form_fields['tests'] ?></label>
								<div class="col-sm-3">
									<input type="text" readonly="readonly" name="test" required class="form-control" id="test" value="1" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="practical" class="col-sm-2 control-label"><?php echo $upload_form_fields['practicals'] ?></label>
								<div class="col-sm-3">
									<input type="text" readonly="readonly" name="practical" required class="form-control" id="practical" value="0" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="assignment" class="col-sm-2 control-label"><?php echo $upload_form_fields['assignments'] ?></label>
								<div class="col-sm-3">
									<input type="text" readonly="readonly" name="assignment" required class="form-control" id="assignment" value="4" placeholder="">
								</div>
								<div class="row">

									<button type="button" id="editNumFiles" class="btn btn-default">Edit Number of files</button>

									<div id="divSaveChange" >
										<button type="button"  id="btnSaveChange" class="btn btn-default">Save Changes</button>
									</div>						
								</div>	
							</div>
							<div id="divUpload" style="visibility: none;" class="form-group">
								<label for="exampleInputFile" class="col-sm-2 control-label">File input:</label>
								<div class="col-sm-6">
									<input type="file" name="file[]" id="fileToUpload" webkitdirectory="" directory="">
								</div>
								<div class="row">
									<button  name="submitFiles" type="submit" value="uploadFiles" class="btn btn-default">Submit</button>
								</div>				

							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div   class="panel panel-default">
			<div class="panel-heading">Uploading file</div>
			<output id="list"></output>
			<script>
				function inArray(needle, haystack) {
					var length = haystack.length;
					for(var i = 0; i < length; i++) {
						if(haystack[i] == needle) return true;
					}
					else{
						return false;
					}
				}

				var index;
				var readers = []
				var testarray = ["test.txt","","test - Copy.txt"];
				var validatedFiles = [];
				$("#fileToUpload").on("change", function (event){
					var files = event.originalEvent.target.files;
					for(index = 0; index<files.length; index++){
						if(inArray(files[index].name,testarray)){
							
							readers[index] = new FileReader();

							readers[index].onload = (function (processedFile) {
								return function (e) {
									var fileData = { name : processedFile.name, fileData : e.target.result };									$.post("#", fileData);

									validatedFiles.push(fileData);
									console.log(validatedFiles);
									
								};
							})(files[index]);

							readers[index].readAsDataURL(files[index]);
						} else { 
						}
						}					
			


					document.getElementById('list').innerHTML = '<ul>' + validatedFiles.join('<br>') + '</ul>';

				}
				)



			</script>
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
	</div>
</body>
</html>


