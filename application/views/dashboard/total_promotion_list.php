<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">
          <div class="box-header">
            <h3 class="box-title">LIST PROMOTION</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped" id="example1" style="width:100%">
              <thead>
                <tr>
                  <th width="30px" class="not-mobile">No</th>
                  <th class="min-mobile">Date Create</th>
                  <th class="min-mobile">Promotion Number</th>
                  <th class="not-mobile">Department</th>
                  <th class="not-mobile">Promotion Name</th>
                  <th class="not-mobile">Fiscal Year</th>
                  <th class="not-mobile">Approval</th>
				  <th class="not-mobile">Status</th>
                </tr>
              </thead>
			  <tbody>
				  <?php $no = 0; foreach ($detail_promotion as $data) : $no++; ?>
				<tr>
				  <td><?php echo $no; ?></td>
				  <td><?php echo $data['date_create']; ?></td>
					<td><a href="<?php echo site_url('welcome/detail_total_read/'),$data['promotion_id'] ?>"><?php echo $data['promotion_number']; ?></a></td>
				  <td><?php echo $data['nama_departemen']; ?></td>
				  <td><?php echo $data['promotion_name']; ?></td>
				  <td><?php echo $data['fiscal_year']; ?></td>
				  <td><?php echo $data['full_name']; ?></td>
				  <td><?php echo $data['status_name']; ?></td>
				</tr>
				  <?php endforeach; ?>
			  </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>