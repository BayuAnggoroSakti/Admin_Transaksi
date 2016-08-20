<link href="<?php echo base_url('assets/admin/css/plugins/sweetalert/sweetalert.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/admin/css/animate.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/admin/css/plugins/dropzone/basic.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/admin/css/plugins/dropzone/dropzone.css') ?>" rel="stylesheet">
                  <div class="ibox-content">
                        <form id="myAwesomeDropzone" class="dropzone" action="#">
                            <div class="dropzone-previews"></div>
                            <button type="submit" class="btn btn-primary pull-right">Submit this form!</button>
                        </form>
                        <div>
                            <div class="m text-right"><small>DropzoneJS is an open source library that provides drag'n'drop file uploads with image previews: <a href="https://github.com/enyo/dropzone" target="_blank">https://github.com/enyo/dropzone</a></small> </div>
                        </div>
                    </div>

          <script src="<?php echo base_url('assets/admin/js/jquery-2.1.1.js') ?>"></script>
          <script src="<?php echo base_url('assets/admin/js/bootstrap.min.js') ?>"></script>
          <script src="<?php echo base_url('assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>
          <script src="<?php echo base_url('assets/admin/js/plugins/metisMenu/jquery.metisMenu.js') ?>"></script>
          <script src="<?php echo base_url('assets/admin/js/plugins/sweetalert/sweetalert.min.js') ?>"></script>
          <script src="<?php echo base_url('assets/admin/js/plugins/dropzone/dropzone.js') ?>"></script>
          <script src="<?php echo base_url('assets/admin/js/inspinia.js') ?>"></script>
          <script src="<?php echo base_url('assets/admin/js/plugins/pace/pace.min.js') ?>"></script>
          <script>

             $(document).ready(function(){

                Dropzone.options.myAwesomeDropzone = {

                    autoProcessQueue: false,
                    uploadMultiple: true,
                    parallelUploads: 100,
                    maxFiles: 100,

                    // Dropzone settings
                    init: function() {
                        var myDropzone = this;

                        this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            myDropzone.processQueue();
                        });
                        this.on("sendingmultiple", function() {
                        });
                        this.on("successmultiple", function(files, response) {
                        });
                        this.on("errormultiple", function(files, response) {
                        });
                    }

                }

           });
          </script>
