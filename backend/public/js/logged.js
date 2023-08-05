username = sessionStorage.getItem('username');
email = sessionStorage.getItem('email');
password = sessionStorage.getItem('password');

function openNav() {
    document.getElementById("mySidenav").style.width = "15vw";
  }
  
/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0vw";
}


function showCalendar() {
  document.getElementById("calendar-container").classList.remove('w-0');
  document.getElementById("calendar-container").classList.add('w-5/12');
  document.getElementById("calendar-container").classList.add('px-4');
  document.getElementById("guide").classList.remove('flex');
  document.getElementById("guide").classList.add('hidden');
}

var selectedDate, update = 0;
const saveButton = document.getElementById("save");

const currentDate = new Date();
selectedDate = formatDate(currentDate); 


// Event listener for previous button
document.getElementById('prevBtn').addEventListener('click', () => {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
});

// Event listener for next button
document.getElementById('nextBtn').addEventListener('click', () => {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
});

// Event listener for calendar cell click
document.getElementById('calendarBody').addEventListener('click', (event) => {
  const selectedCell = event.target;
  if (selectedCell.tagName === 'TD') {
    // Remove existing highlighting
    const highlightedCell = document.querySelector('.bg-violet-700');
    if (highlightedCell) {
      highlightedCell.classList.remove('bg-violet-700');
    }

    // Highlight the clicked cell
    selectedCell.classList.add('bg-violet-700');

    // Update the highlightedDate to the clicked cell's date
    selectedDate = String(selectedCell.textContent).padStart(2,'0') + '-' + String(currentDate.getMonth() + 1).padStart(2, '0') + '-' + currentDate.getFullYear();
    console.log(selectedDate);
    displayTodos("http://localhost:8080/api/task/todos/"+email+"/"+selectedDate);
  }
});

// Function to format date as "dd-mm-yyyy"
function formatDate(date) {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');
  return `${day}-${month}-${year}`;
}

// Function to render the calendar
function renderCalendar() {
  const monthYear = document.getElementById('monthYear');
  const calendarBody = document.getElementById('calendarBody');

  // Clear calendar
  monthYear.textContent = '';
  calendarBody.innerHTML = '';

  // Set month and year
  const monthOptions = { month: 'long', year: 'numeric' };
  monthYear.textContent = currentDate.toLocaleDateString('en-US', monthOptions);

  // Get the first day of the month
  const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

  // Determine the number of days in the month
  const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();

  let date = 1;

  // Create calendar rows and cells
  for (let i = 0; i < 6; i++) {
    const row = document.createElement('tr');

    for (let j = 0; j < 7; j++) {
      const cell = document.createElement('td');

      if (i === 0 && j < firstDay.getDay()) {
        // Empty cells before the first day
        cell.classList.add('py-2', 'px-4', 'border');
      } else if (date > lastDay) {
        // Empty cells after the last day
        cell.classList.add('py-2', 'px-4', 'border');
      } else {
        // Cells with date
        cell.classList.add('py-2', 'px-4', 'border', 'text-white');
        cell.textContent = date;

        if (
          date === currentDate.getDate() &&
          currentDate.getMonth() === currentDate.getMonth() &&
          currentDate.getFullYear() === currentDate.getFullYear()
        ) {
          // Highlight the current date initially
          cell.classList.add('bg-violet-700');
        }

        date++;
      }

      row.appendChild(cell);
    }

    calendarBody.appendChild(row);
  }
}

// Initial calendar render
renderCalendar();

var buttonClicked = 1;
todoList = document.getElementById("list");

function renderTodos(data) {
  // Clear the todo list
  todoList.innerHTML = "";
  // console.log(data);
  // Render each todo item
  for(var i=0; i<data.length; i++){

  const todoItem = document.createElement("card");
  todoItem.className = "todoItem flex items-center p-1 border-b-4 border-purple-700 h-16  mb-2 rounded-xl hover:bg-gray-200 duration-500";
  
  const todo_table = document.createElement("card");
  todo_table.className = "todos px-4 font-mono font-bold text-xl grow";
  var temp=data[i].task_description;
  
  todo_table.innerHTML = temp;
  const doneButton = document.createElement("button");
  doneButton.className = "fa fa-check mx-2 text-green-700 font-extrabold text-xl";
  doneButton.index = parseInt(data[i].id);
  doneButton.addEventListener('click',async function(event){
    await fetch("http://localhost:8080/api/task/done/"+ event.currentTarget.index,{
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      }});
    // const response = await fetch("http://localhost:8080/api/task/todos/"+email+"/"+selectedDate);
    // const data = await response.json();
    if(buttonClicked == 1)
      todoGenerate();
    else
      overdueGenerate();
    
    // alert("Task marked as done")
  });

  const deleteButton = document.createElement("button");
  deleteButton.className = "fa fa-trash mx-1 text-red-600 text-xl";
  deleteButton.index = parseInt(data[i].id);
  deleteButton.addEventListener("click", async function(event){
      await fetch("http://localhost:8080/api/task/"+event.currentTarget.index,{
        method: 'DELETE',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
        }});

      if(buttonClicked == 1)
        todoGenerate();
      else if(buttonClicked == 3)
        overdueGenerate();
      else
        completeGenerate();

      // alert("Task deleted succesfully");
  });

  const updateButton = document.createElement("button");
  updateButton.className = "fa fa-pencil mx-2 text-indigo-600 text-xl";
  updateButton.index = parseInt(data[i].id);
  updateButton.addEventListener("click", async function(event){
    modalOverlay.classList.remove("hidden");
    update = 1;
    saveButton.index = event.currentTarget.index;
    // alert("Task updated succesfully");
  });

  if(buttonClicked == 1){
    todoItem.classList.add('bg-gray-300');
    if(document.getElementById("Completed").classList.contains('text-black'))
    {
      document.getElementById("Completed").classList.remove('text-black');
      document.getElementById("Completed").classList.add('text-gray-300');
    }
    if(document.getElementById("Overdue").classList.contains('text-black'))
    {
      document.getElementById("Overdue").classList.remove('text-black');
      document.getElementById("Overdue").classList.add('text-gray-300');
    }
    document.getElementById("To-do").classList.remove('text-gray-300');
    document.getElementById("To-do").classList.add('text-black');
    todoItem.appendChild(todo_table);
    todoItem.appendChild(doneButton);
    todoItem.appendChild(deleteButton);
    todoItem.appendChild(updateButton);
    todoList.appendChild(todoItem);
  }
  else if(buttonClicked == 2){
    todoItem.classList.add('bg-green-300');
    
    todoItem.appendChild(todo_table);
    todoItem.appendChild(deleteButton);
    todoList.appendChild(todoItem);
  }
  else{
    todoItem.classList.add('bg-red-300');
    
    todoItem.appendChild(todo_table);
    todoItem.appendChild(doneButton);
    todoItem.appendChild(deleteButton);
    todoItem.appendChild(updateButton);
    todoList.appendChild(todoItem);
  }
  };
}

displayTodos("http://localhost:8080/api/task/todos/"+email+"/"+selectedDate);
document.getElementById("guide2").innerText = "Your task list for "+formatDate(currentDate)+". To get your calendar, go to your profile. There you can get your task list for specific dates"
document.getElementById("username").innerText = username;

function todoGenerate(){
  buttonClicked = 1;
  if(document.getElementById("Completed").classList.contains('text-black'))
    {
      document.getElementById("Completed").classList.remove('text-black');
      document.getElementById("Completed").classList.add('text-gray-300');
    }
    if(document.getElementById("Overdue").classList.contains('text-black'))
    {
      document.getElementById("Overdue").classList.remove('text-black');
      document.getElementById("Overdue").classList.add('text-gray-300');
    }
    document.getElementById("To-do").classList.remove('text-gray-300');
    document.getElementById("To-do").classList.add('text-black');
  displayTodos("http://localhost:8080/api/task/todos/"+email+"/"+selectedDate);
}

document.getElementById("To-do").addEventListener('click',todoGenerate);

async function completeGenerate(){
  buttonClicked = 2;
  if(document.getElementById("To-do").classList.contains('text-black'))
    {
      document.getElementById("To-do").classList.remove('text-black');
      document.getElementById("To-do").classList.add('text-gray-300');
    }
    if(document.getElementById("Overdue").classList.contains('text-black'))
    {
      document.getElementById("Overdue").classList.remove('text-black');
      document.getElementById("Overdue").classList.add('text-gray-300');
    }
    document.getElementById("Completed").classList.remove('text-gray-300');
    document.getElementById("Completed").classList.add('text-black');
  const response = await fetch("http://localhost:8080/api/task/completed/"+email);
  const data= await response.json();
  document.getElementById("Completed").innerText = "Completed" + "(" + data.length + ")";
  document.getElementById("completed").innerText = "Completed" + "(" + data.length + ")";
  renderTodos(data);
  if (data == ""){
    const todoText = document.createElement("div");
    const folder = document.createElement("i");
    // <i class=""></i>
    // <div id="todoText" class="">Your to-do list will appear here</div>
    folder.className = "text-8xl text-gray-400 font-bold fa fa-folder";
    todoText.className = "font-mono  text-gray-400 font-bold text-xl";
    todoList.appendChild(folder);
    todoList.appendChild(todoText);
    todoText.innerText = "No completed tasks ";
  }
}

document.getElementById("Completed").addEventListener('click', completeGenerate);

async function overdueGenerate(){
  // console.log(buttonClicked);
  buttonClicked = 3;
  if(document.getElementById("To-do").classList.contains('text-black'))
    {
      document.getElementById("To-do").classList.remove('text-black');
      document.getElementById("To-do").classList.add('text-gray-300');
    }
    if(document.getElementById("Completed").classList.contains('text-black'))
    {
      document.getElementById("Completed").classList.remove('text-black');
      document.getElementById("Completed").classList.add('text-gray-300');
    }
    document.getElementById("Overdue").classList.remove('text-gray-300');
    document.getElementById("Overdue").classList.add('text-black');
  response = await fetch("http://localhost:8080/api/task/overdue/"+email);
  data= await response.json();
  document.getElementById("Overdue").innerText = "Overdue" + "(" + data.length + ")";
  document.getElementById("overdue").innerText = "Overdue" + "(" + data.length + ")";
  renderTodos(data);
  if (data == ""){
    const todoText = document.createElement("div");
    const folder = document.createElement("i");
    // <i class=""></i>
    // <div id="todoText" class="">Your to-do list will appear here</div>
    folder.className = "text-8xl text-gray-400 font-bold fa fa-folder";
    todoText.className = "font-mono  text-gray-400 font-bold text-xl";
    todoList.appendChild(folder);
    todoList.appendChild(todoText);
    todoText.innerText = "No tasks overdue";
  }

  response = await fetch("http://localhost:8080/api/task/completed/"+email);
  data= await response.json();
  document.getElementById("Completed").innerText = "Completed" + "(" + data.length + ")";
  document.getElementById("completed").innerText = "Completed" + "(" + data.length + ")";

  response = await fetch("http://localhost:8080/api/task/todos/"+email+"/"+selectedDate);
  data= await response.json();
  document.getElementById("To-do").innerText = "To-do" + "(" + data.length + ")";
  document.getElementById("todo").innerText = "To-do" + "(" + data.length + ")";
}

document.getElementById("Overdue").addEventListener('click', overdueGenerate);

async function displayTodos(url){

  response = await fetch(url);
  data= await response.json();

  document.getElementById("To-do").innerText = "To-do" + "(" + data.length + ")";
  document.getElementById("todo").innerText = "To-do" + "(" + data.length + ")";
  renderTodos(data);

  if (data == ""){
    const todoText = document.createElement("div");
    const folder = document.createElement("i");
    // <i class=""></i>
    // <div id="todoText" class="">Your to-do list will appear here</div>
    folder.className = "text-8xl text-gray-400 font-bold fa fa-folder";
    todoText.className = "font-mono  text-gray-400 font-bold text-xl";
    todoList.appendChild(folder);
    todoList.appendChild(todoText);
    todoText.innerText = "No tasks to do for " + selectedDate;
  }
  else{
    // document.getElementById("folder").remove;
    // document.getElementById("todoText").remove;
  }
  
  response = await fetch("http://localhost:8080/api/task/completed/"+email);
  data= await response.json();

  document.getElementById("Completed").innerText = "Completed" + "(" + data.length + ")";
  document.getElementById("completed").innerText = "Completed" + "(" + data.length + ")";

  response = await fetch("http://localhost:8080/api/task/overdue/"+email);
  data= await response.json();

  document.getElementById("Overdue").innerText = "Overdue" + "(" + data.length + ")";
  document.getElementById("overdue").innerText = "Overdue" + "(" + data.length + ")";

}



// ADD TASK MODAL WINDOW
document.addEventListener("DOMContentLoaded", function () {
  const modalTriggerBtn = document.getElementById("modalTriggerBtn");
  const modalOverlay = document.getElementById("modalOverlay");
  const modalCloseBtn = document.getElementById("modalCloseBtn");

  // Open modal when the trigger button is clicked
  modalTriggerBtn.addEventListener("click", function () {
    modalOverlay.classList.remove("hidden");
  });

  // Close modal when the close button is clicked
  modalCloseBtn.addEventListener("click", function () {
    modalOverlay.classList.add("hidden");
  });

});


saveButton.addEventListener('click', async function(event){
  // console.log(username);
  // console.log(email);
  // console.log(password);
  document.getElementById("modalOverlay").classList.add("hidden");
  task_description = document.getElementById("task_description").value;
  task_eta = document.getElementById("task_eta").value;
  if(update == 0)
  {  const settings = {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
           task_description: task_description,
           task_owner: username,
           task_owner_email: email,
           task_eta: task_eta,
           password: password
           })
    };
    await fetch("http://localhost:8080/api/task", settings);
    await fetch("http://localhost:8080/api/task/mail", {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      }});
    if(buttonClicked == 1)
      todoGenerate();
    else
      overdueGenerate();
    
  }
  else{
    await fetch("http://localhost:8080/api/task/"+event.currentTarget.index,{
      method: 'PUT',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        task_description: task_description,
        task_eta: task_eta,
        })});

      if(buttonClicked == 1)
        todoGenerate();
      else
        overdueGenerate();
      update = 0;
  } 
});

console.log(selectedDate);
console.log(username);
console.log(password);
console.log(email);

document.getElementById("logout").addEventListener('click',()=>{
  username="";
  password="";
  email="";
  window.location.replace("http://localhost:8080/tasks");
});