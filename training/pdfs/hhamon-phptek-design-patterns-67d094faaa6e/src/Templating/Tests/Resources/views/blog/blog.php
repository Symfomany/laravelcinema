<h1>Blog</h1>

<?php foreach ($posts as $post) : ?>
    <h2><?= $view->escape($post->tile) ?></h2>
<?php endforeach ?>
