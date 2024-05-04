const body = document.querySelector("body");

// <!-- Tiền tệ -->
function vnd(price) {
  if(price != null && price != "0" && price != 0 && price != "")
   return price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
  return "";
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



// <!-- Hiện chi tiết sản phẩm -->
$(".card-button").on('click', function(e){
  e.preventDefault();
  var cardProduct = $(this).closest('.card-product');
  var productId = cardProduct.find('.product-id').val();
  $("#div_detail").css("display", "grid");

  $.post("?module=user&action=showProductDetails", {productID: productId}, function(data){
    $("#div_detail").html(data);
  });
});

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
var currentuser = '';
var list_Cart = [];
function openCart() {
    $('.modal-cart').addClass('open');
    $('body').css('overflow', 'hidden');
    $.post("?module=user&action=listCart", function(data){
        if(data!=null){
          var response = JSON.parse(data);
          currentuser = response.user; 
          list_Cart = response.cart;
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
  <div class="cart-ship">
    <p>Giao hàng</p>
    <div>
        <form class="list-ship" id="radioForm">
            <div>
                <input type="radio" name="shippingOption" class="shippingOption" value="transport-fee" checked>
                <label for="" id="transport-fee">Giao hàng tiết kiệm <strong>${vnd(30000)}</strong></label>
            </div>
            <div>
                <input type="radio" name="shippingOption" class="shippingOption" value="speed-ship">
                <label for="" id="speed-ship">Giao hàng hỏa tốc nội thành: <strong>${vnd(30000)}</strong></label>
            </div>
        </form>
        <p id="ship-to-province">Vận chuyển đến <strong>Hồ Chí Minh</strong></p>
        
        <form action="" id="shippingForm">
            <span class="change-address" onclick="showSectionProv()">Đổi địa chỉ</span>
            <section class="sectionProvince">
                <p>
                    <select name="" id="provinceSelect" class="formProvinces" onchange="selectProv()">
                        <option value="selected" >Chọn tỉnh/thành phố</option>
                    </select>
                    <p>Địa chỉ chi tiết</p>
                    <input type="text" class="detail-address">
                </p>
            </section>
        </form>
    </div>
  </div>
  <div class="total-price">
      <p>Tổng:</p>
      <p id="total-bill"></p>
  </div>
  </div>`);

  // Đặt thuộc tính overflow của body về giá trị "auto"
  $('body').css('overflow', 'auto');
  }
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
      $("#transport-fee").html("Giao hàng tiết kiệm: <Strong>"+vnd(20000)+"</Strong>");
      $("#speed-ship").html("Giao hàng hỏa tốc nội thành: <Strong>"+ vnd(30000) +"</Strong>");
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
  if(userID > 0){
      $.post("?module=user&action=add-cart", {userID: userID, productID: productID, quantity: quantity}, function(response){
        console.log(response)
          closedetail();
      });
  } else {
      alert("Đăng nhập đã con đĩ");
      window.location.href = "?module=auth&action=login";
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
let temp_price_ship = 20000;
$('.shippingOption').on('change', function (e) {
  e.preventDefault();
  temp_price_ship = $('input[name=shippingOption]:checked').val();
  updateCartTotal();
})

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
    let totalBillElement = document.querySelector('#total-bill');
    
    // Kiểm tra xem phần tử có tồn tại hay không
    if (textPriceElement && totalBillElement) {
        // Thiết lập giá trị innerText của các phần tử
        textPriceElement.innerText = vnd(getCartTotal());
        totalBillElement.innerText = vnd(getCartTotal() + parseInt(temp_price_ship));
    } else {
        console.error("Không thể tìm thấy phần tử để cập nhật tổng số tiền trong giỏ hàng.");
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



// Hàm hiển thị thông tin đơn hàng trên trang web
function showOrder() {
  let orderHtml = "";
  let order = JSON.parse(localStorage.getItem('order'));
  let hisOrder = "";
  if(emailUserNow != ""){
    hisOrder = order.filter((item) =>{return item.khachhang === emailUserNow});
  }

  if(hisOrder.length == 0 || emailUserNow == "") {
      orderHtml = `<td colspan="6">Không có dữ liệu</td>`
  } else {
    hisOrder.forEach((item) => {
          let status = item.trangthai == 0 ? `<span class="status-no-complete">Chưa xử lý</span>` : `<span class="status-complete">Đã xử lý</span>`;
          let date = formatDate(item.thoigiandat);
          orderHtml += `
          <tr>
          <td>${item.id}</td>
          <td>${item.tennguoinhan}</td>
          <td>${date}</td>
          <td>${vnd(item.tongtien)}</td>                               
          <td>${status}</td>
          <td class="control">
              <span class="btn-detail detailicon" id="" onclick="detailOrder('${item.id}')"><i class="fa-light fa-circle-info"></i></span>
          </td>
          </tr> `;
      });
  }
  document.querySelector("#showOrder").innerHTML = orderHtml;

}

// Hàm hiển thị chi tiết của một đơn hàng
function detailOrder(id) {
  document.querySelector(".detail-order").classList.add("open");
  let orders = localStorage.getItem("order") ? JSON.parse(localStorage.getItem("order")) : [];
  let products = localStorage.getItem("products") ? JSON.parse(localStorage.getItem("products")) : [];
  // Lấy hóa đơn 
  let order = orders.find((item) => item.id == id);
  // Lấy chi tiết hóa đơn
  let ctDon = getOrderDetails(id);
 
  let spHtml = `<div class="modal-detail-left"><div class="order-item-group">`;

  let textDetailBtn = order.trangthai == 0 ? "Chưa xử lý" : "Đã xử lý";
  ctDon.forEach((item) => {
      let detaiSP = products.find(product => product.id == item.id);

      spHtml += `<div class="order-product">
          <div class="order-product-left">
              <img src="${detaiSP.img}" alt="">
              <div class="order-product-info">
                  <h4>${detaiSP.title}</h4>
                  <p class="order-product-category">${item.category}</p>
                  <p class="order-product-size">Size: ${item.size}<p>
                  <p class="order-product-quantity">SL: ${item.quantity}<p>
              </div>
          </div>
          <div class="order-product-right">
              <div class="order-product-price">
                  <span class="order-product-current-price">${vnd(item.price)}</span>
              </div> 

              
          </div>
      </div>`;
  });
  
  spHtml += `</div>             
               <div class="modal-detail-bottom-left">
               <div class="price-ship">
                      <span class="">Phí ship:</span>
                      <span class="">${vnd(300000)}</span>
                 </div>
                <div class="price-total">
                      <span class="thanhtien">Thành tiền:</span>
                      <span class="price">${vnd(order.tongtien)}</span>
                   </div>
                </div>
              </div>`;
  spHtml += `<div class="modal-detail-right">
      <h4 class="detail-order-info-cust">Thông tin khách hàng</h4>
      <ul class="detail-order-group">
          <li class="detail-order-item">
              <span class="detail-order-item-left"><i class="fa-thin fa-person"></i> Người nhận</span>
             <span class="detail-order-item-right">${order.tennguoinhan}</span>
          </li>

          <li class="detail-order-item">
              <span class="detail-order-item-left"><i class="fa-light fa-phone"></i> Số điện thoại</span>
              <span class="detail-order-item-right">${order.sdtnhan}</span>
          </li>
          <li class="detail-order-item">
              <span class="detail-order-item-left"><i class="fa-light fa-calendar-days"></i> Ngày đặt hàng</span>
              <span class="detail-order-item-right">${formatDate(order.thoigiandat)}</span>
          </li>
          <li class="detail-order-item">
              <span class="detail-order-item-left"><i class="fa-light fa-truck"></i> Hình thức giao</span>
              <span class="detail-order-item-right">${order.hinhthucgiao}</span>
          </li>

          <li class="detail-order-item tb">
              <span class="detail-order-item-t"><i class="fa-light fa-location-dot"></i> Địa chỉ nhận</span>
              <p class="detail-order-item-b">${order.diachinhan}</p>
          </li>
          <li class="detail-order-item tb">
              <span class="detail-order-item-t"><i class="fa-light fa-note-sticky"></i> Ghi chú</span>
              <p class="detail-order-item-b">${order.ghichu}</p>
          </li>
          <li class="detail-order-item">
              <span class="detail-order-item-left"><i class="fa-light fa-truck"></i>Trạng thái đơn hàng</span>
              <span class="detail-order-item-right">${textDetailBtn}</span>
          </li>
      </ul>
  </div>`;
  document.querySelector(".modal-detail-order").innerHTML = spHtml;


}


// Hàm lấy thông tin chi tiết về các sản phẩm trong một đơn hàng cụ thể
function getOrderDetails(madon) {
  let orderDetails = localStorage.getItem("orderDetails") ?
      JSON.parse(localStorage.getItem("orderDetails")) : [];
  let ctDon = [];
  orderDetails.forEach((item) => {
      if (item.madon == madon) {
          ctDon.push(item);
         
      }
  });
  return ctDon;
  
}

document.querySelector(".filter-btn").addEventListener("click",(e) => {
    e.preventDefault();
    document.querySelector(".advanced-search").classList.toggle("open");
    document.getElementById("home-title").scrollIntoView();
})

document.querySelector(".form-search-input").addEventListener("click",(e) => {
    e.preventDefault();
    document.getElementById("home-title").scrollIntoView();
})

function closeSearchAdvanced() {
    document.querySelector(".advanced-search").classList.toggle("open");
}

let minPriceTemp = 0;
let maxPriceTemp = 1000000;
function sliderPrice() {
    var minPrice = 0;
    var maxPrice = 1000000;
    
    $("#max-price").val(vnd(maxPrice));
    $("#min-price").val(vnd(minPrice));

    
    $("#price-range").slider({
      range: true,
      min: 0,
      max: 1000000,
      values: [minPrice, maxPrice],
      slide: function(event, ui) {
        $("#min-price").val(vnd(ui.values[0]));
        $("#max-price").val(vnd(ui.values[1]));
        minPriceTemp = ui.values[0];
        maxPriceTemp = ui.values[1];

      }
    });
}
sliderPrice();

let perPage = 12;
let currentPage = 1;
let totalPage = 0;
let perProducts = [];
var productAll = JSON.parse(localStorage.getItem('products')).filter(item => item.status == 1);
function displayList(productAll, perPage, currentPage) {
    let start = (currentPage - 1) * perPage;
    let end = (currentPage - 1) * perPage + perPage;
    let productShow = productAll.slice(start, end);
    renderProducts(productShow);
}

function showHomeProduct(products) {
    let productAll = products.filter(item => item.status == 1)
    displayList(productAll, perPage, currentPage);
    setupPagination(productAll, perPage, currentPage);
}

function setupPagination(productAll, perPage) {
    document.querySelector('.page-nav-list').innerHTML = '';
    let page_count = Math.ceil(productAll.length / perPage);
    for (let i = 1; i <= page_count; i++) {
        let li = paginationChange(i, productAll, currentPage);
        document.querySelector('.page-nav-list').appendChild(li);
    }
}

function paginationChange(page, productAll, currentPage) {
    let node = document.createElement(`li`);
    node.classList.add('page-nav-item');
    node.innerHTML = `<a href="javascript:;">${page}</a>`;
    if (currentPage == page) node.classList.add('active');
    node.addEventListener('click', function () {
        currentPage = page;
        displayList(productAll, perPage, currentPage);
        let t = document.querySelectorAll('.page-nav-item.active');
        for (let i = 0; i < t.length; i++) {
            t[i].classList.remove('active');
        }
        node.classList.add('active');
        document.getElementById("home-title").scrollIntoView();
    })
    return node;
}
function showCategory(category) {
  let productSearch = productAll.filter(value => {
      return value.category.toString().toUpperCase().includes(category.toUpperCase());
  })
  let currentPageSeach = 1;
  displayList(productSearch, perPage, currentPageSeach);
  setupPagination(productSearch, perPage, currentPageSeach);
  document.getElementById("home-title").scrollIntoView();
}


function writeDescribe(describe){
  let desarray = getDescription(describe);
  let destext = "";

  for (let i = 0; i < desarray.length; i++){
    destext += `<span>${desarray[i]}</span>`;
  }

  return destext;
}

function getDescription(describe){
  let describearray = describe.split('\n ');

  return describearray;
}



window.onload = updateAmount();
window.onload = updateCartTotal();




// Lay so luong hang

function getAmountCart() {
  let currentuser = JSON.parse(localStorage.getItem('currentUser'))
  let amount = 0;
  currentuser.cart.forEach(element => {
      amount += parseInt(element.quantity);
  });
  return amount;
}

//Update Amount Cart 
function updateAmount() {
  if (localStorage.getItem('currentUser') != null) {
      let amount = getAmountCart();
      // document.querySelector('.count-product-cart').innerText= amount; //chưa sửa
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


 function showSectionProv(){
     document.querySelector(".sectionProvince").classList.toggle("active");
     
}

let tempProvinceSelect= "Hồ Chí Minh";
function selectProv(){
  let province= document.getElementById('provinceSelect').value;
  tempProvinceSelect = province;
  document.getElementById("ship-to-province").innerHTML=`Vận chuyển đến <strong >${province}</strong>`
}

let temp_price_bill = temp_price_ship;
// let nutthanhtoan = document.querySelector('.thanh-toan')
let checkoutpage = document.querySelector('.checkout-page');
// nutthanhtoan.addEventListener('click', () => {
//     checkoutpage.classList.add('active');
//     thanhtoanpage(1);
//     closeCart();
//     body.style.overflow = "hidden"
// })
function updateBillTotal() {
    document.querySelector("#checkout-cart-price-final").innerHTML = vnd(getCartTotal()+ parseInt(temp_price_bill));
}
let priceFinal = document.getElementById("checkout-cart-price-final");
// Trang thanh toan
function thanhtoanpage(option,product) {
    // Xu ly don hang
    switch (option) {
        case 1: // Truong hop thanh toan san pham trong gio
            // Hien thi don hang
            showProductCart();
            document.getElementById("selectProvinceBill").value = tempProvinceSelect;
            // Tinh tien
            document.querySelector("#checkout-cart-total").innerHTML = `${vnd(getCartTotal())}`;
            // Tong tien
           updateBillTotal();

            break;
        case 2: // Truong hop mua ngay
            // Hien thi san pham
            showProductBuyNow(product);
            // Tinh tien
            document.querySelector("#checkout-cart-total").innerHTML = `${vnd(product.quantity * product.price)}`;
            // Tong tien
            priceFinal.innerText = vnd((product.quantity * product.price)+parseInt(temp_price_bill));
            break;
    }

    // Tinh tien
    document.getElementById("transport-fee-bill").innerHTML = `Phí vận chuyển: <Strong>${vnd(20000)}</Strong>`;
    document.getElementById("speed-ship-bill").innerHTML = `Giao hàng hỏa tốc nội thành: <Strong>${vnd(30000)}</Strong>`



    // Su kien khu nhan nut dat hang
    document.querySelector(".complete-checkout-btn").onclick = () => {
        switch (option) {
            case 1:
                xulyDathang();
                break;
            case 2:
                xulyDathang(product);
                break;
        }
    }
}

const radioFormShip = document.getElementById('radioFormShip');
const radioValue = radioFormShip.elements.shippingOps; // Lấy tất cả các input radio có name là 'options'

radioFormShip.addEventListener('change', function(event) {
  for (const radioInput of radioValue) {
    if (radioInput.checked) {
      temp_price_bill = radioInput.value;
      updateBillTotal();
    }
  }
});

// Hien thi hang mua ngay
function showProductBuyNow(product) {
  let listOrder = document.getElementById("list-order-checkout");
  let listOrderHtml = `<div class="product-total">
    <div class="product-total-left">
      <div class=""><img class="check-out-img" src="${product.img}" alt=""></div>
      <div class="info-prod">
          <div class="name-prod">${product.title}</div>
      </div>
      <div class="sizeProduct">Size ${product.size}</div>
      <div class="count">  x ${product.quantity}</div>
    </div>
    <div class="product-total-right">
      <div class="priceProd">${vnd(product.price)}</div>
    </div>
  </div>`;
  listOrder.innerHTML = listOrderHtml;
}

function dathangngay() {
  let productInfo = document.getElementById("product-detail-content");
  let datHangNgayBtn = productInfo.querySelector(".button-dathangngay");
  datHangNgayBtn.onclick = () => {
      if(localStorage.getItem('currentUser')) {
          let productId = datHangNgayBtn.getAttribute("data-product");
          let soluong = parseInt(productInfo.querySelector(".buttons_added .input-qty").value);
          let notevalue = productInfo.querySelector("#popup-detail-note").value;
          let ghichu = notevalue == "" ? "Không có ghi chú" : notevalue;
          let products = JSON.parse(localStorage.getItem('products'));
          let a = products.find(item => item.id == productId);
          a.quantity = parseInt(quantity);
          a.note = ghichu;
          checkoutpage.classList.add('active');
          thanhtoanpage(2,a);
          closeCart();
          body.style.overflow = "hidden"
      } else {
          advertise({ title: 'Warning', message: 'Chưa đăng nhập tài khoản !', type: 'warning', duration: 3000 });
      }
  }
}

// Close Page Checkout
function closecheckout() {
  checkoutpage.classList.remove('active');
  body.style.overflow = "auto"
}

// Thong tin cac don hang da mua - Xu ly khi nhan nut dat hang
function xulyDathang(product) {
  let diachinhan = document.querySelector("#diachinhan").value +", "+document.querySelector("#selectProvinceBill").value;

  let currentUser = JSON.parse(localStorage.getItem('currentUser'));
  let orderDetails = localStorage.getItem("orderDetails") ? JSON.parse(localStorage.getItem("orderDetails")) : [];
  let order = localStorage.getItem("order") ? JSON.parse(localStorage.getItem("order")) : [];
  let madon = "MĐ"+createId(order);
  let tongtien = 0;
  if(product == undefined) {
      currentUser.cart.forEach(item => {
          item.madon = madon;
          item.price = getpriceProduct(item.id);
          tongtien += item.price * item.quantity;
          orderDetails.push(item);
      });
  } else {
      product.madon = madon;
      product.price = getpriceProduct(product.id);
      tongtien += product.price * product.quantity;
      orderDetails.push(product);
  }   
  
  let tennguoinhan = document.querySelector("#tennguoinhan").value;
  let sdtnhan = document.querySelector("#sdtnhan").value

  if(tennguoinhan == "" || sdtnhan == "" || diachinhan == "") {
      advertise({ title: 'Chú ý', message: 'Vui lòng nhập đầy đủ thông tin !', type: 'warning', duration: 4000 });
  } else {
      let donhang = {
          id: madon,
          khachhang: currentUser.email,
          hinhthucgiao: "hello",
          ghichu: document.querySelector(".note-order").value,
          tennguoinhan: tennguoinhan,
          sdtnhan: sdtnhan,
          diachinhan: diachinhan,
          thoigiandat: new Date(),
          tongtien:tongtien,
          trangthai: 0
      }
  
      order.unshift(donhang);///them một phan tu tạo do dai moi
      if(product == null) {
          currentUser.cart.length = 0;
      }
  
      localStorage.setItem("order",JSON.stringify(order));
      localStorage.setItem("currentUser",JSON.stringify(currentUser));
      localStorage.setItem("orderDetails",JSON.stringify(orderDetails));
      advertise({ title: 'Thành công', message: 'Đặt hàng thành công !', type: 'success', duration: 1000 });
      closecheckout() 
      document.getElementById("head-img").scrollIntoView();
  }
}

function getpriceProduct(id) {
  let products = JSON.parse(localStorage.getItem('products'));
  let sp = products.find(item => {
      return item.id == id;
  })
  return sp.price;
}


function advertise({
  title = 'Success',
  message = 'Tạo tài khoản thành công',
  type = 'success', 
  duration = 1000
}){
  const main = $('#advertise');
  if(main){
      const advertise = document.createElement('div');
      //Auto remove advertise
      const autoRemove = setTimeout(function(){
          main.removeChild(advertise);
      },duration+1000);
      //Remove advertise when click btn close
      advertise.onclick = function(e){
          if(e.target.closest('.fa-regular')){
              main.removeChild(advertise);
              clearTimeout(autoRemove);
          }
      }
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
      advertise.classList.add('advertise', `advertise--${type}`);
      advertise.style.animation = `slideInTop ease 0.3s, fadeOut linear 1s ${delay}s forwards`;
      advertise.innerHTML = `<div class="advertise__private" >
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
  </div>`
  // document.querySelector('.advertise__background').classList.add("initial");
  main.appendChild(advertise);
  }
}
