<div class="modal fade" id="add-teachers">
  <div class="modal-dialog modal-lg">
  <form action="<?php echo escape($_SERVER['PHP_SELF']);?>" method="post">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Add New Teacher</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">      
          <div class="form-group">
          <input type="text" placeholder="Name" class="form-control" name="name">
          </div> 
           <label>Date of Birth</label>
          <div class="form-group">
          <input type="date"  class="form-control" name="dob">
          </div>
          
          <div class="form-group">
          <input type="number" placeholder="+2526xxxxxxx" class="form-control" name="phone">
          </div>
        
          <div class="form-group">
          <input type="text" placeholder="Address" class="form-control" name="address">
          </div>  
          <div class="form-group">
            <select name="waqti" class="form-control">
                <option value="" selected disabled> Select a shift</option>
                <?php foreach(readAll('shift') as $shift){?>
                    <option value="<?= $shift->id;?>"><?= $shift->shift;?></option>
                    <?php } ?>
            </select>
          </div>
         
      
          </div>
            <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="add-teacher">Save changes</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- update employee -->

<div class="modal fade" id="update-teacher">
  <div class="modal-dialog modal-lg">
  <form action="<?php echo escape($_SERVER['PHP_SELF']);?>" method="post">
  
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Update teacher</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">      
          <div class="form-group">
          <input type="text" placeholder="Name" class="form-control" name="name" id="name">
          </div> 
          <div class="form-group">
          <input type="hidden" placeholder="id" class="form-control" name="id" id="id">
          </div> 
           <label>Date of Birth</label>
          <div class="form-group">
          <input type="date"  class="form-control" name="dob" id="dob">
          </div>
          
          <div class="form-group">
          <input type="number" placeholder="+2526xxxxxxx" class="form-control" name="phone"  id="phone">
          </div>
        
          <div class="form-group">
          <input type="text" placeholder="Address" class="form-control" name="address"  id="address">
          </div>  
          <div class="form-group">
            <select name="waqti" class="form-control" id="waqti">
                <option value="" selected disabled> Select a shift</option>
                <?php foreach(readAll('shift') as $shift){?>
                    <option value="<?= $shift->id;?>"><?= $shift->shift;?></option>
                    <?php } ?>
            </select>
          </div>
         
      
          </div>
         
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="update-teacher">Update</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- delete member -->
