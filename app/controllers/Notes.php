<?php
class Notes extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->noteModel = $this->model('Note');
        $this->userModel = $this->model('User');
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'user_id' => $_SESSION['user_id'],
                'title_error' => '',
                'content_error' => ''
            ];

            // Validate title
            if (empty($data['title'])) {
                $data['title_error'] = 'Please enter title';
            }

            // Validate content
            if (empty($data['content'])) {
                $data['content_error'] = 'Please enter content';
            }

            // Make sure no errors
            if (empty($data['title_error']) && empty($data['content_error'])) {
                // Validated
                if ($this->noteModel->addNote($data)) {
                    flash('note_msg', 'Note added');
                    redirect('notes');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('notes/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'content' => ''
            ];

            $this->view('notes/add', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'user_id' => $_SESSION['user_id'],
                'title_error' => '',
                'content_error' => ''
            ];

            // Validate title
            if (empty($data['title'])) {
                $data['title_error'] = 'Please enter title';
            }

            // Validate content
            if (empty($data['content'])) {
                $data['content_error'] = 'Please enter content';
            }

            // Make sure no errors
            if (empty($data['title_error']) && empty($data['content_error'])) {
                // Validated
                if ($this->noteModel->updateNote($data)) {
                    flash('note_msg', 'Note updated');
                    redirect('notes');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('notes/edit', $data);
            }
        } else {
            // Get existing note from model
            $note = $this->noteModel->getById($id);
            // Check for owner
            if ($note->user_id != $_SESSION['user_id']) {
                redirect('notes');
            }
            $data = [
                'id' => $id,
                'title' => $note->title,
                'content' => $note->content
            ];

            $this->view('notes/edit', $data);
        }
    }

    public function show($id)
    {
        $note = $this->noteModel->getById($id);
        $user = $this->userModel->getById($note->user_id);
        $data = [
            'note' => $note,
            'user' => $user
        ];
        $this->view('notes/show', $data);
    }
}