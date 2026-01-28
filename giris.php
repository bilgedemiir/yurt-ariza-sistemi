<?php
include "db.php";
include "header.php";
session_start();

if (isset($_POST["email"],$_POST["sifre"])){
    $email=$_POST["email"];
    $sifre=$_POST["sifre"];

    $sql="SELECT * FROM kullanicilar WHERE email='$email' AND sifre='$sifre'";
    $result=$conn->query($sql);

    if ($result->num_rows>0){
        $user=$result->fetch_assoc();
        $_SESSION["user"]=$user;
        if($user["rol"]=="ogrenci") header("Location: ogrenci_panel.php");
        if($user["rol"]=="gorevli") header("Location: gorevli_panel.php");
        if($user["rol"]=="yonetici") header("Location: yonetici_panel.php");
        exit;
    } else { $hata="Email veya şifre hatalı."; }
}

?>

<center>
    <div>
        <h2>Giriş Yap</h2>

        <form method="POST">
            <div>
                <label>Email:</label>
                <input type="text" name="email">
            </div>

            <div>
                <label>Şifre:</label>
                <input type="password" name="sifre">
            </div>

            <div>
                <button type="submit">Giriş Yap</button>
            </div>
        </form>

        <?php if (isset($hata)) { ?>
            <div>
                <?php echo $hata; ?>
            </div>
        <?php } ?>
    </div>
</center>


