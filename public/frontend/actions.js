function showModal() {
  console.log('present')
  //$("#formInputs")[0].reset();
  //removeUploadedImages();
  //BeforSave();
  $("#add-model-form").modal("show");
}
// to reload table after any action (delete, add , Edit)
function UpdateTable() {
  table.ajax.reload();
}

// To hide form after any action (delete, add , Edit)
function hideForm() {
  $(".modal").modal("hide");
}

function showDeleteModal(id) {
  console.log(id);
  $('#delete-modal input[id="D_id"]').val(id);
  $("#delete-modal").modal("show");
}

// to show Edit model in some page  
function showEditModal(id) {
  console.log("edit modal " + id)
  console.log('hello')
  removeUploadedImages();
  BeforSave();
  BeforeOpen('edit-model');

  $('#edit-model input[id="E_id"]').val(id);
  path = window.location.pathname;
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    url: path + "/record/" + id, // point to server-side controller method
    cache: false,
    contentType: false,
    processData: false,
    type: "get",
    success: function (data) {
      console.log(data)
      $.each(data.data, function (index, value) {
        console.log(value);
        $('#edit-model input[id="E_' + index + '"]').val(value);
        $('#edit-model .E_' + index).val(value);
        $('#edit-model label[id="E_' + index + '"]').text(value);
        $('#edit-model textarea[id="E_' + index + '"]').val(value);
        $("#E_" + index).val(value);

        if (index == "image") {
          $('#E_' + index).attr('src', value).width(150).height(150);
          $('#E_' + index).attr('onclick', "openImage('" + value + "')");
          $("#E_file").val('');
        }
        $('#edit-model select[id="E_' + index + '"]').attr("select", value);
        $('#edit-model select[id="E_' + index + '"]').val(value).change();
      });
      $("#edit-model").modal("show");
    },
    error: function (response) {
      $("#msg").html(response); // display error response from the server
    }
  });
}

function openImage(src) {
  $('#imagepreview').attr('src', src);
  $("#imagemodal").modal("show");
}

// remove any inputs or other before show models 
function BeforSave() {
  $("div , input , textarea , select ")
    .removeClass("has-danger")
    .removeClass("is-invalid")
    .removeClass("has-error");

  $("span.invalid-feedback").remove();
  $(".error_validation").hide();

}

function BeforeOpen(modal) {
  $('#' + modal + ' .form-entry').val('');
  $('#' + modal + ' textarea').val('');
  $('#' + modal + ' select').val('');
  $('#' + modal + ' img').attr('src', '/images/upload.jpg');
  $('#' + modal + ' #P_show-video').attr('src', '');
  $('#' + modal + ' #P_show-video').css('display', 'none');

  $('#' + modal + ' #P_show-pdf').attr('src', '');
  $('#' + modal + ' #P_show-pdf').css('display', 'none');
}

function removeUploadedImages() {
  $('.uploader .img').attr('value', '');
  var images = $('.uploader .img')
  for (var i = 0; i < images.length; i++) {
    $(images)[i].remove();
    $('.file_to_remove').val('');
  }
}

function readImageURL(input, id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#' + id)
        .attr('src', e.target.result)
        .width(150)
        .height(150);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function readVideoURL(input, id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#' + id)
        .attr('src', e.target.result)
        .width(150)
        .height(150);
    };
    $("#" + id).css('display', 'block');
    reader.readAsDataURL(input.files[0]);
  }
}

function readPDFURL(input, id) {
  if (input.files && input.files[0]) {
    $("#" + id).css('display', 'none');
  }
}

function readUrl(input, imgId, aId) {
  if (input.files && input.files[0]) {
    console.log(input.files[0])
    var reader = new FileReader();
    var image_object_url = URL.createObjectURL(input.files[0]);
    console.log(image_object_url)
    console.log(aId)
    reader.onload = function (e) {
      $('#' + imgId).attr('src', e.target.result);
      $('#' + aId).attr('href', image_object_url);
    };
    reader.readAsDataURL(input.files[0]);
  }
}