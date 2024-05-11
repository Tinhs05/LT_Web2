const body = document.querySelector("body");

// <!-- Tiền tệ -->
function vnd(price) {
  if(price != null && price != "0" && price != 0 && price != "")
   return price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
  return "";
}

function vndFormat(amount) {
  amount = parseFloat(amount).toFixed(0);
  amount = amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

  return amount + " ₫";
}

// <!-- Slices Banner -->
let slideIndex = 0;
function showSlides() {
    let slides = document.getElementsByClassName("slide-img");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 4000);
}
showSlides();

// ````` TÀI KHOẢN `````
// <!-- Lấy thông tin tài khoản -->

// ````` SẢN PHẨM `````
// <!-- Load sản phẩm cho trang user -->
var list_Product = [];
function getAllProducts() {
  $.post("?module=user&action=product", {}, function (data) {
    var data = JSON.parse(data);
    list_Product = data;
    showHomeProduct(list_Product);
  });
}

function showAllProduct(productShow) {
  var html_product = '';
  if (productShow.length > 0) {
    productShow.forEach(function (p) {
      html_product += `<div class="col-product">
                                <article class="card-product">
                                    <div class="card-header">
                                        <a href="#" class="card-image-link">
                                            <img class="card-image" src="./templates${p.Image}" loading="lazy" alt="">
                                            <img class="card-image-hover" src="./templates${p.ImageHV}" loading="lazy" alt="">
                                        </a>
                                    </div>
                                    <div class="prod-info">
                                        <div class="card-content">
                                            <div class="card-title">
                                                <a href="#" class="card-title-link">${p.ProductName}</a>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="product-price">
                                                <span class="current-price"></span>
                                                <span class="old-price">${vndFormat(p.Price)}</span>
                                            </div>
                                            <div class="product-buy">
                                                <button class="card-button order-item" onclick="displayCardProduct(${p.ProductID}, this)"><i class="fa-regular fa-cart-shopping-fast"></i>Xem sản phẩm</button>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>`;
    });
    $('#home-products').html(html_product);
  };
}

// Phân trang
let perPage = 12;
let currentPage = 1;
let totalPage = 0;
let perProducts = []; function displayList(list_Product, perPage, currentPage) {
  let start = (currentPage - 1) * perPage;
  let end = start + perPage;
  let productShow = list_Product.slice(start, end);
  showAllProduct(productShow);
}

function showHomeProduct(list_Product) {
  displayList(list_Product, perPage, currentPage);
  setupPagination(list_Product, perPage);
}

function setupPagination(list_Product, perPage) {
  $('.page-nav-list').html('');
  let page_count = Math.ceil(list_Product.length / perPage);
  for (let i = 1; i <= page_count; i++) {
    let li = paginationChange(i, list_Product, currentPage);
    $('.page-nav-list').append(li);
  }
}

function paginationChange(page, list_Product, currentPage) {
  let node = $('<li></li>').addClass('page-nav-item').html(`<a href="javascript:;">${page}</a>`);
  if (currentPage == page) node.addClass('active');
  node.on('click', function () {
    currentPage = page;
    displayList(list_Product, perPage, currentPage);
    $('.page-nav-item.active').removeClass('active');
    node.addClass('active');
    $('#home-title').get(0).scrollIntoView();
  });
  return node;
}

getAllProducts();

// <!-- Tìm kiếm sản phẩm -->
$('.search-btn').click(function () {
  var keyword = $('#form-search-product').val().toLowerCase();
  var filteredProducts = list_Product.filter(function (product) {
    return product.ProductName.toLowerCase().includes(keyword);
  });
  console.log(filteredProducts)

  if (filteredProducts.length > 0) {
    advertise({
      title: 'Success',
      message: 'Đã tìm thấy sản phẩm theo yêu cầu',
      type: 'success',
      duration: 3000
    });
    showHomeProduct(filteredProducts);
  } else {
    advertise({
      title: 'Error',
      message: 'Không tìm thấy sản phẩm như mong muốn',
      type: 'error',
      duration: 3000
    });
    $('#home-products').html('Không tìm thấy sản phẩm mà bạn mong muốn (TT)');
    $('.page-nav-list').html('');
  }
});

// <!-- Catelogy -->
$('.lowmenu button').click(function () {
  let categoryId = $(this).parent().data('catelogy');
  let filteredProducts = list_Product.filter(function (product) {
    return product.TypeID === categoryId;
  });
  advertise({
    title: 'Success',
    message: 'Đã tìm thấy sản phẩm theo yêu cầu',
    type: 'success',
    duration: 3000
  });
  showHomeProduct(filteredProducts);
});

//<!-- Filter -->
// document.querySelector(".filter-btn").addEventListener("click", (e) => {
//   e.preventDefault();
//   document.querySelector(".advanced-search").classList.toggle("open");
//   document.getElementById("home-title").scrollIntoView();
// })


// <!-- Hiện chi tiết sản phẩm -->
function displayCardProduct(id, btn) {
  $('#div_detail').css('display', 'flex');
  $.post("?module=user&action=showProductDetails", { productID: id }, function (data) {
    $("#div_detail").html(data);
  });
}

// <!-- Đóng chi tiết sản phẩm -->
function closedetail(){
  $("#div_detail").css("display", "none");
}

// <!-- hoán đổi ảnh CTSP -->
function swap_img(reviewimg){
  swap_img_noneb();
  reviewimg.style.border="solid 2px black";
  let a = reviewimg.getAttribute('src');
  document.getElementById("img_main").setAttribute('src',a);
}

function swap_img_noneb(){
  document.getElementsByClassName('idtruoc')[0].style.border="none";
  document.getElementsByClassName('idsau')[0].style.border="none";
}

// <!-- Tắt/Mở bảng size -->
function showtableSize(){
  $("#show-imgSize").css("display", "flex");
}

$("#img-size-close").on('click', function(e){
  e.preventDefault();
  $("#show-imgSize").css("display", "none");
});

// <!-- Tăng/giảm số lượng sản phẩm -->
function handlePlus(button){
    let amountElement = button.parentElement.querySelector(".input-qty");
    let amount = parseInt(amountElement.value);
    amount++;
    amountElement.value = amount;
}

function handleMinus(button){
    let amountElement = button.parentElement.querySelector(".input-qty");
    let amount = parseInt(amountElement.value);
    if(amount > 1){
        amount--;
    }
    amountElement.value = amount;
}

// ````` GIỎ HÀNG `````
// <!-- Mở giỏ hàng -->
var list_Cart = [];
function openCart() {
    $('.modal-cart').addClass('open');
    $('body').css('overflow', 'hidden');
    $.post("?module=user&action=listCart", function(data){
        if(data!=null){
          var response = JSON.parse(data);
          list_Cart = response;
        }
      showCart();
    }, )
}

// <!-- Đóng giỏ hàng -->
function closeCart() {
  updateQuantityCart();
  $('.modal-cart').removeClass('open');

  if(list_Cart.length>0){
    $("#cart-list").html(`<div class ="cart-left">
    <table>
        <thead>
          <tr>
            <td>Sản phẩm</td>
            <td>Phân loại</td>
            <td>Giá</td>
            <td>Số lượng</td>
            <td>Tùy chọn</td>
           </tr>
        </thead>
        <tbody id="showProdCart">
        </tbody>
    </table>
    </div>
    <div class="cart-right">
    <div class="cart-total-price">
      <p class="text-tt">Tạm tính:</p>
      <p class="text-price">0đ</p>
    </div>
    </div>`);

  }
  $('body').css('overflow', 'auto');
}

// Một số nút đóng giỏ hàng khác
let modalCart = document.querySelector('.modal-cart');
let containerCart = document.querySelector('.cart-container');
let themsp = document.querySelector('.them-sp');
modalCart.onclick = function () {
    closeCart();
}
themsp.onclick = function () {
    closeCart();
}
containerCart.addEventListener('click', (e) => {
    e.stopPropagation();
})

//<!-- Show gio hang -->
function showCart() {
  if (list_Cart.length > 0) {
      $('.gio-hang-trong').css('display', 'none');
    $('.cart-left').css('display', 'block');
    $('.cart-right').css('display', 'blbck');
      $('.thanh-toan').removeClass('disabled');
      let productcarthtml = '';
      list_Cart.forEach(function(p){
        productcarthtml +=`<tr>
              <td><div class="cart-img-title"><img class="cart-img-tbl" src="./templates${p.Image}" alt=""><p>${p.ProductName}</p></div></td>
              <td>${p.TypeName}</td>
              <td>
                 <span class="cart-item-price price" data-price="${p.Price}">
                  ${vnd(parseInt(p.Price))}
                  </span>
              </td>
              <td>
                <div class="cart-items">
                  <button class="quantity quantity-down" style="height: 30px; padding: 5px;" onclick="handleCartMinus(${p.ProductID},this)">-</button>
                  <input class="amount input-qty cart-quantity" style="width: 18px;" name="amount" type="text" value="${p.Quantity}" readonly>
                  <input type="hidden" class="product-cart-id" value="${p.ProductID}">
                  <button class="quantity quantity-up" style="height: 30px; padding: 5px;" onclick="handleCartPlus(${p.ProductID},this)">+</button>
                </div>
              </td>                             
              <td><button class="cart-item-delete" onclick="deleteCartItem(${p.ProductID},this)"><i class="fa-solid fa-trash"></i></button></td>
              </tr>`
      });
      $("#showProdCart").html(productcarthtml);
      updateCartTotal();
  } else {
      $('.gio-hang-trong').css('display', 'flex');
      $('.cart-left').css('display', 'none');
      $('.cart-right').css('display', 'none');
      $("#cart-list").html(""); 
  }
}

// <!-- Thêm sản phẩm vào giỏ hàng -->
function addPodCart() {
  var userID = $('#user-id').val();
  var productID = $('#product-id').val();
  var quantity = $('.input-qty').val();

  if (userID > 0) {
    $.post("?module=user&action=add-cart", { userID: userID, productID: productID, quantity: quantity }, function (response) {
      advertise({
        title: 'Success',
        message: 'Sản phẩm đã được thêm vào giỏ hàng thành công!',
        type: 'success',
        duration: 1000
      });
      closedetail();
    });
  } else {
    advertise({
      title: 'Error',
      message: 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!',
      type: 'error',
      duration: 2000
    });
    setTimeout(function () {
      window.location.href = "?module=auth&action=login";
    }, 2000);
  }
}

  // <!-- Xóa sản phẩm trong giỏ hàng -->
function deleteCartItem(id, btn) {
  let pod = btn.parentNode.parentNode;
  pod.remove();
  $.post("?module=user&action=deleteFromCart", {productID: id}, function(data){
  })

    if(list_Cart.length >0){
    list_Cart = list_Cart.filter(function(c) {
      return c.ProductID !== id;
    });
    if(list_Cart.length == 0){
      $('.gio-hang-trong').css('display', 'flex');
      $("#cart-list").html("");
      $('.thanh-toan').addClass('disabled');
    }
    updateCartTotal();
  }
}

// <!-- Tính tiền của giỏ hàng -->

function getCartTotal() {
  let tongtien = 0;
  if (list_Cart && list_Cart.length > 0) {
    list_Cart.forEach(function(c) {
      tongtien += (parseInt(c.Quantity) * parseInt(c.Price));
    });
  }
  return tongtien;
}

function updateCartTotal() {
    let textPriceElement = document.querySelector('.text-price');
    
    if (textPriceElement) {
        textPriceElement.innerText = vnd(getCartTotal());
    }
}
// <!-- Cập nhật số lượng trong giỏ hàng -->
function updateQuantityCart(){
  const productQuantities = [];
  if(list_Cart.length>0){
    list_Cart.forEach((c)=>{
      var quantity = c.Quantity;
      var producID = c.ProductID;
      productQuantities.push({
        'productID': producID,
        'quantity': quantity
      })
    })

    $.ajax({
      url: '?module=user&action=update-cart',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify(productQuantities),
      success: function(response) {
        console.log('Dữ liệu đã được gửi thành công');
        console.log(response)  },
      error: function(xhr, status, error) {
        console.error('Lỗi khi gửi dữ liệu:', error);
      }
    });
  }
}
// <!-- Cập nhật số lượng trong giỏ hàng -->
function handleCartPlus(id,button){
    let amountElement = button.parentElement.querySelector(".input-qty");
    let amount = parseInt(amountElement.value);
    amount++;
    amountElement.value = amount;
    list_Cart.forEach(c => {
      if(c.ProductID === id){
        c.Quantity = amount;
      }
    });
    updateCartTotal();
}

function handleCartMinus(id, button){
    let amountElement = button.parentElement.querySelector(".input-qty");
    let amount = parseInt(amountElement.value);
    if(amount > 1){
        amount--;
    }
    amountElement.value = amount;
    list_Cart.forEach(c => {
      if(c.ProductID === id){
        c.Quantity = amount;
      }
    });
    updateCartTotal();
}


// ````` THANH TOÁN `````
// <!-- Chuyển trang thanh toán -->
$('.thanh-toan').on('click', function () {
  closeCart();
  window.location.href = "?module=user&action=total-bill";
})

// <!-- Thanh toán ngay -->
function buy_now() {
  var userID = $('#user-id').val();
  var productID = $('#product-id').val();
  var quantity = $('.input-qty').val();
  console.log(productID + quantity)

  if (userID > 0) {
    $.post("?module=user&action=buy_now", { productID: productID, quantity: quantity }, function (response) {
      // Xử lý phản hồi từ máy chủ (nếu cần)
      // Sau đó, chuyển hướng trang
      window.location.href = "?module=user&action=buy_now";
    });

  } else {
    advertise({
      title: 'Error',
      message: 'Vui lòng đăng nhập để mua hàng!',
      type: 'error',
      duration: 2000
    });
    setTimeout(function () {
      window.location.href = "?module=auth&action=login";
    }, 2000);
  }
}

// ````` THÔNG BÁO `````
function advertise({
  title = 'Success',
  message = 'Tạo tài khoản thành công',
  type = 'success',
  duration = 1000
}) {
  const main = $('#advertise');
  if (main.length) {
    const advertise = $('<div class="advertise"></div>');
    //Auto remove advertise
    const autoRemove = setTimeout(function () {
      advertise.remove();
    }, duration + 1000);
    //Remove advertise when click btn close
    advertise.on('click', function (e) {
      if ($(e.target).closest('.fa-regular').length) {
        advertise.remove();
        clearTimeout(autoRemove);
      }
    });
    const colors = {
      success: '#47d864',
      info: '#2f86eb',
      warning: '#ffc021',
      error: '#ff6243'
    }
    const icons = {
      success: 'fa-light fa-check',
      info: 'fa-solid fa-circle-info',
      warning: 'fa-solid fa-triangle-exclamation',
      error: 'fa-solid fa-bug'
    };
    const color = colors[type];
    const icon = icons[type];
    const delay = (duration / 1000).toFixed(2);
    advertise.addClass(`advertise--${type}`).css('animation', `slideInTop ease 0.3s, fadeOut linear 1s ${delay}s forwards`)
      .html(`<div class="advertise__private" >
          <div class="advertise__icon">
              <i class="${icon}"></i>
          </div>
          <div class="advertise__body">
              <h3 class="advertise__title" >${title}</h3>
              <p class="advertise__msg">
                  ${message}
              </p>
          </div>
      </div>
      <div class="advertise__background"style="background-color: ${color};">
      </div>`);
    main.append(advertise);
  }
} 

  function createProvinceList() {
  let provinces = [
    'An Giang',
    'Bà Rịa - Vũng Tàu',
    'Bạc Liêu',
    'Bắc Giang',
    'Bắc Kạn',
    'Bắc Ninh',
    'Bến Tre',
    'Bình Định',
    'Bình Dương',
    'Bình Phước',
    'Bình Thuận',
    'Cà Mau',
    'Cần Thơ',
    'Cao Bằng',
    'Đà Nẵng',
    'Đắk Lắk',
    'Đắk Nông',
    'Điện Biên',
    'Đồng Nai',
    'Đồng Tháp',
    'Gia Lai',
    'Hà Giang',
    'Hà Nam',
    'Hà Nội',
    'Hà Tĩnh',
    'Hải Dương',
    'Hải Phòng',
    'Hậu Giang',
    'Hòa Bình',
    'Hồ Chí Minh',
    'Hưng Yên',
    'Khánh Hòa',
    'Kiên Giang',
    'Kon Tum',
    'Lai Châu',
    'Lâm Đồng',
    'Lạng Sơn',
    'Lào Cai',
    'Long An',
    'Nam Định',
    'Nghệ An',
    'Ninh Bình',
    'Ninh Thuận',
    'Phú Thọ',
    'Phú Yên',
    'Quảng Bình',
    'Quảng Nam',
    'Quảng Ngãi',
    'Quảng Ninh',
    'Quảng Trị',
    'Sóc Trăng',
    'Sơn La',
    'Tây Ninh',
    'Thái Bình',
    'Thái Nguyên',
    'Thanh Hóa',
    'Thừa Thiên Huế',
    'Tiền Giang',
    'Trà Vinh',
    'Tuyên Quang',
    'Vĩnh Long',
    'Vĩnh Phúc',
    'Yên Bái'
  ];

  var provinceSelect = document.querySelector('#provinceSelect');
  var selectProvinceBill = document.querySelector('#selectProvinceBill');

  provinces.forEach(function(province) {
    const optionElement = document.createElement('option');
    optionElement.value = province;
    optionElement.text = province;

    provinceSelect.appendChild(optionElement);
    //tạo một bản sao vì khi thêm vào provincSelect nó sẽ di chuyển không tồn tại trong selectProvinceBill
    const tempOptionElement = optionElement.cloneNode(true);
    selectProvinceBill.appendChild(tempOptionElement);
  });
}