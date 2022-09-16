<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Komentar extends BaseController
{
    public function index()
    {
        $komentars = $this->komentar->select('*')->join('wisata', 'wisata.id = komentar.id_lahan')->findAll();
        // print_r($komentars); die();
        $data = [
            "judul" => "Daftar Komentar",
            "nav" => "komentar",
            "record" => $komentars
        ];

        return view('admin/komentar/index', $data);
    }

    public function ambil($id)
    {
        $record = $this->lahan->find($id);
        $msg = [
            'status' => true,
            'record' => $record,
        ];
        echo json_encode($msg); die();
    }

    public function hapus($id)
    {
        // Hapus data di db
        $this->komentar->delete($id);
        
        // Kirim info berhasil menghapus
        $msg = [
            'status' => true,
            'url' => site_url("admin/komentar"),
        ];
        $this->session->setFlashdata('msg', [1, 'Data berhasil dihapus']);
        echo json_encode($msg);
        die();
    }
}
