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
      $result_fu = mysqli_query($conn, "SELECT * FROM fasilitas_umum");

      ?>
      <?php while ($fu = mysqli_fetch_assoc($result_fu)) : ?>
        <tr>
          <td><?= $fu['nama_fasilitas']; ?></td>
          <td><?= $fu['keterangan']; ?></td>
          <td><?= $fu['gambar']; ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>