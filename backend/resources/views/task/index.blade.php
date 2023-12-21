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
   <body class="bg-slate-900">
      <header class="flex pt-4 h-20">
         <span onclick="openNav()" class="cursor-pointer"><i class="text-4xl pl-2 text-violet-400 fas fa-bars"></i></span>
         <div id="mySidenav" class="fixed h-screen w-0 bg-black left-0 top-0 z-10 overflow-x-hidden transition-all duration-500 ease-in-out sidenav">
            <button class="absolute text-gray-700 text-4xl block pb-6 pt-2 right-2 no-underline transition duration-300 hover:text-violet-400 closebtn" onclick="closeNav()">&times;</button>
            <a id="dashboard" href="#cta" class="text-slate-500 text-2xl block px-8 pt-20 no-underline transition duration-300 hover:text-violet-400">Dashboard</a>
            <a id ="profile" href="#cta" class="text-slate-500 text-2xl block px-8 pt-8 no-underline transition duration-300 hover:text-violet-400">Profile</a>
            <a id="team" href="#cta" class="text-slate-500 text-2xl block px-8 pt-8 no-underline transition duration-300 hover:text-violet-400">Team</a>
            <a id="projects" href="#cta" class="text-slate-500 text-2xl block px-8 pt-8 no-underline transition duration-300 hover:text-violet-400">Projects</a>
         </div>
         <h1 class="font-mono text-4xl text-violet-400 text-center justify-center grow">ManagerArcX</h1>
         <a id="signUp" onclick="googleauth()" class="text-violet-400 text-2xl text-center justify-center transition duration-300 hover:text-white">Sign up</a>
         <a id="logIn" onclick="googleauth()" class="text-violet-400 text-2xl  text-center justify-center pl-6 pr-6 transition duration-300 hover:text-white">Login</a>
      </header>
    
      <section class="flex">
         <div class="bg-gradient-to-b from-purple-900 via-violet-900 to-slate-900 h-96 grow">
           <div class="md:flex md:items-center md:justify-between">
             <div class="md:w-1/2 pl-6">
               <h2 class="text-4xl pt-24 font-bold text-black mb-2">Manage Your Tasks Efficiently</h2>
               <p class="text-black font-bold mb-6">Stay organized, track progress, and get things done with our powerful task manager app.</p>
               <a href="#cta" class="bg-slate-900 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-600">Get Started</a>
             </div>
           </div>
         </div>
       </section>
     
       <!-- Features Section -->
       <section class="bg-slate-900 py-20">
         <div class="container mx-auto px-6">
           <h2 class="text-3xl font-bold text-violet-400 text-center mb-8">Key Features</h2>
           <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
             <div class="bg-gradient-to-r from-indigo-400 to-violet-700 shadow-md rounded-lg px-6 py-8">
               <h3 class="text-xl font-bold text-black mb-3">Task Management</h3>
               <p class=" text-black">Create, organize, and manage tasks effectively. Set due dates, priorities, and assign tasks to team members.</p>
             </div>
             <div class="bg-gradient-to-r from-indigo-400 to-violet-700 shadow-md rounded-lg px-6 py-8">
               <h3 class="text-xl font-bold text-black mb-3">Collaboration</h3>
               <p class="text-black">Collaborate with your team members in real-time. Comment, share files, and track progress together.</p>
             </div>
             <div class="bg-gradient-to-r from-indigo-400 to-violet-700 shadow-md rounded-lg px-6 py-8">
               <h3 class="text-xl font-bold text-black mb-3">Reports and Analytics</h3>
               <p class="text-black">Gain insights into your productivity with detailed reports and analytics. Monitor task completion and team performance.</p>
             </div>
           </div>
         </div>
       </section>
     
       <!-- CTA Section -->
       <section id="cta" class="flex justify-between bg-gradient-to-b from-slate-900 to-violet-900 py-16">
         <div class="container text-center px-6">
           <h2 class="text-3xl font-bold text-center text-white mb-8 ml-auto">Start Managing Your Tasks Today</h2>
           <p class="text-white text-center mb-8 ml-auto">Sign up now and experience the power of our task manager app.</p>
           <a id="signup" class="bg-white text-violet-500 font-semibold py-3 px-6 rounded hover:bg-indigo-600 hover:text-white">Sign Up</a>
         </div>

         <!-- LOGIN PAGE -->
        <div id="login" class="items-center justify-center h-auto hidden mr-40 transition-all duration-500">
            <div class="bg-indigo-300 p-8 shadow-violet-800 shadow-lg rounded w-96">
                <h2 class="text-2xl font-semibold mb-6">Login/Sign up</h2>
                <div class="mb-4">
                    <label for="username" class="block font-semibold">Username:</label>
                    <input type="text" id="username" class="w-full border-black border-2 rounded p-2" required>
                    <span class="text-red-500 text-sm" id="username-error"></span>
                </div>
                <div class="mb-4">
                    <label for="email" class="block font-semibold">Email ID:</label>
                    <input type="email" id="email" class="w-full border-black border-2 rounded p-2" required>
                    <span class="text-red-500 text-sm" id="email-error"></span>
                </div>
                <div class="mb-4">
                    <label for="password" class="block font-semibold">Password:</label>
                    <input type="password" id="password" class="w-full border-black border-2 rounded p-2" required>
                    <span class="text-red-500 text-sm" id="password-error"></span>
                </div>
                <button onclick="validateForm()" class="bg-purple-800 text-white px-4 py-2 rounded">Submit</button>
            </div>
        </div>

       </section>
     
       <!-- Footer -->
       <footer class="bg-gradient-to-t from-purple-900 to-violet-900  py-8">
         <div class="container mx-auto px-6">
           <div class="md:flex md:items-center md:justify-between">
             <div class="flex justify-center md:order-2">
               <a href="#" class="text-gray-400 hover:text-white ml-4">Privacy Policy</a>
               <a href="#" class="text-gray-400 hover:text-white ml-4">Terms of Service</a>
             </div>
             <div class="mt-8 md:mt-0 md:order-1">
               <p class="text-center text-gray-400">&copy; 2023 Task Manager. All rights reserved.</p>
             </div>
           </div>
         </div>
       </footer>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/index.js') }}"></script>
   </body>
   </html>
