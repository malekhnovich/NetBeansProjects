<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
<?php
require_once('database.php');

//Get category ID
if (isset($_GET[‘category_id’])) {
$category_id = $_GET[‘category_id’];
//}
/**if(!isset(($category_id))) {
    $category_id = $_GET['category_id'];
    if (!isset($category_id))) {
        $category_id = 1;
    }
}
 * 
 */
//Get name for current category
$query = "SELECT * FROM categories'
                    . 'WHERE categoryID=$category_id";
$category = $db->query($query);
$category = $category->fetch();
$category_name = $category['categoryName'];

//Get all categories
$query = 'SELECT * FROM categories '
        . 'ORDER BY categoryID';
$categories = $db->query($query);

//Get products for selected category
$query = "SELECT * FROM products "
        . "WHERE categoryID=$category_id
                    ORDER BY productID";
$products = $db->query($query)
?>
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="page">
            <div id=""header">
                 <h1> Product Manager </h1>  
            </div>
            <div id="main"></div>
            <h1> Product List </h1>
            <div id="sidebar">
                <!-- display a dropdown list of categories -->
                <h2> Categories </h2>
                <ul class="nav">
                    <?php foreach ($categories as $category) : ?>
                        <li>
                            <a href="?category_id=<?php echo $category['categoryID']; ?>">
                                <?php echo $category['categoryName']; ?>

                            </a>

                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div id="content">
                <!-- displat a table of products -->
                <h2><?php echo $category_name; ?></h2>
                <table>
                    <tr>
                        <th> Code</th>
                        <th> Name </th>
                        <th class="right">Price </th>
                        <th &nbsp; </th>
                    </tr>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td> <?php echo $product['productCode'];?></td>
                        <td> <?php echo $product['productName'];?></td>
                        <td class="right"><?php echo $product['listPrice'];?></td>
                        <td><form action="delete_product.php" method="post"
                                id="delete_product_form">
                            <input type="hidden" name="product_id"
                                   value="<?php echo $product['productID'];?>"/>
                            <input typee="hidden" name="category_id"
                                   value="<?php echo $product['categoryID'];?>"/>
                            <input type="submit" value="Delete" />
                            
                            </form> </td>
                            
                    </tr>
                    <?php endforeach; ?>
                    
                </table>
                <p><a href="add_product_form.php">Add Product </a> </p>
            </div>
        </div>
        <div id="footer">
            <p>&copy; <?php echo date("Y");?> My Guitar Shop, Inc. </p>
        </div>
    </div>
    </body>
</html>
