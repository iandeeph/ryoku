<div class="row">
<?php
    if(isset($_GET['menu']) == 'product' && isset($_GET['detail'])){
        include 'product-detail.php';
    }else{
        $prodNameASC = "ORDER BY product.name ASC";
        $prodNameDESC = "ORDER BY product.name DESC";
        $brandNameASC = "ORDER BY brand.name ASC";
        $brandNameDESC = "ORDER BY brand.name DESC";
        $catMainASC = "ORDER BY category.main ASC";
        $catMainDESC = "ORDER BY category.main DESC";
        $catSubASC = "ORDER BY category.sub ASC";
        $catSubDESC = "ORDER BY category.sub DESC";

        $sortProdList = isset($sortProdList)?$sortProdList:'';
        $sort = isset($sort)?$sort:'';

        if($menu == 'product' && $sortProdList == 'product' && $sort == 'asc'){
            $orderSortListQy = $prodNameASC;
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'product' && $sort == 'desc')
        {
            $orderSortListQy = $prodNameDESC;
            $sortIconProduct = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'brand' && $sort == 'asc')
        {
            $orderSortListQy = $brandNameASC;
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'brand' && $sort == 'desc')
        {
            $orderSortListQy = $brandNameDESC;
            $sortIconBrand = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'main' && $sort == 'asc')
        {
            $orderSortListQy = $catMainASC;
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'main' && $sort == 'desc')
        {
            $orderSortListQy = $catMainDESC;
            $sortIconMain = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'sub' && $sort == 'asc')
        {
            $orderSortListQy = $catSubASC;
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'sub' && $sort == 'desc')
        {
            $orderSortListQy = $catSubDESC;
            $sortIconSub = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }else{
            $orderSortListQy = "";
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }

    ?>
        <div class="col s12 border-bottom grey lighten-2 mb-10">
            <h3 class="left-align">Product List</h3>
        </div>
        <div class="col s12">
            <a href="#addProductModal" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right mb-30" title="Add more images"><i class="material-icons">add</i></a>
        </div>
        <div class="col s12">
            <a class="waves-effect waves-light btn red accent-4 disabled"><i class="material-icons left">delete</i>Delete</a>
        </div>
        <div class="col s12">
            <form action="#" method="post" enctype="multipart/form-data">
                <table class="highlight responsive-table">
                    <thead>
                            <td width="50px">
                                <p>
                                    <input type="checkbox" id="checkAll" />
                                    <label for="checkAll"></label>
                                </p>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=product&sortProdList=product&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>">Product name<?php echo $sortIconProduct; ?></a></div>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=product&sortProdList=brand&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>"><span class="black-font">Brand</span><?php echo $sortIconBrand; ?></a></div>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=product&sortProdList=main&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>"><span class="black-font">Main Category</span><?php echo $sortIconMain; ?></a></div>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=product&sortProdList=sub&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>"><span class="black-font">Sub Category</span><?php echo $sortIconSub; ?></a></div>
                            </td>
                            <td>
                                Total Images
                            </td>
                            <td>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            $prodListQry = "SELECT 
                                            product.idproduct as idproduct,
                                            product.name as name,
                                            product.idcategory as idcategory,
                                            brand.name as brandName,
                                            category.main as main,
                                            category.sub as sub
                                            FROM 
                                                product,
                                                brand,
                                                category
                                            WHERE product.idbrand = brand.idbrand AND product.idcategory = category.idcategory
                                            ".$orderSortListQy."";

                            if($resultProdList = mysqli_query($conn, $prodListQry) or die("Query failed :".mysqli_error($conn))){
                                if(mysqli_num_rows($resultProdList) > 0){
                                    while($rowProdList = mysqli_fetch_array($resultProdList)){
                                        $idProduct          = $rowProdList['idproduct'];
                                        $nameProdList       = $rowProdList['name'];
                                        $idCatProdList      = $rowProdList['idcategory'];
                                        $nameBrandProdList  = $rowProdList['brandName'];
                                        $mainCatProdList  = $rowProdList['main'];
                                        $subCatProdList  = $rowProdList['sub'];

                                        $totImagesProdList = "SELECT count(*) as totalImages FROM images WHERE owner = 'product' AND idowner = '".$idProduct."'";
                                        if($resultImagesProdList = mysqli_query($conn, $totImagesProdList)){
                                            if(mysqli_num_rows($resultImagesProdList) > 0){
                                                $rowImagesBrandQry = mysqli_fetch_array($resultImagesProdList);
                                                $totalImages = $rowImagesBrandQry['totalImages'];
                                            }
                                        }
                                        ?>
                                            <tr>
                                                <td>
                                                    <p>
                                                        <input type="checkbox" id="checkAll" name="<?php echo $idProduct; ?>"/>
                                                        <label for="checkAll"></label>
                                                    </p>
                                                </td>
                                                <td>
                                                    <?php echo $nameProdList; ?>
                                                </td>
                                                <td>
                                                    <?php echo $nameBrandProdList; ?>
                                                </td>
                                                <td>
                                                    <?php echo $mainCatProdList; ?>
                                                </td>
                                                <td>
                                                    <?php echo $subCatProdList; ?>
                                                </td>
                                                <td>
                                                    <?php echo $totalImages; ?>
                                                </td>
                                                <td>
                                                    <div class="col s12">
                                                        <a href="./index.php?menu=product&detail=<?php echo $idProduct; ?>" class="waves-effect waves-light btn green darken-4" id="<?php echo $idProduct; ?>"><i class="material-icons left">edit</i>Edit</a>
                                                    </div>
                                                </td>
                                            </tr>  
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <div id="addProductModal" class="modal">
                    <div class="modal-content">
                        <div class="col s12">
                            <div class="col s12 border-bottom pdb-10">
                                <h5 class="col s12 m6 l6">Add New Product</h5>
                            </div>
                            <div class="input-field col s12 m7 l7 mt-30">
                                <input id="titleProductAdd" name="titleProductAdd" type="text" class="validate">
                                <label for="titleProductAdd">Product Name</label>
                            </div>
                            <div class="input-field col s12 m7 l7">
                                <input id="brandProductAdd" name="brandProductAdd" type="text" class="validate">
                                <label for="brandProductAdd">Brand</label>
                            </div>
                            <div class="input-field col s12 m6 l6">
                                <input id="mainCatAdd" name="mainCatAdd" type="text" class="validate">
                                <label for="mainCatAdd">Main Category</label>
                            </div>
                            <div class="input-field col s12 m6 l6">
                                <input id="subCatAdd" name="subCatAdd" type="text" class="validate">
                                <label for="subCatAdd">Sub Category</label>
                            </div>
                            <div class="input-field col s12 mt-30">
                                <textarea id="wysiwygEditor" class="materialize-textarea">Some text to product specification</textarea>
                            </div>
                            <div class="col s12">
                                <a class="mt-30 mb-30 right waves-effect waves-light btn blue darken-4 disabled"><i class="material-icons left">add</i>Add</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php
    }
    ?>
</div>