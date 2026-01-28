<?php
session_start();
include "header.php";
?>

<center>
    <div>
        <h2>Hoşgeldin <?php echo $_SESSION['user']['ad_soyad']; ?></h2>

        <div style="margin:15px;">
            <a href="ariza_ekle.php">
                <button>Arıza Ekle</button>
            </a>
        </div>

        <div style="margin:15px;">
            <a href="arizalarim.php">
                <button>Arızalarım</button>
            </a>
        </div>

        <div style="margin:15px;">
            <a href="cikis.php">
                <button>Çıkış</button>
            </a>
        </div>
    </div>
</center>

<?php include "footer.php"; ?>
