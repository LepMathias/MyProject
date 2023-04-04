<?php
session_start();
if($_SESSION['admin'] === 1){
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5s
        mXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="../../src/script/adminScript.js"></script>

    </body>
    </html>

<?php
} else {
    header('location: /');
}
?>