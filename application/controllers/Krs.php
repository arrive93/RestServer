<?php
 
require APPPATH . '/libraries/REST_Controller.php';
 
class Krs extends REST_Controller {
 
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data krs
    function index_get() {
        $nim = $this->get('nim');
        if ($nim == '') {
            $krs = $this->db->get('krs')->result();
        } else {
            $this->db->where('nim', $nim);
            $krs = $this->db->get('krs')->result();
        }
        $this->response($krs, 200);
    }
 
    // insert new data to krs
    function index_post() {
		
        $data = array(
                    'nim'           => $this->post('nim'),
                    'nmmk'          => $this->post('nmmk'),
                    'nmds'          => $this->post('nmds'));
        $insert = $this->db->insert('krs', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // update data krs
    function index_put() {
        $nim = $this->get('kdmk');
		
        $data = array(
                    'nim'           => $this->put('nim'),
                    'kdmk'       	 => $this->put('kdmk'),
                    'nmmk'          => $this->put('nmmk'),
                    'sks'          => $this->put('sks'),
                    'nmds'          => $this->put('nmds'));
        $this->db->where('nim', $nim);
        $update = $this->db->update('krs', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete krs
    function index_delete() {
        $nim = $this->delete('nim');
        $this->db->where('nim', $nim);
        $delete = $this->db->delete('krs');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
}