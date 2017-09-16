<div class="">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Data Dokumen</h2>
					<ul class="nav navbar-right panel_toolbox">
                      <a type="button" class="btn btn-primary btn-sm" href="index.php?link=tambahdokumen">Tambah Dokumen</a>
                    </ul>
					<div class="clearfix"></div>

				</div>
				<?php
				include 'koneksi.php';
				$result = mysqli_query($koneksi,"SELECT * FROM tb_dokumen ORDER BY Id");
				$warna = "#DFE3FF";
				?>
				<div class="table-responsive">
					<table id="datatable" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Dokumen</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while($row = mysqli_fetch_array($result)) {
							if($warna=="#DFE3FF"){$warna="#DFF0D8";}else{$warna="#DFE3FF";}
							print("<tr bgcolor='$warna'>");
								print("<td>" . $row['Id'] . ". <font color =blue>" . $row['Judul'] . "</font><br /><textarea class='form-control' cols='160%' >" . $row['Isi']."</textarea>
									</td>");
							print("</tr>");
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>