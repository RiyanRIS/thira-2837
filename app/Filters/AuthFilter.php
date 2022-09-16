<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (!session()->isLogin) {
      return redirect()->to(base_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);
    }

    if (!session()->isAdmin) {
      return redirect()->to(base_url())->with('msg', [0, 'Anda tidak memiliki akses ke halaman ini.']);
    }
  }

  //--------------------------------------------------------------------
  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
