function change_mask(select){
  $("#__entry_id").val("-1");
  $("#input_container").empty();
  window.history.replaceState({}, '', baseuri+'/m/AXL/Articular/entry/create');
  $("#entry_form").attr('action', baseuri+'/m/AXL/Articular/entry/create');
  var maskname = $(select).val();
  $.ajax({
    accepts:'text/plain',
    url:baseuri+'/m/AXL/Articular/mask/getentryform/'+maskname,
    context: $("#input_container"),
    type: 'GET',
    success: function(html){
      $("#input_container").html(html);
    }
  });
}
function select_mask(name){
  $("#__mask_name").val(name);
  change_mask("#__mask_name");
}
