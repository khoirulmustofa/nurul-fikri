<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <?php
                $attribute = array('role' => 'form');
                echo form_open($action, $attribute);
                ?>
                <div class="box-body">
                    <div class="form-group <?php echo set_validation_style('siswa_NIS') ?>">
                        <label>NIS</label>
                        <?php echo form_error('siswa_NIS') ?>
                        <input type="text" readonly name="siswa_NIS" class="form-control" value="<?php echo $siswa_NIS; ?>" placeholder="Masukan NIS ...">
                    </div>
                    <div class="form-group <?php echo set_validation_style('siswa_NISN') ?>">
                        <label>NISN</label>
                        <?php echo form_error('siswa_NISN') ?>
                        <input type="text" readonly name="siswa_NISN" class="form-control" value="<?php echo $siswa_NISN; ?>" placeholder="Masukan NISN ...">
                    </div>
                    <div class="form-group <?php echo set_validation_style('siswa_nama_lengkap') ?>">
                        <label>Nama Lengkap</label>
                        <?php echo form_error('siswa_nama_lengkap') ?>
                        <input type="text" name="siswa_nama_lengkap" class="form-control" value="<?php echo $siswa_nama_lengkap; ?>" placeholder="Masukan Nama Lengkap ...">
                    </div>
                    <div class="form-group <?php echo set_validation_style('kelas_id') ?>">
                        <label>Kelas</label>
                        <?php echo form_error('kelas_id') ?>
                        <?php echo cmb_dinamis('kelas_id', 'kelas', 'kelas_nama', 'kelas_id', $kelas_id, '-- Pilih Kelas --',null) ?>
                    </div>
                    <div class="form-group <?php echo set_validation_style('asrama_id') ?>">
                        <label>Asrama</label>
                        <?php echo form_error('asrama_id') ?>                        
                        <?php
                        $ci = &get_instance();
                        $data_result = $this->Santri_model->get_asrama()->result();

                        $cmb = "<select name='asrama_id' class='form-control select2'> <option value='' selected> -- Pilih Asrama -- </option>";

                        foreach ($data_result as $data) {
                            $cmb .= "<option value='" . $data->asrama_id . "'";
                            $cmb .= $asrama_id == $data->asrama_id ? " selected='selected'" : '';
                            $cmb .= ">" . $data->asrama_nama . "</option>";
                        }
                        $cmb .= "</select>";
                        echo $cmb; ?>
                    </div>
                    <div class="form-group <?php echo set_validation_style('mushrif_tahfidz_id') ?>">
                        <label>Mushrif Tahfidz</label>
                        <?php echo form_error('mushrif_tahfidz_id') ?>
                        <?php echo cmb_dinamis_join3('mushrif_tahfidz_id',  'users_nama_lengkap', 'mushrif_tahfidz_id', $mushrif_tahfidz_id, '-- Pilih Mushrif Tahfidz --', null) ?>
                    </div>
                    <div class="form-group <?php echo set_validation_style('user_id_telegram') ?>">
                        <label>User Id Telegram</label>
                        <?php echo form_error('user_id_telegram') ?>
                        <input type="text" name="user_id_telegram" class="form-control" value="<?php echo $user_id_telegram; ?>" placeholder="Masukan User Id Telegram ...">
                    </div>
                    <div class="form-group <?= set_validation_style('siswa_status') ?>">
                        <label>Status</label>
                        <?php echo form_error('siswa_status') ?>
                        <select name="siswa_status" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="Y" <?php echo $siswa_status == "Y" ? "selected" : "" ?>>Aktif</option>
                            <option value="N" <?php echo $siswa_status == "N" ? "selected" : "" ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="siswa_id" value="<?php echo $siswa_id ?>">
                    <a class="btn btn-default" href="<?php echo site_url('santri') ?>">Batal</a>
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>