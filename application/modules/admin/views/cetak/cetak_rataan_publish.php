<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <style>
        table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename= export-laporan.xls");
    ?>
    <table class="table" id="responden">
        <tr>
            <td>Bulan</td>
            <td><?= $bulan ?></td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td><?= $tahun ?></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">id responden</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Tanggal Mengisi</th>
            <th class="text-center">TimeStamp</th>
            <th class="text-center">Score Rata-rata</th>
        </tr>
        <?php $no = 1;
        foreach ($rekap as $data) : ?>
            <tr id="tr_<?= $data['id_responden']  ?>">
                <td class="text-center"><?php echo $no++; ?></td>
                <td><strong><?php echo $data['id_responden'] ?></strong></td>
                <td><strong><?php echo $data['nama_responden'] ?></strong></td>
                <td class="text-center"><?php echo $data['tanggal'] ?></td>
                <td class="text-center"><?php echo $data['jam_isi'] ?></td>
                <td class="text-center"><?php echo $data['rata'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>