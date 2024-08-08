<?php
namespace App\Controllers;
use App\Models\Student;

class StudentController extends BaseController
{
    protected $std;

    public function __construct() {
        $this->std = new Student();
    }

    public function index() {
        $student = $this->std->danhsachhocsinh();
        return $this->render('student.index', compact('student'));
    }

    public function create() {
        return $this->render('student.create');
    }

    public function store() {
        if (isset($_POST["btn-add"])) {
            
            $sualoi = [];

            if (empty($_POST["name"])) {
                $sualoi[] = 'không được để trống';
            }
            if (empty($_POST["year"])) {
                $sualoi[] = 'không được để trống';
            }
            if (empty($_POST["phone"])) {
                $sualoi[] = 'không được để trống';
            } else if(strlen($_POST['phone']) > 10  ){
                $sualoi[] = 'phone max 10';
                
            }


            if (count($sualoi)) {
                redirect('errors', $sualoi, 'create');
            } else {
                $check = $this->std->themsinhvien(null, $_POST["name"], $_POST["year"], $_POST["phone"]);
                if ($check) {
                    redirect('success', '', 'create');
                }
            }
        }
    }

    public function edit($id) {
        $student = $this->std->idsinhvien($id);
        return $this->render('student.edit', compact('student'));
    }

    public function update($id) {
        if (isset($_POST["btn-save"])) {
            
            $err = [];

            if (empty($_POST["name"])) {
                $err[] = 'không được để trống';
            }
            if (empty($_POST["year"])) {
                $err[] = 'không được để trống';
            }
            if (empty($_POST["phone"])) {
                $err[] = 'không được để trống';
            }else if(strlen($_POST['phone']) > 10  ){
                $err[] = 'phone max 10';
                
            }

            $url = 'edit/'.$id;

            if (count($err)) {
                redirect('errors', $err, $url);
            } else {
                $check = $this->std->updatetStudent($id, $_POST["name"], $_POST["year"], $_POST["phone"]);
                if ($check) {
                    redirect('success', '', $url);
                }
            }
        }
    }

    public function delete($id) {
        $check = $this->std->deleteStudent($id);
        if ($check) {
            redirect('success', '', 'index');
        }
    }
    
}