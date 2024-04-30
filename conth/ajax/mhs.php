<?php

require '../functions.php';
$keyword = $_GET["keyword"];

global $koneksi_ke_db;
$buah_cari = ambil_tabel("SELECT * FROM buah_buahan 
            WHERE
              nama LIKE '%$keyword%' or 
              rasa LIKE '%$keyword%' or 
              asal_negara LIKE '%$keyword%' or 
              tanda_matang LIKE '%$keyword%' or 
              kebebasan_makan LIKE '%$keyword%' or 
              ditemukan_pada LIKE '%$keyword%'
            ");

?>



<table cellspacing="0" cellpadding="2">
      <tr>
        <th>no</th>
        <th>gambar</th>
        <th>nama</th>
        <th>rasa</th>
        <th>asal negara</th>
        <th>tanda matang</th>
        <th>kebebasan makan</th>
        <th>di temukan</th>
        <th rowspan="2">aksi</th>
      </tr>
      <tbody>
        <?php
        $i = 1;
        foreach ($buah_cari as $buah) :
          ?>
          <tr>
            <td><?= $i++; ?></td>
            <td><img src="<?= $buah["gambar"]; ?>" height="50px" alt="gambar buah"></td>
            <td><?= $buah["nama"]; ?></td>
            <td><?= $buah["rasa"]; ?></td>
            <td><?= $buah["asal_negara"]; ?></td>
            <td><?= $buah["tanda_matang"]; ?></td>
            <td><?= $buah["kebebasan_makan"]; ?></td>
            <td><?= $buah["ditemukan_pada"]; ?></td>
            <td><a href="hapus.php?id=<?= $buah["id"]; ?>&gambar=<?= $buah["gambar"];?>" onclick="return confirm('apakah yakin menghapus?')">hapus</a> || <a href="ubah.php?id=<?= $buah["id"] ?>">ubah</a></td>
          </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
