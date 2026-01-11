<?php

class StudentManager {
    private $file = 'students.json';

    private function readJson() {
        if(!file_exists($this->file)) {
            return [];
        }

        return json_decode(file_get_contents($this->file), true);
    }

    private function writeJson($data) {
        file_put_contents($this->file, json_encode($data));
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

    public function update($id, $data) {
        $students = $this->readJson();
        foreach ($students as $student) {
            if($student['id'] == $id) {
                $students = array_merge($students, $data);
                break;
            }
        }
        $this->writeJson($students);
    }

    public function delete($id) {
        $students = array_filter($this->readJson(), fn($student) => $student['id'] != $id);
        $this->writeJson(array_values($students));
    }
}