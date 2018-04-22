<?php
 
require APPPATH . '/libraries/REST_Controller.php';
 
class Matakuliah extends REST_Controller {
 
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data matakuliah
    function index_get() {
        $kdmk = $this->get('kdmk');
        if ($kdmk == '') {
            $matakuliah = $this->db->get('matakuliah')->result();
        } else {
            $this->db->where('kdmk', $kdmk);
            $matakuliah = $this->db->get('matakuliah')->result();
        }
        $this->response($matakuliah, 200);
    }
 
    // insert new data to matakuliah
    function index_post() {
		
        $data = array(
                    'kdmk'           => $this->post('kdmk'),
                    'nmmk'          => $this->post('nmmk'),
                    'sks'          => $this->post('sks'),
                    'prodi'        => $this->post('prodi'));
        $insert = $this->db->insert('matakuliah', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // update data matakuliah
    function index_put() {
        $kdmk = $this->put('kdmk');
        $data = array(
                    'kdmk'       => $this->put('kdmk'),
                    'nmmk'      => $this->put('nmmk'),
                    'sks'          => $this->put('sks'),
                    'prodi'    => $this->put('prodi'));
        $this->db->where('kdmk', $kdmk);
        $update = $this->db->update('matakuliah', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete matakuliah
    function index_delete() {
        $kdmk = $this->delete('kdmk');
        $this->db->where('kdmk', $kdmk);
        $delete = $this->db->delete('matakuliah');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
}