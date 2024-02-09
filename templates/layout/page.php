<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php
            $file = __DIR__ ."/../form/register-form.php";
            if (file_exists($file) && is_readable($file)) {
                require $file;
            }
            ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>