<div class="table-responsive mt-1">
  <table id="fasilitas_kamar" class="table table-striped" style="width:100%">
    <thead class="bg-dark text-light">
      <tr>
        <th>Nama Fasilitas</th>
        <th>Gambar</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $result_fk = mysqli_query($conn, "SELECT * FROM fasilitas_kamar");

      ?>
      <?php while ($fk = mysqli_fetch_assoc($result_fk)) : ?>
        <tr>
          <td><?= $fk['fasilitas']; ?></td>
          <td><?= $fk['gambar']; ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>