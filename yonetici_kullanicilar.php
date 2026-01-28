<?php
include "db.php";
session_start();

if($_SESSION['user']['rol'] != 'yonetici'){
    header("Location: giris.php");
    exit;
}

if(isset($_GET['sil'])){
    $id = $_GET['sil'];
    $conn->query("DELETE FROM kullanicilar WHERE id=$id");
}
include "header.php";
?>

<center>
    <h2>Kullanıcılar</h2>

    <a href="yonetici_kullanici_ekle.php">Yeni Kullanıcı Ekle</a> <br><br>

    <?php
    $result = $conn->query("SELECT * FROM kullanicilar");
    ?>

    <table border="1" cellpadding="8" bgcolor="white">
        <tr bgcolor="#f2f2f2">
            <th>Ad Soyad</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Oda</th>
            <th>İşlem</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['ad_soyad']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['rol']; ?></td>
            <td><?php echo $row['oda_id']; ?></td>
            <td><a href="?sil=<?php echo $row['id']; ?>">Sil</a></td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="yonetici_panel.php">← Geri Dön</a>
</center>
<?php include "footer.php"; ?>
