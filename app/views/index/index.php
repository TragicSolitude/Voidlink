<?php foreach ($vm->posts as $post): ?>
<div class="post">
    <?php if (!empty($post->image)): ?>
	<div class="post-thumbnails">
		<img
			    class="thumbnail"
                src="<?= $vm->imgurl . $post->image ?>"
			    alt="Dynamic Thumbnail" />
	</div>
    <?php endif; ?>
    <div class="post-text">
        <p class="post-meta">
            <?= $post->relative_time ?> by <?= $post->author_name ?>
        </p>
        <p class="post-content"><?= htmlspecialchars($post->content) ?></p>
    </div>
</div>
<br />
<?php endforeach; ?>
