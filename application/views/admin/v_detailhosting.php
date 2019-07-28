<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Dashboard-Manthabill</title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin2/css/bootstrap.min.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin2/css/bootstrap-responsive.min.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin2/css/maruti-style.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin2/css/maruti-media.css');?>" class="skin-color" />

</head>
<body>
<?php $this->load->view('admin/template/topheader');?>
<?php $this->load->view('admin/template/menu_kedua');?>
<?php $this->load->view('admin/k_detailhosting');?>

<!--Start FOOTER-->
<div class="row-fluid">
      <div id="footer" class="span12"> 2012 &copy; Marutii Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<script src="<?php echo base_url('assets/admin2/js/bootstrap.min.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/jquery.min.js');?>"></script> 
<script type="text/javascript">

$(document).ready(function(){

    $("#pilih").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue== "1"){
                $("#nonAktif").show();  
                $("#panjang").hide();
            } else if(optionValue==2){
                $("#panjang").show();
                $("#nonAktif").hide(); 
            } else {
                $("#panjang").hide();
                $("#nonAktif").hide();
            }
        });
    }).change();
});

</script>
</body>

</html>