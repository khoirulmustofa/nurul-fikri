<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php if ($this->session->userdata('error_message') != '') { ?>
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><?php echo $this->session->userdata('error_message') ?></p>
                </div>
            <?php } ?>
            <div class="box">
                <div class="box-header">
                    <p>Keterangan : </p>
                    <button class="btn btn-sm btn-success">Hadir</button>
                    <button class="btn btn-sm bg-navy">Telat</button>
                    <button class="btn btn-sm btn-warning">Sakit</button>
                    <button class="btn btn-sm btn-info">Ijin</button>
                    <button class="btn btn-sm btn-danger">Absen</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="data_siswa" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th style="text-align:center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <a href="<?php echo site_url('absensi_pelajaran/kirim_absensi_pelajaran?mata_pelajaran_guru_kelas=') . $kode_mata_pelajaran_guru ?>" class="btn btn-block btn-success btn-lg">Kirim Absensi Pelajaran</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal_form" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <form action="#" id="form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Judul</h4>
                </div>
                <div class="modal-body form">
                    <input type="hidden" value="" name="absensi_pelajaran_id" />
                    <input type="hidden" value="" name="siswa_nama_lengkap" />
                    <div class="form-body">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="absensi_pelajaran_status" class="form-control">
                                <option value="">--Pilih Status Absensi Pelajaran--</option>
                                <option value="H">Hadir</option>
                                <option value="T">Telat</option>
                                <option value="S">Sakit</option>
                                <option value="I">Ijin</option>
                                <option value="A">Absen</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="absensi_pelajaran_keterangan" rows="3" placeholder="Masukan Keterangan ..."></textarea>
                            <span class="help-block"></span>
                        </div>
                        <div class="alert alert-warning alert-dismissible" style="display:none">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Error!</h4>
                            Warning alert preview. This alert is dismissable.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" id="btnSaveAbsensiPelajaran">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>