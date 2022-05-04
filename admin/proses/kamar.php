<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#modalTambahKamar">
  Tambah
</button>

<!-- The Modal -->
<div class="modal fade" id="modalTambahKamar">
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
        include 'tb_kamar.php'
        ?>
      </div>

    </div>
  </div>
</div>

<div class="table-responsive p-1">
  <table id="kamar" class="table table-striped" style="width:100%">
    <thead class="bg-dark text-light">
      <tr>
        <th>Nama Kamar</th>
        <th>Jumlah Kamar</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $resultKamar = mysqli_query($conn, "SELECT * FROM kamar");

      ?>
      <?php while ($rowKamar = mysqli_fetch_assoc($resultKamar)) : ?>
        <tr>
          <td><?= $rowKamar['nama_kamar']; ?></td>
          <td><?= $rowKamar['total_kamar']; ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>