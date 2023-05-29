<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>


<div class="container mt-5">

    <h1>Klasemen Sepak Bola</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Tim</th>
                <th>Kota Asal</th>
                <th>Jumlah Main</th>
                <th>Jumlah Menang</th>
                <th>Jumlah Seri</th>
                <th>Jumlah Kalah</th>
                <th>Goal Menang</th>
                <th>Goal Kalah</th>
                <th>Point</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teams as $team) : ?>
                <tr>
                    <td><?= $team['nama_klub']; ?></td>
                    <td><?= $team['kota_klub']; ?></td>
                    <td><?= $team['played']; ?></td>
                    <td><?= $team['won']; ?></td>
                    <td><?= $team['drawn']; ?></td>
                    <td><?= $team['lost']; ?></td>
                    <td><?= $team['goals_for']; ?></td>
                    <td><?= $team['goals_against']; ?></td>
                    <td><?= $team['point']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a class="btn btn-sm btn-primary" href="/football/addTeam">Input Data Klub</a>
    <a class="btn btn-sm btn-warning" href="/football/addScore">Input Skor</a>
</div>

<?= $this->endSection(); ?>