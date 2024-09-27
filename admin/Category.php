<?php include 'header.php'; ?>

<div class="container-fluid">
    <h2>Add New Category</h2>
    <div class="row mt-3 mb-3 ms-1">
        <div class="col-2">
        <a href="CategoriesTable.php" class="btn btn-outline-primary">Back</a>
        </div>
    </div>
    <form action="addcategory.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" required>
        </div>

        <div class="mb-3">
            <label for="tr" class="form-label">Product Level</label>
            <select class="form-select" id="tr" name="tr" required>
                <option value="1">Eng ommabop</option>
                <option value="2">Eng arzon</option>
                <option value="3">Eng qimmat</option>
            </select>
        </div>
        <div>
            <label for="active" class="form-label">Active</label>
            <input type="radio" name="active" id="active" value="1"><br>
            <label for="notactive" class="form-label">Not Active</label>
            <input type="radio" name="active" id="notactive" value="0">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
    </form>
</div>

<?php include 'footer.php'; ?>