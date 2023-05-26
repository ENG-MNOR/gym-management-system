<div class="modal fade" id="add-user">
  <div class="modal-dialog modal-lg">
  <form action="<?php echo escape($_SERVER['PHP_SELF']);?>" method="post">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Add New User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">      
          <div class="form-group">
          <input type="text" placeholder="Name" class="form-control" name="name" >
          </div> 
           <label>Date of Birth</label>
          <div class="form-group">
          <input type="date"  class="form-control" name="dob" >
          </div>
          
          <div class="form-group">
          <input type="number" placeholder="+2526xxxxxxx" class="form-control" name="phone" >
          </div>
        
          <div class="form-group">
          <input type="number" placeholder="Password" class="form-control" name="password" >
          </div>
        
          <div class="form-group">
          <input type="text" placeholder="Address" class="form-control" name="address" >
          </div>  
          <div class="form-group">
            <select name="type" class="form-control" >
                <option value="" selected disabled> Select a user type</option>
                    <option value="0">Admin</option>
                    <option value="1">user</option>
            </select>
          </div>
          <div class="form-group">
            <select name="status" class="form-control" >
                <option value="" selected disabled> Select a user status</option>
                    <option value="0">Active</option>
                    <option value="1">Block</option>
            </select>
          </div>
       
      <label for=""> Gender:</label>
            <input type="radio" name="gender" value="0"> Male &nbsp;
            <input type="radio" name="gender" value="1"> Female &nbsp;

          </div>
            <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="add-user">Save changes</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- update employee -->

<div class="modal fade" id="update-user">
  <div class="modal-dialog modal-lg">
  <form action="<?php echo escape($_SERVER['PHP_SELF']);?>" method="post">
  
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Update user</h4>
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
          <input type="number" placeholder="+2526xxxxxxx" class="form-control" name="phone" id="phone">
          </div>
        
          <div class="form-group">
          <input type="number" placeholder="Password" class="form-control" name="password" id="password">
          </div>
        
          <div class="form-group">
          <input type="text" placeholder="Address" class="form-control" name="address" id="address">
          </div>  
          <div class="form-group">
            <select name="type" class="form-control" id="type">
                <option value="" selected disabled> Select a user type</option>
                    <option value="0">Admin</option>
                    <option value="1">user</option>
            </select>
          </div>
          <select name="status" id="status" class="form-control status">
                <option value="" selected disabled > Select a status</option>
                 <option value="0">Active</option>
                 <option value="1">block</option>
            </select>
       <div id ="gender">
      <label for=""> Gender:</label>
            <input type="radio" name="gender" value="0"> Male &nbsp;
            <input type="radio" name="gender" value="1"> Female &nbsp;
</div>
          </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="update-user">Update</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- delete member -->
