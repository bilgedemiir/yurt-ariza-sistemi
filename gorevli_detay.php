<?php
include "db.php";
session_start();

if($_SESSION["user"]["rol"]!="gorevli"){
    header("Location: giris.php");
    exit;
}


$id = $_GET['id'];


$sql = "SELECT arizalar.*, kullanicilar.ad_soyad, odalar.oda_no, odalar.bina
        FROM arizalar
        JOIN kullanicilar ON kullanicilar.id = arizalar.ogrenci_id
        JOIN odalar ON odalar.id = arizalar.oda_id
        WHERE arizalar.id = $id";

$result = $conn->query($sql);
$ariza = $result->fetch_assoc();

if (!$ariza) {
    echo "Arıza bulunamadı.";
    exit;
}
include "header.php";
?>

<center>
<h2>Arıza Detayı</h2>

<p><strong>Başlık:</strong> <?php echo $ariza['baslik'] ?> </p>
<p><strong>Açıklama:</strong> <?php echo  $ariza['aciklama'] ?> </p>
<p><strong>Öğrenci:</strong> <?php echo $ariza['ad_soyad'] ?> </p>
<p><strong>Oda:</strong> <?php echo $ariza['oda_no'] ?>
<p><strong>Bina:</strong> <?php echo $ariza['bina'] ?> </p>
<p><strong>Durum:</strong> <?php echo $ariza['durum'] ?> </p>
<p><strong>Bildirim Tarihi:</strong> <?php echo $ariza['tarih'] ?> </p>

<hr>

<h3>Durumu Güncelle</h3>

<form method="POST">
    <select name="yeni_durum">
        <option value="acik"        <?php echo $ariza['durum'] == "acik" ? "selected" : "" ?>>Açık</option>
        <option value="islemde"     <?php echo $ariza['durum'] == "islemde" ? "selected" : "" ?>>İşlemde</option>
        <option value="tamamlandi"  <?php echo $ariza['durum'] == "tamamlandi" ? "selected" : "" ?>>Tamamlandı</option>
    </select>

    <button type="submit">Kaydet</button>
</form>

<br>
<a href="gorevli_panel.php">← Geri Dön</a>

<?php

if (isset($_POST['yeni_durum'])) {
    $durum = $_POST['yeni_durum'];

    $conn->query("UPDATE arizalar SET durum='$durum' WHERE id=$id");

    echo "<p><b>Durum başarıyla güncellendi!</b></p>";
    echo "<meta http-equiv='refresh' content='1'>";
}
?>
</center>
<?php include "footer.php"; ?>