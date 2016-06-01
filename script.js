/*(function baited() {	
	var x = document.getElementById("b8");
	if (x.innerHTML === "Click me") {
		x.innerHTML = 'baited';
		setTimeout(baited, 1500);
	}
	else {
		x.innerHTML = 'Click me';
	}
} */

function reveal(id) {
	if (document.getElementById(id).style.display === "block") {
		document.getElementById(id).style.display = "none";
	}
	else {
		var elements = document.getElementsByClassName("directlist");
		for (var i=0; i < elements.length; i++) {
			elements[i].style.display = "none";
		}
		document.getElementById(id).style.display = "block";
	}
}

function bgselect(bgname) {
	var background = "url('./images/" + bgname + ".png')";
	switch (bgname) {
		case "white":
			document.body.style.backgroundColor = bgname;
			document.body.style.backgroundImage = "none";
			bgSelectHelper("black", "directorylinks", "black", "#F8F8F8");
			break;
		case "greenCup":
			document.body.style.backgroundImage = background;
			bgSelectHelper("black", "directorylinks", "black", "#D3D9C4");
			break;
		case "stressedLinen":
			document.body.style.backgroundImage = background;
			bgSelectHelper("black", "directorylinks", "white", "#A8A8A8");
			break;
		default:
			break;
	}
	function bgSelectHelper(textColor, className, linkColor, headerColor) {
		document.body.style.color = textColor;
		document.getElementById("header").style.backgroundColor = headerColor;
		var elements = document.getElementsByClassName(className);
		for (var i=0; i < elements.length; i++)
			elements[i].style.color = linkColor;
	}
}

function calc() {
	var input1 = document.getElementById("calcInput1");
	var input2 = document.getElementById("calcInput2");
	if (input1.value && input2.value) {
		var result = parseInt(input1.value, 10) + parseInt(input2.value, 10);
		document.getElementById("calcResult").innerHTML = result;
	}
	else {
		document.getElementById("calcResult").innerHTML = "Enter a number";
		if (input1.value)
			input2.focus();
		else
			input1.focus();
	} 
}

function logRegResult(cond) {
	var output = document.getElementById("logRegResult");
	switch (cond) {
		case "dupe":
			output.innerHTML = "Username already exists";
			break;
		case "regSuccess":
			output.innerHTML = "Registration successful"; 
			break;
		case "logFail": 
			output.innerHTML = "Incorrect login info"; 
			break;
		default: 
			output.innerHTML = ":^)";
	}
}