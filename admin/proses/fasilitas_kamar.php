<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#modalTambahFasilitasKamar">
  Tambah
</button>

<!-- The Modal -->
<div class="modal fade" id="modalTambahFasilitasKamar">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php
        include 'tb_fasilitas_kamar.php'
        ?>
      </div>

    </div>
  </div>
</div>

<div class="table-responsive p-1">
  <table id="fasilitas_kamar" class="table table-striped" style="width:100%">
    <thead class="bg-dark text-light">
      <tr>
        <th>Kamar</th>
        <th>Fasilitas Kamar</th>
        <th>Gambar</th>
        <th>Detail</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $resultFasilitasKamar = mysqli_query($conn, "SELECT * FROM fasilitas_kamar,kamar WHERE fasilitas_kamar.id_kamar = kamar.id_kamar");

      ?>
      <?php while ($rowFasilitasKamar = mysqli_fetch_assoc($resultFasilitasKamar)) : ?>
        <tr>
          <td><?= $rowFasilitasKamar['nama_kamar']; ?></td>
          <td><?= $rowFasilitasKamar['fasilitas']; ?></td>
          <td>
            <img src="../vendor/img/fasilitas_kamar/<?= $rowFasilitasKamar['gambar']; ?>" alt="gambar" style="width: 120px; height: 70px;">
          </td>
          <td>
            <a href="./proses/dt_fasilitas_kamar.php?id_fasilitas_kamar=<?= $rowFasilitasKamar['id']; ?>" class="btn btn-info text-light">detail</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>