<?php 

require_once __DIR__ . '/../../Pages/connect.php';
    $sql = "DELETE FROM employee_details WHERE id=3";
  
  if ($conn->query($sql) === TRUE) {
    echo' <div class="modal" id="myModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Record deleted successfully</h5>        
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
        <i class="bi bi-check-circle bi-primary"></i>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" >Okay</button>
        </div>
  
      </div>
    </div>
  </div>';
  } else {
    echo "Error deleting record: ";
  }
  

?>