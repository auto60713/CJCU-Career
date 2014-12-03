$(document).ready(function(){
  $("#add_button").click
  (
    function()
    {
      $("#add_file_button").append('<label for="file_show_name[]">目標</label><input type="text" name="file_show_name[]" value="" size="32" maxlength="64"><br />');      
    }
  );
  $("#remove_button").click(function(){
  		$("#add_button").remove();
  });
  $("a[id='del_file[]']").click(function(){
      if (confirm('確定刪除檔案')) {
        return true;
      }
      return false;
  });    
});