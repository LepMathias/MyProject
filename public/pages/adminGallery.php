<?php
session_start();
if($_SESSION['admin'] === 1 || $_SESSION['admin'] === 2){
    include './includes/header.php';
    include './includes/adminHeader.php'
    ?>
    <div class="container-fluid gallery-menu" id="gallery-menu">
        <div id="gallery-menu">
            <div class="row ">
                <div class="col-md-2">
                    <form name="gallery-form" enctype="multipart/form-data" method="post" action="">
                        <label class="form-label text-center" for="uploadedFile">Choisissez une photo à ajouter</label>
                        <input class="form-control" type="file" id="uploadedFile" name="uploadedFile"
                               accept="image/png, imgae/jpeg, image/jpg, image/gif">

                        <label class="form-label" for="title">Nom de la photo</label>
                        <input class="form-control" type="text" id="title" name="pictureTitle">

                        <input name="upload-picture" value="pictureUploaded" type="hidden"/>
                        <button type="submit" class="btn btn-menu btn-success mt-3 mb-3">Upload</button>
                    </form>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center">
                        <?php
                        foreach ($allPictures as $picture) {
                            include './includes/adminPictureView.php';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include './includes/scriptsIncluded.php';

} else {
    header('location: /');
}
?>