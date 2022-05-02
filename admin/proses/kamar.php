<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary mt-2 mb-1" data-bs-toggle="modal" data-bs-target="#myModal">
  Tambah
</button>

<!-- The Modal -->
<div class="modal fade" id="myModal">
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
        include 'tb_fa_kamar.php'
        ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" name="ta_kamar" class="btn btn-danger">Tambah</button>
      </div>

    </div>
  </div>
</div>


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