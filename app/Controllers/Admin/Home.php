<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            "judul" => "Dashboard",
            "nav" => "dashboard"
        ];

        return view('admin/home/index', $data);
    }

    public function tentang()
    {
        $desas = $this->desa->find(1);

        $data = [
            "judul" => "Tentang",
            "nav" => "tentang",
            "record" => $desas
        ];

        return view('admin/home/tentang', $data);
    }

    public function ubah()
    {
        $this->validation->setRules($this->desa->rules_tambah_ubah);

        if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
            $id = 1;

            $sebelumupdate = $this->desa->find($id);

            $additionalData = $this->request->getPost();
            $additionalData['id_user'] = session()->user_id;

            unset($additionalData['id']);

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
                            ->save(ROOTPATH . 'public/uploads/desa/' . $newName);
                        unlink(ROOTPATH . 'public/uploads/temp/' . $newName);

                        $img_lama = $sebelumupdate['foto'];
                        $target_file = ROOTPATH . 'public/uploads/desa/' . $img_lama;
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
            $lastid = $this->desa->update($whr, $additionalData);
            
            if($lastid){
                $msg = [
                    'status' => true,
                    'url' => site_url("admin/tentang"),

                ];
                $this->session->setFlashdata('msg', [1, 'Data berhasil dirubah']);
            }else{
                $msg = [
                    'status' => false,
                    'url' => site_url("admin/tentang"),
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
}
