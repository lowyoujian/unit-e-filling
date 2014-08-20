	function unitAssignValidation(){
		var status1 = false;
		var input1 = document.getElementById("lecturerId").value;
		if(input1.length == 0){
			document.getElementById("error_lecturerId").innerHTML = "Please insert Lecturer ID";
			status1 = false;
			}
		else{
			document.getElementById("error_lecturerId").innerHTML = "";
			status1 = true;
			}
				
	}
	
		function programmeAssignValidation(){
		var status2 = false;
		var input2 = document.getElementById("programmeName").value;
		if(input2.length == 0){
			document.getElementById("error_programmeName").innerHTML = "Please insert Programme Name";
			status2 = false;
			}
		else{
			document.getElementById("error_programmeName").innerHTML = "";
			status2 = true;
			}
				
				
			var status3 = false;
		var input3 = document.getElementById("shortCodes").value;
		if(input3.length == 0){
			document.getElementById("error_shortCodes").innerHTML = "Please insert Short Code";
			}
		else{
			document.getElementById("error_shortCodes").innerHTML = "";
			status3 = true;
			}
	}