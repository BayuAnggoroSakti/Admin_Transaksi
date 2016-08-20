    <table class="table table-bordered" id="myTable">
                <thead>
                  <tr align="center">
                    <th>Nama</th> 
                    <th>Quantity</th> 
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <?php foreach ($get_data->result() as $data) { ?>
                 <tr>
                     <td><?php echo $data->nama ?></td>
                     <td><?php echo $data->qty ?></td>
                     <td><?php echo $data->subtotal ?></td>
                 </tr>   
                <?php
                } ?>
                 
              </table>