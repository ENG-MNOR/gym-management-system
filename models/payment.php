<div class="modal fade" id="payment">
  <div class="modal-dialog modal-lg">
  <form action="<?php echo escape($_SERVER['PHP_SELF']);?>" method="post">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Add New payment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">      
      <div class="form-group">
            <select name="name" class="form-control" id="name">
                <option value="" selected disabled> Select a member</option>
                <?php foreach(readAll('member') as $member){?>
                    <option value="<?= $member->id;?>"><?= $member->name;?></option>
                    <?php } ?>
            </select>
          </div>
           <label>month of payment</label>
          <div class="form-group">
          <input type="date"  class="form-control" name="month" id="month">
          </div>
          <div class="form-group">
          <input type="hidden"  class="form-control" name="id" id="id">
          </div>
          
          <div class="form-group">
          <input type="number" placeholder="amount" class="form-control" name="amount" id="amount" disabled>
          </div>  
          </div>
            <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="payment">Pay</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- update employee -->



