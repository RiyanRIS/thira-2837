<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if(session()->isLogin){
            $data_wisata = $this->wisata->findAll();
            $data_lahan = $this->lahan->findAll();
    
            $data_semua = array_merge($data_wisata, $data_lahan);
        } else {
            $data_wisata = $this->wisata->findAll();
            $data_semua = $data_wisata;
        }

        // echo "<pre>";print_r($data_semua); die();
        $data = [
            "judul" => "Home",
            "nav" => "home",
            "record" => $data_semua
        ];

        return view('home', $data);
    }

    public function wisata()
    {
        $data_wisata = $this->wisata->findAll();

        $data = [
            "judul" => "Wisata",
            "nav" => "wisata",
            "record" => $data_wisata
        ];

        return view('wisata', $data);
    }

    public function lahan()
    {
        if(session()->isLogin){
            $data_lahan = $this->lahan->findAll();

            $data = [
                "judul" => "Lahan",
                "nav" => "lahan",
                "record" => $data_lahan
            ];
    
            return view('lahan', $data);
    
        } else {
            // return redirect()->to(site_url())->with('msg', [0, "Anda tidak memiliki akses ke halaman ini."]);
            var_dump(session()->isLogin);
        }

    }

    public function desa()
    {
        $data_desa = $this->desa->findAll();

        $data = [
            "judul" => "Desa",
            "nav" => "desa",
            "record" => $data_desa
        ];

        return view('desa', $data);
    }

    public function detail($apa = 'wisata', $id)
    {
        if($apa == 'wisata'){
            $data_desa = $this->wisata->find($id);
            $data_komentar = $this->komentar->where('id_lahan', $id)->findAll();

            $data = [
                "judul" => "Detail Wisata",
                "nav" => "wisata",
                "key" => $data_desa,
                "komentar" => $data_komentar,
                "id" => $id
            ];
    
            return view('detail_wisata', $data);
        } else {
            $data_desa = $this->lahan->find($id);

            $data = [
                "judul" => "Detail Lahan",
                "nav" => "lahan",
                "key" => $data_desa
            ];
    
            return view('detail_lahan', $data);
        }
    }

    public function addKomentar()
    {
        $post = $this->request->getPost();

        // Input ke database
        $lastid = $this->komentar->simpan($post);

        if($lastid) // Kondisi berhasil menambah data
        {
            $msg = [
                'status' => true,
                'url' => site_url("detail/wisata/" . $post['id_lahan']),

            ];
            $this->session->setFlashdata('msg', [1, 'Berhasil membuat komentar']);
        }else{ // kondisi gagal
            $msg = [
                'status' => false,
                'url' => site_url("detail/wisata/" . $post['id_lahan']),
                'pesan'	 => 'Data gagal ditambah',
            ];
        }

        // mengembalikan nilai
        echo json_encode($msg);
        die();
    }
}
