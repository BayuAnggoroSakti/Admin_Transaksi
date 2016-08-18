<link href="<?php echo base_url('assets/admin/css/plugins/sweetalert/sweetalert.css') ?>" rel="stylesheet">
   <div class="row" id="konten">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Form Tambah Produk</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                        </div>
                    </div>
                    <?php 
                      foreach ($get_data->result() as $data) {

                    ?>
                    <div class="ibox-content">
                            <form id="prosesTambah" class="form-horizontal">
                            <input type="hidden" name="id_produk" value="<?php echo $data->id_produk ?>">
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="nama" value="<?php echo $data->nama ?>" class="form-control">
                                      <div style="color:red;" id="namaError"></div>
                                    </div>
                                     
                                </div>
                                 <div class="form-group">
                                  <label class="col-sm-2 control-label">Deskripsi</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" name="deskripsi"><?php echo $data->deskripsi ?></textarea>
                                      <div style="color:red;" id="deskripsiError"></div>
                                    </div>
                                     
                                </div>
                                 <div class="form-group">
                                  <label class="col-sm-2 control-label">Harga</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="harga" value="<?php echo $data->harga ?>" class="form-control">
                                      <div style="color:red;" id="hargaError"></div>
                                    </div>
                                    
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo site_url('admin/produk') ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-white">Cancel</a>
                                         <a href="javascript:void(0)" id="submited" onclick="submit()" class="btn btn-primary">Submit</a>
                                    </div>
                                </div>
                                <div id="token">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash()  ?>">
                                </div>
                            </form>
                            <?php 
                              }
                            ?>
                        </div>
                </div>
            </div>
           <script src="<?php echo base_url('assets/admin/js/plugins/sweetalert/sweetalert.min.js') ?>"></script>
          <script>

          function submit(){
              $('#submited').text('Processing...'); //change button text
              $('#submited').attr('disabled',true); //set button disable
              $('#submited').attr('class','btn btn-warning');
               $.ajax({
                url : '<?php echo site_url("admin/proses_edit_p") ?>',
                type: "POST",
                data: $('#prosesTambah').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                  var objek = jQuery.parseJSON(data);
                  if (objek.status == 'false') {
                    $('#hargaError').html(objek.harga);
                    $('#namaError').html(objek.nama);
                    $('#deskripsiError').html(objek.deskripsi);
                    $('#token').html(' <input type="hidden" id="token" name="'+objek.csrfTokenName+'" value="'+objek.csrfHash+'">');

                    $('#submited').text('Submit'); //change button text
                    $('#submited').attr('disabled',false); //set button disable
                    $('#submited').attr('class','btn btn-primary');
                  }
                  else
                  {
                         swal({
                            title: "Berhasil",
                            text: "Mengubah Data Produk",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "green",
                            confirmButtonText: "close",
                            closeOnConfirm: false,
                            closeOnCancel: false },
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location.href = "<?php echo base_url('admin/produk') ?>";
                            } 
                        });
                  }
                  
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert(errorThrown);
         
                }
            });
           }
          </script>
