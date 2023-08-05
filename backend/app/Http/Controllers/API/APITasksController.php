<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\TaskManager;
use Illuminate\Http\Request;
use Mail;
use App\Mail\MailTask;


class APITasksController extends Controller
{
    public function create(Request $request){
        // dd($request->all());
        $data = new TaskManager();
        $data->task_description = $request->get('task_description');
        $data->task_owner = $request->get('task_owner');
        $data->task_owner_email = $request->get('task_owner_email');
        $data->task_eta = $request->get('task_eta');
        $data->password = $request->get('password');
        if($data->save()){
            // dispatch(new SendEmailJob($data));
            return "Data saved succesfully";
        }
        else
            return "Error saving the data";

    }

    public function index(){
        $data = TaskManager::get();
        return $data;
    }

    public function getTodos($email,$date){
        $data = TaskManager::where('status',0)->where('task_owner_email',$email)->where('task_eta',$date)->get();
        return $data;
    }

    public function getCompletedTasks($email){
        $data = TaskManager::where('status',1)->where('task_owner_email',$email)->get();
        return $data;
    }

    public function getOverdueTasks($email){
        $date = date("d-m-Y");
        $data = TaskManager::where('task_eta', '<', $date)->where('task_owner_email',$email)->where('status',0)->get();
        return $data;
    }

    public function getTaskByID($id){
        $data = TaskManager::find($id);
        return $data;
    }

    public function getTaskByUser($email){
        $data = TaskManager::where('task_owner_email',$email)->get();
        return $data;
    }

    public function getTaskByUserAndDate($email,$date){
        $data = TaskManager::where('task_owner_email',$email)->where('task_eta',$date)->get();
        return $data;
    }
    
    public function updateTaskByID(Request $request,$id){
        $data = TaskManager::find($id);
        $data->task_description = $request->get('task_description');
        // $data->task_owner = $request->get('task_owner');
        // $data->task_owner_email = $request->get('task_owner_email');
        $data->task_eta = $request->get('task_eta');
        // $data->status =  $request->get('status');
        if($data->save())
            return "Data updated succesfully";
        else
            return "Error saving the data";

    }

    public function mailUser(){
        $data = TaskManager::orderBy('id','DESC')->first();
        Mail::to($data->task_owner_email)->queue(new MailTask($data));
    }

    public function markAsDone($id){
        $data = TaskManager::find($id);
        $data->status = 1;
        if($data->save())
            return "marked as done succesfully";
        else
            return "Error saving the data";

    }

    public function delete($id){
        $data = TaskManager::find($id);
        if($data->delete()){
            // dispatch(new SendEmailJob($data));
            return "Data deleted succesfully";
        }
        else
            return "Error deleting the data";
    }
}
