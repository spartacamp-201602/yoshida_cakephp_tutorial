<h2>Blog Posts</h2>

<?php // debug($posts); ?>

<!-- <h1><?php echo $this->Html->Link('新規投稿', '/posts/add'); ?></h1> -->
<?php echo $this->Html->Link('新規投稿', array('controller' => 'posts', 'action' => 'add')); ?>

<table>
    <tr>
        <th>Id</th>
        <th>タイトル</th>
        <th>操作</th>
        <th>投稿日</th>
    </tr>

    <?php foreach ($posts as $post) : ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td><?php echo $this->Html->link(
                $post['Post']['title'],
                array('controller' => 'posts', 'action' => 'show', $post['Post']['id']
            )); ?>
        </td>
        <td>

            <!-- 編集ボタン -->
            <?php echo $this->Html->Link(
                    '編集',
                    array('action' => 'edit', $post['Post']['id'])) ?>

            <!-- 削除ボタン -->
            <?php echo $this->Form->postLink(
                    '削除',
                    array('action' => 'delete', $post['Post']['id']),
                    array('confirm' => '削除してよろしいですか？')
                ) ?>
        </td>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>