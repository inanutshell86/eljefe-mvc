<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?= URLROOT; ?>/notes" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?= $data['note']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?= $data['user']->name; ?> on <?= $data['note']->created_at; ?>
</div>
<p><?= $data['note']->content; ?></p>
<?php if ($data['note']->user_id == $_SESSION['user_id']) : ?>
    <hr>
    <a href="<?= URLROOT; ?>/notes/edit/<?= $data['note']->id; ?>" class="btn btn-dark">Edit</a>

    <form class="pull-right" action="<?= URLROOT; ?>/notes/delete/<?= $data['note']->id; ?>" method="post">
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
