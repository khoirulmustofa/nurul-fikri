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
                    <div>
                        <a href="<?php echo base_url('mushrif_alquran/create') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Mushrif Alqur`an</a>
                        <a href="<?php echo base_url('#') ?>" class="btn btn-default"><i class="fa fa-upload"></i> Import</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table id="table_mushrif" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mushrif</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>