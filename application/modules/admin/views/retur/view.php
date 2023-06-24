<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Retur Order #<?php echo $retur->order_number; ?></h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><?php echo anchor('admin/retur', 'Retur'); ?></li>
                  <li class="breadcrumb-item active" aria-current="page">Order #<?php echo $retur->order_number; ?></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-md-8">
          <div class="card-wrapper">
            <div class="card">
              <div class="card-header">
                <h3 class="mb-0">Retur Order #<?php echo $retur->order_number; ?></h3>
                <?php if ($flash) : ?>
                <span class="float-right text-success font-weight-bold" style="margin-top: -30px;"><?php echo $flash; ?></span>
                <?php endif; ?>
              </div>
              <div class="card-body p-0">
              <table class="table align-items-center table-flush table-hover">
              <tr>
                        <td>Judul</td>
                        <td><b><?php echo $retur->title; ?></b></td>
                    </tr>
                    <tr>
                        <td>Order</td>
                        <td><b>#<?php echo $retur->order_number; ?></b></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><b><?php echo get_formatted_date($retur->retur_date); ?></b></td>
                    </tr>
                    <tr>
                        <td>Retur</td>
                        <td><b><?php echo $retur->retur_text; ?></b></td>
                    </tr>
                    <tr>
                    <td>Bukti Upload</td>
                                <td>
                                    <img src="<?php echo base_url($retur->upload_proof); ?>" alt="Bukti Upload" width="200">
                                </td>
                    </tr>
                </table>
                    <div class="card-footer">
                    <form action="<?php echo site_url('admin/retur/validasi_proof'); ?>" method="POST">
                    <input type="hidden" name="retur" value="<?php echo $retur->id; ?>">
                      <div class="row">
                        <div class="col-md-10">
                          <div class="form-group">
                            <?php if ($retur->validasi_proof == 1) : ?>
                            <select class="form-control" id="status" name="status">
                              <option value="2"<?php echo ($retur->status == 2) ? ' selected' : ''; ?>>Menunggu Konfirmasi</option>
                              <option value="3"<?php echo ($retur->status == 3) ? ' selected' : ''; ?>>Dikonfirmasi </option>
                              <option value="4"<?php echo ($retur->status == 4) ? ' selected' : ''; ?>>Gagal</option>
                            </select>
                            <?php else : ?>
                            <select class="form-control" id="status" name="status">
                              <option value="2"<?php echo ($retur->status == 2) ? ' selected' : ''; ?>>Menunggu Konfirmasi</option>
                              <option value="3"<?php echo ($retur->status == 3) ? ' selected' : ''; ?>>Dikonfirmasi </option>
                              <option value="4"<?php echo ($retur->status == 4) ? ' selected' : ''; ?>>Gagal</option>
                            </select>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="text-right">
                            <input type="submit" value="OK" class="btn btn-md btn-primary">
                          </div>
                        </div>
                      </div>
                </form>
              </div>
              </div>
            </div>
            
          </div>

        </div>
        <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                  <h3 class="mb-0">Tindakan</h3>
              </div>
              <div class="card-body">
              <a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
                <i class="fa fa-trash"></i> Hapus
            </a>
              </div>
              
            </div>
        </div>
      </div>

      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletelModalLabel">Hapus Retur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="deleteText">Anda yakin ingin menghapus retur?</p>
      </div>
      <div class="modal-footer">
      <?php echo anchor('admin/retur/delete/'. $retur->id, 'Hapus', array('class' => 'btn btn-danger')); ?>
      </div>
    </div>
  </div>
</div>