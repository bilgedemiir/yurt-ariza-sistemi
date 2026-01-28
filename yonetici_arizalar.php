<?php
include "db.php";
session_start();

if($_SESSION['user']['rol'] != 'yonetici'){
    header("Location: giris.php");
    exit;
}


if (isset($_GET['sil'])) {
    $sil_id = $_GET['sil'];
    $conn->query("DELETE FROM arizalar WHERE id = $sil_id");
}

$sql = "SELECT arizalar.*, kullanicilar.ad_soyad, odalar.oda_no, odalar.bina
        FROM arizalar
        JOIN kullanicilar ON kullanicilar.id = arizalar.ogrenci_id
        JOIN odalar ON odalar.id = arizalar.oda_id
        ORDER BY arizalar.tarih DESC";

$result = $conn->query($sql);

include "header.php";
?>

<center>
    <h2>Arıza Listesi</h2>

    <a href="yonetici_panel.php">← Geri Dön</a>
    <br><br>

    <table border="1" cellpadding="8" bgcolor="white">
        <tr bgcolor="#f2f2f2">
            <th>Başlık</th>
            <th>Öğrenci</th>
            <th>Oda</th>
            <th>Durum</th>
            <th>Tarih</th>
            <th>Sil</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['baslik']; ?></td>
            <td><?php echo $row['ad_soyad']; ?></td>
            <td><?php echo $row['oda_no']." (".$row['bina'].")"; ?></td>
            <td><?php echo $row['durum']; ?></td>
            <td><?php echo $row['tarih']; ?></td>

            <td>
                <a href="?sil=<?php echo $row['id']; ?>" 
                   onclick="return confirm('Bu arızayı silmek istediğine emin misin?');">
                   Sil
                </a>
            </td>
        </tr>
        <?php 
    } ?>
    </table>
</center>

<?php include "footer.php"; ?>
