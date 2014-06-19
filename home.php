<?php

class Home extends CI_Controller
{

// 1. Fungsi Manajemen User
    public function manajemen_user()
    {
        $this->load->model('usermodel');

        // level untuk user ini
        $level = $this->session->userdata('level');

        // ambil menu dari database sesuai dengan level
        $data['menu'] = $this->usermodel->get_menu_for_level($level);
        $data['all_user'] = $this->usermodel->get_all_user();

        // mencegah user yang belum login untuk mengakses halaman ini
        $this->auth->restrict();

        // mencegah user mengakses menu yang tidak boleh ia buka
        $this->auth->cek_menu(1);

        // tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
        $this->template->set('title','Manajemen User | S.I.S.A');
        $this->template->load('template_admin','admin/manajemen_user',$data);

    }

// 2. Fungsi tambah user
    function insert_user()
    {
        $this->load->model('usermodel');

        // level untuk user ini
        $level = $this->session->userdata('level');

        // ambil menu dari database sesuai dengan level
        $data['menu'] = $this->usermodel->get_menu_for_level($level);

        // mencegah user yang belum login untuk mengakses halaman ini
        $this->auth->restrict();

        // mencegah user mengakses menu yang tidak boleh ia buka (manejemen user menu_id= 2)
        $this->auth->cek_menu(1);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('password_conf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('level', 'Level', 'trim|required');
        $this->form_validation->set_error_delimiters(' <span style="color:#FF0000">', '</span>');

        if ($this->form_validation->run() == FALSE)
        {
            $data['level'] = $this->usermodel->get_all_level();
            $this->template->set('title','Tambah User Baru | S.I.S.A');
            $this->template->load('template_admin','admin/form_input_user',$data);

        }
        else
        {
            $data_user = array
            (
                'user_nama' =>$this->input->post('nama'),
                'user_username' =>$this->input->post('username'),
                'user_password' =>md5($this->input->post('password')),
                'user_level' =>$this->input->post('level')
            );

            $this->usermodel->insert_data_user($data_user);

            // kembalikan ke halaman manajemen user
            redirect('home/manajemen_user');
        }
    }

// 3. Fungsi edit user
    function edit_user()
    {
        $this->load->model('usermodel');
        // level untuk user ini
        $level = $this->session->userdata('level');
        // ambil menu dari database sesuai dengan level
        $data['menu'] = $this->usermodel->get_menu_for_level($level);
        // mencegah user yang belum login untuk mengakses halaman ini
        $this->auth->restrict();
        // mencegah user mengakses menu yang tidak boleh ia buka (manejemen user menu_id = 2)
        $this->auth->cek_menu(1);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('password_conf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('level', 'Level', 'trim|required');
        $this->form_validation->set_error_delimiters(' <span style="color:#FF0000">', '</span>');
        // dapatkan id user dari segment ke-3 dari URI
        $id = $this->uri->segment(3);

        if ($this->form_validation->run() == FALSE)
        {
            $data['level'] = $this->usermodel->get_all_level();
            // dapatkan data user yg akan diedit dari database
            $data['user'] = $this->usermodel->get_user_by_id($id);
            $this->template->set('title','Edit User | S.I.S.A');
            $this->template->load('template_admin','admin/form_edit_user',$data);

        }
        else
        {
            $data_user = array
            (
                'user_nama' =>$this->input->post('nama'),
                'user_username' =>$this->input->post('username'),
                'user_password' =>md5($this->input->post('password')),
                'user_level' =>$this->input->post('level')
            );
            $this->usermodel->update_data_user($data_user,$id);
            // kembalikan ke halaman manajemen user
            redirect('home/manajemen_user');
        }
    }

// 4. Fungsi Hapus User
    function delete_user()
    {
        $this->load->model('usermodel');
        // level untuk user ini
        $level = $this->session->userdata('level');
        // ambil menu dari database sesuai dengan level
        $data['menu'] = $this->usermodel->get_menu_for_level($level);
        // mencegah user yang belum login untuk mengakses halaman ini
        $this->auth->restrict();
        // mencegah user mengakses menu yang tidak boleh ia buka (manejemen user menu_id = 2)
        $this->auth->cek_menu(1);
        // dapatkan id user dari segment ke-3 dari URI
        $id = $this->uri->segment(3);
        $this->usermodel->delete_user($id);
        // kembalikan ke halaman manajemen user
        redirect('home/manajemen_user');
    }

}

// location : controllers/home.php
