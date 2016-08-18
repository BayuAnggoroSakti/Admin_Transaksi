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
                        <h5>Detail Transaksi</h5>
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
                        <th>ID Transaksi</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Produk</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $i = 1;
                        foreach ($get_data->result() as $data)
                        { ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data->id_transaksi; ?></td>
                            <td><?php echo $data->nama ?></td>
                            <td><?php echo $data->qty; ?></td>
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
    </script>
               