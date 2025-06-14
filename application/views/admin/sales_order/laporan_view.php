<!-- application/views/admin/sales_order/laporan_view.php -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="font-weight-bold text-primary"><i class="fas fa-file-alt mr-2"></i><?= \$title ?></h3>
        </div>
        <div class="col-sm-6 text-right">
          <span class="text-muted">Tanggal: <?= date('d-m-Y') ?></span>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Data Sales Order</h5>
        </div>
        <div class="card-body table-responsive">
          <table id="datatable" class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 25%;">Tanggal</th>
                <th style="width: 45%;">Pelanggan</th>
                <th style="width: 25%;">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach (\$orders as \$i => \$order): ?>
                <tr>
                  <td><?= \$i + 1 ?></td>
                  <td><?= date('d-m-Y', strtotime(\$order->created_at)) ?></td>
                  <td><?= \$order->nama_pelanggan ?></td>
                  <td><span class="badge badge-secondary text-uppercase px-2 py-1"><?= ucfirst(\$order->status) ?></span></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="card shadow-sm">
        <div class="card-header bg-light">
          <strong><i class="fas fa-sticky-note mr-2"></i>Catatan</strong>
        </div>
        <div class="card-body">
          <textarea class="summernote"></textarea>
        </div>
      </div>

    </div>
  </section>
</div>

<script>
  $(document).ready(function () {
    if ($('#datatable').length) {
      const table = $('#datatable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        dom: 'Bfrtip',
        buttons: [
          {
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
    }

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
        onImageUpload: function (files) {
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
        success: function (response) {
          try {
            let imageUrl = JSON.parse(response).url;
            $('.summernote').summernote('insertImage', imageUrl);
          } catch (e) {
            console.error('Error parsing JSON response:', e);
            console.log('Raw response:', response);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus, errorThrown);
        }
      });
    }
  });
</script>
