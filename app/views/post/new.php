<h1 class="page-title"><?= $vm->page_title ?></h1>
<form
        method="POST"
        action="/post/create"
        enctype="multipart/form-data"
        id="new-post-form">
    <div class="form-group">
        <span class="form-label required">Post Text</span>
        <textarea name="content" class="form-control"><?= $vm->form["content"] ?></textarea>
    </div>
    <div class="form-group">
        <span class="form-label">Post Image</span>
        <div class="form-image-target"></div>
        <input
                name="postimage"
                type="file"
                class="form-control" />
    </div>
    <div class="errors">
    <?php foreach ($vm->errors as $error): ?>
        <p class="error"><?= $error ?></p>
    <?php endforeach; ?>
    </div>
    <div class="form-action">
        <button class="form-button primary" type="submit">Submit</button>
        <a class="form-button" href="/">Cancel</a>
    </div>
</form>
