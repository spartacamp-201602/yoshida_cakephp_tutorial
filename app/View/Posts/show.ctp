<?php debug($post) ?>

<?php echo h($post['Post']['id']) ?>
<h2><?php echo h($post['Post']['title']) ?></h2>
<p><?php echo h($post['Post']['body']) ?></p>
<?php echo '投稿日時: '.h($post['Post']['created']) ?>