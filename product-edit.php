<?php
    require_once("connection/connectdb.php");
?>

<?php
    
    try {
		$sql = "select * from category";
		$stmt_cat = $conn->query($sql);
		$rows_cat = $stmt_cat->fetchAll();		
	} catch(PDOException $ex) {
		echo "Error: " . $ex->getMessage();
	}	

    try {
        $sql = "select * from product where productID = ?";
        $stmt_edit = $conn->prepare($sql);
        $stmt_edit->bindParam(1, $_GET['id']);
        $stmt_edit->execute();
        $row_edit = $stmt_edit->fetch();
    }catch(PDOException $ex) {
        echo 'Error: ' . $ex->getMessage();
    }

    // update product
    if(isset($_POST['update'])) {
        try {
			$sql = "update product  
                    set productName = ?, productPrice = ?, productImage = ?, 
                        productDetails = ?, categoryID = ?     
                    where productID = ?";

            $image = $_POST['image'] == '' ? $_POST['old_image'] : $_POST['image'];
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(1, $_POST['name']);
			$stmt->bindParam(2, $_POST['price']);
			$stmt->bindParam(3, $image);	
			$stmt->bindParam(4, $_POST['details']);
			$stmt->bindParam(5, $_POST['category']);
            $stmt->bindParam(6, $_POST['id']);   
			$stmt->execute();
			header('Location: product-list.php');	// sau khi xác nhận đúng thì sẽ quay về list
		} catch(PDOException $ex) {
			echo "Error: " . $ex->getMessage();
		}
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <title>Product add</title>
</head>

<body>
    <div class="container mt-4">
        <h2>Add new product</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="mb-3 mt-3">
                <label>Product ID:</label>
                <input type="text" class="form-control" 
                       value="<?= $row_edit['productID'] ?>" name="id" readonly>
            </div>
            <div class="mb-3">
                <label>Name:</label>
                <input type="text" class="form-control" 
                       value="<?= $row_edit['productName'] ?>" name="name">
            </div>
            <div class="mb-3">
                <label>Price:</label>
                <input type="number" class="form-control" 
                       value="<?= $row_edit['productPrice'] ?>" name="price">
            </div>
            <div class="mb-3">
                <label>Image:</label>
                <input type="hidden" name="old_image" value="<?= $row_edit['productImage'] ?>">
                <img src=".\assets\img\slider\<?= $row_edit['productImage'] ?>"
                     height="80px" width="70px" alt="no image"> 
                <input type="file" class="form-control" name="image">
            </div>
            <div class="mb-3">
                <label>Details:</label>
                <textarea name="details" rows="5" class="form-control">
                    <?= $row_edit['productDetails'] ?>
                </textarea>
            </div>
            <div class="mb-3">
                <label>Category:</label>
                <select name="category" class="form-control">
                    <?php foreach($rows_cat as $row)  { ?> 
                    <option value="<?= $row['categoryID'] ?>" 
                            <?php echo $row['categoryID'] == $row_edit['categoryID'] ? 'selected' : '' ?> >
                        <?php echo $row['categoryName'] ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
            <a href="product-list.php" class="btn btn-success">Back</a>
        </form>
    </div>
</body>
</html>