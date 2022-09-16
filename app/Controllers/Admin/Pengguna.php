<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Pengguna extends BaseController
{
    public function index()
    {
        $users = $this->user->orderBy('id', 'desc')->findAll();

        $data = [
            "judul" => "Master Pengguna",
            "nav" => "pengguna",
            "record" => $users
        ];

        return view('admin/pengguna/index', $data);
    }

    public function ambil($id)
    {
        $record = $this->user->find($id);
        $msg = [
            'status' => true,
            'record' => $record,
        ];
        echo json_encode($msg); die();
    }

    public function tambah()
    {
        $this->validation->setRules($this->user->rules_tambah);

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
            $additionalData = [
                'nama_lengkap' 			=> $this->request->getPost('nama_lengkap'),
                'username' 			=> $this->request->getPost('username'),
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'      => $this->request->getPost('role'),
            ];

            $lastid = $this->user->simpan($additionalData);

            if($lastid){
                $msg = [
                    'status' => true,
                    'url' => site_url("admin/pengguna"),

                ];
                $this->session->setFlashdata('msg', [1, 'Data berhasil ditambah']);
            }else{
                $msg = [
                    'status' => false,
                    'url' => site_url("admin/pengguna"),
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
        $this->validation->setRules($this->user->rules_ubah);

        if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
            $additionalData = [
                'nama_lengkap' 			=> $this->request->getPost('nama_lengkap'),
                'username' 			=> $this->request->getPost('username'),
                'role'      => $this->request->getPost('role'),
            ];

            if($this->request->getPost("password")){
                if($this->request->getPost("password") == $this->request->getPost("konfirmasi_password")){
                    $additionalData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
                }
            }

            $lastid = $this->user->update(["id" => $this->request->getPost('id')], $additionalData);

            if($lastid){
                $msg = [
                    'status' => true,
                    'url' => site_url("admin/pengguna"),

                ];
                $this->session->setFlashdata('msg', [1, 'Data berhasil dirubah']);
            }else{
                $msg = [
                    'status' => false,
                    'url' => site_url("admin/pengguna"),
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
        $this->user->delete($id);
        $msg = [
            'status' => true,
            'url' => site_url("admin/pengguna"),
        ];
        $this->session->setFlashdata('msg', [1, 'Data berhasil dihapus']);
        echo json_encode($msg); die();
    }
}
