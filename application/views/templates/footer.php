<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Sistem Sales Order</b> v1.0.0
  </div>
  <strong>&copy; <?= date('Y') ?> <a href="#">PT. Maju Jaya</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Optional: Konten sidebar tambahan -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- ChartJS -->
<script src="<?= base_url('assets/adminlte/plugins/chart.js/Chart.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?= base_url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>

<!-- Summernote -->
<script src="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.min.js') ?>"></script>

<!-- overlayScrollbars -->
<script src="<?= base_url('assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>

<!-- AdminLTE -->
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  $(document).ready(function() {
    // DataTable
    const table = $('#datatable').DataTable({
      responsive: true,
      lengthChange: true,
      autoWidth: false,
      dom: 'Bfrtip',
      buttons: [{
          extend: 'excelHtml5',
          className: 'btn btn-success btn-sm',
          title: 'Laporan_SalesOrder'
        },
        {
          extend: 'pdfHtml5',
          className: 'btn btn-danger btn-sm',
          title: 'Laporan_SalesOrder',
          orientation: 'landscape',
          pageSize: 'A4'
        },
        {
          extend: 'print',
          className: 'btn btn-info btn-sm',
          title: 'Laporan_SalesOrder'
        }
      ]
    });
    table.buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');

    $(document).ready(function() {
      // Hanya aktifkan DataTable jika ada tabel dengan ID produkTable
      if ($('#produkTable').length) {
        $('#produkTable').DataTable({
          responsive: true,
          lengthChange: true,
          autoWidth: false,
          paging: true,
          searching: true,
          ordering: true
        });
      }
    });

    $(document).ready(function() {
      if ($('#pelangganTable').length) {
        $('#pelangganTable').DataTable({
          responsive: true,
          lengthChange: true,
          paging: true,
          searching: true,
          ordering: true
        });
      }
    });

    $(document).ready(function() {
      if ($('#historyTable').length) {
        $('#historyTable').DataTable({
          responsive: true,
          lengthChange: true,
          paging: true,
          searching: true,
          ordering: true
        });
      }
    });





    // Summernote
    $('.summernote').summernote({
      height: 300,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'italic', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ],
      callbacks: {
        onImageUpload: function(files) {
          for (let i = 0; i < files.length; i++) {
            uploadSummernoteImage(files[i]);
          }
        }
      }
    });

    function uploadSummernoteImage(file) {
      let data = new FormData();
      data.append('image', file);

      $.ajax({
        url: '<?= base_url('berita/upload_summernote_image'); ?>',
        type: 'POST',
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
          try {
            let imageUrl = JSON.parse(response).url;
            $('.summernote').summernote('insertImage', imageUrl);
          } catch (e) {
            console.error('Error parsing JSON response:', e);
            console.log('Raw response:', response);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error(textStatus, errorThrown);
        }
      });
    }
  });
</script>
<script>
  $(document).ready(function() {
    function hitungTotal(row) {
      let jumlah = parseFloat(row.find('.jumlah').val()) || 0;
      let harga = parseFloat(row.find('.harga_satuan').val()) || 0;
      row.find('.total_harga').val(jumlah * harga);
    }

    $('#produk-table').on('change', '.produk-select', function() {
      let harga = $(this).find(':selected').data('harga');
      let row = $(this).closest('tr');
      row.find('.harga_satuan').val(harga);
      hitungTotal(row);
    });

    $('#produk-table').on('input', '.jumlah', function() {
      let row = $(this).closest('tr');
      hitungTotal(row);
    });

    $('#addRow').click(function() {
      let newRow = $('#produk-table tbody tr:first').clone();
      newRow.find('input, select').val('');
      $('#produk-table tbody').append(newRow);
    });

    $('#produk-table').on('click', '.removeRow', function() {
      if ($('#produk-table tbody tr').length > 1) {
        $(this).closest('tr').remove();
      }
    });
  });
</script>




</body>

</html>