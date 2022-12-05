var pathname = window.location.pathname;
var arr = pathname.split('/');

$(document).ready(function () {
  var id = arr[arr.length - 1];
  table = $("#customers-table").DataTable({
    ajax: "/customers/records",
    processing: true,
    serverSide: true,
    lengthMenu: [
      [25, 50, 100],
      [25, 50, 100]
    ],
    order: [[0, "desc"]],
    fnInitComplete: function (oSettings, json) {
      $.each(json, function (key, val) {
        $('#dataFilter span[data="' + key + '"]').text(val);
        console.log(key);
        console.log(val);
      });
    },
    columns: [
      {
        data: "name",
        name: "name"
      },
      {
        data: "address",
        name: "address"
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return data.created_by.name 
        }
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return data.employee.name 
        }
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return data.action.name 
        }
      },
      {
        data: "description",
        name: "description"
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return (
            `
             <a onClick="showEditModal(
            '${data.id}' 
            )" style="margin-right: 4px;" class="btn btn-success  btn-sm btn-icon icon-left"><i class="mdi mdi-account-edit-outline"></i></a>` +

            `<a onClick="showDeleteModal(
                '${data.id}'
            )" style="margin-right: 4px;" class="btn btn-danger  btn-sm btn-icon icon-left"><i class="mdi mdi-delete" style="font-size: 16px; cursor: pointer;"></i></a>`);
        }
      },
    ],
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
  });
});
