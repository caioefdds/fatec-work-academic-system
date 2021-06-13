<?php

require 'Connection.php';

class Controller extends Connection
{
    public function getCourses($id = null)
    {
        if (!empty($id)) {
            $sql = "SELECT * FROM course WHERE id = $id";
        } else {
            $sql = 'SELECT * FROM course';
        }
        $query = $this->query($sql);
        $result = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }

        return $result;
    }

    public function getTitration($id = null)
    {
        if (!empty($id)) {
            $sql = "SELECT * FROM subject WHERE id = $id";
        } else {
            $sql = 'SELECT * FROM subject';
        }
        $query = $this->query($sql);
        $result = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }

        return $result;
    }

    public function getClasses($id = null)
    {
        if (!empty($id)) {
            $sql = "SELECT * FROM class WHERE id = $id";
        } else {
            $sql = 'SELECT * FROM class';
        }
        $query = $this->query($sql);
        $result = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }

        return $result;
    }

    public function getProfessor($id = null)
    {
        if (!empty($id)) {
            $sql = "SELECT * FROM professor WHERE id = $id";
        } else {
            $sql = 'SELECT * FROM professor';
        }
        $query = $this->query($sql);
        $result = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }

        return $result;
    }

    public function getStudent($id = null)
    {
        if (!empty($id)) {
            $sql = "SELECT * FROM student WHERE id = $id";
        } else {
            $sql = 'SELECT * FROM student';
        }
        $query = $this->query($sql);
        $result = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }

        return $result;
    }

    public function createRegister()
    {
        $name = !empty($_POST['name']) ? $_POST['name'] : '';
        $description = !empty($_POST['description']) ? $_POST['description'] : '';
        $period = !empty($_POST['period']) ? $_POST['period'] : '';
        $titration = !empty($_POST['titration']) ? $_POST['titration'] : '';
        $workload = !empty($_POST['workload']) ? $_POST['workload'] : '';
        $course_id = !empty($_POST['course_id']) ? $_POST['course_id'] : '';
        $class_id = !empty($_POST['class_id']) ? $_POST['class_id'] : '';
        $type = (int)$_POST['type'];

        if (empty($type) || $type == 0) {
            return [
                'status' => 400,
                'msg' => "Selecione um tipo, antes de continuar"
            ];
        }



        switch ($type) {
            case 1: {
                $this->createCourse($name, $period, $description);
                break;
            }
            case 2: {
                $this->createSubject($name, $workload, $course_id);
                break;
            }
            case 3: {
                $this->createProfessor($name, $titration);
                break;
            }
            case 4: {
                $this->createClass($description, $course_id);
                break;
            }
            case 5: {
                $this->createStudent($name, $class_id);
                break;
            }
        }

        $_POST = null;
    }

    protected function createCourse($name, $period, $description)
    {
        $sql = "INSERT INTO course
                (name, period, description) VALUES
                (\"$name\", \"$period\", \"$description\")
        ;";

        return $this->conn->query($sql);
    }

    protected function createSubject($name, $workload, $course_id)
    {
        $sql = "INSERT INTO subject
                (name, workload, course_id) VALUES
                (\"$name\", \"$workload\", \"$course_id\")
        ;";

        return $this->conn->query($sql);
    }

    protected function createProfessor($name, $titration)
    {
        $sql = "INSERT INTO professor
                (name, titration) VALUES
                (\"$name\", \"$titration\")
        ;";

        return $this->conn->query($sql);
    }

    protected function createClass($description, $course_id)
    {
        $sql = "INSERT INTO class
                (description, course_id) VALUES
                (\"$description\", \"$course_id\")
        ;";

        return $this->conn->query($sql);
    }

    protected function createStudent($name, $class_id)
    {
        $sql = "INSERT INTO student
                (name, class_id) VALUES
                (\"$name\", \"$class_id\")
        ;";

        return $this->conn->query($sql);
    }

    public function getReports($type)
    {
        $columns = $this->getColumnName();

        if ($type == 1) {
            return [
                "title" => "Lista de cursos",
                "columns" => $columns,
                "data" => $this->reportCourse()
            ];
        } elseif ($type == 2) {
            return [
                "title" => "Lista de professores",
                "columns" => $columns,
                "data" => $this->reportProfessor()
            ];
        } elseif ($type == 3) {
            return [
                "title" => "Lista de disciplinas, por curso",
                "columns" => $columns,
                "data" => $this->reportSubject()
            ];
        } elseif ($type == 4) {
            return [
                "title" => "Lista de turmas, por curso",
                "columns" => $columns,
                "data" => $this->reportClass()
            ];
        } elseif ($type == 5) {
            return [
                "title" => "Lista de alunos, por turma",
                "columns" => $columns,
                "data" => $this->reportStudent()
            ];
        }
    }

    public function reportCourse()
    {
        $sql = "SELECT * FROM course;";
        $query = $this->query($sql);
        $num_rows = mysqli_num_rows($query);

        $mysql_result = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $mysql_result[] = $row;
        }

        $result = [];
        foreach ($mysql_result AS $key => $value) {
            $result[0]['title'] = null;
            $result[0]['items'][$key]['id'] = $value['id'];
            $result[0]['items'][$key]['name'] = $value['name'];
            $result[0]['items'][$key]['description'] = $value['description'];
            $result[0]['items'][$key]['period'] = $value['period'];
            $result[0]['columns'] = array_keys($result[0]['items'][$key]);
        }

        return $result;
    }

    public function reportProfessor()
    {
        $sql = "SELECT p.id, p.name, s.name as titration FROM professor as p LEFT JOIN subject as s ON s.id = p.titration;";
        $query = $this->query($sql);
        $num_rows = mysqli_num_rows($query);

        $mysql_result = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $mysql_result[] = $row;
        }

        $result = [];
        foreach ($mysql_result AS $key => $value) {
            $result[0]['title'] = null;
            $result[0]['items'][$key]['id'] = $value['id'];
            $result[0]['items'][$key]['name'] = $value['name'];
            $result[0]['items'][$key]['titration'] = $value['titration'];
            $result[0]['columns'] = array_keys($result[0]['items'][$key]);
        }

        return $result;
    }

    public function reportSubject()
    {
        $sql = "SELECT sub.id, sub.name, sub.workload, course.name as course_name, sub.course_id FROM subject AS sub LEFT JOIN course ON course.id = sub.course_id;";
        $query = $this->query($sql);
        $num_rows = mysqli_num_rows($query);

        $mysql_result = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $mysql_result[] = $row;
        }

        $result = [];
        foreach ($mysql_result AS $key => $value) {
            $result[$value['course_id']]['title'] = $value['course_name'];
            $result[$value['course_id']]['items'][$key]['id'] = $value['id'];
            $result[$value['course_id']]['items'][$key]['name'] = $value['name'];
            $result[$value['course_id']]['items'][$key]['workload'] = $value['workload'];
            $result[$value['course_id']]['columns'] = array_keys($result[$value['course_id']]['items'][$key]);
        }

        return $result;
    }

    public function reportClass()
    {
        $sql = "SELECT c.id, c.description, co.name as course_name, co.id as course_id FROM class as c LEFT JOIN course as co ON c.course_id = co.id;";
        $query = $this->query($sql);
        $num_rows = mysqli_num_rows($query);

        $mysql_result = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $mysql_result[] = $row;
        }

        $result = [];
        foreach ($mysql_result AS $key => $value) {
            $result[$value['course_id']]['title'] = $value['course_name'];
            $result[$value['course_id']]['items'][$key]['id'] = $value['id'];
            $result[$value['course_id']]['items'][$key]['description'] = $value['description'];
            $result[$value['course_id']]['columns'] = array_keys($result[$value['course_id']]['items'][$key]);
        }

        return $result;
    }

    public function reportStudent()
    {
        $sql = "SELECT st.id, st.name, class.id as class_id, class.description as class_name FROM student as st LEFT JOIN class ON class.id = st.class_id;";
        $query = $this->query($sql);
        $num_rows = mysqli_num_rows($query);

        $mysql_result = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $mysql_result[] = $row;
        }

        $result = [];
        foreach ($mysql_result AS $key => $value) {
            $result[$value['class_id']]['title'] = $value['class_name'];
            $result[$value['class_id']]['items'][$key]['id'] = $value['id'];
            $result[$value['class_id']]['items'][$key]['description'] = $value['name'];
            $result[$value['class_id']]['columns'] = array_keys($result[$value['class_id']]['items'][$key]);
        }

        return $result;
    }

    public function deleteCourse($course_id)
    {
        $sql = "DELETE st FROM student as st
                INNER JOIN class ON class.id = st.class_id
                WHERE class.course_id = $course_id";
        $query = $this->query($sql);

        $sql = "DELETE FROM class
                WHERE course_id = $course_id";
        $query = $this->query($sql);

        $sql = "DELETE pf FROM professor as pf
                LEFT JOIN subject ON subject.id = pf.titration
                WHERE subject.course_id = $course_id";
        $query = $this->query($sql);

        $sql = "DELETE FROM subject
                WHERE course_id = $course_id";
        $query = $this->query($sql);

        $sql = "DELETE FROM course
                WHERE id = $course_id";
        $query = $this->query($sql);

        return [
            "msg" => "Registro deletado com sucesso.",
            "status" => 200
        ];
    }

    public function deleteSubject($id)
    {
        $sql = "DELETE FROM professor
                WHERE titration = $id";
        $query = $this->query($sql);

        $sql = "DELETE FROM subject
                WHERE id = $id";
        $query = $this->query($sql);

        return [
            "msg" => "Registro deletado com sucesso.",
            "status" => 200
        ];
    }

    public function deleteClass($id)
    {
        $sql = "DELETE FROM student
                WHERE class_id = $id";
        $query = $this->query($sql);

        $sql = "DELETE FROM class
                WHERE id = $id";
        $query = $this->query($sql);

        return [
            "msg" => "Registro deletado com sucesso.",
            "status" => 200
        ];
    }

    public function deleteStudent($id)
    {
        $sql = "DELETE FROM student
                WHERE id = $id";
        $query = $this->query($sql);

        return [
            "msg" => "Registro deletado com sucesso.",
            "status" => 200
        ];
    }

    public function deleteProfessor($id)
    {
        $sql = "DELETE FROM professor
                WHERE id = $id";
        $query = $this->query($sql);

        return [
            "msg" => "Registro deletado com sucesso.",
            "status" => 200
        ];
    }

    public function updateCourse($id, $data)
    {
        $sql = "UPDATE course SET
            name = '{$data['name']}',
            period = '{$data['period']}',
            description = '{$data['description']}'
        WHERE id = $id
        ;";
        $query = $this->query($sql);

        return [
            "msg" => "Registro atualizado com sucesso.",
            "status" => 200
        ];
    }

    public function updateSubject($id, $data)
    {
        $sql = "UPDATE subject SET
            name = '{$data['name']}',
            workload = {$data['workload']},
            course_id = {$data['course_id']}
        WHERE id = $id
        ;";
        $query = $this->query($sql);

        return [
            "msg" => "Registro atualizado com sucesso.",
            "status" => 200
        ];
    }

    public function updateProfessor($id, $data)
    {
        $sql = "UPDATE professor SET
            name = '{$data['name']}',
            titration = {$data['titration']}
        WHERE id = $id
        ;";
        $query = $this->query($sql);

        return [
            "msg" => "Registro atualizado com sucesso.",
            "status" => 200
        ];
    }

    public function updateClass($id, $data)
    {
        $sql = "UPDATE class SET
            description = '{$data['description']}',
            course_id = {$data['course_id']}
        WHERE id = $id
        ;";
        $query = $this->query($sql);

        return [
            "msg" => "Registro atualizado com sucesso.",
            "status" => 200
        ];
    }

    public function updateStudent($id, $data)
    {
        $sql = "UPDATE student SET
            name = '{$data['name']}',
            class_id = {$data['class_id']}
        WHERE id = $id
        ;";
        $query = $this->query($sql);

        return [
            "msg" => "Registro atualizado com sucesso.",
            "status" => 200
        ];
    }

    public function getColumnName()
    {
        return [
            'id' => "#",
            'name' => "Nome",
            'period' => "Período",
            'description' => "Descrição",
            'course_id' => "Id do curso",
            'course_name' => "Nome do curso",
            'class_name' => "Nome da turma",
            'class_id' => "Id da classe",
            'workload' => "Carga Horária (em horas)",
            'titration' => "Titulação",
        ];
    }
}