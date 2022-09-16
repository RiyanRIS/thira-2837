<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class InfoDesa extends BaseController
{
    public function index()
    {
        $infodesa = $this->infodesa->orderBy('id', 'desc')->findAll();

        $data = [
            "judul" => "Master Info Desa",
            "nav" => "infodesa",
            "record" => $infodesa
        ];

        return view('admin/infodesa/index', $data);
    }

    public function ambil($id)
    {
        $record = $this->infodesa->find($id);
        $msg = [
            'status' => true,
            'record' => $record,
        ];
        echo json_encode($msg); die();
    }

    public function tambah()
    {

        // validasi input
        $this->validation->setRules($this->infodesa->rules_tambah_ubah);
        $validationRule = [
            'foto' => [
                'label' => 'Foto desa',
                'rules' => 'is_image[foto]'
                    . '|max_size[foto,10000]'
            ],
        ];

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run() && $this->validate($validationRule)) {
            
            // inisialisasi data yang akan dimasukkan ke database
            $additionalData = $this->request->getPost();
            $additionalData['id_user'] = session()->user_id;

            // Proses Upload Gambar
            $img = $this->request->getFile('foto');
            if (!$img->isValid()) {
                $err = [
                    'foto' => $img->getErrorString()
                ];
                $msg = [
                    'status' => false, 
                    'errors' => $err,
                ];
                echo json_encode($msg);
                die();
            } else {
                $newName = $img->getRandomName();
                $img->move(ROOTPATH . 'public/uploads/temp/', $newName);
                $additionalData['foto'] = $newName;

                // Mengecilkan gambar
                $this->image
                    ->withFile(ROOTPATH . 'public/uploads/temp/' . $newName)
                    ->resize(650, 650, true)
                    ->save(ROOTPATH . 'public/uploads/infodesa/' . $newName);
                unlink(ROOTPATH . 'public/uploads/temp/' . $newName);
            }

            // Input ke database
            $lastid = $this->infodesa->simpan($additionalData);

            if($lastid) // Kondisi berhasil menambah data
            {
                $msg = [
                    'status' => true,
                    'url' => site_url("admin/infodesa"),

                ];
                $this->session->setFlashdata('msg', [1, 'Data berhasil ditambah']);
            }else{ // kondisi gagal
                $msg = [
                    'status' => false,
                    'url' => site_url("admin/infodesa"),
                    'pesan'	 => 'Data gagal ditambah',
                ];
            }

        } else { // kondisi validasi error
            $msg = [
                'status' => false, 
                'errors' => $this->validation->getErrors(),
            ];
        }

        // mengembalikan nilai
        echo json_encode($msg);
        die();
    }

    public function tes()
    {
        $data = [
            "id" => "2",
            "nama" => "5",
            "kecamatan" => "545",
        ];
        $data['sual'] = "22";
        unset($data['id']);
        var_dump($data);
    }

    public function ubah()
    {
        $this->validation->setRules($this->infodesa->rules_tambah_ubah);

        if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
            $id = $this->request->getPost('id');

            $sebelumupdate = $this->infodesa->find($id);

            $additionalData = $this->request->getPost();
            $additionalData['id_user'] = session()->user_id;

            unset($additionalData['id']);

            // $additionalData = [
            //     'id_user' 			=> session()->user_id,
            //     'nama' 			=> $this->request->getPost('nama'),
            //     'deskripsi' 			=> $this->request->getPost('deskripsi'),
            //     'kecamatan' 			=> $this->request->getPost('kecamatan'),
            //     'kabupaten' 			=> $this->request->getPost('kabupaten'),
            //     'provinsi' 			=> $this->request->getPost('provinsi'),
            // ];

            $img = $this->request->getFile('foto');

            if(!empty($img->getName())){
                $validationRule = [
                    'foto' => [
                        'label' => 'Foto desa',
                        'rules' => 'is_image[foto]'
                            . '|max_size[foto,10000]'
                    ],
                ];
                if ($this->validate($validationRule)) {
                    if (!$img->isValid()) {
                        $err = [
                            'foto' => $img->getErrorString()
                        ];
                        $msg = [
                            'status' => false, 
                            'errors' => $err,
                        ];
                        echo json_encode($msg);
                        die();
                    } else {
                        $newName = $img->getRandomName();
                        $img->move(ROOTPATH . 'public/uploads/temp/', $newName);
                        $additionalData['foto'] = $newName;

                        $this->image
                            ->withFile(ROOTPATH . 'public/uploads/temp/' . $newName)
                            ->resize(650, 650, true)
                            ->save(ROOTPATH . 'public/uploads/infodesa/' . $newName);
                        unlink(ROOTPATH . 'public/uploads/temp/' . $newName);

                        $img_lama = $sebelumupdate['foto'];
                        $target_file = ROOTPATH . 'public/uploads/infodesa/' . $img_lama;
                        if(file_exists($target_file)){
                            unlink($target_file);
                        }
                    }
                } else {
                    $msg = [
                        'status' => false, 
                        'errors' => $this->validation->getErrors(),
                    ];
                    echo json_encode($msg);
                    die();
                }
            }

           
            $whr = ["id" => $id];
            $lastid = $this->infodesa->update($whr, $additionalData);
            
            if($lastid){
                $msg = [
                    'status' => true,
                    'url' => site_url("admin/infodesa"),

                ];
                $this->session->setFlashdata('msg', [1, 'Data berhasil dirubah']);
            }else{
                $msg = [
                    'status' => false,
                    'url' => site_url("admin/infodesa"),
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
        // Hapus file foto
        $sebelumupdate = $this->infodesa->find($id);
        $img_lama = $sebelumupdate['foto'];
        $target_file = ROOTPATH . 'public/uploads/infodesa/' . $img_lama;
        if(file_exists($target_file)){
            unlink($target_file);
        }

        // Hapus data di db
        $this->infodesa->delete($id);
        
        // Kirim info berhasil menghapus
        $msg = [
            'status' => true,
            'url' => site_url("admin/infodesa"),
        ];
        $this->session->setFlashdata('msg', [1, 'Data berhasil dihapus']);
        echo json_encode($msg);
        die();
    }
}
