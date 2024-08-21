<?php

namespace App\Repositories;
use App\Interfaces\TasksInterface;
use App\Models\Task;

class TaskRepository implements TasksInterface
{
    // TODO: Implement createTasks() method.
    public function createTask(array $data): Task
    {
        $tasks = new Task();
        $tasks->id = auth()->id();
        $tasks->title = $data['title'] ?? null;
        $tasks->description = $data['description'] ?? null;
        $tasks->priority = $data['priority'] ?? null;
        $tasks->status = $data['status'] ?? null;
        $tasks->save();
        return $tasks;
    }
      // TODO: Implement getTask() method.
    public function getTask(int $id): Task
    {
        $tasks = Task::find($id);
        return $tasks;
    }

    // TODO: Implement updateTasks() method.
    public function updateTask(array $data, int $id): Task
    {
        $tasks = $this->getTask($id);
        $tasks->title = $data['title'] ?? null;
        $tasks->description = $data['description'] ?? null;
        $tasks->priority = $data['priority'] ?? null;
        $tasks->status = $data['status'] ?? null;
        $tasks->save();
        return $tasks;
    }



    // TODO: Implement getAllTasks() method.
    public function getAllTasks(): Task
    {
        $tasks = auth()->user()->tasks;
        return $tasks;
    }

    // TODO: Implement deleteTasks() method.
    public function deleteTask(int $id): Bool
    {
        $task = $this->getTask($id);
        $task->delete();
        return true;
    }

    // TODO: Implement MarkTaskAsCompleted() method.
    public function markAsCompleted(int $id): Task
    {
        $task = $this->getTask($id);
        $task->completed = true;
        $task->status = 'completed';
        $task->save();
        return $task;
    }
}
