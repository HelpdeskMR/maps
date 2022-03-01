<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth_model extends CI_Model
{
    private $table = "tbl_user";
    private $pk = "id_users";
    public function __construct()
    {
        parent::__construct();
    }
    // ambil data dari database yang usernamenya $username dan passwordnya p$assword
    public function login($email, $password)
    {
        $passHass = $password;
        $this->db->select('tbl_user.id_users,
        tbl_user.full_name,
        tbl_user.email,
        tbl_user.images,
        tbl_user.id_user_level,
        tbl_user.kode_departemen,
        tbl_user.is_aktif,
        tbl_user.kode_distributor,
        tbl_user.store_code,
        tbl_user.region_code,
        tbl_user.brand_code,
        tbl_user.id_form,
        tbl_user.cookie,
        arc_distributor.category_id', FALSE);
        $this->db->join('arc_distributor','tbl_user.kode_distributor = arc_distributor.kode_distributor','left');
        $this->db->where('tbl_user.email', $email);
        $this->db->where('tbl_user.password', password_verify($password, $passHass));
        return $this->db->get($this->table);
    }
    // update user
    public function update($data, $id_users)
    {
        $this->db->where($this->pk, $id_users);
        $this->db->update($this->table, $data);
    }
    // ambil data berdasarkan cookie
    public function get_by_cookie($cookie)
    {
        $this->db->where('cookie', $cookie);
        return $this->db->get($this->table);
    }
}
