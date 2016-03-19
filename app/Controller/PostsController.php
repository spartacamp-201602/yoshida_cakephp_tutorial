<?php

//コントローラ...クラスの中でも xxxxControllerと定義されているもの
// アクション ... xxxCntorollerの中に定義されている関数
class PostsController extends AppController {

    public $helpers = array('Html', 'Form');

    public function index() {
        $options = array('limit' => 1);
        $this->set('posts', $this->Post->find('all'));
        // $this->set をすることによって
        // viewの中で下記のように変数が使えるようになる。
        /* <?php ehco $posts ?> */
        // $this->Post ...app/Model/Post.php
        // $this
    }

    //メソッドの中に $id を定義すると、
    // $_GET['id'] と同等の結果が取得できる
    // URLの後ろに記載されたデータが取得できる
    // 例： /posts/show/123 => $id の中身が 123 と代入される
    public function show($id) {
        $post = $this->Post->findById($id);
        $this->set('post', $post);
    }

}
