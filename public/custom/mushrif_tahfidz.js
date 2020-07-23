$(document).ready(function () {
  table = $("#table").DataTable({
    processing: true, //Feature control the processing indicator.
    serverSide: true, //Feature control DataTables' server-side processing mode.
    order: [], //Initial no order.
    autoWidth: true,
    // Load data for the table's content from an Ajax source
    language: {
      processing: "<div class='loader'></div>",
    },
    ajax: {
      url: base_url + "mushrif_tahfidz/ajax_list_mushrif_tahfidz",
      type: "POST",
    },

    //Set column definition initialisation properties.
    columnDefs: [
      {
        targets: [0], //first column
        orderable: false, //set not orderable
      },
      {
        targets: [-1], //last column
        orderable: false, //set not orderable
      },
    ],
  });
});
