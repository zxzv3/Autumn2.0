<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->name = __CLASS__;
		$this->load->model('Admin_user_model');

		$this->params = array(
			"{$this->name}/edit:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
				'class' => array('max' => 16 , 'min' => 1 , 'name' => '文章栏目'),
				'title' => array('max' => 50 , 'min' => 2 , 'name' => '文章标题'),
				'keywords' => array('max' => 16 , 'min' => 1 , 'name' => '文章关键词'),
				'description' => array('max' => 220 , 'min' => 1 , 'name' => '文章描述'),
				'content' => array('max' => 10000 , 'min' => 1 , 'name' => '文章内容'),
			),
			"{$this->name}/create:POST" => array(
				'class' => array('max' => 16 , 'min' => 1 , 'name' => '文章栏目'),
				'title' => array('max' => 50 , 'min' => 2 , 'name' => '文章标题'),
				'keywords' => array('max' => 16 , 'min' => 1 , 'name' => '文章关键词'),
				'description' => array('max' => 220 , 'min' => 1 , 'name' => '文章描述'),
				'content' => array('max' => 10000 , 'min' => 1 , 'name' => '文章内容'),
			),


			"{$this->name}/remove:POST" => array(
				'id' => array('max' => 10 , 'min' => 1 , 'name' => 'id'),
			),
			"{$this->name}/login:POST" => array(
				'username' => array('min' => 6 , 'max' => 16 , 'name' => '用户名'),
				'password' => array('min' => 6 , 'max' => 16 , 'name' => '密码'),
			),
		);
	}


	public function _remap($method){
		$this->params = Autumn::params("{$this->name}/{$method}" , 'api/admin' , $this->params);
		method_exists($this, $method) ? $this->$method() : show_404();
	}

	/**
	 * 接收上传的图片
	 * @return [type] [description]
	 */
	public function upload(){
        $config['upload_path']      = FCPATH . 'public/temp';
        $config['allowed_types']    = 'gif|jpg|png|bmp';
        $config['max_size']     	= 2048;
        $config['file_name']		= md5(time());
        // $config['max_width']        = 1024;
        // $config['max_height']       = 768;

        $this->load->library('upload', $config);

    	unset($_SESSION['upload']['article_upload_image']);
        if( ! $this->upload->do_upload('file')){
            $error = array('error' => $this->upload->display_errors());
            Autumn::end(false , $error);
        }else{
            $data = array('upload_data' => $this->upload->data());
            $_SESSION['upload']['article_upload_image'] = $data['upload_data'];
            Autumn::end(true , $data);
        }
	}

	/**
	 * 删除文章
	 * @param id $[name] [<description>]
	 * @return [type] [description]
	 */
	public function remove(){
		$this->load->model('Article_model');
		if( ! $this->Article_model->is_exist(array('id' => $this->params->id))) Autumn::end(false , '您输入的文章不经存在');
		$this->Article_model->remove(array('id' => $this->params->id));
		Autumn::end(true);
	}

	/**
	 * 创建一个文章
	 * @param title [<文章标题>]
	 * @param class [<文章所属栏目>]
	 * @param keywords [<文章关键词>]
	 * @param description [<文章描述>]
	 * @param content [<文章内容>]
	 */
	public function create(){
		$this->load->model('Article_model');
		$this->load->model('Class_model');
		$content = strip_tags(htmlspecialchars($this->input->post('content' , true)) , '<p><b><span><a><table><tr><td><h1><h2><h3><h4><h5><h6><font><strong><video><img>');

		if($this->Article_model->is_exist(array('title' => htmlspecialchars($this->params->title)))) Autumn::end(false , '您输入的标题文章已经存在');
		if( ! $this->Class_model->is_exist(array('id' => $this->params->class))) Autumn::end(false , '您输入的栏目不存在');


		$article_image = '';
		if(isset($_SESSION['upload']['article_upload_image'])){
			$article_image = 'assets/upload/article/' . $_SESSION['upload']['article_upload_image']['orig_name'];
			copy($_SESSION['upload']['article_upload_image']['full_path'], FCPATH . $article_image);
			unset($_SESSION['upload']['article_upload_image']);
		}

		$this->Article_model->create(array(
			'create_time' => date('Y-m-d H:i:s'),
			'update_time' => date('Y-m-d H:i:s'),
			'content' => $content,
			'title' => $this->params->title,
			'image' => @$this->params->image,
			'from_class' => $this->params->class,
			'keywords' => @$this->params->keywords,
			'description' => $this->params->description,
			'image' => $article_image,
		));
		Autumn::end(true);
	}



	/**
	 * 编辑一个文章
	 * @param id [<文章ID>]
	 * @param title [<文章标题>]
	 * @param class [<文章所属栏目>]
	 * @param keywords [<文章关键词>]
	 * @param description [<文章描述>]
	 * @param content [<文章内容>]
	 */
	public function edit(){
		$this->load->model('Article_model');
		$this->load->model('Class_model');
		$content = strip_tags(htmlspecialchars($this->input->post('content' , true)) , '<p><b><span><a><table><tr><td><h1><h2><h3><h4><h5><h6><font><strong><video><img>');

		if( ! $this->Article_model->is_exist(array('id' => $this->params->id))) Autumn::end(false , '您输入的文章不经存在');
		if( ! $this->Class_model->is_exist(array('id' => $this->params->class))) Autumn::end(false , '您输入的栏目不存在');


		$Article_data = $this->Article_model->get(array('id' => $this->params->id));

		$article_image = $Article_data['image'];
		if(isset($_SESSION['upload']['article_upload_image'])){
			$article_image = 'assets/upload/article/' . $_SESSION['upload']['article_upload_image']['orig_name'];

			copy($_SESSION['upload']['article_upload_image']['full_path'], FCPATH . $article_image);
			unset($_SESSION['upload']['article_upload_image']);
		}


		$this->Article_model->edit(array('id' => $this->params->id) , array(
			'update_time' => date('Y-m-d H:i:s'),
			'image' => $article_image,
			'content' => $content,
			'title' => $this->params->title,
			'from_class' => $this->params->class,
			'keywords' => @$this->params->keywords,
			'description' => $this->params->description,
		));
		Autumn::end(true);
	}
}