<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Wisata extends BaseController
{
    public function index()
    {
        $infodesas = $this->infodesa->orderBy('id', 'desc')->findAll();
        $wisata = $this->wisata->orderBy('id', 'desc')->findAll();

        $data = [
            "judul" => "Daftar Wisata",
            "nav" => "wisata",
            "desa" => $infodesas,
            "record" => $wisata
        ];

        return view('admin/wisata/index', $data);
    }

    public function ambil($id)
    {
        $record = $this->wisata->find($id);
        $msg = [
            'status' => true,
            'record' => $record,
        ];
        echo json_encode($msg); die();
    }

    public function tambah()
    {

        // validasi input
        $this->validation->setRules($this->wisata->rules_tambah_ubah);
        $validationRule = [
            'foto' => [
                'label' => 'Foto wisata',
                'rules' => 'is_image[foto]'
                    . '|max_size[foto,10000]'
            ],
        ];

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run() && $this->validate($validationRule)) {
            
            $desa_id = $this->request->getPost('desa_id');
            $data_desa = $this->infodesa->find($desa_id);

            // inisialisasi data yang akan dimasukkan ke database
            $additionalData = $this->request->getPost();
            $additionalData['user_id'] = session()->user_id;
            $additionalData['dusun'] = $data_desa['nama'];
            $additionalData['kecamatan'] = $data_desa['kecamatan'];
            $additionalData['kabupaten'] = $data_desa['kabupaten'];
            $additionalData['provinsi'] = $data_desa['provinsi'];

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
                    ->resize(650, 430, false)
                    ->save(ROOTPATH . 'public/uploads/wisata/' . $newName);
                unlink(ROOTPATH . 'public/uploads/temp/' . $newName);
            }

            // Input ke database
            $lastid = $this->wisata->simpan($additionalData);

            if($lastid) // Kondisi berhasil menambah data
            {
                $msg = [
                    'status' => true,
                    'url' => site_url("admin/wisata"),

                ];
                $this->session->setFlashdata('msg', [1, 'Data berhasil ditambah']);
            }else{ // kondisi gagal
                $msg = [
                    'status' => false,
                    'url' => site_url("admin/wisata"),
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
        $this->validation->setRules($this->wisata->rules_tambah_ubah);

        if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
            $id = $this->request->getPost('id');

            $sebelumupdate = $this->wisata->find($id);

            $desa_id = $this->request->getPost('desa_id');
            $data_desa = $this->infodesa->find($desa_id);

            // inisialisasi data yang akan dimasukkan ke database
            $additionalData = $this->request->getPost();
            $additionalData['user_id'] = session()->user_id;
            $additionalData['dusun'] = $data_desa['nama'];
            $additionalData['kecamatan'] = $data_desa['kecamatan'];
            $additionalData['kabupaten'] = $data_desa['kabupaten'];
            $additionalData['provinsi'] = $data_desa['provinsi'];

            unset($additionalData['id']);

            $img = $this->request->getFile('foto');

            if(!empty($img->getName())){
                $validationRule = [
                    'foto' => [
                        'label' => 'Foto wisata',
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
                            ->resize(650, 430, false)
                            ->save(ROOTPATH . 'public/uploads/wisata/' . $newName);
                        unlink(ROOTPATH . 'public/uploads/temp/' . $newName);

                        $img_lama = $sebelumupdate['foto'];
                        $target_file = ROOTPATH . 'public/uploads/wisata/' . $img_lama;
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
            $lastid = $this->wisata->update($whr, $additionalData);
            
            if($lastid){
                $msg = [
                    'status' => true,
                    'url' => site_url("admin/wisata"),

                ];
                $this->session->setFlashdata('msg', [1, 'Data berhasil dirubah']);
            }else{
                $msg = [
                    'status' => false,
                    'url' => site_url("admin/wisata"),
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
        $sebelumupdate = $this->wisata->find($id);
        $img_lama = $sebelumupdate['foto'];
        $target_file = ROOTPATH . 'public/uploads/wisata/' . $img_lama;
        if(file_exists($target_file)){
            unlink($target_file);
        }

        // Hapus data di db
        $this->wisata->delete($id);
        
        // Kirim info berhasil menghapus
        $msg = [
            'status' => true,
            'url' => site_url("admin/wisata"),
        ];
        $this->session->setFlashdata('msg', [1, 'Data berhasil dihapus']);
        echo json_encode($msg);
        die();
    }
}
