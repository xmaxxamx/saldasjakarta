<form method="post" action="<?php echo base_url('data/Data_order/uploadReceipt'); ?>" enctype="multipart/form-data">
	<section class="ftco-section">
		<div class="container">
			<div>
				<?php echo $this->session->flashdata('message');?>
			</div>
			<div class="row justify-content-center">
				<div class="col-xl-7 ftco-animate">
					<h3 class="mb-4 billing-heading">Detail Pembayaran</h3>
					<?php foreach($getPesanan->result() as $row): $bank = $row->bank; $acc = $row->acc_number; $name = $row->acc_name; ?>
						<div class="row align-items-end">
							<div class="col-md-6">
								<div class="form-group">
									<label for="towncity">ID Transaksi</label>
									<input type="text" readonly class="form-control" placeholder="" id="kota" name="kota" value="<?php echo $row->transaction_id;?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="postcodezip">Metode Pembayaran</label>
									<input type="text" readonly class="form-control" placeholder="" id="provinsi" name="provinsi" value="<?php echo $row->metode_pembayaran;?>">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="towncity">Status</label>
									<input type="text" readonly class="form-control" placeholder="" id="kota" name="kota" value="<?php echo $row->status;?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="postcodezip">Bukti Transfer Pembayaran</label>
									<?php if ($row->file == NULL) { ?>
										<input type="hidden" class="form-control" placeholder="" id="id_pesanan" name="id_pesanan" value="<?php echo $row->id_pesanan;?>">
										<input type="file" readonly required class="form-control" placeholder="" id="file_receipt" name="file_receipt">
									<?php } else { ?>
										<a href="<?php echo base_url('data/Data_order/download/'.$row->id_pesanan); ?>" class="btn btn-primary form-control">Download Bukti Pembayaran</a>
									<?php } ?>
								</div>
							</div>
							<?php if ($row->status == 'CANCELLED') { ?>
							<?php } ?>
							<?php if ($row->status != 'CANCELLED' && $row->file == NULL) { ?>
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary form-control">Submit Bukti Transfer Pembayaran</button>
										</div>
									</div>
								<?php } ?>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="col-xl-5">
					<div class="row mt-5 pt-3">
						<div class="col-md-12 d-flex mb-5">
							<div class="cart-detail cart-total p-3 p-md-4">
								<h3 class="billing-heading mb-4">Pembayaran</h3>
								<p class="d-flex">
								<span><b><?php echo $bank.' No. Rek '.$acc;?></b></span>
								<span>Atas Nama <?php echo $name;?></span>
								</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 d-flex mb-5">
							<div class="cart-detail cart-total p-3 p-md-4">
								<h3 class="billing-heading mb-4">Ringkasan Keranjang</h3>
								<div id="cart_summary">

								</div>

								<p class="d-flex total-price">
									<span>Total</span>
									<span id="total_summary"></span>
								</p>
							</div>
						</div>
					</div>
				</div> <!-- .col-md-8 -->
			</div>
		</div>
	</section>
</form>

<?php
if(!isset($_SESSION['logged_in']['username'])){                                
            // redirect('Login');
} else { ?>
	<script src="<?php echo base_url() ?>/assets/backend/js/detail_product.js"></script>
	<script type="text/javascript">
		getDetailPesanan('CART.SUMMARY', '<?php echo $this->uri->segment('3'); ?>', '<?php echo $this->uri->segment('4'); ?>');
          	// sumOrder('CART.SUMMARY', id);
          </script>
          <?php } ?>