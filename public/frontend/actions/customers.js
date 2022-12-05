// Course control
// add New Course 
function addCustomer() {
    BeforSave();
    var name = $("#name").val();
    var address = $("#address").val();
    var action_id = $("#action_id").val();
    var employee_id = $("#employee_id").val();
    var form_data = new FormData();
    form_data.append("_token", $("#_token").val());
    form_data.append("name", name);
    form_data.append("address", address);
    form_data.append("action_id", action_id);
    form_data.append("employee_id", employee_id);
    document.querySelector('#addButtonCustomer').innerHTML = 'Loading ...';
    document.getElementById('addButtonCustomer').disabled = 'disabled';
    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: "/customers/create", // point to server-side controller method
      dataType: "text", // what to expect back from the server
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: "post",
      success: function (data) {
        if (typeof data == "string") {
          data = jQuery.parseJSON(data);
        }
        $.each(data.triggers, function (index, FunctionName) {
          eval(FunctionName);
        });
        $("#finishing-request").css('display', 'none');
     
      },
      error: function (data) {
        if (typeof data.responseText == "string") {
          data = jQuery.parseJSON(data.responseText);
        }
  
        console.log(data.error)
        $.each(data.errors, function (index, value) {
          $("#errors").text(data.error);
          $("#errors").show();
          $('#add-model-form input[id="P_' + index + '"]').addClass("is-invalid");
          $('#add-model-form label[id="P_' + index + '"]').addClass("is-invalid");
          $('#add-model-form textarea[id="P_' + index + '"]').addClass("is-invalid");
          $('#add-model-form select[id="P_' + index + '"]').addClass("is-invalid");
          $('#add-model-form select[id="P_' + index + '"]').addClass("is-invalid");
          $("#P_" + index).text(value);
          $("#P_" + index).show();
        })
        $("#finishing-request").css('display', 'none');
        
      }
    });
    document.querySelector('#addButtonCustomer').innerHTML = 'Save';
    document.getElementById('addButtonCustomer').disabled = '';
  }
  
  function editCustomer() {
    var name = $("#E_name").val();
    var address = $("#E_address").val();
    var action_id = $("#E_action_id").val();
    var employee_id = $("#E_employee_id").val();
    var description = $("#E_description").val();

    var id = $("#E_id").val();
    var form_data = new FormData();
  
    form_data.append("_token", $("#_token").val());
    form_data.append("name", name);
    form_data.append("address", address);
    form_data.append("action_id", action_id);
    form_data.append("employee_id", employee_id);
    form_data.append("description", description);
  
    document.querySelector('#editButtonCustomer').innerHTML = 'loading ...';
    document.getElementById('editButtonCustomer').disabled = 'disabled';
    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: `/customers/${id}/update`, // point to server-side controller method
      dataType: "text", // what to expect back from the server
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: "post",
      success: function (data) {
        if (typeof data == "string") {
          data = jQuery.parseJSON(data);
        }
        $.each(data.triggers, function (index, FunctionName) {
          eval(FunctionName);
        });
        $("#E_finishing-request").css('display', 'none');
        document.querySelector('#editButtonCustomer').innerHTML = 'edit';
        document.getElementById('editButtonCustomer').disabled = '';
      },
      error: function (data) {
        if (typeof data.responseText == "string") {
          data = jQuery.parseJSON(data.responseText);
        }
        console.log(data.errors);
        $.each(data.errors, function (index, value) {
          console.log(index);
          $('#edit-model input[id="E_' + index + '"]').addClass("is-invalid");
          $('#edit-model label[id="E_' + index + '"]').addClass("is-invalid");
          $('#edit-model textarea[id="E_' + index + '"]').addClass("is-invalid");
          $('#edit-model select[id="E_' + index + '"]').addClass("is-invalid");
          $('#edit-model select[id="E_' + index + '"]').addClass("is-invalid");
          $("#P_E_" + index).text(value);
          $("#P_E_" + index).show();
        });
        document.querySelector('#editButtonCustomer').innerHTML = 'Save';
        document.getElementById('editButtonCustomer').disabled = '';
      }
    });
  }
  
  function deleteCustomer() {
    var id = $("#D_id").val();
    var form_data = new FormData();
    form_data.append("_token", $("#_token").val());
  
    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: `/customers/${id}/delete`, // point to server-side controller method
      dataType: "text", // what to expect back from the server
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: "post",
      success: function (data) {
        if (typeof data == "string") {
          data = jQuery.parseJSON(data);
        }
        $.each(data.triggers, function (index, FunctionName) {
          eval(FunctionName);
        });
      },
      error: function (response) {
      }
    });
  }
  