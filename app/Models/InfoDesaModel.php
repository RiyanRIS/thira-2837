<?php

namespace App\Models;

use CodeIgniter\Model;

class InfoDesaModel extends Model
{
	protected $table = 'info_desa';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';

	protected $allowedFields = ['id', 'id_user', 'nama', 'kecamatan', 'kabupaten', 'provinsi', 'deskripsi', 'foto'];

	public $rules_tambah_ubah = [
        'nama' => [
            'label'  => 'Nama',
            'rules'  => 'required',
            'errors' => [
            ],
        ],
        'kecamatan' => [
            'label'  => 'Kecamatan',
            'rules'  => 'required',
            'errors' => [
            ],
        ],
        'kabupaten' => [
            'label'  => 'Kabupaten',
            'rules'  => 'required',
            'errors' => [
            ],
        ],
        'provinsi' => [
            'label'  => 'Provinsi',
            'rules'  => 'required',
            'errors' => [
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
