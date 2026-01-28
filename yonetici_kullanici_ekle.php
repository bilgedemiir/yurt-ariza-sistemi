<?php
include "db.php";
session_start();

if($_SESSION['user']['rol'] != 'yonetici'){
    header("Location: giris.php");
    exit;
}

if(isset($_POST['ad'])){
    $ad = $_POST['ad'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];
    $rol = $_POST['rol'];

    if ($_POST['oda_id'] != "") {
        $oda = $_POST['oda_id'];
    } else {
        $oda = "NULL";

        if ($rol == "ogrenci" && $_POST['oda_id'] == "") {
            echo "Öğrenci için oda seçmek zorunludur!";
            exit;
        }
    }

    $conn->query("INSERT INTO kullanicilar(ad_soyad,email,sifre,rol,oda_id)
                  VALUES('$ad','$email','$sifre','$rol',$oda)");

    echo "Kullanıcı eklendi.";
}

$odalar = $conn->query("SELECT * FROM odalar");
include "header.php";
?>

<center>
    <div>
        <h2>Yeni Kullanıcı Ekle</h2>

        <a href="yonetici_kullanicilar.php">← Geri Dön</a> <br><br>

        <form method="POST">
            <div>
                Ad Soyad:<br>
                <input type="text" name="ad">
            </div> <br>

            <div>
                Email:<br>
                <input type="text" name="email">
            </div> <br>

            <div>
                Şifre:<br>
                <input type="password" name="sifre">
            </div> <br>

            <div>
                Rol:<br>
                <select name="rol">
                    <option value="ogrenci">Öğrenci</option>
                    <option value="gorevli">Görevli</option>
                    <option value="yonetici">Yönetici</option>
                </select>
            </div> <br>

            <div>
                Oda:<br>
                <select name="oda_id">
                    <option value="">Oda Yok</option>

                    <?php while ($oda = $odalar->fetch_assoc()) { ?>
                        <option value="<?= $oda['id'] ?>">
                            <?= $oda['oda_no'] . " (" . $oda['bina'] . ")" ?>
                        </option>
                    <?php } ?>
                </select>
            </div> <br><br>

            <button type="submit">Kaydet</button>

        </form>
    </div>
</center>

<?php include "footer.php"; ?>
