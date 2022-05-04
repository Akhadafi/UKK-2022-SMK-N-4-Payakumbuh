<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#modalTambahFasilitasUmum">
  Tambah
</button>

<!-- The Modal -->
<div class="modal fade" id="modalTambahFasilitasUmum">
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
        include 'tb_fasilitas_umum.php'
        ?>
      </div>

    </div>
  </div>
</div>

<div class="table-responsive mt-1">
  <table id="fasilitas_umum" class="table table-striped" style="width:100%">
    <thead class="bg-dark text-light">
      <tr>
        <th>Nama Fasilitas</th>
        <th>Keterangan</th>
        <th>Gambar</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $resultFasilitasUmum = mysqli_query($conn, "SELECT * FROM fasilitas_umum");

      ?>
      <?php while ($rowFasilitasUmum = mysqli_fetch_assoc($resultFasilitasUmum)) : ?>
        <tr>
          <td><?= $rowFasilitasUmum['nama_fasilitas']; ?></td>
          <td><?= $rowFasilitasUmum['keterangan']; ?></td>
          <td>
            <img src="../vendor/img/fasilitas_umum/<?= $rowFasilitasUmum['gambar']; ?>" alt="gambar" style="width: 120px; height: 70px;">
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>