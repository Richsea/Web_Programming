<?php
// data file directory :: can save only txt
$data_dir = "./data/";
$data_file = fopen($data_dir . "booklist.txt", 'a+');
$book_name = htmlspecialchars($_POST['pname']);
$book_price = htmlspecialchars($_POST['price']);
$book_amount = htmlspecialchars($_POST['amount']);

// img file directory :: can save .jpg, .jpeg, .png, .gif
$img_dir = "./uploads/";
$img_file = $img_dir . basename($_FILES["update_file"]["name"]);
$imgFileType = getExt($img_file);

$uploadOk = 1;

// Check if file already exists
if(file_exists($img_file))
{
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "gif")
{
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if($uploadOk == 0)
{
    echo "Sorry, your file was not uploaded.";
}
else
{
    if(move_uploaded_file($_FILES["update_file"]["tmp_name"], $img_file))
    {
        fwrite($data_file, $book_name . '|' . $book_price . '|' . $book_amount . '|' . $img_file . "\r\n");
        echo("<script>location.replace('./Saved.html');</script>");
    }
    else
    {
        echo "Sorry, there was an error uploading your file.";
    }
}

function getExt($filename, $file_str = "/php|html|htm|exe|ph/")
{
    $ext_array = explode(".", $filename);       // split data with '.'
    $ext = $ext_array[count($ext_array)-1];     // get last extension
    $ext = strtolower($ext);
    $ext_array = strtolower($file_str);

    if(preg_match($file_str, $ext))
    {
        error("cannot upload file");
        $ext = null;
        $uplaodOk = 0;
    }
    
    return $ext;
}

?>