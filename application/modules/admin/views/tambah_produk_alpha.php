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

                    <div class="ibox-content">
                            <form id="prosesTambah" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="nama" value="<?php echo set_value('nama') ?>" class="form-control">
                                      <div style="color:red;" id="namaError"></div>
                                    </div>  
                                </div>

                                <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-2 control-label">Tambahkan Gambar</label>
                                  <div class="col-sm-10">
                                    <img id="thumb_image" height="200px" width="200px" src="<?=base_url()?>assets/no_pict.png" /><br /><br />
                                    <span id="thumb_delete" class="glyphicon glyphicon-trash" style="cursor: pointer;">
                                  </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-5">
                                    <input rel="tooltip" title="Browse File" class="btn btn-primary" type="button" value="Browse ..." onclick="$(this).parent().find('input[type=file]').click();">
                                     <input type="file" style="visibility:hidden; width: 1px; height: 1px;" id="alkes_img" name="gambar" onchange="validate_file(this)">
                                 </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Deskripsi</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" name="deskripsi"><?php echo set_value('deskripsi') ?></textarea>
                                      <div style="color:red;" id="deskripsiError"></div>
                                    </div>   
                                </div>

                                 <div class="form-group">
                                  <label class="col-sm-2 control-label">Harga</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="harga" value="<?php echo set_value('harga') ?>" class="form-control">
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
                        </div>
                </div>
            </div>
          <script src="<?php echo base_url('assets/admin/js/plugins/sweetalert/sweetalert.min.js') ?>"></script>
          <script>
             var staf = "<?php base_url('assets/no_pict.png') ?>";
              function validate_file(obj){
                  var file_name = $(obj).val().replace('C:\\fakepath\\', '');
                  var file_name_attr = file_name.split('.');
                  file_name_attr[2] = obj.files[0].size/1024;
                  
                  if(file_name_attr[2] > 5000){
                      $(obj).wrap('<form>').closest('form').get(0).reset();
                      $(obj).unwrap();
                      $(obj).parent().parent().find('.text_file').val('');
                      readURL(obj, 'set');
                      alert('File must jpg and maximum file size under 5 mb!');
                  }
                  else{
                      $(obj).parent().parent().find('.text_file').val(file_name);
                      $('#thumb_delete').fadeIn();
                      readURL(obj);
                  }
              }
              
              function readURL(input, type) {
                  if (type != 'set'){
                      if (input.files && input.files[0]) {
                          var reader = new FileReader();
                  
                          reader.onload = function (e) {
                              $('#thumb_image').attr('src', e.target.result);
                          }
                  
                          reader.readAsDataURL(input.files[0]);
                      }
                  }
                  else{
                      //$('#thumb_image').attr('src','jst/assets/images/no_pict.png');
                      $('#thumb_image').attr('src',staf);
                  }
              }
              
              $(function(){
                  $('#thumb_delete').fadeOut();
                  
                  $('#thumb_delete').click(function(){
                      //$('#thumb_image').attr('src','jst/assets/images/no_pict.png');
                      $('#thumb_image').attr('src',staf);
                      var obj = $('#alkes_img');
                      
                      obj.wrap('<form>').closest('form').get(0).reset();
                      obj.unwrap();
                      obj.parent().parent().find('.text_file').val('');
                      $(this).fadeOut();
                  });
                  
                  $('#alkes_price').change(function(){
                      var value = $(this).autoNumeric('get');
                      $(this).parent().find('input[type="hidden"]').val(value);
                  });
              });
              
            function submit(){
              $('#submited').text('Processing...'); //change button text
              $('#submited').attr('disabled',true); //set button disable
              $('#submited').attr('class','btn btn-warning');
               $.ajax({
                url : '<?php echo site_url("admin/proses_tambah_p") ?>',
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
                            text: "Menambahkan Produk Baru",
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
