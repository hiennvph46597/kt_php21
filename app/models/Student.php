<?php
namespace App\Models;

class Student extends BaseModel
{
    public function danhsachhocsinh() {
        $sql = "SELECT * FROM sinh_vien";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function themsinhvien($id, $name, $year, $phone) {
        $sql = "INSERT INTO sinh_vien VALUES (?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$id, $name, $year, $phone]);
    }

    public function idsinhvien($id) {
        $sql = "SELECT * FROM sinh_vien WHERE id=?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function updatetStudent($id, $name, $year, $phone) {
        $sql = "UPDATE sinh_vien SET name=?, year_of_birth=?, phone_number=? WHERE id=?";
        $this->setQuery($sql);
        return $this->execute([$name, $year, $phone, $id]);
    }

    public function deleteStudent($id) {
        $sql = "DELETE FROM sinh_vien WHERE id=?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
}
