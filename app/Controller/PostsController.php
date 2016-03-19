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

            //データが送られてきていない時 -> URLでアクセスした時
            //既存のレコードを表示する
            if (!$this->request->data)
            {
                $this->request->data = $post;
            }

            // $this->Post->save(引数)
        }
    }

    public function delete($id)
    {
        // $id -> /posts/delete/5 だったら5になる
        // /delete.php?id=5
        // sql = "delete from posts where id = 5"

        if ($this->request->is('get'))
        {
            //GETできた場合
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id))
        {
            //削除に成功した場合
            $this->Flash->error('記事'.$id.'を削除しました');
            //リダイレクト
            return $this->redirect(array('action' =>'index'));
        }
    }

    public function edit($id) {

        // 既存レコードの取得
        $post = $this->Post->findById($id);

        if (!$post)
        {
            throw new NotFoundException('そんな記事ないよ〜');
        }

        $this->Post->id = $id;

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success('記事' . $id . 'を編集しました！');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error('記事を編集できませんでした...');
        }

        // データが送られてきていない時 -> URLでアクセスした時
        // 既存レコードを表示する
        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }
}
