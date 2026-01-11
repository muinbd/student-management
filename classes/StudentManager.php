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
}