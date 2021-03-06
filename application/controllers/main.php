<?php

class Main extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_order');
        $this->load->model('m_produk');
        $this->load->model('m_user');
        if(isset($_SESSION['logged_in']['username'])){
            if ($_SESSION['logged_in']['aktivasi'] != '1') {
                redirect('Login/aktivasi');
            }
        }
    }

    public function index()
    {
        $data['getKategori'] = $this->m_order->getKategori('PHP');
        $this->load->view('templates_frontend/v_header', $data);
        $this->load->view('templates_frontend/v_main');
        $this->load->view('templates_frontend/v_footer');
    }

    public function kategori_produk($id = FALSE)
    {
        $data['getKategori'] = $this->m_order->getKategori('PHP');
        $this->load->view('templates_frontend/v_header', $data);
        if ($id === FALSE) {
            $this->load->view('templates_frontend/kategori_produk/v_kat_produk', $data);
        } else {
            $array['getKategori'] = $this->m_order->getKategori('PHP');
            $this->load->view('templates_frontend/kategori_produk/v_kat_detail', $array);
        }
        $this->load->view('templates_frontend/v_footer');   
    }

    public function detail_produk($id)
    {
        $data['getKategori'] = $this->m_order->getKategori('PHP');
        $data['GetDetailProdukFront'] = $this->m_produk->GetDetailProdukFront($id);
        $this->load->view('templates_frontend/v_header', $data);
        $this->load->view('templates_frontend/detail_produk/v_detail', $data);
        $this->load->view('templates_frontend/v_footer');   
    }

    public function tentang_kami()
    {
        $data['getKategori'] = $this->m_order->getKategori('PHP');
        $this->load->view('templates_frontend/v_header', $data);
        $this->load->view('templates_frontend/tentang_kami/v_tentang_kami');
        $this->load->view('templates_frontend/v_footer');   
    }

    public function kontak_kami()
    {
        $data['getKategori'] = $this->m_order->getKategori('PHP');
        $this->load->view('templates_frontend/v_header', $data);
        $this->load->view('templates_frontend/kontak_kami/v_kontak_kami');
        $this->load->view('templates_frontend/v_footer');   
    }

    public function keranjang()
    {
        $data['getKategori'] = $this->m_order->getKategori('PHP');
        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        } else {
            $this->load->view('templates_frontend/v_header', $data);
            $this->load->view('templates_frontend/keranjang/v_keranjang');
            $this->load->view('templates_frontend/v_footer');   
        }
    }

    public function bayar()
    {
        $data['getKategori'] = $this->m_order->getKategori('PHP');
        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        } else {
            $data['paymentMethod'] = $this->m_order->paymentMethod();
            $this->load->view('templates_frontend/v_header', $data);
            $this->load->view('templates_frontend/bayar/v_bayar', $data);
            $this->load->view('templates_frontend/v_footer');   
        }
    }

    public function myOrder()
    {
        $data['getKategori'] = $this->m_order->getKategori('PHP');
        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        } else {
            $data['getUserOrder'] = $this->m_order->getUserOrder();
            $this->load->view('templates_frontend/v_header', $data);
            $this->load->view('templates_frontend/keranjang/v_myOrder', $data);
            $this->load->view('templates_frontend/v_footer');   
        }
    }

    public function detail($param, $id)
    {
        $data['getKategori'] = $this->m_order->getKategori('PHP');
        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        } else {
            $data['getPesanan'] = $this->m_order->getPesanan($id, $param);
            $this->load->view('templates_frontend/v_header', $data);
            $this->load->view('templates_frontend/keranjang/v_detail', $data);
            $this->load->view('templates_frontend/v_footer');   
        }
    }

    public function profile($username){
        $data['getKategori'] = $this->m_order->getKategori('PHP');
        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        } else {
            $data['getUserProfile'] = $this->m_user->getUserProfile($username);
            $this->load->view('templates_frontend/v_header', $data);
            $this->load->view('templates_frontend/profile/v_profile', $data);
            $this->load->view('templates_frontend/v_footer');   
        }
    }
}