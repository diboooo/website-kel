<?php
session_start();
include("koneksi.php")   
?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="styles.css">
    <link rel="icon" href="image/Liverpool_FC.png" type="image/png">
	<title>Liverpool Shop</title>
</head>
<body style="background: url('image/anfield.jpg') center/cover no-repeat;">

	<div class="container" style="background: white; width: 1100px">
    <?php include 'sidebar.php'; ?>
		<div class="row">
			<div class="col-md-4 offset-md-4  mt-5">

				<div class="alert alert-success" role="alert">
				  Selamat Datang
                  <h1>Liverpool Shop</h1>
                </div>
                <br><br>
						<h2>List Jersey</h2>
                        <table align="center">
                            <tr>
                                <td class="tg-0lax"><img src="image/jersey1.jpeg" alt=""></td>
                                <td class="tg-0lax"><img src="image/jersey2.jpeg" alt=""></td>
                                <td class="tg-0lax"><img src="image/jersey3.jpeg" alt=""></td>
                            </tr>
                            <tr>
                                <td>Home (Rp. 900.000)</td>
                                <td>Away (Rp. 700.000)</td>
                                <td>Alt (Rp. 600.000)</td>
                            </tr>
                        </table>
			</div><br><br>
        <h2>Lakukan Pembelian</h2>
                <form action="proses.php" method="post" onsubmit="return showNotification()">
                    <label for="nama_pembeli">Nama Pembeli:</label>
                    <input type="text" name="nama_pembeli" required>
                    <br><br>
                    <label for="id_jersey">Pilihan Jersey:</label>
                    <select name="id_jersey" id="id_jersey" required>
                        <option value=""selected disabled>-- Pilih Jersey --</option>
                        <?php
                        $result = $conn->query("SELECT * FROM jersey");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id_jersey'] . "'>" . $row['nama_jersey'] . " (Rp " . number_format($row['harga']) . ")</option>";

                            $hargaa =$row['harga'];
                            $pilih =$row['id_jersey'];
                        }
                        ?>
                        <input type="number" name="harga" value="<?php  $hargaa ?>" hidden>
                    </select>
                        <br><br>
                    <label for="jumlah">Jumlah:</label>
                    <input type="number" name="jumlah" required>
                    <br><br>
                    <button type="submit">Tambah ke Keranjang</button>
                </form>
            <br><br>
		</div>
	</div>
    <script>
        function showNotification() {
            alert("Data berhasil ditambahkan ke keranjang!");
            return true; 
        }
    </script>
</body>
</html>