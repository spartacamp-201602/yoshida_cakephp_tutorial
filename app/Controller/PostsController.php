<?php

//コントローラ...クラスの中でも xxxxControllerと定義されているもの
// アクション ... xxxCntorollerの中に定義されている関数
class PostsController extends AppController {

    public $helpers = array('Html', 'Form');
    //使用するコンポーネントを記述
    public $components = array('Flash');

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

    public function add() {
        // if ($_SERVER['REQUEST_METHOD'] == 'POST')
        if ($this->request->is('post'))
        {
            //保存処理
            if ($this->Post->save($this->request->data))
            {
                //保存に成功した場合
                //フラッシュメッセージ
                $this->Flash->success('新しい記事を追加しました');

                return $this->redirect(array('action' => 'index'));
                //今まで header('Location: index.php'); exit;
            } else
            {
                //保存に失敗した場合
                return $this->Flash->error('保存できませんでした...');
            }

            // $this->Post->save(引数)
        }
    }

}
