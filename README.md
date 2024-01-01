# ManagerArcX: A task manager web application
## Description: 
A calendar-integrated task manager web application. Upon logging in or signing up, users are greeted
with a personalized dashboard that seamlessly integrates a user profile and an interactive calendar.

- **User Authentication:** Secure login and sign-up functionality for personalized user accounts using OAuth.

  ![Landing Page](https://github.com/ArcXzost/ManagerArcX/assets/96982138/60724828-04a8-4e94-8ca3-828e8b8f3b4b)

- **Dashboard:** A centralized hub showcasing user information and a dynamic calendar for intuitive task management.
  
- **Calendar Integration:** Users can easily select a date from the calendar to view their scheduled tasks for the day.
  
  ![Calendar](https://github.com/ArcXzost/ManagerArcX/assets/96982138/e1c48f6b-9a78-49d9-878b-861bbed739d4)

  
- **Task Organization:** Tasks are categorized into sections, including upcoming tasks, completed tasks, and overdue tasks.
  
  ![Tasks](https://github.com/ArcXzost/ManagerArcX/assets/96982138/6faaef03-e81f-4fa4-93bd-2dab4f5352e6)

  
- **Task Operations:** Users have the flexibility to add, update, delete, and mark tasks as done, providing full control over their task list.
  
  ![Tasks](https://github.com/ArcXzost/ManagerArcX/assets/96982138/48f5a58b-c118-4393-8b08-148de8835143)

  
## Impact: 

- Optimized task management for users by implementing an intuitive interface, leading to heightened productivity and improved organization. The user-friendly design with the integration of an interactive calendar further
- facilitates seamless task tracking, enabling users to easily locate and manage tasks scheduled on specific dates.
  
## Technology Stack:

- **Frontend:** HTML, Tailwind CSS, JavaScript
- **Backend:** PHP (framework: Laravel), Firebase Real-time Database, Firebase SDK


## Steps to run ManagerArcX on your local computer
- Database already set up with firebase real-time database
- Run these commands to install firebase sdk and tools
  >composer require kreait/laravel-firebase --with-all-dependencies

- Run these commands on separate terminals in the root directory of the project(i.e backend here)
  > php artisan serve --port=[port]
  
  > npm run start

- The default landing page can be accessed using the end point localhost:[port]
- Hope you like this project :)
