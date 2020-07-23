<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <?php
                $attribute = array('role' => 'form');
                echo form_open($action, $attribute);
                ?>                
                <div class="box-body">
                    <div class="form-group <?= set_validation_style('asrama_nama') ?>">
                        <label>Nama Asrama</label>
                        <?php echo form_error('asrama_nama') ?>
                        <input type="text" name="asrama_nama" class="form-control" value="<?php echo $asrama_nama; ?>" placeholder="Masukan Nama Asrama ...">
                    </div>
                    <div class="form-group <?= set_validation_style('users_id') ?>">
                        <label>Wali Asrama</label>
                        <?php echo form_error('users_id') ?>
                        <?php
                        $ci = &get_instance();
                        $user_result = $this->Asrama_model->get_user_active()->result();

                        $cmb = "<select name='users_id' class='form-control select2'> <option value='' selected> -- Pilih Wali Asrama -- </option>";

                        foreach ($user_result as $data) {
                            $cmb .= "<option value='" . $data->users_id . "'";
                            $cmb .= $users_id == $data->users_id ? " selected='selected'" : '';
                            $cmb .= ">" . $data->users_nama_lengkap . "</option>";
                        }
                        $cmb .= "</select>";
                        echo $cmb; ?>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="asrama_id" value="<?php echo $asrama_id ?>">
                    <a class="btn btn-default" href="<?php echo site_url('asrama') ?>">Batal</a>
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>