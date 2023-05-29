<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>


<div class="container mt-5">
    <h1>Input Data Klub</h1>
    <?php if (session()->getFlashdata('_ci_validation_errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('_ci_validation_errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>
    <form action="/football/saveTeam" method="POST">
        <div class="form-group col-md-3 mb-3">
            <label class="form-label" for="nama_klub">Nama Klub:</label>
            <input class="form-control" type="text" id="nama_klub" name="nama_klub" required>
        </div>
        <div class="form-group col-md-3 mb-3">
            <label class="form-label" for="kota_klub">Kota Asal:</label>
            <input class="form-control" type="text" id="kota_klub" name="kota_klub" required>
        </div>
        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
    </form>
</div>

<?= $this->endSection(); ?>