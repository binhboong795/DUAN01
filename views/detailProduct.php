<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
  .wrapping{
  width: 1140px;
}
    body{
        color: white;
    }
</style>
<body>
<div class="wrapping">
<div class="tieude">
    <div><img id="head" src="assets/img/icon.png" alt="" ></div>
  <div id="apw"><p style="color: white; width: 300px; scale: 4;">APPLE WATCH STORE</p></div>
</div>
<div class="header">
          <img src="assets/img/banner.jpg" alt="" class="banner" />
</div>
<div class="nav">
  <div id="menu">
            
          <ul>
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="">Danh mục</a></li>
            <li><a href="">Giới thiệu</a></li>
            <li><a href="">Liên hệ</a></li>
           
          </ul>
  </div>
  <div class="search">
    <input id="tim" type="text" name="search" placeholder="Tìm kiếm sản phẩm">
    <input type="submit" value="Tìm kiếm">
  </div>
</div>
        <div class="wrapper-detail">
    <h1 class="chitiet">Chi Tiết Sản Phẩm:</h1>
    <div class="top-pro-wrapper">
        <div class="top-pro-items">
            <img src="assets/img/<?=$productOne['pro_img']?>" alt="" class="top-pro-img">
        </div>
        <div class="pro-wrapper">
            <div class="pr">
                <h2 class="namepr"><?=$productOne['pro_name']?></h2>
            <p class="price"><?=number_format($productOne['price'])?>VND</p>
            </div>
            <div class="detail">
                <p class="detail"><?=$productOne['detail']?></p>
            </div>
            
            <p class="sale"></p>
        </div>
        
    </div>
    </div>
    <footer>
          <div class="diachi">
          <p>HỆ THỐNG CỬA HÀNG</p>
          <p>Hà Nội
            120 Thái Hà, Q. Đống Đa <br>
            Điện thoại: 0969.120.120 - 037.437.9999
              <br>
            42 Phố Vọng, Hai Bà TrưngXem bản đồ
            Điện thoại: 0979.884242 - 037.437.9999</p>
            <p>Hotline CSKH: 097.120.66.88</p>
          </div>
          <div class="diachi">
          <p>HỆ THỐNG CỬA HÀNG</p>
          <p>CHÍNH SÁCH BẢO HÀNH  
Chính sách vận chuyển
Chính sách đổi trả hàng
Chính sách bảo mật thông tin
Hướng dẫn thanh toán
Hướng dẫn mua hàng Online
Dịch vụ Ship COD Toàn quốc
Chính sách đại lý linh, phụ kiện</p>
          </div>
          
        </footer>
  </div>
</body>
</html>