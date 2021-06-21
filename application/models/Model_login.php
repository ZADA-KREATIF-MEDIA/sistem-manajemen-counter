<?php
class Model_login extends CI_Model{

    private $_table = "user";

    public function get_where()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->db->get_where('user', ['username' => $username])->row_array();
	}
}

?>