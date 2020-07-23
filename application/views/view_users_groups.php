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
                    <?php } ?>
                    <?php if ($this->session->userdata('error_message') != '') { ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->userdata('error_message') ?>
                        </div>
                    <?php } ?>
                    <form role="form" action="<?php echo $action ?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Groups</label>
                                <?php echo form_error('groups_id') ?>
                                <select name="groups_id" class="form-control">
                                    <option value="">-- Pilih Groups --</option>
                                    <?php foreach ($groups_data as $groups) { ?>
                                        <option value="<?php echo $groups->groups_id ?>"><?php echo $groups->groups_nama ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="users_id" value="<?php echo $users_id; ?>" />
                            <a class="btn btn-default" href="<?php echo site_url('users') ?>">Batal</a>
                            <button type="submit" class="btn btn-success pull-right">Tambah</button>
                        </div>
                    </form>
                </div>
                <div class="box-body table-responsive">
                    <table id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Group Nama</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $start = 0; ?>
                            <?php foreach ($groups_users_id_data as $data) { ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $data->groups_nama ?></td>
                                    <td><?php echo $data->groups_keterangan ?></td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="<?php echo site_url('users/hapus_groups/') . $data->users_groups_id ?>" onclick="javasciprt: return confirm('Apakah kamu mau menghapus data ini ?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>