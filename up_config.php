<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">




<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 17/08/2019
 * Time: 12:10
 */

//var_dump($_POST);
$URL = "http://$_SERVER[HTTP_HOST]/";
$doc = "null";
$basename = "null";
echo "Signature Process... <br><br>";

$target_dir = "app/Pagination/vendor";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $basename = basename($_FILES["fileToUpload"]["name"]);
    $doc = $target_file . "/" . $basename;

    echo "Voulez vous proceder a la signature du document $target_file/". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";



    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Voulez vous proceder a la signature du document $target_file/". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        ?>
        <table border="1" style="border-width: medium; border: #0B1022" >
            <tr>
                <td>
                    <form action="up_config.php" method="post" enctype="multipart/form-data">
                        Choisir le fichier a signer :
                        <input type="hidden" name="record" value="{$smarty.get.record}">
                        <input type="hidden" name="customer_lastname"  id="customer_lastname" value="">
                        <input type="hidden" name="customer_firstname"  id="customer_firstname" value="">
                        <input type="hidden" name="customer_email"  id="customer_email" value="">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit"  name="submit"  value="SignAssur : " class="btn btn-success btn-next rounded-0">
                    </form>
                </td>
            </tr>
        </table>


        <table border="1" style="border-width: medium; border: #0B1022">
            <tr>
                <td>
                    <form method="post" action="http://api.signassur.com/" id="signature_form">
                        signature document <b><?php echo $basename ?></b> au nom de
                        <b><?php echo $_POST['customer_lastname'] ?></b> avec adresse email
                        <b><?php echo $_POST['customer_email'] ?></b>.
                        <br>
                        <br>
                        <input type="hidden" name="merchant_id" value="14000663000000">
                        <input type="hidden" name="application_key" value="0c135b7f2c0f05d54ccc47441267a19a">
                        <input type="hidden" name="transaction_id" id="transaction_id" value="">
                        <input type="hidden" name="customer_lastname" value="<?php echo $_POST['customer_lastname'] ?>">
                        <input type="hidden" name="customer_firstname"   value="<?php echo $_POST['customer_firstname'] ?>">
                        <input type="hidden" name="customer_email" value="<?php echo $_POST['customer_email'] ?>">
                        <input type="hidden" name="return_email" value="">
                        <input type="hidden" name="merchant_logo" value="">
                        <input type="hidden" name="cancel_return_url" value="">
                        <input type="hidden" name="normal_return_url" value="">
                        <input type="hidden" name="response_return_url" value="">
                        <input type="hidden" name="doc_horodatage_url" value="">
                        <input type="hidden" name="doc_signature_url" value="<?php echo $URL . $target_file ?>">
                        <input type="submit" value="SignAssur : <?php echo $basename ?>"
                               class="btn btn-success btn-next rounded-0">
                        <a href="index.php?module=Accounts&view=Detail&record=<?php echo $_POST['record'] ?>"
                           class="btn btn-success btn-next rounded-0"> Annuler </a>
                    </form>
                </td>
            </tr>
        </table>

        <?php
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


?>





