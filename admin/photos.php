<?php include ("includes/header.php");

if(!$session->is_signed_in()){
    redirect('login.php');
}
$photos = Photo::find_all();

?>
<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content-top.php"); ?>
<?php include ("includes/footer.php"); ?>

