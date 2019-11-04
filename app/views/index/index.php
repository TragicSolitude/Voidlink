<?php foreach ($vm->posts as $post): ?>
<div class="post">
    <p class="post-meta">
        <?= $post->relative_time ?> by <?= $post->author ?>
    </p>
    <p class="post-content"><?= htmlspecialchars($post->content) ?></p>
	<div class="post-thumbnails">
		<img
			class="thumbnail"
			src="/public/img/lookofdisapproval.jpg"
			alt="Dynamic Thumbnail" />
	</div>
</div>
<br />
<?php endforeach; ?>
