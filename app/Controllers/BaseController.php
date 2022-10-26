<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use \App\Models\AuthModel;
use \App\Models\UserModel;
use \App\Models\DesaModel;
use \App\Models\InfoDesaModel;
use \App\Models\WisataModel;
use \App\Models\LahanModel;
use \App\Models\PetaniModel;
use \App\Models\KomentarModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    protected $session;
    protected $validation;
    protected $image;

    protected $cfg;

    protected $auth;
    protected $user;
    protected $desa;
    protected $infodesa;
    protected $wisata;
    protected $lahan;
    protected $petani;
    protected $komentar;


    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        helper(['form', 'url', 'cookie']);

        $this->cfg = new \SConfig();

        $this->session      = \Config\Services::session();
        $this->validation 	= \Config\Services::validation();
        $this->image        = \Config\Services::image();

        $this->auth = new AuthModel();
        $this->user = new UserModel();
        $this->desa = new DesaModel();
        $this->infodesa = new InfoDesaModel();
        $this->wisata = new WisataModel();
        $this->lahan = new LahanModel();
        $this->petani = new PetaniModel();
        $this->komentar = new KomentarModel();

        $awal = $this->desa->find(1);
        $data_awal = [
            'desa_logo' => $awal['logo'],
        ];

        session()->set($data_awal);
    }
}
