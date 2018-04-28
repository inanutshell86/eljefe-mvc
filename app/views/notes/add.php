<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?= URLROOT; ?>/notes/" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Add note</h2>
    <p>Create a note with this form</p>
    <form action="<?= URLROOT; ?>/users/login" method="post">
        <div class="form-group">
            <label for="title">Title <sup>*</sup></label>
            <input type="text" name="title" class="form-control form-control-lg <?= (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>" value="<?= $data['title']; ?>">
            <span class="invalid-feedback"><?= $data['title_error']; ?></span>
        </div>
        <div class="form-group">
            <label for="name">Content: <sup>*</sup></label>
            <textarea name="content" class="form-control form-control-lg <?= (!empty($data['content_error'])) ? 'is-invalid' : ''; ?>">
                <?= $data['content']; ?>
            </textarea>
            <span class="invalid-feedback"><?= $data['content_error']; ?></span>
        </div>
        <input type="submit" class="btn btn-success" value="Submit">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
