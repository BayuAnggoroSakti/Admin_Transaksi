<link href="<?php echo base_url('assets/admin/css/plugins/sweetalert/sweetalert.css') ?>" rel="stylesheet">
   <div class="row" id="konten">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Form Edit User</h5>
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
                            <input type="hidden" name="id_user" value="<?php echo $data->id_user ?>">
                              <div class="form-group">
                                  <label class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="username" value="<?php echo $data->username ?>" class="form-control">
                                      <div style="color:red;" id="usernameError"></div>
                                    </div>
                                     
                                </div>
                                  <div class="form-group">
                                  <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                      <input type="password" name="password" class="form-control">
                                      <div style="color:red;" id="passwordError"></div>
                                    </div>
                                     
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Konfrmasi Password</label>
                                    <div class="col-sm-10">
                                      <input type="password" name="passconf" class="form-control">
                                      <div style="color:red;" id="passconfError"></div>
                                    </div>
                                     
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="nama" value="<?php echo $data->nama ?>" class="form-control">
                                      <div style="color:red;" id="namaError"></div>
                                    </div>
                                     
                                </div>
                                  <div class="form-group">
                                  <label class="col-sm-2 control-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                      <input type="date" name="tgl_lahir" value="<?php echo $data->tanggal_lahir ?>" class="form-control">
                                      <div style="color:red;" id="tglError"></div>
                                    </div>
                                     
                                </div>
                                 <div class="form-group">
                                  <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="email" value="<?php echo $data->email ?>" class="form-control">
                                      <div style="color:red;" id="emailError"></div>
                                    </div>
                                     
                                </div>
                                 <div class="form-group">
                                  <label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" name="alamat"><?php echo $data->alamat ?></textarea>
                                      <div style="color:red;" id="alamatError"></div>
                                    </div>
                                     
                                </div>
                               
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo site_url('admin/user') ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-white">Cancel</a>
                                         <a href="javascript:void(0)" onclick="submit()" id="submited" class="btn btn-primary">Submit</a>
                                    </div>
                                </div>
                                <div id="token">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash()  ?>">
                                </div>
                            </form>
                        </div>
                        <?php 
                          }
                        ?>
                </div>
            </div>
           <script src="<?php echo base_url('assets/admin/js/plugins/sweetalert/sweetalert.min.js') ?>"></script>
          <script>

          function submit(){
              $('#submited').text('Processing...'); //change button text
              $('#submited').attr('disabled',true); //set button disable
              $('#submited').attr('class','btn btn-warning');
               $.ajax({
                url : '<?php echo site_url("admin/user/proses_edit") ?>',
                type: "POST",
                data: $('#prosesTambah').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                  var objek = jQuery.parseJSON(data);
                  if (objek.status == 'false') {
                    $('#namaError').html(objek.nama);
                    $('#alamatError').html(objek.alamat);
                    $('#emailError').html(objek.email);
                    $('#usernameError').html(objek.username);
                    $('#passconfError').html(objek.passconf);
                    $('#passwordError').html(objek.password);
                    $('#tglError').html(objek.tgl_lahir);
                    $('#token').html(' <input type="hidden" id="token" name="'+objek.csrfTokenName+'" value="'+objek.csrfHash+'">');
                    $('#submited').text('Submit'); //change button text
                    $('#submited').attr('disabled',false); //set button disable
                    $('#submited').attr('class','btn btn-primary');
                  }
                  else
                  {
                         swal({
                            title: "Berhasil",
                            text: "Mengubah Data User",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "green",
                            confirmButtonText: "close",
                            closeOnConfirm: false,
                            closeOnCancel: false },
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location.href = "<?php echo base_url('admin/user') ?>";
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
