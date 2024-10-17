<form enctype="multipart/form-data" action="upload.php" method="post" class="form">
    <p class="flash_message"><?php flash('upload'); ?></p>

    <h2 class="title">Upload Profile Picture</h2>

    <div class="form-group">
        <label for="profile" class="label">
            <span class="label-title">Select your Image</span>
            <input class="file-input" type="file"
                name="image"
                id="profile"
                accept="image/png, image/jpeg">

            <small class="error" style="display: <?= $errors['message'] ? 'block' : 'none' ?>;">
                <?= $errors['message'] ?>
            </small>
        </label>
    </div>

    <button type="submit" class="btn btn-submit">Upload</button>
</form>