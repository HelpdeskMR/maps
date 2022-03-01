<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">
          <div class="box-header">
            <h3 class="box-title">APPROVAL PENGGANTI BARANG</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped" id="mytable" style="width:100%; ">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Date Create</th>
                  <th>Claim Number</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0;
                foreach ($row_pengganti_barang as $row) : $no++; ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row->date_create; ?></td>
                  <td><?php echo $row->claim_number; ?></td>
                  <td>
                      <a href="<?php echo base_url('wf_pengganti_barang/read/'.$row->code_pengganti_barang.''); ?>" class="btn btn-sm btn-success"> Read</a>
                  </td>
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
<script src="<?php echo base_url('assets/datatables/dataTables.responsive.js') ?>"></script>
<script>
    $(function() {
        $('#mytable').DataTable({
            "order": [
                [0, "desc"]
            ],
            'paging': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'responsive': true,
        })
    })
</script>