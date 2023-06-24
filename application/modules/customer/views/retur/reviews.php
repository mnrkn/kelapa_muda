<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Retur Saya</h1>
                </div>
                <div class="col-sm-1"> 
                    <?php echo anchor('customer/retur/write', 'buat Retur Baru'); ?>
                </div>
                <div class="col-sm-5">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Beranda'); ?></li>
                        <li class="breadcrumb-item active">Retur</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
        <div class="card-body<?php echo (count($returs) > 0) ? ' p-0' : ''; ?>">
        
                <?php if (count($returs) > 0) : ?>
                    <div class="table-responsive">
                        <table class="table table-striped m-0">
                            <tr class="bg-primary">
                                <th scope="col">No.</th>
                                <th scope="col">Order</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Retur</th>
                                <th scope="col">Status</th>
                                <th scope="col">Bukti Upload</th>
                            </tr>
                            <?php foreach ($returs as $returs) : ?>
                                <tr>
                                    <td><?php echo $returs->id; ?></td>
                                    <td><?php echo anchor('customer/retur/view/' . $returs->id, '#' . $returs->order_number); ?></td>
                                    <td><?php echo get_formatted_date($returs->retur_date); ?></td>
                                    <td><?php echo $returs->retur_text; ?></td>
                                    <td><?php echo get_retur_status($returs->validasi_proof, $returs->status); ?></td>
                                    <td>
                                        <?php if ($returs->upload_proof) : ?>
                                            <a href="<?php echo base_url($returs->upload_proof); ?>" target="_blank">Lihat Bukti</a>
                                        <?php else : ?>
                                            Tidak Ada Bukti
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                Belum ada retur yang dibuat. Silakan tulis baru.
                            </div>

                            <?php echo anchor('customer/retur/write', 'Tulisan retur baru'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($pagination) : ?>
                <div class="card-footer">
                    <?php echo $pagination; ?> 
                </div>
            <?php endif; ?>

        </div>
    </section>
</div>
