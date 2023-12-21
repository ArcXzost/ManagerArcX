# ManagerArcX: A task manager web application
## Description: 
A calendar-integrated task manager web application. Upon logging in or signing up, users are greeted
with a personalized dashboard that seamlessly integrates a user profile and an interactive calendar.

- **User Authentication:** Secure login and sign-up functionality for personalized user accounts.
  
- **Dashboard:** A centralized hub showcasing user information and a dynamic calendar for intuitive task management.

- **Calendar Integration:** Users can easily select a date from the calendar to view their scheduled tasks for the day.

- **Task Organization:** Tasks are categorized into sections, including upcoming tasks, completed tasks, and overdue tasks.

- **Task Operations:** Users have the flexibility to add, update, delete, and mark tasks as done, providing full control over their task list.

## Impact: 

- Optimized task management for users by implementing an intuitive interface, leading to heightened productivity and improved organization. The user-friendly design with the integration of an interactive calendar further
- facilitates seamless task tracking, enabling users to easily locate and manage tasks scheduled on specific dates.
  
## Technology Stack:

- **Frontend:** HTML, Tailwind CSS, JavaScript
- **Backend:** PHP (framework: Laravel), MySQL.


## Steps to run ManagerArcX on your local computer
- Install XAMPP.
- The root folder of the project must be located in C:\xampp\htdocs
- Make sure you are running Apache and mySQl on XAMPP control pannel on appropriate ports.
- To build the database
  > php artisan migrate
- The task table files are included in database\migrations\2023_07_12_173235_create_tasks_table.php
- Run these commands on separate terminals in the root directory of the project(i.e backend here)
  > php artisan serve --port=[port]
  > npm run start
- The default landing page can be accessed using the end point localhost:[port]/tasks
- Hope you like this project :)
