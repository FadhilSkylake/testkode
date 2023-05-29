<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<div class="container mt-5">
    <h1>Input Skor</h1>
    <?php if (session()->has('error')) : ?>
        <p><?= session('error'); ?></p>
    <?php endif; ?>
    <form action="/football/saveScore" method="POST">
        <div class="form-group col-md-3 mb-3">
            <label class="form-label" for="home_team">Tim Tuan Rumah:</label>
            <select class="form-control form-control-sm" id="home_team" name="home_team" required>
                <option selected value="" disabled>Pilih Tim Tuan Rumah</option>
                <?php foreach ($teams as $team) : ?>
                    <option value="<?= $team['id']; ?>"><?= $team['nama_klub']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-3 mb-3">
            <label class="form-label" for="away_team">Tim Tamu:</label>
            <select class="form-control" id="away_team" name="away_team" required>
                <option selected value="" disabled>Pilih Tim Tamu</option>
                <?php foreach ($teams as $team) : ?>
                    <option value="<?= $team['id']; ?>"><?= $team['nama_klub']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-3 mb-3">
            <label class="form-label" for="home_team_score">Skor Tim Tuan Rumah:</label>
            <input class="form-control" type="number" id="home_team_score" name="home_team_score" required>
        </div>
        <div class="form-group col-md-3 mb-3">
            <label class="form-label" for="away_team_score">Skor Tim Tamu:</label>
            <input class="form-control" type="number" id="away_team_score" name="away_team_score" required>
        </div>
        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
    </form>
</div>

<?= $this->endSection(); ?>