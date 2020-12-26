<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
	<?php $this->load->view('admin/template/header');?>
</head>

<body>
<?php $this->load->view('admin/template/topheader');?>
<?php $this->load->view('admin/template/menu_kedua');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Charts &amp; graphs</a></div>
    <h1>Charts &amp; graphs</h1>
  </div>
  <div class="container-fluid">
    <div class="widget-box widget-plain">
      <div class="center">
        <ul class="stat-boxes">
          <li>
            <div class="left peity_bar_neutral"><span><span style="display: none;">2,4,9,7,12,10,12</span>
              <canvas width="50" height="24"></canvas>
              </span>+10%</div>
            <div class="right"> <strong>15598</strong> Visits </div>
          </li>
          <li>
            <div class="left peity_line_neutral"><span><span style="display: none;">10,15,8,14,13,10,10,15</span>
              <canvas width="50" height="24"></canvas>
              </span>10%</div>
            <div class="right"> <strong>150</strong> New Users </div>
          </li>
          <li>
            <div class="left peity_bar_bad"><span><span style="display: none;">3,5,6,16,8,10,6</span>
              <canvas width="50" height="24"></canvas>
              </span>-40%</div>
            <div class="right"> <strong>4560</strong> Orders</div>
          </li>
          <li>
            <div class="left peity_line_good"><span><span style="display: none;">12,6,9,23,14,10,17</span>
              <canvas width="50" height="24"></canvas>
              </span>+60%</div>
            <div class="right"> <strong>5672</strong> Active Users </div>
          </li>
          <li>
            <div class="left peity_bar_good"><span>12,6,9,23,14,10,13</span>+30%</div>
            <div class="right"> <strong>2560</strong> Register</div>
          </li>
          <li>
            <div class="left peity_bar_bad"><span>12,6,9,23,14,10,5</span>-5%</div>
            <div class="right"> <strong>155</strong> Pending Orders</div>
          </li>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
            <h5>Bar chart</h5>
          </div>
          <div class="widget-content">
            <div class="bars"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
            <h5>Line chart</h5>
          </div>
          <div class="widget-content">
            <div class="chart"></div>
          </div>
        </div>
      </div>
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
            <h5>Pie chart</h5>
          </div>
          <div class="widget-content">
            <div class="pie"></div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
<!-- Footer -->
<?php $this->load->view('admin/template/footer');?>
<!-- /Footer -->


<script src="<?php echo base_url('assets/admin2/js/excanvas.min.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/jquery.min.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/jquery.ui.custom.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/bootstrap.min.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/jquery.flot.min.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/jquery.flot.pie.min.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/jquery.flot.resize.min.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/maruti.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/maruti.charts.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/maruti.dashboard.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/jquery.peity.min.js');?>"></script>

</body>

</html>
