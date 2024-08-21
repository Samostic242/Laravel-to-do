<?php
namespace App\Interfaces;

interface TasksInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function createTask(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function getTask(int $id);

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function updateTask(array $data, int $id);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteTask(int $id);

    /**
     * @return mixed
     */
    public function getAllTasks();

    public function markAsCompleted(int $id);
}
