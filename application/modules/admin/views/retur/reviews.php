<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Retur Pelanggan</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Retur</li>
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
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0">Kelola Retur</h3>
            </div>

            <?php if ( count($returs) > 0) : ?>
            <div class="card-body p-0">
                <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Order</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Retur</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bukti Upload</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($returs as $retur) : ?>
                  <tr>
                    <th scope="col">
                      <?php echo $retur->id; ?>
                    </th>
                    <td><?php echo anchor('admin/retur/view/'. $retur->id, '#'. $retur->order_number); ?></td>
                    <td>
                      <?php echo $retur->name; ?>
                    </td>
                    <td>
                      <?php echo get_formatted_date($retur->retur_date); ?>
                    </td>
                    <td>
                      <?php echo $retur->retur_text; ?>
                    </td>
                    <td>
                      <?php echo get_retur_status($retur->validasi_proof, $retur->status); ?>
                    </td>
                    <td>
                        <?php if ($retur->upload_proof) : ?>
                            <a href="<?php echo base_url($retur->upload_proof); ?>" target="_blank">Lihat Bukti</a>
                        <?php else : ?>
                             Tidak Ada Bukti
                        <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
                </div>
            
            <div class="card-footer">
                <?php echo $pagination; ?>
            </div>
            <?php else : ?>
             <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="alert alert-primary">
                           Belum ada retur dari user
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
          </div>
        </div>
      </div>