
<?php

require_once ('database.php');
require_once ('sql.php');

$obj = new crud;

if($_SERVER['REQUEST_METHOD']=='POST'):
	$nim  = $_POST['nim'];
	$nama = $_POST['nama_mahasiswa'];
	if($obj->insertData($nim, $nama)):
		echo '<div class="alert alert-success">Data berhasil disimpan</div>';
	else:

		echo '<div class="alert alert-danger">Data berhasil disimpan</div>';
	endif;
endif;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tutorial PHP : CRUD PDO PHP</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
	<div class="container">
		<div class="card shadow mb-4 mt-4">
	        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		        <div class="card-body">
					<div class="row">
						
						<div class="col-md-4">
							<div class="form-group">
								<label>NIM :</label>
								<input type="text" class="form-control" name="nim"/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>NAMA MAHASISWA :</label>
								<input type="text" class="form-control" name="nama_mahasiswa"/>
							</div>
						</div>
						<div class="col-md-4">
							
								<button type="submit" class="mt-4 btn btn-md btn-primary"> Simpan</button>
						
						</div>
					</div>
				</div>
			</form>
			<div class="row m-auto">
				<table class="table table-bordered">
					<tr>
						<th>NO</th>
						<th>NIM</th>
						<th>NAMA MAHASISWA</th>
						<th>AKSI</th>
					</tr>
					<?php 
					$no=1;
						$data=$obj->showData();
						if($data->rowCount()>0){
						while($row=$data->fetch(PDO::FETCH_ASSOC)){
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $row['nim']; ?></td>
						<td><?php echo $row['nama_mahasiswa']; ?></td>
						<td>
							<?php echo "<a class='btn btn-sm btn-primary' href='edit.php?id_mahasiswa=".$row['id_mahasiswa']."'>edit</a>"; ?>
							<?php echo "<a class='btn btn-sm btn-primary' href='delete.php?id_mahasiswa=".$row['id_mahasiswa']."'>delete</a>"; ?>
						</td>
					</tr>
					<?php $no+=1; } $data->closeCursor();

									}else{
										echo '
											<tr>
												<td> Not found</td>
											</tr>
										';
									}
									?>
				</table>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>