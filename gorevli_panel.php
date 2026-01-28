<?php
include "db.php";
session_start();

if($_SESSION["user"]["rol"]!="gorevli"){
    header("Location: giris.php");
    exit;
}

include "header.php";
?>

<center>
    <h2>Görevli Paneli</h2>
    <p>Hoşgeldiniz, <?php echo $_SESSION['user']['ad_soyad']; ?></p>

    <a href="cikis.php">Çıkış Yap</a>
    <br><br>

    <?php
    $sql = "SELECT arizalar.*, kullanicilar.ad_soyad, odalar.oda_no 
            FROM arizalar
            JOIN kullanicilar ON kullanicilar.id = arizalar.ogrenci_id
            JOIN odalar ON odalar.id = arizalar.oda_id
            ORDER BY arizalar.tarih DESC";

    $result = $conn->query($sql);
    ?>

    <table border="1" cellpadding="8" cellspacing="0" bgcolor="white">
        <tr bgcolor="#f2f2f2">
            <th>Başlık</th>
            <th>Öğrenci</th>
            <th>Oda</th>
            <th>Durum</th>
            <th>Tarih</th>
            <th>İşlem</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['baslik']; ?></td>
            <td><?php echo $row['ad_soyad']; ?></td>
            <td><?php echo $row['oda_no']; ?></td>
            <td><?php echo $row['durum']; ?></td>
            <td><?php echo $row['tarih']; ?></td>
            <td><a href="gorevli_detay.php?id=<?php echo $row['id']; ?>">Detay</a></td>
        </tr>
        <?php } ?>
    </table>
</center>

<?php include "footer.php"; ?>
