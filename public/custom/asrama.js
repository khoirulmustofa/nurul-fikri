var table;

$(document).ready(function () {

  $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
    return {
      "iStart": oSettings._iDisplayStart,
      "iEnd": oSettings.fnDisplayEnd(),
      "iLength": oSettings._iDisplayLength,
      "iTotal": oSettings.fnRecordsTotal(),
      "iFilteredTotal": oSettings.fnRecordsDisplay(),
      "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
      "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
  };

  table = $("#table_asrama").DataTable({
    initComplete: function () {
      var api = this.api();
      $("#table_asrama_filter input")
        .off('.DT')
        .on('keyup.DT', function (e) {
          if (e.keyCode == 13) {
            api.search(this.value).draw();
          }
        });
    },
    dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [{
        extend: "copy",
        exportOptions: {
          columns: [1, 2]
        }
      },
      {
        extend: "print",
        exportOptions: {
          columns: [1, 2]
        }
      },
      {
        extend: "excel",
        exportOptions: {
          columns: [1, 2]
        }
      },
      {
        extend: "pdf",
        exportOptions: {
          columns: [1, 2]
        }
      }
    ],
    oLanguage: {
      sProcessing: "<div class='loader'></div>"
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "asrama/asrama_data",
      type: "POST"
    }, 
    columns: [{
        data: "asrama_id",
        orderable: false,
        searchable: false
      },
      {
        data: "asrama_nama"
      },
      {
        data: "users_nama_lengkap"
      }
    ],
    columnDefs: [
      {
        targets: 3,
        data: "asrama_id",
        render: function (data, type, row, meta) {
          return `<div class="text-center">                      
                      <a class="btn btn-xs btn-warning" href="${base_url}asrama/update/${data}" title="Edit">
                          <i class="fa fa-pencil"></i>
                      </a>
                      <a href="${base_url}asrama/delete/${data}" onclick="javasciprt: return confirm('Apakah kamu ingin menghapus data ini ?')"
                       class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>                      
                  </div>`;
        }
      }
    ],
    order: [
      [1, "asc"]
    ],
    rowId: function (a) {
      return a;
    },
    rowCallback: function (row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $("td:eq(0)", row).html(index);
    }
  });

  table
    .buttons()
    .container()
    .appendTo("#table_asrama_wrapper .col-md-6:eq(0)");
});