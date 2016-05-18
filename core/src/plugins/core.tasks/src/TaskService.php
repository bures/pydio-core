<?php
/*
 * Copyright 2007-2015 Abstrium <contact (at) pydio.com>
 * This file is part of Pydio.
 *
 * Pydio is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Pydio is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Pydio.  If not, see <http://www.gnu.org/licenses/>.
 *
 * The latest code can be found at <http://pyd.io/>.
 */
namespace Pydio\Tasks;

use Pydio\Access\Core\Model\AJXP_Node;
use Pydio\Access\Core\Model\Repository;
use Pydio\Conf\Core\AbstractAjxpUser;

defined('AJXP_EXEC') or die('Access not allowed');

class TaskService implements ITasksProvider
{
    /**
     * @var ITasksProvider
     */
    private $realProvider;

    /**
     * @var TaskService
     */
    private static $instance;

    public function setProvider(ITasksProvider $provider){
        $this->realProvider = $provider;
    }

    /**
     * @return TaskService
     */
    public static function getInstance(){
        if(!isSet(self::$instance)){
            self::$instance = new TaskService();
        }
        return self::$instance;
    }


    /**
     * @param Task $task
     * @param Schedule $when
     * @return Task
     */
    public function createTask(Task $task, Schedule $when)
    {
        return $this->realProvider->createTask($task, $when);
    }

    /**
     * @param string $taskId
     * @return Task
     */
    public function getTaskById($taskId)
    {
        return $this->realProvider->getTaskById($taskId);
    }

    /**
     * @param Task $task
     * @return Task
     */
    public function updateTask(Task $task)
    {
        return $this->realProvider->updateTask($task);
    }

    /**
     * @param string $taskId
     * @param int $status
     * @return Task
     */
    public function updateTaskStatus($taskId, $status)
    {
        return $this->realProvider->updateTaskStatus($taskId, $status);
    }

    /**
     * @param string $taskId
     * @return bool
     */
    public function deleteTask($taskId)
    {
        return $this->realProvider->deleteTask($taskId);
    }

    /**
     * @return Task[]
     */
    public function getPendingTasks()
    {
        return $this->realProvider->getPendingTasks();
    }

    /**
     * @param AJXP_Node $node
     * @return Task[]
     */
    public function getTasksForNode(AJXP_Node $node)
    {
        return $this->realProvider->getTasksForNode($node);
    }

    /**
     * @param AbstractAjxpUser $user
     * @param Repository $repository
     * @param int $status
     * @return Task[]
     */
    public function getTasks($user = null, $repository = null, $status = -1)
    {
        return $this->realProvider->getTasks($user, $repository, $status);
    }
}