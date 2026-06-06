<?php 
	include_once('header.php');
?>
    

        <!-- Mobile Specification Form -->
        <div class="specification-form">
            <h2 class="mb-4">Add New Article</h2>
            
            <form action="" method="POST" enctype="">
                <!-- Basic Information -->
                <div class="form-section">
                    <h4>Article Information</h4>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="brand_id" class="form-label">Title</label>
                            <input type="text" class="form-control" id="brand_id" name="title" required>
                        </div>
						<div class="col-md-4 mb-3">
                            <label for="height" class="form-label">Status</label>
							<select class="form-control" id="height" name="status" required>
								<option value="News"> News </option>
								<option value="upcoming-phone"> upcoming-phone </option>
								<option value="Reviews"> Reviews </option>
								<option value="Used"> Used </option>
							</select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="colors" class="form-label">Content</label>
							<textarea name="content" class="form-control" id="colors" rows="8" cols="40" placeholder="Enter your Content..."></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="phone_image">
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
					<button type="reset" class="btn btn-secondary me-2">
						<i class="fas fa-undo"></i> Reset
					</button>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save me-2"></i> Save Specification
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php 
	include_once('footer.php');
?>