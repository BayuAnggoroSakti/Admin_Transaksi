<link href="<?php echo base_url('assets/admin/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
          <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $judul ?></h2>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Transaksi</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th width="1">No</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Lokasi</th>
                        <th>Alamat</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $i = 1;
                        foreach ($get_data->result() as $data)
                        { ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><a href="javascript:void(0)"" onclick="detail(<?php echo $data->id_transaksi ?>)"><?php echo IndoFormat::indonesian_date($data->tanggal); ?></a></td>
                            <td><?php echo $data->user ?></td>
                            <td><?php echo IndoFormat::rupiah($data->total); ?></td>
                            <td><?php echo $data->lokasi; ?></td>
                            <td><?php echo $data->alamat; ?></td>  
                          </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
           
        </div>
<script src="<?php echo base_url('assets/admin/js/jquery-2.1.1.js') ?>"></script>
<script src="<?php echo base_url('assets/admin/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/admin/js/plugins/dataTables/datatables.min.js') ?>"></script>
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
        });

        function detail(id){
             $("#modal_form").modal({"backdrop": "static"});
                $.ajax({
                    url : "<?php echo site_url('admin/detail')?>/" + id,
                    type: "GET",
                    success: function(data)
                    {
                        //console.log(data);
                    /*  for (var i = 0; i < data.length; i++) {
                        $('#body').append('<tr><td>'+data[i].nama+'</td><td>'+data[i].qty+'</td><td>'+data[i].subtotal+'</td></tr>');
                        console.log(data[i].nama);
                        }*/
                        $('#myTable').html(data);
                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded

                        $('.modal-title').text('Detail Transaksi'); // Set title to Bootstrap modal title
                        
             
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
        }
        function close()
        {
            $('#body').remove();;
        }
    </script>
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="close()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" align="center">Person Form</h3>
                <hr>
            </div>
            <div class="modal-body">
              <table class="table table-bordered" id="myTable">
                <thead>
                  <tr align="center">
                    <th>Nama</th> 
                    <th>Quantity</th> 
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody id="body">
                  
                </tbody>
              </table>
            </div>
           
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
               