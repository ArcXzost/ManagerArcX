<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Task Manager</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"
         integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />
   </head>
   <body class="bg-gradient-to-r from-slate-900 to-black">
      <header class="flex pt-4 h-20 bg-slate-900">
         <span onclick="openNav()" class="cursor-pointer"><i class="text-4xl pl-2 text-violet-400 fas fa-bars"></i></span>
         <div id="mySidenav" class="fixed h-screen w-0 bg-black left-0 top-0 z-10 overflow-x-hidden transition-all duration-500 ease-in-out sidenav">
            <button class="absolute text-gray-700 text-4xl block pb-6 pt-2 right-2 no-underline transition duration-300 hover:text-violet-400 closebtn" onclick="closeNav()">&times;</button>
            <button class="text-slate-500 text-2xl block px-8 pt-20 no-underline transition duration-300 hover:text-violet-400">Dashboard</button>
            <button id ="profile" onclick="showCalendar()" class="text-slate-500 text-2xl block px-8 pt-8 no-underline transition duration-300 hover:text-violet-400">Profile</button>
            <button href="#" class="text-slate-500 text-2xl block px-8 pt-8 no-underline transition duration-300 hover:text-violet-400">Team</button>
            <button href="#" class="text-slate-500 text-2xl block px-8 pt-8 no-underline transition duration-300 hover:text-violet-400">Projects</button>
         </div>
         <h1 class="font-mono text-4xl text-violet-400 text-center justify-center grow">ManagerArcX</h1>
         <a id="logout" class="text-violet-400 text-2xl pr-4 text-center justify-center hover:text-white">Log out</a>
      </header>

      <!-- PROFILE WITH CALENDAR -->
      <div class="flex w-full">
      <div id="calendar-container" class="block bg-gradient-to-r from-gray-800 to-slate-900 pt-6 pb-10 w-0 overflow-x-hidden transition-all duration-500 ease-in-out">
        <div class="bg-gradient-to-r  from-indigo-700 to-purple-900 rounded-3xl container mt-10 mb-32">
        <div class="p-6 rounded-lg shadow">
            <div class="flex items-center">
            <div class="w-16 h-16 rounded-full overflow-hidden mr-4">
                <img src="{{ URL::asset('js/TaskManager.png') }}" alt="Profile Image" class="object-cover w-full h-full">
            </div>
            <div>
                <h2 id="username" class="text-2xl text-black font-bold">Username</h2>
                <p id="userID" class="text-gray-500">UserID</p>
            </div>
            </div>
        </div>
        </div>

        <div class="flex w-full">
        <button id="completed" class="bg-gradient-to-r  from-indigo-700 to-purple-900 block mr-4 px-6 py-1 w-full rounded-3xl text-gray-300 text-xl mb-16 hover:text-black font-bold duration-500">Completed (5)</button>
        <button id="todo" class="bg-gradient-to-r  from-indigo-700 to-purple-900 block mx-4 px-6 py-1 w-full rounded-3xl text-gray-300 text-xl mb-16 hover:text-black font-bold duration-500">To do (4)</button>
        <button id="overdue" class="bg-gradient-to-r  from-indigo-700 to-purple-900 block ml-4 px-6 py-1 w-full rounded-3xl text-gray-300 text-xl mb-16 hover:text-black font-bold duration-500">Overdue (1)</button>
        </div>
        <div class="flex justify-between mb-5">
        <button id="prevBtn" class="py-2 px-4 bg-purple-900 text-gray-300 rounded-lg">Previous</button>
        <h2 id="monthYear" class="text-xl text-gray-300 font-bold"></h2>
        <button id="nextBtn" class="py-2 px-4 bg-purple-900 text-gray-300 rounded-lg">Next</button>
        </div>
        <table id="calendar" class="border-collapse w-full">
        <thead>
            <tr>
            <th class="py-2 px-4 text-gray-300 border">Sun</th>
            <th class="py-2 px-4 text-gray-300 border">Mon</th>
            <th class="py-2 px-4 text-gray-300 border">Tue</th>
            <th class="py-2 px-4 text-gray-300 border">Wed</th>
            <th class="py-2 px-4 text-gray-300 border">Thu</th>
            <th class="py-2 px-4 text-gray-300 border">Fri</th>
            <th class="py-2 px-4 text-gray-300 border">Sat</th>
            </tr>
        </thead>
        <tbody id="calendarBody"></tbody>
        </table>
        </div>
        <!-- <div id="task-container" class="flex"> -->
        <div class="transition-all duration-500 ease-in-out w-7/12 px-4">
            <!-- TASK LIST -->
            <div id="TaskList" class="w-full">
                <div class="bg-gradient-to-r  from-indigo-700 to-purple-900 rounded-3xl container text-3xl font-bold text-gray-300 px-12 py-1 mt-16 w-64 text-center">Task List</div>
                <div class="flex">
                    <button id="To-do" class="bg-gradient-to-r  from-indigo-700 to-purple-900 block mt-8 mr-12 px-6 py-1 w-64 rounded-3xl text-gray-300 text-xl mb-16 hover:text-black font-bold duration-500">To do (_)</button>
                    <button id="Completed" class="bg-gradient-to-r  from-indigo-700 to-purple-900 block mt-8 mr-10 px-6 py-1 w-64 rounded-3xl text-gray-300 text-xl mb-16 hover:text-black font-bold duration-500">Completed (_)</button>
                    <button id="Overdue" class="bg-gradient-to-r  from-indigo-700 to-purple-900 block mt-8 ml-2 px-6 py-1 w-64 rounded-3xl text-gray-300 text-xl mb-16 hover:text-black font-bold duration-500">Overdue (_)</button>
                </div>
                <div id="list" class="text-center justify-center">
                </div>
            </div>
        </div>
        <!-- Modal Trigger Button -->
        <button id="modalTriggerBtn" class="fixed right-4 bottom-4 bg-violet-600 hover:bg-purple-700 text-white text-center font-bold text-5xl pt-1 pb-3 px-4 rounded-full z-10">+</button>

        <div id="guide" class="flex">
            <div class="text-3xl absolute right-0 pt-96 w-5/12 font-mono overflow-hidden text-gray-400 z-0"><------</div>
            <div id="guide2" class="text-3xl absolute right-0 flex-wrap pt-80 w-4/12 font-mono overflow-hidden text-gray-400 pr-10 z-0"></div>
        </div>
            <!-- MODAL WINDOW ADD TASK -->

            <!-- Modal Overlay (hidden by default) -->
            <div id="modalOverlay" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden">
            <!-- Modal Container -->
                <div class="bg-indigo-400 mx-auto mt-24 w-96 p-4 rounded-lg shadow-lg">
                    <!-- Close Button -->
                    <button id="modalCloseBtn" class="pl-80 text-slate-800 hover:text-black">
                    <i class="fa fa-close text-2xl"></i>
                    </button>

                    <!-- Modal Content -->
                    <div class="mb-4">
                    <label class="block text-black text-sm font-bold mb-2" for="task_description">Task Description:</label>
                    <input type="text" id="task_description" class="w-full px-3 py-2 border-2 border-black rounded" placeholder="Enter task description">
                    </div>

                    <div class="mb-4">
                    <label class="block text-black text-sm font-bold mb-2" for="task_eta">Task ETA:</label>
                    <input type="text" id="task_eta" class="w-full px-3 py-2 border-2 border-black rounded" placeholder="Enter task ETA">
                    </div>

                    <!-- Modal Actions (e.g., Save Button) -->
                    <div class="flex justify-end">
                    <button id="save" class="bg-violet-700 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        Save
                    </button>
                    </div>
                </div>
            </div>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script type="text/javascript" src="{{ URL::asset('js/logged.js') }}"></script>
    </body>
</html>

