
function readUrl(input,img){
if(input.files && input.files[0]) {
var reader =new FileReader();
reader.onload = function(e) {
    img.attr('src',e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

//===========================================================================//

$(document).ready(function(){

  $("#logo").click(function(){
    $("#inplogo").click();
  });

  $("#inplogo").change(function(){
    img = $("#img");
    readUrl(this, img);
  });

$(document).on("click", ".delete", function(){

  var id = $(this).attr('data-row-id');
  var path = $(this).attr('data-path');
  var tbl = $(this).attr('data-tbl');
  var tr = $(this).closest('tr');

  swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
    $.ajax({
      type:"post",
      url: path+"ajax/delete",
      data: "id="+id+"&tbl="+tbl,
      success: function() {
        tr.fadeOut();
      }
    })
  }
});

});

});
