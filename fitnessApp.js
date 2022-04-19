// --------------- LOG IN UP PAGE ------------
function logIN(){ //login page
    var email     = document.getElementById("email").value;
    var password  = document.getElementById("password").value;
    var loginURL  = "LoginIn.php?email="+email+"&password="+password;

    var myXMLRequest = new XMLHttpRequest();
    myXMLRequest.onload= displayLOGININ;
    myXMLRequest.open("GET", loginURL, true);
    myXMLRequest.send();

}

// GO TO APP PAGE FROM LOG IN PAGE
function displayLOGININ(){
    var data = this.responseText;
    if(data=="valid"){
      window.location.href = "Resultspage.html";
      }
      else{
        var output = "Login info invaild";
        document.getElementById("txtHINT").innerHTML=output;
  }
}
// ------------------------------------------

// --------------- SIGN UP PAGE ------------
function submitUserinfo (){
    //TASK 1: BUILD the User account Query  : SIGNUP PAGE
    // A. Specify the php file
    //A. send information to database
    //not sure if the this is needed!!!!!
    var uFN = document.getElementById("firstname").value;
    var uLN = document.getElementById("lastName").value;
    var uE = document.getElementById("email").value;
    var uP = document.getElementById("password").value;

    if(uFN ==""  || uLN=="" || uE=="" || uP==""){
      alert("One or more fields were not filled!");
    }
    else{

          var signUp = "alternativeSignup.php?firstname=" +uFN+ "&lastName=" +uLN+ "&email=" +uE+ "&password=" +uP;
          //TASK 2: CREATE AN HTTP REQUEST AND PROCESS IT
          var myXMLRequest = new XMLHttpRequest();
          //myXMLRequest.onload= test;
          myXMLRequest.onload= sendUserInformation;
          myXMLRequest.open("GET", signUp, true);
          myXMLRequest.send();
    }
}
// //DEBUGGING
// function test(){
//   var test = this.responseText;
//   alert(test);
// }

function sendUserInformation(){

    var outcome = this.responseText;
    var results= JSON.parse(outcome);

    if(results.valid == "You're information has been successfully saved." ){
        alert("You are now registered. Redirecting to the Login page. ");
        window.location.assign("http://www.arhim345w.com/Assignment11/Assignment(11).html");
    }
    else if(results.valid== "user already exsists!"){
        alert("The account already exists.")
    }
    else if(results.valid== "Invaild Email address. Try agin. "){
        alert("The email form is invaild!");
    }
}

// ------------------------------------------

// --------------- PEFORM SEARCH ON RESULTS PAGE ------------
function sendUserWS(){
  //TASK 1: BUILD the QUERY STRING : SEARCH
  // A. Specify the php file
  //A. Retrieve the user input (major) from the form
  var chosen = document.getElementById("MuscleGroup").value;
  var workoutOutput = "results.php?MuscleGroup=" +chosen;

  //TASK 2: CREATE AN HTTP REQUEST AND PROCESS IT
  var myXMLRequest = new XMLHttpRequest();
  myXMLRequest.onload= displayResults;
  myXMLRequest.open("GET", workoutOutput, true);
  myXMLRequest.send();
}

//HANDLER FOR THE PROCESSING THE HTTP REQUEST
function displayResults(){
  document.getElementById("output").innerHTML = this.responseText;
}
