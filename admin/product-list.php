<div class="row">
<?php
    if(isset($_GET['menu']) == 'product' && isset($_GET['detail'])){
        include 'product-detail.php';
    }else{
        $prodNameASC = "ORDER BY product.name ASC";
        $prodNameDESC = "ORDER BY product.name DESC";
        $brandNameASC = "ORDER BY brand.name ASC";
        $brandNameDESC = "ORDER BY brand.name DESC";
        $catMainASC = "ORDER BY product.mainCategory ASC";
        $catMainDESC = "ORDER BY product.mainCategory DESC";
        $catSubASC = "ORDER BY product.subCategory ASC";
        $catSubDESC = "ORDER BY product.subCategory DESC";

        $sortProdList = isset($_GET['sortProdList'])?$_GET['sortProdList']:'';
        $sort = isset($_GET['sort'])?$_GET['sort']:'';

        if($menu == 'product' && $sortProdList == 'product' && $sort == 'asc'){
            $orderSortListQry = $prodNameASC;
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'product' && $sort == 'desc')
        {
            $orderSortListQry = $prodNameDESC;
            $sortIconProduct = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'brand' && $sort == 'asc')
        {
            $orderSortListQry = $brandNameASC;
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'brand' && $sort == 'desc')
        {
            $orderSortListQry = $brandNameDESC;
            $sortIconBrand = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'main' && $sort == 'asc')
        {
            $orderSortListQry = $catMainASC;
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'main' && $sort == 'desc')
        {
            $orderSortListQry = $catMainDESC;
            $sortIconMain = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'sub' && $sort == 'asc')
        {
            $orderSortListQry = $catSubASC;
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'product' && $sortProdList == 'sub' && $sort == 'desc')
        {
            $orderSortListQry = $catSubDESC;
            $sortIconSub = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }else{
            $orderSortListQry = "";
            $sortIconSub = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconBrand = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconMain = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProduct = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }

// ========================================= ADD PRODUCT SUBMIT =======================
    if(isset($_POST['btnAddProductSubmit'])){
        $postName           = $_POST['addProdName'];
        $postBrand          = $_POST['brandProductAddSelect'];
        $postMainCat        = $_POST['mainCatAdd'];
        $postSubCat         = $_POST['subCatAdd'];
        $postContentWord    = $_POST['addContentWordProduct'];

        $insertNewProduct = "INSERT INTO product (name, idbrand, mainCategory, subCategory, contentWord) VALUES ('".$postName."', '".$postBrand."', '".$postMainCat."', '".$postSubCat."', '".$postContentWord."')";
        if(mysqli_query($conn, $insertNewProduct)){
            header('Location: ./index.php?menu=product&cat=list');
        }else{
            $postMessages = "ERROR: Could not able to execute ".$insertNewProduct.". " . mysqli_error($conn);
            $colorMessages = "red-text";
        }
    }

// ==================================== BUTTON DELETE SUBMIT ===============================
    if(isset($_POST['btnDeleteProductList'])){
        $delProdQry = "DELETE FROM product WHERE idproduct in (".implode($_POST['checkboxProductList'], ',').")";

        if(mysqli_query($conn, $delProdQry)){
            $delImagesQry = "DELETE FROM images WHERE owner = 'product' AND idowner in (".implode($_POST['checkboxProductList'], ',').")";

            if(mysqli_query($conn, $delImagesQry)){
                $unsetImagesQry = "SELECT path FROM images WHERE owner = 'product' AND idowner in (".implode($_POST['checkboxProductList'], ',').")";

                if($resultPathImages = mysqli_query($conn, $unsetImagesQry)){
                    if(mysqli_num_rows($resultPathImages) > 0){
                        $rowPathImages = mysqli_fetch_array($resultPathImages);
                        $pathImages = $rowPathImages['path'];
                        unlink("../".$pathImages);
                        header('Location: ./index.php?menu=product&cat=list');
                    }
                }else{
                    $postMessages = "ERROR: Could not able to execute ".$unsetImagesQry.". " . mysqli_error($conn);
                    $colorMessages = "red-text";
                }

            }else{
                $postMessages = "ERROR: Could not able to execute ".$delImagesQry.". " . mysqli_error($conn);
                $colorMessages = "red-text";
            }

        }else{
            $postMessages = "ERROR: Could not able to execute ".$delProdQry.". " . mysqli_error($conn);
            $colorMessages = "red-text";
        }

    }
    ?>
        <div class="col s12 border-bottom grey lighten-2 mb-10">
            <h3 class="left-align">Product List</h3>
        </div>
        <div class="col s12">
            <a id="delSelectionProduct" href="#modalDelProductItems" class="modal-trigger waves-effect waves-light btn red accent-4 disabled mt-30"><i class="material-icons left">delete</i>Delete</a>
            <a href="#addProductModal" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right mb-30" title="Add more images"><i class="material-icons">add</i></a>
        </div>
        <div class="col s12">
            <form action="#" method="post" enctype="multipart/form-data">
                <table class="highlight responsive-table">
                    <thead>
                            <td width="50px">
                                <p>
                                    <input type="checkbox" id="checkAllProdList" />
                                    <label for="checkAllProdList"></label>
                                </p>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=product&cat=list&sortProdList=product&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>">Product name<?php echo $sortIconProduct; ?></a></div>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=product&cat=list&sortProdList=brand&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>"><span class="black-font">Brand</span><?php echo $sortIconBrand; ?></a></div>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=product&cat=list&sortProdList=main&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>"><span class="black-font">Main Category</span><?php echo $sortIconMain; ?></a></div>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=product&cat=list&sortProdList=sub&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>"><span class="black-font">Sub Category</span><?php echo $sortIconSub; ?></a></div>
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
                                            product.mainCategory as mainCategory,
                                            product.subCategory as subCategory,
                                            brand.name as brandName
                                            FROM 
                                                product,
                                                brand
                                            WHERE product.idbrand = brand.idbrand
                                            ".$orderSortListQry."";

                            if($resultProdList = mysqli_query($conn, $prodListQry) or die("Query failed :".mysqli_error($conn))){
                                if(mysqli_num_rows($resultProdList) > 0){
                                    while($rowProdList = mysqli_fetch_array($resultProdList)){
                                        $idProduct          = $rowProdList['idproduct'];
                                        $nameProdList       = $rowProdList['name'];
                                        $nameBrandProdList  = $rowProdList['brandName'];
                                        $mainCatProdList    = $rowProdList['mainCategory'];
                                        $subCatProdList     = $rowProdList['subCategory'];

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
                                                        <input name="checkboxProductList[]" type="checkbox" id="<?php echo $idProduct; ?>" value="<?php echo $idProduct; ?>" />
                                                        <label for="<?php echo $idProduct; ?>"></label>
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
                                                        <a href="./index.php?menu=product&cat=list&detail=<?php echo $idProduct; ?>" class="waves-effect waves-light btn green darken-4" id="<?php echo $idProduct; ?>"><i class="material-icons left">edit</i>Edit</a>
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
                <div id="modalDelProductItems" class="modal">
                    <div class="modal-content">
                        <h4>Deleting Confirmation</h4>
                        <h5>Are you sure you want to delete selected item(s) ?</h5>
                    </div>
                    <div class="modal-footer col s12 mb-50">
                        <button type="submit" name="btnDeleteProductList" class="waves-effect waves-light btn green darken-4 right">Yes</button>
                        <a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
                    </div>
                </div>
            </form>
            <div id="addProductModal" class="modal">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="col s12">
                            <div class="col s12 border-bottom pdb-10">
                                <h5 class="col s12 m6 l6">Add New Product</h5>
                            </div>

            <!-- ========================================== PRODUCT NAME -->
                            <div class="input-field col s12 m7 l7 mt-30">
                                <input id="addProdName" name="addProdName" type="text" class="validate" required>
                                <label for="addProdName">Product Name</label>
                            </div>

            <!-- ========================================== PRODUCT BRAND -->
                            <div id="selectBrandWrapper" class="input-field col s12 m7 l7">
                                <select id="brandProductAddSelect" name="brandProductAddSelect" required>
                                    <option selected disabled>Select Brand</option>
                                    <?php
                                        $brandProdListQry = "SELECT idbrand, name FROM brand ORDER BY name ASC";
                                        if ($resultProdList = mysqli_query($conn, $brandProdListQry)) {
                                            if (mysqli_num_rows($resultProdList) > 0) {
                                                while($rowProdList   = mysqli_fetch_array($resultProdList)){
                                                    $idBrandProdList  = $rowProdList['idbrand'];
                                                    $nameBrandProdList  = $rowProdList['name'];
                                                    ?>
                                                        <option value="<?php echo $idBrandProdList;?>"><?php echo $nameBrandProdList;?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <label>Select Brand</label>
                            </div>

            <!-- ========================================== PRODUCT MAIN CAT -->
                            <div id="mainCatWrapper" class="col s12 m6 l6">
                                <div id="selectMainCatWrapper" class="input-field">
                                    <select id="mainCatAddSelect" name="mainCatAdd" required>
                                        <option selected disabled>Select Main Category</option>
                                        <?php
                                            $mainCatQry = "SELECT mainCategory FROM product WHERE mainCategory IS NOT NULL AND mainCategory != ''GROUP BY mainCategory";
                                            if ($resultMainCat = mysqli_query($conn, $mainCatQry)) {
                                                if (mysqli_num_rows($resultMainCat) > 0) {
                                                    while($rowMainCat   = mysqli_fetch_array($resultMainCat)){
                                                        $mainCat    = $rowMainCat['mainCategory'];
                                                        ?>
                                                            <option value="<?php echo $mainCat;?>"><?php echo $mainCat;?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                    <label>Main Category</label>
                                    <div class="col s12">
                                        <a href="#mainCatAddModal" class="modal-trigger blue-text">[+]Add Main Category</a>
                                    </div>
                                </div>
                            </div>
            <!-- ========================================== PRODUCT SUB CAT -->
                            <div id="subCatWrapper" class="col s12 m6 l6">
                                <div id="selectSubCatWrapper" class="input-field">
                                    <select id="subCatAdd" name="subCatAdd" required>
                                        <option selected disabled>Select Sub Category</option>
                                        <?php
                                            $subCatQry = "SELECT subCategory FROM product WHERE subCategory IS NOT NULL AND subCategory != '' GROUP BY subCategory";
                                            if ($resultSubCat = mysqli_query($conn, $subCatQry)) {
                                                if (mysqli_num_rows($resultSubCat) > 0) {
                                                    while($rowSubCat    = mysqli_fetch_array($resultSubCat)){
                                                        $subCat     = $rowSubCat['subCategory'];
                                                        ?>
                                                            <option value="<?php echo $subCat;?>"><?php echo $subCat;?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                    <label>Sub Category</label>
                                    <div class="col s12">
                                        <a href="#subCatAddModal" class="modal-trigger blue-text">[+]Add Sub Category</a>
                                    </div>
                                </div>
                            </div>


            <!-- ========================================== PRODUCT CONTENT WORD -->
                            <div class="input-field col s12 mt-30">
                                <textarea id="wysiwygEditor" name="addContentWordProduct" class="materialize-textarea" required>Some text to product specification</textarea>
                            </div>


            <!-- ========================================== PRODUCT BUTTON SUBMIT -->
                            <div class="col s12">
                                <button type="submit" name="btnAddProductSubmit" class="ml-30 mt-30 mb-30 right waves-effect waves-light btn green darken-4">Add</button>
                                <a href="#!" class="mt-30 mb-30 modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- ============================================================== MODAL ============================================== -->
            <div id="mainCatAddModal" class="modal">
                <div class="modal-content">
                    <div class="border-bottom mb-10"><h4>Add Main Category</h4></div>
                    <div class="col s12 mt-30 center container">
                        <div class="file-field input-field">
                            <input id="addMainProdCatList" name="addMainProdCatList" type="text" class="validate">
                            <label for="addMainProdCatList">Main Category</label>
                        </div>
                        <div class="input-field col s12 mb-50">
                            <a href="#!" id="btnAddMainProdCatList" name="btnAddMainProdCatList" class="modal-action modal-close waves-effect waves-light btn green darken-4 right">Add Main Category</a>
                            <a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="subCatAddModal" class="modal">
                <div class="modal-content">
                    <div class="border-bottom mb-10"><h4>Add Sub Category</h4></div>
                    <div class="col s12 mt-30 center container">
                        <div class="file-field input-field">
                            <input id="addSubProdCatList" name="addSubProdCatList" type="text" class="validate">
                            <label for="addSubProdCatList">Sub Category</label>
                        </div>
                        <div class="input-field col s12 mb-50">
                            <a href="#!" id="btnAddSubProdCatList" name="btnAddSubProdCatList" class="modal-action modal-close waves-effect waves-light btn green darken-4 right">Add Main Category</a>
                            <a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== MODAL ============================================== -->
        </div>
    <?php
    }
    ?>
</div>