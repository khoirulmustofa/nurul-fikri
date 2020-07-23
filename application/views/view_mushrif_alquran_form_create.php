<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <?php
                $attribute = array('role' => 'form');
                echo form_open($action, $attribute);
                ?>
                <div class="box-body">
                    <div class="form-group <?= set_validation_style('users_id') ?>">
                        <label>Nama Mushrif</label>
                        <?php echo form_error('users_id') ?>
                        <?php echo cmb_dinamis('users_id', 'auth_users', 'users_nama_lengkap', 'users_id', $users_id, '-- Pilih Pengguna --', null) ?>
                    </div>
                    <div class="form-group <?= set_validation_style('mushrif_tahfidz_status') ?>">
                        <label>Status</label>
                        <?php echo form_error('mushrif_tahfidz_status') ?>
                        <select name="mushrif_tahfidz_status" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="Y" <?php echo $mushrif_tahfidz_status == "Y" ? "selected" : "" ?>>Aktif</option>
                            <option value="N" <?php echo $mushrif_tahfidz_status == "N" ? "selected" : "" ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="mushrif_tahfidz_id" value="<?php echo $mushrif_tahfidz_id ?>">
                    <a class="btn btn-default" href="<?php echo site_url('mushrif_alquran') ?>">Batal</a>
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>