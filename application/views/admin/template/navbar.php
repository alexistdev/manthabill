<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="<?php echo base_url('admin');?>">Administrator ManthaBill V.1.0 </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          
         <li><a href="logout">Logout</a></li>
        </ul>
        
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="active"><a href="<?php echo base_url('staff/admin');?>"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li><a href="<?php echo base_url('staff/admin/user');?>"><i class="icon-group"></i><span>User</span> </a> </li>
        <li><a href="<?php echo base_url('staff/admin/hosting');?>"><i class="icon-tasks"></i><span>Hosting</span> </a></li>
        <li><a href="<?php echo base_url('staff/admin/invoice');?>"><i class="icon-credit-card"></i><span>Invoice</span> </a> </li>
        <li><a href="<?php echo base_url('staff/admin/product');?>"><i class="icon-hdd"></i><span>Product</span> </a> </li>
		<li><a href="<?php echo base_url('staff/admin/berita');?>"><i class="icon-bullhorn"></i><span>Berita</span> </a> </li>
        <li><a href="<?php echo base_url('staff/admin/setting');?>"><i class="icon-cog"></i><span>Setting</span> </a> </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->