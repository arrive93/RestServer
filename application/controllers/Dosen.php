<?php
 
require APPPATH . '/libraries/REST_Controller.php';
 
class Dosen extends REST_Controller {
 
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data dosen
    function index_get() {
        $nip = $this->get('nip');
        if ($nip == '') {
            $dosen = $this->db->get('dosen')->result();
        } else {
            $this->db->where('nip', $nip);
            $dosen = $this->db->get('dosen')->result();
        }
        $this->response($dosen, 200);
    }
 
    // insert new data to dosen
    function index_post() {
		
        $data = array(
                    'nip'           => $this->post('nip'),
                    'nmds'          => $this->post('nmds'));
        $insert = $this->db->insert('dosen', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // update data dosen
    function index_put() {
        $nip = $this->put('nip');
        $data = array(
                    'nip'       => $this->put('nip'),
                    'nmds'      => $this->put('nmds'));
        $this->db->where('nip', $nip);
        $update = $this->db->update('dosen', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete dosen
    function index_delete() {
        $nip = $this->delete('nip');
        $this->db->where('nip', $nip);
        $delete = $this->db->delete('dosen');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
}