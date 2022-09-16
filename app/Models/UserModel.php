<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';

	protected $allowedFields = ['id', 'nama_lengkap', 'username', 'password', 'role'];

	public $rules_tambah = [
        'nama_lengkap' => [
            'label'  => 'Nama Lengkap',
            'rules'  => 'required',
            'errors' => [
            ],
        ],
		'username' => [
            'label'  => 'Username',
            'rules'  => 'required|is_unique[user.username]',
            'errors' => [
                // 'required' => 'All accounts must have {field} provided',
            ],
        ],
        'password' => [
            'label'  => 'Password',
            'rules'  => 'required|min_length[6]',
            'errors' => [
                // 'min_length' => 'Your {field} is too short. You want to get hacked?',
            ],
        ],
		'konfirmasi_password' => [
            'label'  => 'Konfirmasi Password',
            'rules'  => 'required|matches[password]',
            'errors' => [
                // 'matches' => '{field} tidak cocok',
            ],
        ],
		'role' => [
            'label'  => 'Role',
            'rules'  => 'required',
            'errors' => [
                // 'min_length' => 'Your {field} is too short. You want to get hacked?',
            ],
        ],
    ];

	public $rules_ubah = [
        'nama_lengkap' => [
            'label'  => 'Nama Lengkap',
            'rules'  => 'required',
            'errors' => [
            ],
        ],
		'username' => [
            'label'  => 'Username',
            'rules'  => 'required|is_unique[user.username, id, {id}]',
            'errors' => [
                // 'required' => 'All accounts must have {field} provided',
            ],
        ],
		'role' => [
            'label'  => 'Role',
            'rules'  => 'required',
            'errors' => [
                // 'min_length' => 'Your {field} is too short. You want to get hacked?',
            ],
        ],
    ];
	
	public function simpan($data){
			$this->db->table($this->table)->insert($data);
			$id = $this->db->insertId($this->table);
			return $id ?? false;
	}

	public function getByUsername(string $username)
	{
		return $this->db->table($this->table)
											->where('username', $username)
											->limit(1)
											->get()
											->getRow();
	}

}
