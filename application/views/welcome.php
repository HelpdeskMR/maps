<style>
.small-box {
	border-radius: 5px;
	box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
	display: block;
	margin-bottom: 20px;
	position: relative;
}
.small-box > .inner {
	padding: 10px;
}
*, ::after, ::before {
 box-sizing: border-box;
}
.small-box .icon > i.fa, .small-box .icon > i.fab, .small-box .icon > i.far, .small-box .icon > i.fas, .small-box .icon > i.glyphicon, .small-box .icon > i.ion {
	font-size: 70px;
	top: 20px;
}
.bg-info {
	background-color: #17a2b8 !important;
}
.bg-info, .bg-info > a {
	color: #fff !important;
}
.bg-warning {
	background-color: #ffc107 !important;
}
.bg-warning, .bg-warning > a {
	color: #1f2d3d !important;
}
.bg-success {
	background-color: #28a745 !important;
}
.bg-success, .bg-success > a {
	color: #fff !important;
}
.bg-danger {
	background-color: #dc3545 !important;
}
.bg-danger, .bg-danger > a {
	color: #fff !important;
}
.content-header {
 padding: 15px .5rem;
}
.content-header h1 {
	font-size: 2.5rem;
	margin: 0;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
 margin-bottom: .5rem;
	font-family: inherit;
	font-weight: 500;
	line-height: 1.2;
	color: inherit;
}
*, ::after, ::before {
 box-sizing: border-box;
}
.container-fluid {
	width: 100%;
	padding-right: 7.5px;
	padding-left: 7.5px;
	margin-right: auto;
	margin-left: auto;
}
.container-fluid2 {
	width: 100%;
	padding-right: 0px;
	padding-left: 0px;
	margin-right: auto;
	margin-left: auto;
}
.box-success {
	background-color:#00A65A;
	text-align:center;
	color:#FFF;
	border-radius: 0.25em;
	word-wrap: break-word;
	width:180px;
}
.box-danger {
	background-color:#DD4B39;
	text-align:center;
	color:#FFF;
	border-radius: 0.25em;
	word-wrap: break-word;
	width:180px;
}
</style>
<div class="content-wrapper">
	<?php 
	$id_user_level = $this->session->userdata('id_user_level');
	if($this->session->userdata('id_user_level') == 17 || $id_user_level == 18  || $id_user_level == 24 ) { ?>
	<section class="content">
		<!--?php echo alert('alert-info', 'Selamat Datang Di Mustika Ratu Promotion System', '')?-->
        <?php echo redirect(site_url('claim'));?>
	</section>
	<?php } elseif ($id_user_level == 19 || $id_user_level == 13 || $id_user_level == 12 || $id_user_level == 20 || $id_user_level == 22 || $id_user_level == 23) { ?>
	<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
        <!-- /.col --> 
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container-fluid --> 
  </div>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">
          <div class="box-body">
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $total_claim;?></h3>
                    <p>Total Claim</p>
                  </div>
                  <div class="icon"> <i class="fa fa-file-text "></i> </div>
                  <a href="<?php echo site_url('claim') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
              </div>
              <div class="col-lg-3 col-xs-6"> 
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?php echo $total_claim_waiting;?></h3>
                    <p>Waiting Approval</p>
                  </div>
                  <div class="icon"> <i class="fa fa-hourglass-2"></i> </div>
                  <a href="<?php echo site_url('wf_claim') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
              </div>
              <div class="col-lg-3 col-xs-6"> 
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php echo $total_claim_approve;?></h3>
                    <p>Approved</p>
                  </div>
                  <div class="icon"> <i class="fa fa-thumbs-o-up"></i> </div>
                  <a href="<?php echo site_url('welcome/approve_promotion') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
              </div>
              <div class="col-lg-3 col-xs-6"> 
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php echo $total_claim_reject;?></h3>
                    <p>Rejected</p>
                  </div>
                  <div class="icon"> <i class="fa fa-thumbs-o-down"></i> </div>
                  <a href="<?php echo site_url('welcome/reject_promotion') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
	<?php } else { ?>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
        <!-- /.col --> 
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container-fluid --> 
  </div>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">
          <div class="box-body">
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $total_promotion;?></h3>
                    <p>Total Promotion</p>
                  </div>
                  <div class="icon"> <i class="fa fa-file-text "></i> </div>
                  <a href="<?php echo site_url('promotion_form') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
              </div>
              <div class="col-lg-3 col-xs-6"> 
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?php echo $total_promotion_waiting;?></h3>
                    <p>Waiting Approval</p>
                  </div>
                  <div class="icon"> <i class="fa fa-hourglass-2"></i> </div>
                  <a href="<?php echo site_url('wf_program') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
              </div>
              <div class="col-lg-3 col-xs-6"> 
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php echo $total_promotion_approve;?></h3>
                    <p>Approved</p>
                  </div>
                  <div class="icon"> <i class="fa fa-thumbs-o-up"></i> </div>
                  <a href="<?php echo site_url('welcome/approve_promotion') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
              </div>
              <div class="col-lg-3 col-xs-6"> 
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php echo $total_promotion_reject;?></h3>
                    <p>Rejected</p>
                  </div>
                  <div class="icon"> <i class="fa fa-thumbs-o-down"></i> </div>
                  <a href="<?php echo site_url('welcome/reject_promotion') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
              </div>
<!--
				<div class="col-lg-3 col-xs-6"> 
                 small box 
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php echo $total_promotion_delete;?></h3>
                    <p>Deleted</p>
                  </div>
                  <div class="icon"> <i class="fa fa-trash"></i> </div>
                  <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
              </div>
-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>
</div>
