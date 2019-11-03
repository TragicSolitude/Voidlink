<h1 class="page-title"><?= $vm->page_title ?></h1>
<form method="POST" action="/post/create" id="new-post-form">
    <div class="form-group">
        <h2 class="form-label">Post Text</h2>
        <textarea name="content" class="form-control"><?= $vm->form["content"] ?></textarea>
    </div>
    <div class="form-group">
        <h2 class="form-label">Post Images</h2>
        <div class="form-image-target"></div>
        <button
                class="form-button upload-image-button"
                type="button">
            Upload Image
        </button>
    </div>
    <div class="errors">
    <?php foreach ($vm->errors as $error): ?>
        <p class="error"><?= $error ?></p>
    <?php endforeach; ?>
    </div>
    <div class="form-action">
        <button class="form-button-primary" type="submit">Submit</button>
        <a class="form-button" href="/">Cancel</a>
    </div>
</form>
