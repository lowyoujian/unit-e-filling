	function lecturerAssignValidation(){
		var input1 = document.getElementById("lecturerId").value;
		if(input1.length == 0){
			alert("Please make sure Lecturer ID is not null. Please try again.");

			}
	}
	
		function moderatorAssignValidation(){
		var inputModerator = document.getElementById("moderatorId").value;
		if(inputModerator.length == 0){
			alert("Please make sure Moderator ID is not null. Please try again.");

			}
				
	}
	
	function unitAssignValidation(){
		var inputUnitCode = document.getElementById("unitCodes").value;
		var inputUnitName = document.getElementById("unitNames").value;
		if(inputUnitCode.length == 0 && inputUnitName.length == 0){
			alert("Please make sure Unit Code and Unit Name are not null. Please try again.");
			}else
		if(inputUnitCode.length > 10){
			alert("Please make sure Unit Code should not more than 10 characters. Please try again.");
			}else
		if(inputUnitCode.length == 0){
			alert("Please make sure Unit Code is not null. Please try again.");
			}else			
			if(inputUnitName.length == 0){
			alert("Please make sure Unit Name is not null. Please try again.");
			}
				
	}
	
	function programmeAssignValidation(){
		var input2 = document.getElementById("programmeNames").value;
		var input3 = document.getElementById("shortCodes").value;
		if(input2.length == 0 && input3.length == 0){
			alert("Please make sure Programme Name and Short Code is not null. Please try again.");
			}else
		if(input2.length > 50){
			alert("Please make sure Programme Name should not more than 50 characters. Please try again.");
			}else
		if(input2.length == 0){
			alert("Please make sure Programme Name is not null. Please try again.");
			}else			
			if(input3.length > 4){
			alert("Please make sure Short Code should not more than 4 characters. Please try again.");
			}else			
			if(input3.length == 0){
			alert("Please make sure Short Code is not null. Please try again.");
			}
	}
	
	function setFileNumValidation(){
		var text1 = "Number of Lecture";
		var text2 = "Number of Tutorial";
		var text3 = "Number of Practical";
		var text4 = "Number of Assignment";
		var text5 = "Number of Test";
		var text6 = "Number of Quiz";		
		var num1 = document.getElementById("numOfLectures").value;
		var num2 = document.getElementById("numOfTutorials").value;
		var num3 = document.getElementById("numOfPracticals").value;
		var num4 = document.getElementById("numOfAssignments").value;
		var num5 = document.getElementById("numOfTests").value;
		var num6 = document.getElementById("numOfQuizes").value;
		if(num1.length == 0){
		alert(text1+"is required. Please try again.");

		}
		else if(num2.length == 0){
			alert(text2+"is required. Please try again.");
		}
		else if(num3.length == 0){
			alert(text3+"is required. Please try again.");
		}
		else if(num4.length == 0){
			alert(text4+"is required. Please try again.");
		}
		else if(num5.length == 0){
			alert(text5+"is required. Please try again.");
		}
		else if(num6.length == 0){
			alert(text6+"is required. Please try again.");
		}
		
		
	}