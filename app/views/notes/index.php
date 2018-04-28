<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('note_msg'); ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Notes</h1>
    </div>
    <div class="col-md-6">
        <a href="<?= URLROOT; ?>/notes/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i>Add Note
        </a>
    </div>
</div>
<?php foreach ($data['notes'] as $note) : ?>
<div class="card card-body mb-3">
    <h4 class="card-title"><?= $note->title; ?></h4>
    <div class="bg-light p-2 mb-3">
        written by <?= $note->name; ?> on <?= $note->noteCreated; ?>
    </div>
    <p class="card-text"><?= $note->content; ?></p>
    <a href="<?= URLROOT; ?>/notes/show/<?= $note->noteId; ?>" class="btn btn-dark">More</a>
</div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php';