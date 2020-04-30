<?php
class Group{
	public function __construct(){
		$this->db = new Database;
	}
	public function add($data){
		$this->db->query('INSERT INTO groups(group_name,group_image,group_b_image,creator_id,members_ids) VALUES(:group_name,:group_image,:group_b_image,:creator_id,:members_ids)');
		$creator_id = $_SESSION['user_id'];
		$group_image = $data['group_image'];
		$group_name = $data['group_name'];
		$members_ids = $data['members_ids'];
		$num = rand(0,999999999999);
		$group_image = $_SESSION['user_role'] . $num . $data['group_image']['name'];
		$group_image_temp = $data['group_image']['tmp_name'];
		if($group_image === $_SESSION['user_role'] . $num){
			$group_image = "default-g-image.png";
		}
		$num = rand(0,999999999999);
		$group_b_image = $_SESSION['user_role'] . $num . $data['group_b_image']['name'];
		$group_b_image_temp = $data['group_b_image']['tmp_name'];
		if($group_b_image === $_SESSION['user_role'] . $num){
			$group_b_image = "";
		}

		move_uploaded_file($group_image_temp,$_SERVER['DOCUMENT_ROOT'] . "\mymvc\public\images\groups_images\\" . $_SESSION['user_name'] . "_" . $group_name . "_images\\group_images\\" . $group_image);
		move_uploaded_file($group_b_image_temp,$_SERVER['DOCUMENT_ROOT'] . "\mymvc\public\images\groups_images\\" . $_SESSION['user_name'] . "_" . $group_name . "_images\\group_b_images\\" . $group_b_image);
		$this->db->bind(':creator_id', $creator_id);
		$this->db->bind(':group_image', $group_image);
		$this->db->bind(':group_b_image', $group_b_image);
		$this->db->bind(':group_name', $group_name);
		$this->db->bind(':members_ids', $members_ids);
		$group = $this->db->execute();
		if($group){
			return true;
		}else{
			return false;
		}
	}
	public function find_group_by_creator_id($creator_id){
		$this->db->query("SELECT group_name FROM groups WHERE creator_id = :creator_id");
		$this->db->bind(':creator_id', $creator_id);
		return $this->db->resultSet();
	}
	public function find_group_by_id($group_id){
		$this->db->query("SELECT * FROM groups WHERE group_id = :group_id");
		$this->db->bind(':group_id', $group_id);
		return $this->db->single();
	}
	public function update_g_image($group_id){
		$num = rand(0,999999999999);
		$group_image = $_SESSION['group_id'] . $num . $_FILES['group_image']['name'];
		$group_image_temp = $_FILES['group_image']['tmp_name'];
		$group = $this->find_group_by_id($group_id);
		move_uploaded_file($group_image_temp,$_SERVER['DOCUMENT_ROOT'] . "/mymvc/public/images/groups_images/" . $_SESSION['user_name'] . "_" . $group->group_name . "_images/group_images/" . $group_image);
		$this->db->query("UPDATE groups SET group_image = :group_image WHERE group_id = :group_id");
		$this->db->bind(':group_image', $group_image);
		$this->db->bind('group_id', $group_id);
		return $this->db->execute();
	}
	public function update_g_b_image($group_id){
		$num = rand(0,999999999999);
		$group_b_image = $_SESSION['group_id'] . $num . $_FILES['group_b_image']['name'];
		$group_b_image_temp = $_FILES['group_b_image']['tmp_name'];
		$group = $this->find_group_by_id($group_id);
		move_uploaded_file($group_b_image_temp,$_SERVER['DOCUMENT_ROOT'] . "/mymvc/public/images/groups_images/" . $_SESSION['user_name'] . "_" . $group->group_name . "_images/group_b_images/" . $group_b_image);
		$this->db->query("UPDATE groups SET group_b_image = :group_b_image WHERE group_id = :group_id");
		$this->db->bind(':group_b_image', $group_b_image);
		$this->db->bind('group_id', $group_id);
		return $this->db->execute();
	}
	public function update_group_name($group_id){
		$this->db->query("UPDATE groups SET group_name = :group_name WHERE group_id = :group_id");
		$this->db->bind(':group_name', $_POST['group_name']);
		$this->db->bind('group_id', $group_id);
		return $this->db->execute();
	}
	public function find_group_by_name_and_creator($group_name,$creator_id){
		$this->db->query("SELECT group_id FROM groups WHERE group_name = :group_name AND creator_id = :creator_id");
		$this->db->bind(':group_name', $group_name);
		$this->db->bind(':creator_id', $creator_id);
		return $this->db->single();
	}
	public function update_members($new_members_ids,$group_id){
		$this->db->query("UPDATE groups SET members_ids = :members_ids WHERE group_id = :group_id");
		$this->db->bind(':members_ids', $new_members_ids);
		$this->db->bind(':group_id', $group_id);
		return $this->db->execute();
	}
	public function get_all_groups(){
		$this->db->query('SELECT group_id FROM groups');
		return $this->db->resultSet();
	}
}