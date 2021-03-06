<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata['logged'] == TRUE)
        {   }
        else
        {
            $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
            redirect(base_url('login'));
        }
         $this->load->library('form_validation'); 
         $this->load->helper(array('form', 'url','tombol')); 
         $this->load->model(array('DbHelper', 'M_toko')); 
    

        // $this->load->model('M_login');
    }

    public function index(){
        $this->load->view('admin/v_toko');
    }
 public function setView(){
        $result = $this->M_toko->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"        => $No,
                        "id"       => $r->ID,
                        "kode"       => $r->Kode,
                        "nama"    => $r->Nama,
                        "ket"      => $r->Ket,
                        "lokasi"       => $r->Lokasi,
                        "telp"    => $r->Telp,
                        "jambuka"      => $r->Jambuka,
                        "jamtutup"       => $r->Jamtutup,
                        "status"    => $r->Status,
                        "datei"      => $r->Datei,
                        "dateu"      => $r->Dateu,
                        "ket"      => $r->Ket,
                        "action"     => tombol($r->ID)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

    public function ajax_delete($id)
    {
        $this->M_toko->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_add(){

        $kode = $this->input->post('kode');
        $lokasi = $this->input->post('lokasi');
        $nama = $this->input->post('nama');
        $telp = $this->input->post('telp');
        $jambuka = $this->input->post('jambuka');
        $jamtutup = $this->input->post('jamtutup');
        $status = $this->input->post('status');
        $ket = $this->input->post('ket');

 
        $data = array(
            "Kode"       => $kode,
            "Nama"    => $nama,
            "Ket"      => $ket,
            "Lokasi"       => $lokasi,
            "Telp"    => $telp,
            "Jambuka"      => $jambuka,
            "Jamtutup"       => $jamtutup,
            "Status"    => $status,
            "Ket"    => $ket,
            "Datei"      => 'now()'
                    );
            
        $this->M_toko->inputdata($data,'toko');
        echo json_encode(array("status" => TRUE));
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_toko->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        $id = $this->input->post('id');
        $kode = $this->input->post('kode');
        $lokasi = $this->input->post('lokasi');
        $nama = $this->input->post('nama');
        $telp = $this->input->post('telp');
        $jambuka = $this->input->post('jambuka');
        $jamtutup = $this->input->post('jamtutup');
        $status = $this->input->post('status');
        $ket = $this->input->post('ket');

    $data = array(  
        "Kode"    => $kode,
        "Nama"    => $nama,
        "Ket"      => $ket,
        "Lokasi"       => $lokasi,
        "Telp"    => $telp,
        "Jambuka"      => $jambuka,
        "Jamtutup"       => $jamtutup,
        "Status"    => $status,
        "Ket"    => $ket,
        "Datei"      => 'now()'
            );

        $where = array(
        'ID' => $id
    );
 
        $this->M_toko->update($where,$data);
        echo json_encode(array("status" => TRUE));

}

 
   
	
}
