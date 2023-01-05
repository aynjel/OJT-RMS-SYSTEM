<?php

require_once('Database.class.php');

class Task extends Database{
    
        public function getTasks() {
            $sql = "SELECT * FROM tbl_task";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
    
        public function getTask($id) {
            $sql = "SELECT * FROM tbl_task WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        }
    
        public function getTaskByStudents($student_id) {
            $sql = "SELECT * FROM tbl_task WHERE student_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$student_id]);
            $result = $stmt->fetchAll();
            return $result;
        }
    
        public function getTaskByStudent($student_id) {
            $sql = "SELECT * FROM tbl_task WHERE student_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$student_id]);
            $result = $stmt->fetch();
            return $result;
        }
    
        public function getTaskByCourse($course_id) {
            $sql = "SELECT * FROM tbl_task WHERE course_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$course_id]);
            $result = $stmt->fetchAll();
            return $result;
        }
    
        public function getTaskByOrganization($organization_id) {
            $sql = "SELECT * FROM tbl_task WHERE organization_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$organization_id]);
            $result = $stmt->fetchAll();
            return $result;
        }
    
        public function createTask($task_name, $task_description, $task_deadline, $user_id, $organization_id) {
            $get_coordinator = new Coordinator();
            if($user_id == $get_coordinator->getCoordinatorByOrganization($organization_id)['coordinator_id']) {
                $sql = "INSERT INTO tbl_task (task_name, task_description, task_deadline, user_id, task_status, organization_id) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$task_name, $task_description, $task_deadline, $user_id, 'Pending', $organization_id]);
            } else {
                $sql = "INSERT INTO tbl_task (task_name, task_description, task_deadline, user_id, task_status, organization_id) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$task_name, $task_description, $task_deadline, $user_id, 'Approved', $organization_id]);
            }
            
            $_SESSION['success'] = 'Task created successfully';
            header('Location: tasks.php');
        }

        public function updateTask($task_name, $task_description, $task_deadline, $task_status, $task_id) {
            $sql = "UPDATE tbl_task SET task_name = ?, task_description = ?, task_deadline = ?, task_status = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$task_name, $task_description, $task_deadline, $task_status, $task_id]);
            $_SESSION['success'] = 'Task updated successfully';
            header('Location: tasks.php');
        }

        public function deleteTask($task_id) {
            $sql = "DELETE FROM tbl_task WHERE task_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$task_id]);
            $_SESSION['success'] = 'Task deleted successfully';
            header('Location: tasks.php');
        }
}