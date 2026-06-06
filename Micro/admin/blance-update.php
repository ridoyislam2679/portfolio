
   
    <!-- Main Content -->
   
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">User Blance Update</h1>
            </div>

            <!-- Add Task Form -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Blance Information</h6>
                </div>
                <div class="card-body">
                    <form id="taskForm" method="POST" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="taskTitle" class="form-label">User Id</label>
                                    <input type="text" name="userId" class="form-control" id="taskTitle" placeholder="Enter task title" required>
                                </div>
                            </div>
							<div class="col-md-6">
                                <div class="form-group">
                                    <label for="taskTitle" class="form-label">User Email</label>
                                    <input type="email" name="userEmail" class="form-control" id="taskTitle" placeholder="Enter task title" required>
                                </div>
                            </div>
                        </div>
                        
						<div class="form-group mb-4">
                            <label for="total-blance" class="form-label">Total Blance</label>
                            <input type="number" name="total_blance" class="form-control" id="total-blance" placeholder="Enter total blance" required>
                        </div>
						
                        <div class="form-group mb-4">
                            <label for="main-blance" class="form-label">Main Blance</label>
                            <input type="number" name="main_blance" class="form-control" id="main-blance" placeholder="Enter main blance" required>
                        </div>
						
						<div class="form-group mb-4">
                            <label for="total-coin" class="form-label">Total Coin</label>
                            <input type="number" name="total_coin" class="form-control" id="total-coin" placeholder="Enter total coin" required>
                        </div>
						
						<div class="form-group mb-4">
                            <label for="rit-coin" class="form-label">Rit Coin</label>
                            <input type="number" name="rit_coin" class="form-control" id="rit-coin" placeholder="Enter rit coin" required>
                        </div>
                        
						<div class="form-group mb-4">
                            <label for="free-spain" class="form-label">Free Spain</label>
                            <input type="number" name="free_spain" class="form-control" id="free-spain" placeholder="Enter free spain" required>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" name="update_blance" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Blance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   
