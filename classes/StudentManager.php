<?php

class StudentManager {
    private $file = 'students.json';

    private function readJson() {
        if(!file_exists($this->file)) {
            return [];
        }

        return json_decode(file_get_contents($this->file), true);
    }

   private function writeJson($data)
{
    // ensure numeric array (prevents object-style JSON)
    $data = array_values($data);

    file_put_contents(
        $this->file,
        json_encode($data, JSON_PRETTY_PRINT)
    );
}


    public function getAllStudents() {
        return $this->readJson();
    }
    public function getStudentById($id) {
        foreach($this->getAllStudents() as $student) {
            if ($student['id'] == $id) {
                return $student;
            }
        }
        return null;
    }

    public function create($data) {
        $students = $this->readJson();
        foreach ($students as $student) {
            if($student['id'] == $data['id']) {
                return false;
            }
        }
        $students[] = $data;
        $this->writeJson($students);
        return true;
    }

   public function update($id, $data)
{
    $students = $this->readJson();

    foreach ($students as $index => $student) {

        if (!is_array($student) || !isset($student['id'])) {
            continue;
        }

        if ($student['id'] == $id) {

            $students[$index]['name']   = $data['name'];
            $students[$index]['email']  = $data['email'];
            $students[$index]['phone']  = $data['phone'];
            $students[$index]['status'] = $data['status'];

            break;
        }
    }

    $this->writeJson($students);
}


   public function delete($id)
{
    $students = array_filter(
        $this->readJson(),
        function ($student) use ($id) {

            // safety check (prevents fatal error)
            if (!is_array($student) || !isset($student['id'])) {
                return false;
            }

            return $student['id'] != $id;
        }
    );

    $this->writeJson(array_values($students));
}


}