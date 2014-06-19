<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="art-box art-post">
    <div class="art-box-body art-post-body">
        <div class="art-post-inner art-article">
            <h2 class="art-postheader"><span class="art-postheadericon">Form Edit User</span></h2>
            <div class="art-postcontent">

                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell layout-item-0" style="width: 100%;">

                            <?php
                                $row = $user->row();
                                echo form_open('home/edit_user/'.$row->user_id);
                            ?>

                            <table width='100%'>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>
                                        <?php echo form_input('nama',$row->user_nama);?>
                                        <?php echo form_error('nama');?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td>
                                        <?php echo form_input('username',$row->user_username);?>
                                        <?php echo form_error('username');?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Password</td>
                                    <td>:</td>
                                    <td>
                                        <?php echo form_password('password');?>
                                        <?php echo form_error('password');?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Konfirmasi Password</td>
                                    <td>:</td>
                                    <td>
                                        <?php echo form_password('password_conf');?>
                                        <?php echo form_error('password_conf');?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Level</td>
                                    <td>:</td>
                                    <td>
                                        <?php
                                            // menampilkan dropdown level
                                            foreach($level->result() as $rows)
                                            {
                                                $array_level[$rows->level_id] = $rows->level_nama;
                                            }

                                            echo form_dropdown('level',$array_level,$row->user_level);
                                        ?>

                                        <?php echo form_error('level');?>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo form_submit('submit','Update');?></td>
                                </tr>
                            </table>

                            <?php echo form_close();?>

                        </div>
                    </div>
                </div>

                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell layout-item-0" style="width: 50%;">

                            <ul>
                                <li>Suspendisse pharetra auctor pharetra. Nunc a sollicitudin est.</li>
                                <li>Donec vel neque in neque porta venenatis sed sit amet lectus.</li>
                                <li>Curabitur ullamcorper gravida felis, sit amet scelerisque lorem iaculissed.</li>
                            </ul>

                        </div>

                        <div class="art-layout-cell layout-item-0" style="width:50%;">
                            <blockquote style="margin: 10px 0">
                                Nunc a sollicitudin est. Curabitur ullamcorper gravida felis, sit amet scelerisque
                                lorem iaculis sed. Donec vel neque in neque porta venenatis sed sit amet lectus.
                            </blockquote>
                        </div>

                    </div>
                </div>
            </div>

            <div class="cleared"></div>
            
        </div>


// simpan dalam folder application/views/form_edit_user.php
