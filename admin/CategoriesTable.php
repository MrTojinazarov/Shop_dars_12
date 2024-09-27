<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=market", 'root', 'mr2344');

$sql2 = "SELECT * FROM categories";
$statement = $con->query($sql2);
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

include 'header.php';
?>

<div class="container-fluid">
    <div class="row m-3">
        <div class="col-3">
            <h1>Categories</h1>
            <a href="Category.php" class="btn btn-outline-primary">Create</a>
        </div>
    </div>
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col" style="width: 50px;">Id</th>
                <th scope="col" style="width: 150px;">Name</th>
                <th scope="col" style="width: 150px;">Tartibi</th>
                <th scope="col" style="width: 150px;">Active</th>
                <th scope="col" style="width: 150px;">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($categories as $category) { ?>
                <tr>
                    <th scope="row"><?= $category['id'] ?></th>
                    <td><?= $category['name'] ?></td>
                    <td>
                        <?php
                            if($category['tr'] == 1){
                                echo "Eng ommabop";
                            }elseif($category['tr'] == 2){
                                echo "Eng arzon";
                            }elseif($category['tr'] == 3){
                                echo "Eng qimmat";
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($category['active'] == 1) {
                            echo "True";
                        } else {
                            echo 'False';
                        }
                        ?>
                    </td>
                    <td>
                        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="<?php echo '#UpdateModal' . $category['id'] ?>">
                            Update
                        </a>
                        <div class="modal fade" id="<?php echo 'UpdateModal' . $category['id'] ?>" tabindex="-1" aria-labelledby="UpdateModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="categoryUpdate.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="UpdateModalLabel">Update category</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="name" value="<?= $category['name'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tr" class="form-label">Categories</label>
                                                <select class="form-select" name="tr">
                                                        <option value="1">Eng ommabop</option>
                                                        <option value="2">Eng arzon</option>
                                                        <option value="3">Eng qimmat</option>
                                                </select>
                                            </div>
                                            <div>
                                                <?php if ($category['active'] == 1) { ?>
                                                    <label for="active" class="form-label">Active</label>
                                                    <input type="radio" name="active" id="active" value="1" checked><br>
                                                    <label for="notactive" class="form-label">Not Active</label>
                                                    <input type="radio" name="active" id="notactive" value="0">
                                                <?php } else { ?>
                                                    <label for="active" class="form-label">Active</label>
                                                    <input type="radio" name="active" id="active" value="1"><br>
                                                    <label for="notactive" class="form-label">Not Active</label>
                                                    <input type="radio" name="active" id="notactive" value="0" checked>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="ok" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="<?php echo '#DeleteModal' . $category['id'] ?>">
                            Delete
                        </a>
                        <div class="modal fade" id="<?php echo 'DeleteModal' . $category['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="CategoryDelete.php" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">category qo'shish</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                            <h1><?php echo $category['name'] . "ni o'chirishni hohlaysizmi?" ?></h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="ok" class="btn btn-primary">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>

<?php
include 'footer.php';
?>