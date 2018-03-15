function add_mask_field(){
  //TODO: this is ugly
  var elem =
    `<fieldset class="form-group well">
      <div class="input-group">
        <span class="input-group-addon">Field name</span>
        <input type="text" class="form-control" aria-label="Field-name" name="field_name[]"/>
      </div>
      <br/>
      <div class="input-group">
        <span class="input-group-addon">Default value</span>
        <input type="text" class="form-control" aria-label="Default" name="field_value[]"/>
      </div>
      <br/>
      <select class="form-control" name="field_type[]">
        <option value="integer">integer</option>
        <option value="float">floating-point number</option>
        <option value="text">text</option>
        <option value="datetime">Date and time</option>
        <option value="blob">binary/file</option>
      </select>
      <br/>
      <button type="button" class="btn btn-danger" onclick="rm_mask_field(this);">Remove field</button>
    </fieldset>`;
  $("#add_field_button").before(elem);
}
function rm_mask_field(elem){
  $(elem).parent().remove();
}
