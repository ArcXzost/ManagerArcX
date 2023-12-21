function openNav() {
    document.getElementById("mySidenav").style.width = "15vw";
  }
  
/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0vw";
}


// LOGIN PAGE

var username,email,password;
async function googleauth()
{
  // const response = await fetch("http://localhost:8080/api/task/login");
  window.location.replace("http://localhost:8080/task/login");
}
async function validateForm() {
  username = document.getElementById("username").value;
  email = document.getElementById("email").value;
  password = document.getElementById("password").value;

  // Regular expression for email validation
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Reset error messages
  document.getElementById("username-error").textContent = "";
  document.getElementById("email-error").textContent = "";
  document.getElementById("password-error").textContent = "";

  var isValid = true;
  var matchFound = false;

  if (!emailRegex.test(email)) {
    document.getElementById("email-error").textContent = "Invalid email ID.";
    isValid = false;
  }
  else{
    const response = await fetch("http://localhost:8080/api/task");
    const data= await response.json();
    // console.log(data);
    flag = 0;
    for(var i = 0; i < data.length; i++)
    {
      // console.log(data[i].task_owner_email+" "+data[i].password);
      if(data[i].task_owner_email.localeCompare(email) == 0)
      {
        flag = 1;
        if(data[i].task_owner.localeCompare(username) == 0 && data[i].password.localeCompare(password) == 0){
          // console.log("logged in");
          matchFound = true;
        }
    }
  }
    if(flag == 1)
    {
      if(!matchFound)
        isValid = false;
      else{
        alert("Welcome user logging you in");
        sessionStorage.setItem('username', username);
        sessionStorage.setItem('password', password);
        sessionStorage.setItem('email', email);
        window.location.replace("http://localhost:8080/tasks/logged");
      }
    }
    else{
      //create new task
      alert("New user account created");
      sessionStorage.setItem('username', username);
      sessionStorage.setItem('password', password);
      sessionStorage.setItem('email', email);
      window.location.replace("http://localhost:8080/tasks/logged");
    }
  }
  // Check if fields are empty
  if (username == "") {
      document.getElementById("username-error").textContent = "Invalid username.";
      isValid = false;
  }

  if (!password.trim()) {
      document.getElementById("password-error").textContent = "Invalid password.";
      isValid = false;
  }
 
  // If all fields are valid, proceed with login logic
  if (!isValid) {
    alert("Login failed! Invalid credentials!");
  }
}

document.getElementById("profile").addEventListener('click',()=>{
  document.getElementById("login").classList.remove("hidden");
  document.getElementById("login").classList.add("flex");
});

document.getElementById("dashboard").addEventListener('click',()=>{
  document.getElementById("login").classList.remove("hidden");
  document.getElementById("login").classList.add("flex");
});

document.getElementById("team").addEventListener('click',()=>{
  document.getElementById("login").classList.remove("hidden");
  document.getElementById("login").classList.add("flex");
});

document.getElementById("projects").addEventListener('click',()=>{
  document.getElementById("login").classList.remove("hidden");
  document.getElementById("login").classList.add("flex");
});

document.getElementById("signup").addEventListener('click',()=>{
  document.getElementById("login").classList.remove("hidden");
  document.getElementById("login").classList.add("flex");
});

document.getElementById("signUp").addEventListener('click',()=>{
  document.getElementById("login").classList.remove("hidden");
  document.getElementById("login").classList.add("flex");
});

document.getElementById("logIn").addEventListener('click',()=>{
  document.getElementById("login").classList.remove("hidden");
  document.getElementById("login").classList.add("flex");
});

