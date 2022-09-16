<?php

namespace App\Models;

use CodeIgniter\Model;

class LahanModel extends Model
{
	protected $table = 'lahan';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';

	protected $allowedFields = ['id', 'user_id', 'desa_id', 'kepemilikan', 'kategori', 'alamat_lengkap', 'dusun', 'kecamatan', 'kabupaten', 'provinsi', 'latitude', 'longitude', 'deskripsi', 'foto'];

	public $rules_tambah_ubah = [
        'desa_id' => [
            'label'  => 'Desa',
            'rules'  => 'required',
            'errors' => [
            ],
        ],
        'kepemilikan' => [
            'label'  => 'Kepemilikan',
            'rules'  => 'required',
            'errors' => [
            ],
        ],
        'kategori' => [
            'label'  => 'Kategori',
            'rules'  => 'required',
            'errors' => [
            ],
        ],
        'alamat_lengkap' => [
            'label'  => 'Alamat Lengkap',
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
