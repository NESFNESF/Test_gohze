<?php

namespace App\Service;

use App\Models\Day;
use App\Models\Task;
use App\Http\Resources\TaskResource;

class TaskService{
    public static function new_day($input){
        $day = Day::create($input);
        return $day;
    }
    public static function new_task($input){
        $task = Task::create($input);
    }
    public static function all_task(){
        $tasks = TaskResource::collection( Task::latest()->get());
        return $tasks;
    }
    public static function update_task($input){
        $task = Task::findOrfail($input);
        $task->statut = true;
        $task->save();
    }
    public static function update_day($input){
        $day = Day::findOrfail($input);
        $day->statut = true;
        $day->save();
        return $day;
    }
}
