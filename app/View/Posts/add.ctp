<h2>Add Post</h2>
<?php

echo $this->element('form');
//フォームの記述
// echo $this->Form->create('Post');
// echo $this->Form->input('title');
// echo $this->Form->input('body', array('rows' => 3));
echo $this->Form->end('Save Post');

?>