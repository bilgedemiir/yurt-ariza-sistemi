<?php
include "db.php";
session_start();

if ($_SESSION['user']['rol'] != 'ogrenci') {
    header("Location: giris.php");
    exit;
}

$ogrenci_id = $_SESSION['user']['id'];

$sql = "SELECT * FROM arizalar WHERE ogrenci_id = $ogrenci_id ORDER BY id DESC";
$result = $conn->query($sql);

include "header.php";
?>

<center>
    <div>
        <a href="ogrenci_panel.php">Geri Dön</a>
        <h2>Arızalarım</h2>

        <table border="1" cellpadding="10" bgcolor="white">
            <tr bgcolor="#ffffffff">
                <th>Başlık</th>
                <th>Kategori</th>
                <th>Durum</th>
                <th>Tarih</th>
            </tr>

            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['baslik'] ?></td>
                <td><?= $row['kategori'] ?></td>
                <td><?= $row['durum'] ?></td>
                <td><?= $row['tarih'] ?></td>
            </tr>
            <?php
             }
            ?>
        </table>
    </div>
</center>

<?php include "footer.php"; ?>
