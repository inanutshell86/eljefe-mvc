<?php
class Notes extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->noteModel = $this->model('Note');
    }

    public function index()
    {
        $notes = $this->noteModel->getNotes();
        $data = [
            'notes' => $notes
        ];
        $this->view('notes/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => '',
            'content' => ''
        ];

        $this->view('notes/add', $data);
    }
}