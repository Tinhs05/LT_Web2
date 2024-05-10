
<style>
.list-product {
    color: var(--light-gray);
    background-color: var(--lightest-gray);
}
</style>
<?php
if(!defined('_CODE')){
    die('Access denied...');
}


function setupPagination($productAll, $perPage, $currentPage, $chooseType, $inputText) {
    echo '<form action="?module=admin&action=homeProducts" method="get"><ul class="page-nav-list">';
    $page_count = ceil(count($productAll) / $perPage);
    for ($i = 1; $i <= $page_count; $i++) {
        $li = paginationChange($i, $productAll, $currentPage, $chooseType, $inputText);
        echo $li;
    }
    echo '</ul></form>';
}

function paginationChange($pageNumber, $productAll, $currentPage, $chooseType, $inputText) {
    $isActive = $pageNumber == $currentPage ? 'active' : '';
    return '<li class="page-nav-item"><a href="?module=admin&action=homeProducts&page=' . $pageNumber . '&curPage=' . $currentPage . '&chooseType=' . $chooseType . '&inputText=' . $inputText . '" class="page-link ' . $isActive . '">' . $pageNumber . '</a></li>';
}

// Hàm phân trang
function getListWithPage($listAllProduct, $productsPerPage, $page) {
    // Sản phẩm hiển thị trên trang
    $bat_dau = ($page - 1) * $productsPerPage;
    $ket_thuc = $bat_dau + $productsPerPage;
    if ($ket_thuc > count($listAllProduct)) {
        $ket_thuc = count($listAllProduct);
    }

    // Tạo danh sách sản phẩm cho trang hiện tại
    $listProductWithPage = array();
    for ($i = $bat_dau; $i < $ket_thuc; $i++) {
        $listProductWithPage[] = $listAllProduct[$i];
    }

    return $listProductWithPage;
}

// Số sản phẩm trên mỗi trang
$productsPerPage = 10;

// Trang hiện tại
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Loại sản phẩm được chọn
$chooseType = isset($_GET['chooseType']) ? $_GET['chooseType'] : '';

// Dữ liệu trong ô tìm kiếm
$inputText = isset($_GET['inputText']) ? $_GET['inputText'] : '';

$sql = "SELECT product.*, type.TypeName
                                FROM product
                                INNER JOIN type ON product.TypeID = type.TypeID
                                WHERE 1 ";

if (!empty($chooseType)) {
    $sql .= " AND product.TypeID = $chooseType";
}

if (!empty($inputText)) {
    $sql .= " AND UPPER(CONCAT(product.ProductName, ' ', type.TypeName,' ', product.Price,' ', product.Description)) LIKE '%$inputText%' ";
}

$sql .= " ORDER BY product.ProductID DESC " ;                          

$listAllProduct = getAllRows($sql);
$listProductWithPage = getListWithPage($listAllProduct, $productsPerPage, $page);

require_once('header.php');

function loadData($listProduct) {
    if(!empty($listProduct)):
        foreach($listProduct as $item):            
        ?>
        <div class="list">
                    <div class="list-left">
                    <img src="./templates/<?php echo $item['Image'] ?>" alt="">
                    <div class="list-info">
                        <h4><?php echo strtoupper($item['ProductName']); ?></h4>

                        <span class="list-category"><?php echo $item['TypeName'] ?></span>
                        <p class="list-note"><?php echo $item['Description'] ?></p>
                    
                    </div>
                    </div>
                <div class="list-right">
                    <div class="list-price">
                    <span class="list-old-price"><?php echo number_format($item['Price']). " VND" ?></span>               
                    <!-- <span class="list-current-price"><?php echo number_format($item['SalePrice']). " VND" ?></span>      -->
                    </div>
                    <div class="list-control">
                    <div class="list-tool">
                        <button id="btn-edit" class="btn-edit" data-product-id="<?php echo $item['ProductID'] ?>" onclick="editProduct(<?php echo $item['ProductID'] ?>)"><i class="fa-light fa-pen-to-square"></i></button>
                        <!-- ${btnCtl} -->
                        <?php 
                        echo $item['Status'] == 1 ? 
                        '<button class="btn-delete" id="btn-delete" onclick="deleteProduct('.$item['ProductID'].')"><i class="fa-regular fa-trash"></i></button>' :
                        '<button class="btn-delete" id="btn-change-status" onclick="changeStatusProduct('.$item['ProductID'].')"><i class="fa-light fa-square-plus"></i></button>'
                        ?>
                    </div>  
                                       
                </div>
                <div class="rate">
                <i id="star1" class="fa-solid fa-star"></i> 
                <i id="star2" class="fa-solid fa-star"></i> 
                <i id="star3" class="fa-solid fa-star"></i> 
                <i id="star4" class="fa-solid fa-star"></i> 
                <i id="star5" class="fa-solid fa-star"></i> 
                </div>
                </div> 
            </div>
<?php 
        endforeach;
    else:
        ?>
        <div class="no-result"><div class="no-result-i"><i class="fa-light fa-circle-exclamation"></i></div><div class="no-result-h">Không có sản phẩm để hiển thị</div></div>
        <?php
    endif;
}

?>

<div class="section active admin-all">
    <div class="admin-control">
    <div class="admin-control-left">
        <form id="formSelect" action="?module=admin&action=homeProducts" method="get">
            <select name="chooseType" id="the-loai">
                <option value="0" <?php echo $chooseType == 0 ? 'selected' : ''?>>Tất cả</option>
                <option value="1" <?php echo $chooseType == 1 ? 'selected' : ''?>>Áo Thun</option>
                <option value="2" <?php echo $chooseType == 2 ? 'selected' : ''?>>Áo Hoodie</option>
                <option value="3" <?php echo $chooseType == 3 ? 'selected' : ''?>>Áo Sơ mi</option>
                <option value="4" <?php echo $chooseType == 4 ? 'selected' : ''?>>Áo Polo</option>
                <option value="5" <?php echo $chooseType == 5 ? 'selected' : ''?>>Áo Khoác</option>
                <!-- <option value="Sale">Sale</option> -->
                <!-- <option value="6"  -->
                <?php 
                // echo $chooseType == 6 ? 'selected' : ''
                ?>
                <!-- >Đã xóa</option> -->
            </select>
        </form>
    </div>
        <div class="admin-control-center">
            <form action="" class="form-search">
                <span class="search-btn"><i class="fa-light fa-magnifying-glass"></i></span>
                <input id="form-search-product" type="text" class="form-search-input" placeholder="Tìm kiếm sản phẩm ..." value="<?php echo $inputText ?>">
            </form>
        </div>
        <div class="admin-control-right">
            <button class="btn-control-large" id="btn-cancel-product" onclick="cancelSearchProduct()"><i class="fa-light fa-rotate-right"></i> Làm mới</button>
            <button class="btn-control-large" id="btn-add-product" onclick="resetFormData()"><i class="fa-light fa-plus"></i> Thêm sản phẩm</button>                  
        </div>  
        
    </div>
    <div id="show-product">
        <?php loadData($listProductWithPage)?>
    </div>
    <div class="page-nav">
        <!-- <ul class="page-nav-list">
        </ul> -->
        <?php setupPagination($listAllProduct, $productsPerPage, $page, $chooseType, $inputText); ?>
    </div>
</div>

<div class="modal add-product">
        <div class="modal-container">
            <h3 class="modal-container-title add-product-e">THÊM SẢN PHẨM MỚI</h3>
            <h3 class="modal-container-title edit-product-e">CHỈNH SỬA SẢN PHẨM</h3>
            <button class="modal-close product-form"><i class="fa-regular fa-xmark"></i></button>
            <div class="modal-content">
                <form action="/LT_Web2/modules/admin/addProduct.php" class="add-product-form" id="product-form" method="POST" enctype="multipart/form-data">
                    <div class="modal-content-left">
                        <div class="up-img">
                            <img src="./templates/assets/upload 2.png" alt="" class="upload-image-preview" id="image">
                            <img src="./templates/assets/upload 2.png" alt="" class="image-hover" id="image-hv">
                        </div>

                        <div class="form-group file">
                            <label for="up-hinh-anh" class="form-label-file"><i class="fa-regular fa-cloud-arrow-up"></i>Chọn ảnh chính</label>
                            <input accept="image/jpeg, image/png, image/jpg, image/webp" id="up-hinh-anh" name="up-hinh-anh" type="file" class="form-control" onchange="chooseFile(this)">
                            <label for="up-hinh-anh-hvr" class="form-label-file"><i class="fa-regular fa-cloud-arrow-up"></i>Chọn ảnh mô tả thêm</label>
                            <input accept="image/jpeg, image/png, image/jpg, image/webp" id="up-hinh-anh-hvr" name="up-hinh-anh-hvr" type="file" class="form-control" onchange="chooseFileHV(this)">
                        </div>
                    </div>
                    <div class="modal-content-right">
                        <div class="form-group">
                            <label for="ten-ao" class="form-label">Tên áo</label>
                            <input id="ten-ao" name="ten-ao" type="text" placeholder="Nhập tên áo"  class="form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="category" class="form-label">Chọn loại áo</label>
                            <select name="category" id="chon-loai-ao">
                                <option value="1">Áo Thun</option>
                                <option value="4">Áo Polo</option>
                                <option value="3">Áo Sơ mi</option>
                                <option value="5">Áo Khoác</option>
                                <option value="2">Áo Hoodie</option>
                            </select>
                            <span class="form-message"></span>
                        </div>                        
                        <div class="form-group">
                            <label for="gia-ban" class="form-label">Giá bán</label>
                            <input id="gia-ban" name="gia-ban" type="number" placeholder="Nhập giá bán" class="form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="mo-ta" class="form-label">Mô tả</label>
                            <textarea name="mo-ta" class="product-desc" id="mo-ta" placeholder="Nhập mô tả sản phẩm..."></textarea>
                            <span class="form-message"></span>
                        </div>
                        <button class="form-submit btn-add-product-form add-product-e" id="add-product-button">
                            <i class="fa-regular fa-plus"></i>
                            <span>THÊM SẨN PHẨM</span>
                        </button>
                        <button class="form-submit btn-update-product-form edit-product-e" id="update-product-button">
                            <i class="fa-light fa-pencil"></i>
                            <span>LƯU THAY ĐỔI</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>    

<?php 
    
    require_once('footer.php');
?>

<script>
    document.getElementById('form-search-product').addEventListener("change",function(e) {
        e.preventDefault();
        const inputAction = '&inputText='+ this.value;
        const selectAction = '&chooseType='+ document.getElementById('the-loai').value;
        var onInputAction = '?module=admin&action=homeProducts' + inputAction + selectAction;
        // document.getElementById('forminput').setAttribute('action', onInputAction);
        window.location.href = onInputAction;
    });
    
    document.getElementById('the-loai').addEventListener("change",function(e) {
        e.preventDefault();
        const selectAction = '&chooseType='+this.value;
        const inputAction = '&inputText='+ document.getElementById('form-search-product').value;
        var changeSelectAction = '?module=admin&action=homeProducts' + selectAction + inputAction;
        window.location.href = changeSelectAction;
    });

    document.getElementById('btn-cancel-product').addEventListener("click",function(e) {
        e.preventDefault();
        window.location.href = '?module=admin';
    });

    $(document).ready(function() {
        $('#product-form').submit(function(event) {
            // Xác định nút button được nhấp
        var element = document.getElementById("add-product-button");

        var displayStyle = window.getComputedStyle(element).getPropertyValue('display');

        // Kiểm tra nút button và xử lý tương ứng
        if (displayStyle === 'block') {
            // Thực hiện hành động cho nút "Thêm sản phẩm"
            event.preventDefault(); // Ngăn chặn form gửi đi một cách thông thường
            var formData = new FormData(this);

            // Gửi request AJAX
            $.ajax({
                url: '/LT_Web2/modules/admin/addProduct.php',
                type: 'POST',
                data: formData,
                processData: false, // Ngăn chặn jQuery chuyển đổi dữ liệu thành chuỗi query
                contentType: false, // Không thiết lập header Content-Type
                success: function(response) {
                    alert(response); // Hiển thị cửa sổ cảnh báo với thông báo thành công
                    if(response === 'Thêm sản phẩm thành công.'){
                        window.location.href = '?module=admin';
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error: " + xhr.responseText); // Hiển thị cửa sổ cảnh báo với thông báo lỗi
                }
            });
        } else {
            event.preventDefault(); // Ngăn chặn form gửi đi một cách thông thường
            var formData = new FormData(this);
            
            // Lấy giá trị của data-product-id từ nút submit
            var productId = $(this).find('#update-product-button').data('product-id');
            formData.append('product_id', productId); // Thêm product_id vào formData

            var imageUrl = $('#up-hinh-anh').data('image-src');
            formData.append('image_url', imageUrl); // Thêm image_url vào formData

            var imageHvUrl = $('#up-hinh-anh-hvr').data('image-hv-src');            
            formData.append('image_hv_url', imageHvUrl); // Thêm image_hv_url vào formData


            // Gửi request AJAX
            $.ajax({
                url: '/LT_Web2/modules/admin/editProduct.php',
                type: 'POST',
                data: formData,
                processData: false, // Ngăn chặn jQuery chuyển đổi dữ liệu thành chuỗi query
                contentType: false, // Không thiết lập header Content-Type
                success: function(response) {
                    alert(response); // Hiển thị cửa sổ cảnh báo với thông báo thành công
                    if(response === 'Thay đổi thông tin sản phẩm thành công.'){
                        window.location.href = '?module=admin';
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error: " + xhr.responseText); // Hiển thị cửa sổ cảnh báo với thông báo lỗi
                }
            });
        }

            
        });
    });


    function editProduct(id) {
        document.querySelectorAll(".add-product-e").forEach(item => {
            item.style.display = "none";
        })
        document.querySelectorAll(".edit-product-e").forEach(item => {
            item.style.display = "block";
        })
        document.querySelector(".add-product").classList.add("open");
        $.ajax({
            url: '/LT_Web2/modules/admin/getInfoProduct.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                var product = JSON.parse(response);
                
                document.querySelector(".upload-image-preview").src ="./templates/"+product.Image;
                document.querySelector(".image-hover").src = "./templates/"+product.ImageHV;
                document.getElementById("ten-ao").value = product.ProductName.toUpperCase();
                document.getElementById("gia-ban").value = product.Price;
                document.getElementById("mo-ta").value = product.Description;
                document.getElementById("chon-loai-ao").value = product.TypeID;
                document.getElementById("update-product-button").setAttribute("data-product-id", id);
                document.getElementById("up-hinh-anh").setAttribute("data-image-src", product.Image);
                document.getElementById("up-hinh-anh-hvr").setAttribute("data-image-hv-src", product.ImageHV);
                document.getElementById("add-product-button").type = "button";
                document.getElementById("update-product-button").type = "submit";
            }
        }); 
    }


    // Hàm để reset dữ liệu
    function resetFormData() {
        document.querySelector(".upload-image-preview").src = "./templates/assets/upload 2.png";
        document.querySelector(".image-hover").src = "./templates/assets/upload 2.png";
        document.getElementById("ten-ao").value = "";
        document.getElementById("gia-ban").value = "";
        document.getElementById("mo-ta").value = "";
        document.getElementById("chon-loai-ao").value = 1;
        document.getElementById("add-product-button").type = "submit";
        document.getElementById("update-product-button").type = "button";
        document.getElementById("product-form").attr('id', 'add-product-form');
    }

    function deleteProduct(id) {
        $.ajax({
            url: '/LT_Web2/modules/admin/isSoldProduct.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if(response === 'Đã ẩn sản phẩm ở trang bán hàng'){
                    alert('Đã ẩn sản phẩm ở trang bán hàng');
                    window.location.reload();
                } else{

                    if (response === 'Sản phẩm này chưa được bán ra'){
                        if(confirm('Sản phẩm này chưa được bán ra.\nBạn có chắc muốn xóa sản phẩm này?')){
                            $.ajax({
                                url: '/LT_Web2/modules/admin/deleteProduct.php',
                                type: 'POST',
                                data: { id: id},
                                success: function(response) {
                                    alert(response);
                                    window.location.reload();
                                },
                                error: function() {
                                    alert('Có lỗi kết nối đến server !');
                                }
                            });
                        };
                    }
                } 
            },
            error: function() {
                alert('Có lỗi kết nối đến server !');
            }
        });
    }

    function changeStatusProduct(id) {
        $.ajax({
            url: '/LT_Web2/modules/admin/changeProductStatus.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if(response === 'Đã hiển thị sản phẩm lên trang bán hàng.'){
                    alert('Đã hiển thị sản phẩm lên trang bán hàng.');
                    window.location.reload();
                } else {
                    alert('Không thể hiển thị sản phẩm lên trang bán hàng.');
                }
            },
            error: function() {
                alert('Có lỗi kết nối đến server !');
            }
        });
    }


    

</script>

<?php 
// require_once('addProduct.php');
?>