<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function login(){
		// echo password_hash("1234", PASSWORD_DEFAULT); die();
		if(session()->islogin){
			return redirect()->to(site_url("admin"));
		}

		$username = '';

		$this->validation->setRule('username', "Username", 'required');
		$this->validation->setRule('password', "Password", 'required');
		if($this->request->getPost() && $this->validation->withRequest($this->request)->run()){
			$username =  (String)$this->request->getVar('username');
			$password =  (String)$this->request->getVar('password');
			// $remember =  (bool)$this->request->getVar('ingatsaya');

			if($this->auth->login($username, $password)){
				$data_user = $this->user->getByUsername($username);
				if(session()->isAdmin){
					return redirect()->to(site_url("admin"))->with('msg', [1, "Selamat datang, " . $data_user->nama_lengkap]);
				} else {
					return redirect()->to(site_url())->with('msg', [1, "Selamat datang, " . $data_user->nama_lengkap]);
				}
			} else {
				$ses = [0, "Kombinasi username dan password belum tepat"];
				session()->setFlashdata(['msg' => $ses]);
			}
		}
		$data = [
			'err' => $this->validation->getErrors(),
			'username' => (@$username ?: '')
		];
		return view("admin/auth/login", $data);
	}

	public function logout(){
		$this->auth->logout(session()->user_id);
		return redirect()->to(site_url())->with('msg', [1, "Berhasil Logout"]);
	}
}
