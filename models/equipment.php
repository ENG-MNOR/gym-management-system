<div class="modal fade" id="add-equipment">
  <div class="modal-dialog modal-lg">
  <form action="<?php echo escape($_SERVER['PHP_SELF']);?>" method="post">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Add New equipment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">  
        
          <div class="form-group">
          <input type="text" placeholder="Name" class="form-control" name="name">
          </div> 
          <div class="form-group">
          <input type="number" placeholder="Cost" class="form-control" name="cost">
          </div>
        
          <div class="form-group">
          <input type="number" placeholder="Quantity" class="form-control" name="quantity">
          </div>  
         
          </div>
            <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="add-equipment">Save changes</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- update employee -->

<div class="modal fade" id="update-equipment">
  <div class="modal-dialog modal-lg">
  <form action="<?php echo escape($_SERVER['PHP_SELF']);?>" method="post">
  
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Update equipment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">      
      <div class="form-group">
          <input type="hidden" placeholder="ID" class="form-control" name="id" id="id">
          </div>   
          <div class="form-group">
          <input type="text" placeholder="Name" class="form-control" name="name" id="name">
          </div> 
          <div class="form-group">
          <input type="number" placeholder="Cost" class="form-control" name="cost" id="cost">
          </div>
        
          <div class="form-group">
          <input type="number" placeholder="Quantity" class="form-control" name="quantity" id="quantity">
          </div>  
         
          </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="update-equipment">Update</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- delete member -->
