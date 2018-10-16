<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">

		<p>
			<a href="<?= base_url().'admin/Resep/New' ?>" class="btn btn-primary btn-sm"> Create New</a>
		</p> <br>

		<?php if(isset($message)) { ?>
			<div class="alert alert-success alert-link"><?=$message?></div>
			<?php } ?>


			<div class="col-lg-9" id="article">

				<div class="form-group row">
					<input class="search form-control" placeholder="search article" onkey="alert('reset')">
				</div>

				<div class="list">
					<?php foreach ($resep as $row) {
						
						?>
						<div class="row">
							<div class="panel panel-default article">
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-12">
											<span class="title"><?= $row->judul; ?></span>
											<div class="pull-right">
												<a href="<?= base_url() ?>admin/Resep/editResep/<?= $row->id_resep ?>">
													<i class="fa fa-edit"></i>
												</a>
												&nbsp;
												<a href="<?= base_url() ?>admin/Resep/deleteResep/<?= $row->id_resep ?>" onclick="return confirm('Delete Resep ?')">
													<i class="fa fa-trash-o"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<?php } ?>
					</div>
					<ul class="pagination">

					</ul>
				</div>
				
				</div>
			</div>
		</div>
