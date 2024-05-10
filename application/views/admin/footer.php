
</div>
<footer class="footer">
<div class="container">
  <div class="row align-items-center flex-row-reverse">
    <div class="col-auto ml-lg-auto">
      <div class="row align-items-center">
        <div class="col-auto">
           Developed by <a href="https://spminfosys.com" target="_blank">SPM Infosys</a>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
      Copyright © 2024 <a href="javascript:;">Prasad Seeds</a>. All rights reserved.
    </div>
  </div>
</div>
</footer>
<script>
$(document).ready(function(){
  $.validate({
    module: 'location, date, security, file',
   });

jQuery(document).keydown(function(event) {
        // If Control or Command key is pressed and the S key is pressed
        // run save function. 83 is the key code for S.
        if((event.ctrlKey || event.metaKey) && event.which == 83) {
            // Save Function
            event.preventDefault();
            $('form').submit();
            return false;
        }
    }
);
});
</script>
</div>
</body>
</html>
