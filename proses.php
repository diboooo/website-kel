<?php
include("koneksi.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pembeli = $_POST["nama_pembeli"];
    $id_jersey = $_POST["id_jersey"];
    $jumlah = $_POST["jumlah"];

    $stmt = $conn->prepare("INSERT INTO keranjang (nama_pembeli, id_jersey, jumlah) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $nama_pembeli, $id_jersey, $jumlah);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

if (isset($_POST['edit_item'])) {
    $item_id = $_POST["id_pembelian"];
    $new_jumlah = $_POST["new_jumlah"];

    $stmt = $conn->prepare("UPDATE keranjang SET jumlah = ? WHERE id_pembelian = ?");
    $stmt->bind_param("ii", $new_jumlah, $item_id);
    $stmt->execute();

    $stmt->close();
}

if (isset($_POST['delete_item'])) {
    $item_id = $_POST["item_id"];

    $stmt = $conn->prepare("DELETE FROM keranjang WHERE id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();

    $stmt->close();
}

header("Location: keranjang.php");
exit();