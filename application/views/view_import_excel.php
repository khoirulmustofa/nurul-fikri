<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <?php if ($this->session->userdata('success_message') != '') { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->userdata('success_message') ?>
                        </div>
                    <?php   } ?>
                    <?php if ($this->session->userdata('error_message') != '') { ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->userdata('error_message') ?>
                        </div>
                    <?php   } ?>
                </div>
                <div class="box-body">
                    <?php echo form_open_multipart($action, array('name' => 'spreadsheet')); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <p class="help-block">Download Format File <a href="<?php echo site_url($file_download) ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-cloud-download"></i> DI SINI</a></p>
                            <hr>
                            <label>Pilih File</label>
                            <input type="file" name="upload_file" />
                            <p class="help-block"><?php echo form_error('name'); ?></p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn btn-info pull-right" value="Import" />
                        <a href="<?php echo site_url('santri') ?>" class="btn btn-default">Batal</a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>