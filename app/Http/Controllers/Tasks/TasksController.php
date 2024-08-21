<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Interfaces\TasksInterface;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    function __construct(
        protected TasksInterface $tasksInterface
    ){}

    public function create(CreateTaskRequest $request)
    {
        $data = $request->validated();
        if(!$tasks = $this->tasksInterface->createTask($data))
        {
            return ErrorResponse(400, 'An error occured');
        }
        return SuccessResponse('Task created successfully', $tasks);
    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        $data = $request->validated();
        if(!$tasks = $this->tasksInterface->updateTask($data, $id))
        {
            return ErrorResponse(400, 'An error occurred while updating task');
        }
        return SuccessResponse('Task updated successfully', $tasks);
    }

    public function delete($id)
    {
        if(!$tasks = $this->tasksInterface->deleteTask($id))
        {
            return ErrorResponse(400, 'An error occurred while deleting task');
        }
        return SuccessResponse('Task deleted successfully');
    }

    public function getTask($id)
    {
        if(!$task = $this->tasksInterface->getTask($id))
        {
            return ErrorResponse(400, 'An error occurred while fetching task');
        }
        return SuccessResponse('Task fetched successfully', $task);
    }

    public function getAllTasks()
    {
        if(!$tasks = $this->tasksInterface->getAllTasks())
        {
            return ErrorResponse(400, 'An error occurred while fetching tasks');
        }
        return SuccessResponse('Tasks fetched successfully', $tasks);
    }

    public function markAsCompleted($id)
    {
        if(!$tasks = $this->tasksInterface->markAsCompleted($id))
        {
            return ErrorResponse(400, 'An error occurred while marking task as completed');
        }
        return SuccessResponse('Task marked as completed successfully', $tasks);
        
    }

}
