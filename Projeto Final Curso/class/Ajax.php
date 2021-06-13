<?php

require_once "Controller.php";

class Ajax extends Controller
{
    public function edit()
    {
        $data = $_POST['data'];

        if (!empty($data['type']) && !empty($data['id'])) {
            switch ($data['type']) {
                case 1: {
                    return $this->deleteCourse($data['id']);
                }
                case 2: {
                    return $this->deleteProfessor($data['id']);
                }
                case 3: {
                    return $this->deleteSubject($data['id']);
                }
                case 4: {
                    return $this->deleteClass($data['id']);
                }
                case 5: {
                    return $this->deleteStudent($data['id']);
                }
            }
        }
    }

    public function delete()
    {
        $id = $_POST['id'];
        $type = $_POST['type'];

        if (!empty($type) && !empty($id)) {
            switch ($type) {
                case 1: {
                    return $this->deleteCourse($id);
                }
                case 2: {
                    return $this->deleteProfessor($id);
                }
                case 3: {
                    return $this->deleteSubject($id);
                }
                case 4: {
                    return $this->deleteClass($id);
                }
                case 5: {
                    return $this->deleteStudent($id);
                }
            }
        }
    }

    public function getInfo()
    {
        $id = $_POST['id'];
        $type = $_POST['type'];

        if (!empty($type) && !empty($id)) {
            switch ($type) {
                case 1: {
                    return $this->getCourses($id);
                }
                case 2: {
                    return $this->getTitration($id);
                }
                case 3: {
                    return $this->getProfessor($id);
                }
                case 4: {
                    return $this->getClasses($id);
                }
                case 5: {
                    return $this->getStudent($id);
                }
            }
        }
    }

    public function update()
    {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $data = $_POST['data'];

        if (!empty($type) && !empty($id) && !empty($data)) {
            switch ($type) {
                case 1: {
                    return $this->updateCourse($id, $data);
                }
                case 2: {
                    return $this->updateSubject($id, $data);
                }
                case 3: {
                    return $this->updateProfessor($id, $data);
                }
                case 4: {
                    return $this->updateClass($id, $data);
                }
                case 5: {
                    return $this->updateStudent($id, $data);
                }
            }
        }
    }
}

if (!empty($_GET['func'])) {
    $class = new Ajax;
    $func = $_GET['func'];

    echo json_encode($class->$func());
}