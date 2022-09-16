<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Petani extends BaseController
{
    public function index()
    {
        $petanis = $this->petani->findAllPetaniLahan();
        $lahans = $this->lahan->orderBy('id', 'desc')->findAll();

        $data = [
            "judul" => "Master Petani",
            "nav" => "petani",
            "lahan" => $lahans,
            "record" => $petanis
        ];

        return view('admin/petani/index', $data);
    }

    public function ambil($id)
    {
        $record = $this->petani->find($id);
        $msg = [
            'status' => true,
            'record' => $record,
        ];
        echo json_encode($msg); die();
    }

    public function tambah()
    {
        $this->validation->setRules($this->petani->rules_tambah_ubah);

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
            $additionalData = $this->request->getPost();
            unset($additionalData['id']);

            $lastid = $this->petani->simpan($additionalData);

            if($lastid){
                $msg = [
                    'status' => true,
                    'url' => site_url("admin/petani"),

                ];
                $this->session->setFlashdata('msg', [1, 'Data berhasil ditambah']);
            }else{
                $msg = [
                    'status' => false,
                    'url' => site_url("admin/petani"),
                    'pesan'	 => 'Data gagal ditambah',
                ];
            }

        } else {
            $msg = [
                'status' => false, 
                'errors' => $this->validation->getErrors(),
            ];
        }
        echo json_encode($msg);
        die();
    }

    public function ubah()
    {
        $this->validation->setRules($this->petani->rules_tambah_ubah);

        if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
            $additionalData = $this->request->getPost();
            unset($additionalData['id']);

            $lastid = $this->petani->update(["id" => $this->request->getPost('id')], $additionalData);

            if($lastid){
                $msg = [
                    'status' => true,
                    'url' => site_url("admin/petani"),

                ];
                $this->session->setFlashdata('msg', [1, 'Data berhasil dirubah']);
            }else{
                $msg = [
                    'status' => false,
                    'url' => site_url("admin/petani"),
                    'pesan'	 => 'Data gagal dirubah',
                ];
            }

        } else {
            $msg = [
                'status' => false, 
                'errors' => $this->validation->getErrors(),
            ];
        }
        echo json_encode($msg);
        die();
    }

    public function hapus($id)
    {
        $this->petani->delete($id);
        $msg = [
            'status' => true,
            'url' => site_url("admin/petani"),
        ];
        $this->session->setFlashdata('msg', [1, 'Data berhasil dihapus']);
        echo json_encode($msg); die();
    }
}
