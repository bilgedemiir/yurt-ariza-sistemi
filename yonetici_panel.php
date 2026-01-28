<?php
include "db.php";
session_start();

if($_SESSION['user']['rol'] != 'yonetici'){
    header("Location: giris.php");
    exit;
}
include "header.php";
?>

<center>
    <div>
        <h2>Yönetici Paneli</h2>
        <p>Hoşgeldiniz, <?php echo $_SESSION["user"]["ad_soyad"]; ?></p>

        <div style="margin:15px;">
            <a href="yonetici_kullanicilar.php">
                <button>Kullanıcılar</button>
            </a>
        </div>

        <div style="margin:15px;">
            <a href="yonetici_arizalar.php">
                <button>Arıza Listesi</button>
            </a>
        </div>

        <div style="margin:15px;">
            <a href="cikis.php">
                <button>Çıkış Yap</button>
            </a>
        </div>
    </div>
</center>

<?php include "footer.php"; ?>
