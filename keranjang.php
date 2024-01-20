
<?php
include("koneksi.php");
header("Cache-Control: no-cache, must-revalidate");

$result = $conn->query("SELECT keranjang.id_pembelian, nama_pembeli, jersey.nama_jersey, jumlah, harga
                        FROM keranjang
                        JOIN jersey ON keranjang.id_jersey = jersey.id_jersey");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_item_modal'])) {
        $id_item = $_POST["id_pembelian"];
        $new_jumlah = $_POST["modal_jumlah"];

        $conn->query("UPDATE keranjang SET jumlah = $new_jumlah WHERE id_pembelian = $id_item");
        header("Location: keranjang.php");
        exit();
    }

    if (isset($_POST['delete_item'])) {
        $item_id = $_POST["id_pembelian"];
        $conn->query("DELETE FROM keranjang WHERE id_pembelian = $item_id");
        header("Location: keranjang.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liverpool Shop</title>
    <link rel="icon" href="image/Liverpool_FC.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body style="background: url('image/anfield.jpg') center/cover no-repeat;">
<?php include 'sidebar.php'; ?>
<div class="container" style="background: white; width: 1100px">
    <h1>Shopping Cart</h1>
        <center>
    <table>
        <thead>
            <tr>
                <th>Nama Pembeli</th>
                <th>Nama Jersey</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                $total = $row['jumlah'] * $row['harga'];
                echo "<tr>
                        <td>{$row['nama_pembeli']}</td>
                        <td>{$row['nama_jersey']}</td>
                        <td>{$row['jumlah']}</td>
                        <td>Rp " . number_format($row['harga']) . "</td>
                        <td>Rp " . number_format($total) . "</td>
                        <td>
                            <button onclick='openEditModal(\"{$row['nama_pembeli']}\", \"{$row['nama_jersey']}\", {$row['jumlah']}, {$row['id_pembelian']})'>Edit</button>
                            <form method='post' action='keranjang.php' onsubmit='return confirm(\"Are you sure?\");'>
                                <input type='hidden' name='id_pembelian' value='{$row['id_pembelian']}'>
                                <button type='submit' name='delete_item'>Delete</button>
                            </form>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
    </center>
    <!-- Modal -->
    <div class="container">
    <div id="editModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="keranjang.php">
            <label for="modal_jersey">Nama Jersey:</label>
            <input type="text" id="modal_jersey" name="modal_jersey" readonly>
            <br><br>
            <label for="modal_jumlah">Jumlah:</label>
            <input type="number" id="modal_jumlah" name="modal_jumlah" required>
            <br>
            <input type="hidden" id="modal_item_id" name="id_pembelian">    
            <input type="hidden" name="new_jumlah" value="" id="modal_new_jumlah">
            <br>
            <button class="btn btn-primary" type="submit" name="edit_item_modal">Save</button><br><br>
        </form>
        <button class="btn btn-secondary" onclick="closeEditModal()">Close</button>
        </div>
    </div>
    </div>
  </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function openEditModal(nama_pembeli, nama_jersey, jumlah, id_pembelian) {
            document.getElementById('modal_jersey').value = nama_jersey;
            document.getElementById('modal_jumlah').value = jumlah;
            document.getElementById('modal_item_id').value = id_pembelian;
            document.getElementById('modal_new_jumlah').value = ''; // Clear the value
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
    
</div>
</body>
</html>
