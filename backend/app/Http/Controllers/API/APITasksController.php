<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\TaskManager;
use Illuminate\Http\Request;
use Mail;
use App\Mail\MailTask;
use Laravel\Socialite\Facades\Socialite;
use Kreait\Firebase\Contract\Database;

class APITasksController extends Controller
{
    // public function create(Request $request){
    //     // dd($request->all());
    //     $data = new TaskManager();
    //     $data->task_description = $request->get('task_description');
    //     $data->task_owner = $request->get('task_owner');
    //     $data->task_owner_email = $request->get('task_owner_email');
    //     $data->task_eta = $request->get('task_eta');
    //     // $data->password = $request->get('password');
    //     if($data->save()){
    //         // dispatch(new SendEmailJob($data));
    //         return "Data saved succesfully";
    //     }
    //     else
    //         return "Error saving the data";

    // }

    // public function connect()
    // {
    //     $firebase = (new Factory)
    //         ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
    //         ->withDatabaseUrl(env('FIREBASE_DATABASE_URL'));

    //     return $firebase->createDatabase();
    // }
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->table = 'TaskList';
    }

    public function create(Request $request){
        $database = $this->database;
        $newPost = $database
            ->getReference($this->table)
            ->push([
                'task_description' => $request->get('task_description'),
                'task_owner' => $request->get('task_owner'),
                'task_owner_email' => $request->get('task_owner_email'),
                'task_eta' => $request->get('task_eta'),
                'status' => 0,
            ]);

        if($newPost)
            return "Data saved succesfully";
        else
            return "Error saving the data";
    }

    public function index(){
        $data = $this->database->getReference($this->table)->getValue();
        return $data;
    }

    public function getTodos($email, $date) {
        $taskListRef = $this->database->getReference($this->table);
    
        // Query data based on task_owner_email
        $emailQuery = $taskListRef->orderByChild('task_owner_email')->equalTo($email)->getSnapshot();
    
        // Filter results based on status and task_eta
        $filteredData = [];
    
        foreach ($emailQuery->getValue() as $key => $value) {
            if ($value['status'] === 0 && $value['task_eta'] === $date) {
                $filteredData[$key] = $value;
            }
        }
    
        return $filteredData;
    }
    

    public function getCompletedTasks($email) {
        $taskListRef = $this->database->getReference($this->table);
    
        // Query data based on status
        $statusQuery = $taskListRef->orderByChild('status')->equalTo(1)->getSnapshot();
    
        // Filter results based on task_owner_email
        $filteredData = [];
    
        foreach ($statusQuery->getValue() as $key => $value) {
            if ($value['task_owner_email'] === $email) {
                $filteredData[$key] = $value;
            }
        }
    
        return $filteredData;
    }
    

    public function getOverdueTasks($email)
{
    $date = date("d-m-Y");
    $taskListRef = $this->database->getReference($this->table);
    $dateQuery = $taskListRef->orderByChild('status')->equalTo(0)->getSnapshot();
    $dateData = $dateQuery->getValue();

    $filteredData = [];

    foreach ($dateData as $key => $value) {
        $taskEtaTimestamp = strtotime($value['task_eta']);
        $currentDateTimestamp = strtotime($date);

        if ($taskEtaTimestamp < $currentDateTimestamp && $value['task_owner_email'] === $email) {
            $filteredData[$key] = $value;
        }
    }

    return $filteredData;
}



public function getTaskByID($id){
    $data = $this->database->getReference($this->table. '/' .$id)
                          ->getSnapshot()
                          ->getValue();

    return $data;
}


    public function getTaskByUser($email){
        // $data = TaskManager::where('task_owner_email',$email)->get();
        $data = $this->database->getReference($this->table)->orderByChild('task_owner_email')->equalTo($email)->getValue();
        return $data;
    }

    public function getTaskByUserAndDate($email,$date){
        // $data = TaskManager::where('task_owner_email',$email)->where('task_eta',$date)->get();
        // return $data;
        $taskListRef = $this->database->getReference($this->table);

        $statusQuery = $taskListRef->orderByChild('task_eta')->equalTo($date)->getSnapshot();

        // Filter data based on task_owner_email
        $emailQuery = $taskListRef->orderByChild('task_owner_email')->equalTo($email)->getSnapshot();

        // Merge the results
        $mergedData = [];

        // Merge status query results
        foreach ($statusQuery->getValue() as $key => $value) {
            $mergedData[$key] = $value;
        }

        // Merge email query results
        foreach ($emailQuery->getValue() as $key => $value) {
            $mergedData[$key] = $value;
        }

        return $mergedData;
    }
    
    public function updateTaskByID(Request $request,$id){
        $data = $this->database->getReference($this->table)->getChild($id)
                                ->update([
                                    'task_description' => $request->get('task_description'),
                                    'task_eta' => $request->get('task_eta'),
                                ]);
        if($data)
            return "Data updated succesfully";
        else
            return "Error saving the data";

    }

    public function mailUser(){
        $data = TaskManager::orderBy('id','DESC')->first();
        Mail::to($data->task_owner_email)->queue(new MailTask($data));
    }

    public function markAsDone($id){
        $data = $this->database->getReference($this->table)->getChild($id)
                                ->update(['status' => 1]);
        if($data)
            return "marked as done succesfully";
        else
            return "Error saving the data";

    }

    public function delete($id){
        $data = $this->database->getReference($this->table)->getChild($id)->remove();
    }

    // public function redirectToGoogle()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // public function handleGoogleCallback()
    // {
    //     $user = Socialite::driver('google')->user();

    //     // Check if the user is from the @iiitg.ac.in domain
    //     if (str_ends_with($user->email, '@iiitg.ac.in')) {
    //         // Authenticate the user or perform any other necessary actions
    //         auth()->login($user, true);

    //         return view('task.logged')->with('user', $user);
    //     }

    //     // Redirect or display an error message for unauthorized users
    //     return redirect()->route('login')->with('error', 'Authentication failed. Only @iiitg.ac.in users are allowed.');
    // }
}
