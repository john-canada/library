<?php
post controller

public function view($lug=NULL){
$data=$this->post_model->get_post($slug);
$post_id=$data['post']['id'];
$data['comments']=$this->db-get_comments($post_id);
}


class comments_model extends CI_Model{
	public function _construct(){
		$this->load->database();
	}
	
	public function create_comments($post_id){
		
		$data=array(
		'post_id'=>$post_id,
		'name'=>$this->input->post('name'),
		'body'=>$this->input->post('body')
		);
		return $this->db->insert('comments',$data);
	}
	
	public funtion get_comments($post_id){
		$query=$this->db->get_where('comments',array('post_id'=$post_id));
		return $query->result_array();
	}
	
}


class comments extends CI_Controller{
	
	public function create($post_id){
		$slug=$this->input->post('slug');
		$data['post']=$this->post_model->get_post($lug);
		
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('body','Body','required');
	}
	
	if($this->form_validation->run()===false){
		$this->load->view('template/header');
		$this->load->view('post/view',$data);
		$this->load->view('template/footer');
		
	}else{
	
	$this->comments_model->create_comments($post_id);
	redirect('post/'.$slug)
	}
}

<h2>comments</h2>
<?php if($comments):?>
    <?php foreach($comments as $comment):?>
	   <h5><?php $comment['body']; ?><strong>[by <?php $comment['name'];?>]</stron></h5>
	<?php endforeach;?>
<?php else:?>
  <h4>No comments</h4>
<?php endif;?>

<input type="hiddent" name="slug" value="<?php echo post['slug']; ?>">