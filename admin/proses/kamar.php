<div class="table-responsive mt-1">
  <table id="kamar" class="table table-striped" style="width:100%">
    <thead class="bg-dark text-light">
      <tr>
        <th>Nama Kamar</th>
        <th>Jumlah Kamar</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $result = mysqli_query($conn, "SELECT * FROM kamar");

      ?>
      <?php while ($kamar = mysqli_fetch_assoc($result)) : ?>
        <tr>
          <td><?= $kamar['nama_kamar']; ?></td>
          <td><?= $kamar['total_kamar']; ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>