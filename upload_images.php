<?php
$target_dir = "uploads/";

echo '<body style="background-color:'.$_POST['colour'].';"></body>';
echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
echo "<br>";
echo "The file ". basename( $_FILES["fileToUpload2"]["name"]). " has been uploaded.";
echo "<br>";
echo "The file ". basename( $_FILES["fileToUpload3"]["name"]). " has been uploaded.";
echo "<br>";
echo "The file ". basename( $_FILES["fileToUpload4"]["name"]). " has been uploaded.";
echo "<br>";

//image 1
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
$file = $_FILES["fileToUpload"]["name"];
$file_path = "uploads/" . $file;
echo "<br>";
echo '<img src="'.$file_path.'" height="400px" width="400px"/>';
echo $_POST["filecaption"];

//image2
$target_file = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file);
$file = $_FILES["fileToUpload2"]["name"];
$file_path = "uploads/" . $file;
echo '<img src="'.$file_path.'" height="400px" width="400px"/>';
echo $_POST["filecaption2"];

//image3
$target_file = $target_dir . basename($_FILES["fileToUpload3"]["name"]);
move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"], $target_file);
$file = $_FILES["fileToUpload3"]["name"];
$file_path = "uploads/" . $file;
echo "<br>";
echo '<img src="'.$file_path.'" height="400px" width="400px"/>';
echo $_POST["filecaption3"];

//image4
$target_file = $target_dir . basename($_FILES["fileToUpload4"]["name"]);
move_uploaded_file($_FILES["fileToUpload4"]["tmp_name"], $target_file);
$file = $_FILES["fileToUpload4"]["name"];
$file_path = "uploads/" . $file;
echo '<img src="'.$file_path.'" height="400px" width="400px"/>';
echo $_POST["filecaption4"];

/*// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;

    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
/upload to webpage
    $sImage = $_FILES["fileToUpload"]["name"];
    echo '<p>The image has been uploaded successfully</p><p>Preview:</p><img src="' . $sImage . '" alt="Your Image" />';

	} else {
        echo "Sorry, there was an error uploading your file.";
    }
}*/


?>
