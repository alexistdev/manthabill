 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php foreach($user->result_array() as $row): 
		  $username = $row['username']; 
		  $namaDepan = $row['nama_depan'];
		  $namaBelakang = $row['nama_belakang'];
		  if (!empty($namaDepan)){
			  echo htmlentities($namaDepan." ".$namaBelakang, ENT_QUOTES, 'UTF-8');
		  }else{
			  echo htmlentities($username, ENT_QUOTES, 'UTF-8');
		  }
		  ;endforeach;?></p>	
  
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="<?php echo base_url('member');?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        <li><a href="<?php echo base_url('product');?>"><i class="fa fa fa-server text-red"></i> <span>Product</span></a></li>
        <li><a href="<?php echo base_url('domain');?>"><i class="fa fa-globe text-green"></i> <span>Domain</span></a></li>
        <li><a href="<?php echo base_url('service');?>"><i class="fa fa-book"></i> <span>Service</span></a></li>
        <li><a href="<?php echo base_url('invoice');?>"><i class="fa fa-credit-card text-yellow"></i> <span>Invoice</span></a></li>
        <li><a href="<?php echo base_url('ticket');?>"><i class="fa fa-bullhorn text-blue"></i> <span>Ticket</span></a></li>
        <li><a href="<?php echo base_url('setting');?>"><i class="fa fa-cog"></i> <span>Setting</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>