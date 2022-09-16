<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
	protected $table = 'komentar';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';

	protected $allowedFields = ['id', 'id_lahan', 'email', 'isi'];

   	public function simpan($data){
			$this->db->table($this->table)->insert($data);
			$id = $this->db->insertId($this->table);
			return $id ?? false;
	}

}
