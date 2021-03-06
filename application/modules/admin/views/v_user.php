<link href="<?php echo base_url('assets/admin/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/admin/css/plugins/sweetalert/sweetalert.css') ?>" rel="stylesheet">
          <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2 id="judulKonten"><?php echo $judul ?></h2>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight" id="konten">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Users</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                        </div>
                    </div>

                    <div class="ibox-content">
                         <a href="javascript:void(0)" class="btn btn-primary" id="tambah" onclick="tambah()" >Tambah</a>
                         <a href="javascript:void(0)" id="kembali" onclick="back()" class="btn btn-danger" >Back</a>
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th width="1">No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $i = 1;
                        foreach ($get_data->result() as $data)
                        { ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data->nama ?></td>
                            <td><?php echo $data->username; ?></td>
                            <td><?php echo $data->email; ?></td>
                            <td><?php echo $data->alamat; ?></td>
                            <td><?php if ($data->status == 'active') { ?>
                                <div data-toggle="tooltip" title="Lihat" class="label label-success" style="display:block;"> Active </div>
                            <?php 
                            } elseif($data->status == "pending") { ?>
                                <div data-toggle="tooltip" title="Lihat" class="label label-warning" style="display:block;"> Pending </div>
                            <?php
                            } else { ?>
                                 <div data-toggle="tooltip" title="Lihat" class="label label-danger" style="display:block;"> Not Active </div>
                            <?php
                            }
                             ?></td>
                            <td align="center">
                              <a href="javascript:void(0)" onclick="edit(<?php echo $data->id_user ?>)" class="btn btn-warning">Detail/Edit</a>
                              <?php 
                                if ($data->status != "not_active") { ?>
                                     <a href="javascript:void(0)" onclick="hapus(<?php echo $data->id_user ?>)" class="btn btn-danger">Hapus</a>
                            <?php
                                }  
                              ?>
                             
                            </td>
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
<script src="<?php echo base_url('assets/admin/js/plugins/sweetalert/sweetalert.min.js') ?>"></script>
    <script>

    function hapus(id)
    {
                    swal({
                        title: "Are you sure?",
                        text: "User yang di hapus akan berstatus Not Active",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {
                             $.ajax({
                                url : "<?php echo site_url('admin/user/hapus')?>/"+id,
                                type: "GET",
                                success: function(data)
                                {
                                     swal("Deleted!", "Berhasil Menonaktifkan User", "success");
                                     window.location.href = "<?php echo base_url('admin/user') ?>";
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });
                            
                        } else {
                            swal("Cancelled", "Berhasil dibatalkan", "error");
                        }
                    });
    }

    function edit(id)
    {
          $.ajax({
            url : "<?php echo site_url('admin/user/edit')?>/"+id,
            type: "GET",
            success: function(data)
            {
                 $('#judulKonten').html('Edit User');
                 $('#kembali').show();
                 $('#tambah').hide();
                 $('#konten').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function tambah()
        {
            $.ajax({
                url : "<?php echo site_url('admin/user/tambah')?>",
                success: function(data)
                {
                     $('#judulKonten').html('Tambah User');
                     $('#kembali').show();
                     $('#tambah').hide();
                     $('#konten').html(data);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        $(document).ready(function(){
            $('#kembali').hide();
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
               