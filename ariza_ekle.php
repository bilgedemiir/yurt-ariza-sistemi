<?php
include "db.php";
session_start();

if($_SESSION["user"]["rol"]!="ogrenci"){
    header("Location: login.php");
    exit;
}

if(isset($_POST["baslik"])){
    $baslik=$_POST["baslik"];
    $aciklama=$_POST["aciklama"];
    $kategori=$_POST["kategori"];
    $ogrenci_id=$_SESSION["user"]["id"];
    $oda_id=$_SESSION["user"]["oda_id"];

    $sql="INSERT INTO arizalar(baslik,aciklama,kategori,ogrenci_id,oda_id)
          VALUES('$baslik','$aciklama','$kategori',$ogrenci_id,$oda_id)";
    $conn->query($sql);

    echo "ARIZA BİLDİRİMİ OLUŞTURULDU.";
}

include "header.php";
?>

<center>
    <h2>Arıza Ekle</h2>

    <form method="POST">
        <div>
            <label>Başlık:</label><br>
            <input type="text" name="baslik">
        </div>

        <div>
            <label>Açıklama:</label><br>
            <textarea name="aciklama"></textarea>
        </div>

        <div>
            <label>Kategori:</label><br>
            <select name="kategori">
                <option value="ariza">Arıza</option>
                <option value="temizlik">Temizlik</option>
                <option value="diger">Diğer</option>
            </select>
        </div>

        <br>

        
        <table>
            <tr>
                <td>
                    <a href="ogrenci_panel.php">Geri Dön</a>
                </td>
                <td>
                    <button type="submit">Gönder</button>
                </td>
            </tr>
        </table>
    </form>
</center>

<?php include "footer.php"; ?>
