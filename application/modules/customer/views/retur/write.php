<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
            <?php echo form_open_multipart('customer/retur/write_me'); ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="title" class="form-control-label">Judul Retur</label>
                    <input type="text" name="title" value="<?php echo set_value('title'); ?>" class="form-control" id="title" required>
                    <?php echo form_error('title'); ?>
                </div>

                <div class="form-group">
                    <label for="order_id" class="form-control-label">Order:</label>
                    <select name="order_id" class="form-control" id="order_id">
                        <?php if (count($orders) > 0) : ?>
                            <?php foreach ($orders as $order) : ?>
                                <option value="<?php echo $order->id; ?>" <?php echo set_select('order_id', $order->id); ?>><?php echo '#' . $order->order_number; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <?php echo form_error('order_id'); ?>
                </div>

                <div class="form-group">
                    <label for="retur" class="form-control-label">Isi retur</label>
                    <textarea name="retur" class="form-control" id="retur" required><?php echo set_value('retur'); ?></textarea>
                    <?php echo form_error('retur'); ?>
                </div>

                <div class="form-group">
                    <label for="upload_proof" class="form-control-label">Upload Proof</label>
                    <input type="file" name="upload_proof" class="form-control-file" id="upload_proof">
                    <?php echo form_error('upload_proof'); ?>
                </div>

            </div>
            <div class="card-footer">
                <input type="submit" value="Tulis Retur" class="btn btn-primary">
            </div>
            </form>
        </div>
    </section>
</div>
