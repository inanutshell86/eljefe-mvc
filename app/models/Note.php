<?php

class Note
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getNotes()
    {
        $this->db->query('SELECT *, 
                              notes.id as noteId, 
                              users.id as userId,
                              notes.created_at as noteCreated,
                              users.created_at as userCreated 
                              FROM notes 
                              INNER JOIN users 
                              ON notes.user_id = users.id 
                              ORDER BY notes.created_at DESC');
        $results = $this->db->resultSet();

        return $results;
    }

    public function addNote($data)
    {
        $this->db->query('INSERT INTO notes (title, user_id, content) VALUES (:title, :user_id, :content)');

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':content', $data['content']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateNote($data)
    {
        $this->db->query('UPDATE notes SET title = :title, content = :content WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM notes WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    public function deleteNote($id)
    {
        $this->db->query('DELETE FROM notes WHERE id = :id');

        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}