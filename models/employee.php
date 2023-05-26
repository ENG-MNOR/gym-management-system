<div class="modal fade" id="add-employee">
  <div class="modal-dialog modal-lg">
  <form action="<?php echo escape($_SERVER['PHP_SELF']);?>" method="post">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Add New Member</h4>
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
          <input type="email" placeholder="Email" class="form-control" name="email">
          </div>
        
          <div class="form-group">
          <input type="text" placeholder="Address" class="form-control" name="address">
          </div>  
          <div class="form-group">
            <select name="waqti" class="form-control">
                <option value="" selected > Select a mode</option>
                <?php foreach(readAll('mode') as $mode){?>
                    <option value="<?php echo $mode->id;?>"><?php echo $mode->mode;?></option>
                    <?php } ?>
            </select>
          </div>
           <div class="form-group">
          <input type="text" placeholder="type" class="form-control" name="type">
      </div> 
      <label for=""> Gender:</label>
            <input type="radio" name="gender" value="0"> Male &nbsp;
            <input type="radio" name="gender" value="1"> Female &nbsp;
          </div>
            <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="add-employee">Save changes</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- update employee -->

<div class="modal fade" id="update-member">
  <div class="modal-dialog modal-lg">
  <form action="<?php echo escape($_SERVER['PHP_SELF']);?>" method="post">
  
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Update Employee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">      
          <div class="form-group">
          <input type="text" placeholder="Name" class="form-control" name="name" id="name">
          </div> 
           <label>Date of Birth</label>
          <div class="form-group">
          <input type="date"  class="form-control" name="dob" id="dob">
          </div>
          
          <div class="form-group">
          <input type="text" placeholder="+2526xxxxxxx" class="form-control" name="phone" id="phone">
          </div>
        
          <div class="form-group">
          <input type="email" placeholder="Email" class="form-control" name="email" id="email">
          </div>
        
          <div class="form-group">
          <input type="text" placeholder="Address" class="form-control" name="address" id="address" >
          </div>  
          <div class="form-group">
          <input type="text" placeholder="status" class="form-control" name="status" id="status" >
          <input type="hidden" placeholder="status" class="form-control id" name="id" id="id">
            <select name="waqti" id="waqti" class="form-control waqti">
                <option value="" > Select a shift</option>
                <?php foreach(readAll('mode') as $mode){?>
                    <option value="<?php echo $mode->id;?>"><?php echo $mode->mode;?></option>
                    <?php } ?>
            </select>
          </div>
           <div class="form-group">
          <input type="text" placeholder="type" class="form-control" name="type" id="type">
      </div> 
      <div id="gender">
      <label for="" > Gender:</label>
            <input type="radio" name="gender" value="0"> Male &nbsp;
            <input type="radio" name="gender" value="1"> Female &nbsp;
      </div>
          </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary update" name="update-member">Update</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<!-- delete member -->
<div class="modal fade" id="delete-member">
  <div class="modal-dialog modal-lg">
  <form action="<?php echo escape($_SERVER['PHP_SELF']);?>" method="post">
  
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Update Employee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary update" name="update-member">Update</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>