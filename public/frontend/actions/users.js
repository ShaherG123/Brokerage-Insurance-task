// Course control
// add New Course 
function addUser() {
    BeforSave();
    var name = $("#name").val();
    var email = $("#email").val();
    var type = $("#type").val();
    var password = $("#password").val();
    var password_confirmation = $("#password_confirmation").val();
    var form_data = new FormData();
    form_data.append("_token", $("#_token").val());
    form_data.append("name", name);
    form_data.append("email", email);
    form_data.append("type", type);
    form_data.append("password", password);
    form_data.append("password_confirmation", password_confirmation);
    document.querySelector('#addButtonUser').innerHTML = 'Loading ...';
    document.getElementById('addButtonUser').disabled = 'disabled';
    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: "/users/create", // point to server-side controller method
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
    document.querySelector('#addButtonUser').innerHTML = 'Save';
    document.getElementById('addButtonUser').disabled = '';
  }
  
  function editUser() {
    var name = $("#E_name").val();
    var email = $("#E_email").val();
    var type = $("#E_type").val();
    var password = $("#E_password").val();
    var password_confirmation = $("#E_password_confirmation").val();
    var id = $("#E_id").val();
    var form_data = new FormData();
  
    form_data.append("_token", $("#_token").val());
    form_data.append("name", name);
    form_data.append("email", email);
    form_data.append("type", type);
    form_data.append("password", password);
    form_data.append("password_confirmation", password_confirmation);
    
  
    document.querySelector('#editButtonUser').innerHTML = 'loading ...';
    document.getElementById('editButtonUser').disabled = 'disabled';
    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: `/users/${id}/update`, // point to server-side controller method
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
        document.querySelector('#editButtonUser').innerHTML = 'edit';
        document.getElementById('editButtonUser').disabled = '';
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
        document.querySelector('#editButtonUser').innerHTML = 'Save';
        document.getElementById('editButtonUser').disabled = '';
      }
    });
  }
  
  function deleteUser() {
    var id = $("#D_id").val();
    var form_data = new FormData();
    form_data.append("_token", $("#_token").val());
  
    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: `/users/${id}/delete`, // point to server-side controller method
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
  