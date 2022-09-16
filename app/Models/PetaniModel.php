<?php

namespace App\Models;

use CodeIgniter\Model;

class PetaniModel extends Model
{
	protected $table = 'petani';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';

	protected $allowedFields = ['id', 'nama_lengkap', 'no_telepon', 'id_lahan'];

	public $rules_tambah_ubah = [
        'nama_lengkap' => [
            'label'  => 'Nama Lengkap',
            'rules'  => 'required',
            'errors' => [
            ],
        ],
		'no_telepon' => [
            'label'  => 'No Telepon',
            'rules'  => 'required',
            'errors' => [
            ],
        ],
        'id_lahan' => [
            'label'  => 'Lahan',
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

    public function findAllPetaniLahan()
    {
        return $this->db->table($this->table . " a")
                    ->join('lahan b', 'a.id_lahan = b.id')
                    ->orderBy('a.id', 'desc')
                    ->get()
                    ->getResultArray();
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
