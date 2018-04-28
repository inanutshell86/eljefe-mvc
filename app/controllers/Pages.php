<?php
class Pages extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('notes');
        }
        $data = [
            'title' => 'ShareNotes',
            'desc' => 'Simple social network built on the EljefeMVC PHP framework'
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
            'desc' => 'App to share notes with other users'
        ];
        $this->view('pages/about', $data);
    }
}
