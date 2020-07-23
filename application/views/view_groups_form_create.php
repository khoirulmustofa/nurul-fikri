<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <?php
                $attribute = array('role' => 'form');
                echo form_open($action, $attribute);
                ?>                
                <div class="box-body">
                    <div class="form-group <?= set_validation_style('groups_nama') ?>">
                        <label>Nama Group</label>
                        <?php echo form_error('groups_nama') ?>
                        <input type="text" name="groups_nama" class="form-control" value="<?php echo $groups_nama; ?>" placeholder="Masukan Nama Group ...">
                    </div>
                    <div class="form-group <?= set_validation_style('groups_keterangan') ?>">
                        <label>Keterangan</label>
                        <?php echo form_error('groups_keterangan') ?>
                        <input type="text" name="groups_keterangan" class="form-control" value="<?php echo $groups_keterangan; ?>" placeholder="Masukan Keterangan ...">
                    </div>                                       
                </div>
                <div class="box-footer">
                    <input type="hidden" name="groups_id" value="<?php echo $groups_id ?>">
                    <a class="btn btn-default" href="<?php echo site_url('groups') ?>">Batal</a>
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>