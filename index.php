<?php
include ("includes/header.php");

$photos = Photo::find_all();

?>

<!-- Page Content -->
  <div class="container">

    <div class="row">
      <!-- Post Content Column -->
      <div class="col-12">
        <!-- Title -->
        <h1>Homepagine: Foto's</h1>
            <?php foreach ($photos as $photo): ?>
            <div class="col-3">
                <a href="photo.php?id=<?php echo $photo->id;?>">
                <img src="<?php echo 'admin' .DS.$photo->picture_path(); ?>" alt="" class=" img-fluid"></a>
            </div>
          <?php endforeach; ?>
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php include("includes/footer.php");?>
