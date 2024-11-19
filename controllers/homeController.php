<?php
session_start();

class homeController
{
    public $homeModel;
    function __construct()
    {
        $this->homeModel = new homeModel();
    }
    function home()
    {
        $product = $this->homeModel->allProduct();
        require_once 'views/home.php';

        // Giả sử đây là trang bạn muốn hiển thị tổng số lượng sản phẩm trong giỏ hàng
        if (isset($_SESSION['user'])) {
            $iduser = $_SESSION['user']['id'];
            // Lấy tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = $this->homeModel->getTotalQuantity($iduser);
            // Các biến khác mà bạn cần
        }

        // Chuyển tới View
        require_once 'assets/header/headerHome.php'; // Truyền vào headerHome
        require_once 'assets/header/headerCart.php'; // Truyền vào headerCart
        require_once 'assets/header/headerShop.php'; // Truyền vào headerShop

    }


    function shop()
    {

        $products = [];
        if (isset($_GET['priceRange'])) {
            $priceRange = $_GET['priceRange'];
            switch ($priceRange) {
                case '<3':
                    $products = $this->homeModel->getPrice(0, 3);
                    break;
                case '3-6':
                    $products = $this->homeModel->getPrice(3, 6);
                    break;
                case '>6':
                    $products = $this->homeModel->getPrice(6);
                    break;
                default:
                    $products = $this->homeModel->allProductShop();
                    break;
            }
        } else {
            $products = $this->homeModel->allProductShop();
        }
        $danhmuc = $this->homeModel->allDanhmuc();
        require_once 'views/shop.php';
        if (isset($_SESSION['user'])) {
            $iduser = $_SESSION['user']['id'];
            // Lấy tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = $this->homeModel->getTotalQuantity($iduser);
        }

        require_once 'assets/header/headerShop.php';
        require_once 'assets/header/headerHome.php'; // Truyền vào headerHome
        require_once 'assets/header/headerCart.php'; // Truyền vào headerCart
        // Truyền vào headerShop
    }
    function shopDetail($id)
    {

        $productOne = $this->homeModel->findProductById($id);
        $comments = $this->homeModel->getCommentById($id);

        if (isset($_SESSION['user'])) {
            $iduser = $_SESSION['user']['id'];
            // Lấy tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = $this->homeModel->getTotalQuantity($iduser);
            // Lấy thông tin chi tiết sản phẩm
            $product = $this->homeModel->findProductById($id);
        }

        require_once 'views/shopDetail.php';
        require_once 'assets/header/headerHome.php'; // Truyền vào headerHome
        require_once 'assets/header/headerCart.php'; // Truyền vào headerCart
        require_once 'assets/header/headerShop.php'; // Truyền vào headerShop
        require_once 'assets/header/headerDetail.php'; // Truyền vào headerDetail
    }

    function contact()
    {
        if (isset($_SESSION['user'])) {
            $iduser = $_SESSION['user']['id'];
            // Lấy tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = $this->homeModel->getTotalQuantity($iduser);
        }

        require_once 'views/contact.php';
        require_once 'assets/header/headerHome.php'; // Truyền vào headerHome
        require_once 'assets/header/headerCart.php'; // Truyền vào headerCart
        require_once 'assets/header/headerShop.php'; // Truyền vào headerShop
        require_once 'assets/header/headerContract.php'; // Truyền vào headerContract
    }

    function testimonial()
    {
        require_once 'views/testimonial.php';
    }
    function error()
    {
        require_once 'views/404.php';
    }
    function chackout()
    {
        require_once 'views/chackout.php';
    }
    function registerUser()
    {
        $error = "";

        if (isset($_POST["dangky"])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];

            if ($user == "" || $pass == "" || $email == "") {
                $error = "Vui lòng nhập đầy đủ thông tin đăng ký!";
            } else {
                $mUser = new homeModel();
                $registerUser = $mUser->insertUser(null, $user, $pass, $email);
                echo "<script>
                        alert('Bạn đã đăng ký thành công!');
                        window.location.href='?act=dangnhap';
                    </script>";
            }
        }
        require_once 'views/taikhoan/dangky.php';
    }
    function login()
    {
        // Include view

        if (isset($_POST['dangnhap'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $userInfo = $this->homeModel->checkAcc($user, $pass);

            if ($userInfo) {  // Nếu thông tin người dùng tồn tại
                // Lưu thông tin vào session
                $_SESSION['user'] = [
                    'username' => $userInfo['user'], // Giả sử cột tên là `user`
                    'email' => $userInfo['email'],  // Giả sử cột tên là `email`
                    'id' => $userInfo['id']
                ]; // Lưu tên tài khoản vào session
                header('Location:index.php'); // Chuyển hướng về trang chủ
                exit;
            } else {
                $error = "Đăng nhập thất bại! Tài khoản hoặc mật khẩu không đúng";
            }
        }
        require_once 'views/taikhoan/dangnhap.php';
    }

    function logout()
    {
        unset($_SESSION['user']);
        header('Location:index.php');
    }


    function quenmk()
    {
        $error = "";

        if (isset($_POST["doimatkhau"])) {
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
            $mUser = new homeModel();
            $userExists = $mUser->checkEmailExists($email); // Kiểm tra email

            if ($email == "" || $pass == "") {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            } elseif (!$userExists) {
                $error = "Email không tồn tại!";
            } else {
                // Cập nhật mật khẩu mới
                $updatePassword = $mUser->updatePassword($email, $pass);
                if ($updatePassword) {
                    echo "<script>
                        alert('Bạn đã thay đổi mật khẩu thành công!');
                        window.location.href='?act=dangnhap';
                    </script>";
                } else {
                    $error = "Lỗi khi cập nhật mật khẩu!";
                }
            }
        }


        require_once 'views/taikhoan/quenmk.php'; // Giao diện để người dùng nhập thông tin
    }

    function addComment()
    {
        if (isset($_POST['comment']) && isset($_SESSION['user']) && isset($_GET['id'])) {
            $noidung = $_POST['comment'];
            $iduser = $_SESSION['user']['id']; // Lấy ID người dùng từ session
            $idpro = $_GET['id']; // ID sản phẩm
            $ngaybinhluan = date('Y:m:d');
            $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 5;
            if ($noidung !== "") {
                // Gọi phương thức saveComment để lưu vào cơ sở dữ liệu
                $this->homeModel->insertComment(null, $noidung, $iduser, $idpro, $ngaybinhluan, $rating);
                // echo "<script>alert('Bình luận của bạn đã được lưu!');</script>";
                header("Location: index.php?act=shopdetail&id={$idpro}"); // Chuyển hướng về chi tiết sản phẩm
                exit;
            } else {
                echo "<script>
                        alert('Vui lòng nhập bình luận!');
                        window.location.href='?act=shopdetail&id={$idpro}';
                    </script>";
            }
        } else {
            echo "<script>alert('Vui lòng đăng nhập để bình luận.');</script>";
        }
    }






    // Thêm sản phẩm vào giỏ hàng
    // function addToCart($id)
    // {
    //     if (!isset($_SESSION['cart'])) {
    //         $_SESSION['cart'] = [];
    //     }

    //     // Tăng số lượng nếu sản phẩm đã có trong giỏ
    //     if (isset($_SESSION['cart'][$id])) {
    //         $_SESSION['cart'][$id]++;
    //     } else {
    //         // Thêm sản phẩm mới vào giỏ
    //         $_SESSION['cart'][$id] = 1;
    //     }

    //     // Chuyển hướng tới trang giỏ hàng
    //     header("Location: index.php?act=cart");
    // }
    // homeController.php

    // Ví dụ cho trang chi tiết sản phẩm (headerDetail.php)
    function detail($id) {}

    // Ví dụ cho trang hợp đồng (headerContract.php)


    // Ví dụ cho trang shop (headerShop.php)
    function shopCart() {}

    // Hiển thị giỏ hàng
    function cart()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?act=dangnhap");
            exit;
        }

        $iduser = $_SESSION['user']['id'];
        $totalQuantity = $this->homeModel->getTotalQuantity($iduser);
        $cartItems = $this->homeModel->getCartItems($iduser);

        // Tính tổng giá trị tất cả các sản phẩm trong giỏ hàng
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['total_price']; // Giả sử 'total_price' là giá trị của mỗi sản phẩm
        }

        require_once 'assets/header/headerHome.php';
        require_once 'assets/header/headerCart.php';
        require_once 'views/cart.php';
    }





    // Xóa sản phẩm khỏi giỏ hàng
    // function removeFromCart($id)
    // {
    //     if (isset($_SESSION['cart'][$id])) {
    //         unset($_SESSION['cart'][$id]);
    //     }
    //     header("Location: index.php?act=cart");
    // }
    // // Lấy tổng số lượng sản phẩm trong giỏ hàng
    function getCartQuantity()
    {
        if (isset($_SESSION['cart'])) {
            // Tính tổng số lượng sản phẩm 
            return max(0, array_sum($_SESSION['cart'])); // max(0, ...) để tránh kết quả âm
        }
        return 0; // Nếu không có sản phẩm trong giỏ hàng
    }

    // /// Cập nhật số lượng sản phẩm trong giỏ hàng
    // function updateQuantityCart($id, $action)
    // {
    //     if (isset($_SESSION['cart'][$id])) {
    //         if ($action == 'increase') {
    //             $_SESSION['cart'][$id]++;
    //         } elseif ($action == 'decrease' && $_SESSION['cart'][$id] > 1) {
    //             $_SESSION['cart'][$id]--;
    //         }
    //     }

    //     // Chuyển hướng lại trang giỏ hàng
    //     header("Location: index.php?act=cart");
    // }
    //----------------------------------------------------------------
    // Thêm sản phẩm vào giỏ hàng

    function addToCartDb($id)
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?act=dangnhap");
            exit;
        }

        $iduser = $_SESSION['user']['id'];
        $product = $this->homeModel->findProductById($id);

        if ($product) {
            // Tạo idbill ngẫu nhiên (ví dụ: số ngẫu nhiên từ 1000 đến 9999)
            $idbill = rand(1, 100);

            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            $cartItem = $this->homeModel->getCartItems($iduser, $id);

            if ($cartItem) {
                // Nếu đã có, tăng số lượng và cập nhật thành tiền
                $newQuantity = $cartItem['soluong'] + 1;
                $newTotalPrice = $newQuantity * $product['price'];
                $this->homeModel->updateCartItem($cartItem['id'], $newQuantity, $newTotalPrice);
            } else {
                // Nếu chưa có, thêm sản phẩm mới vào giỏ hàng với idbill ngẫu nhiên
                $this->homeModel->insertCartItem(
                    $iduser,
                    $id,
                    $product['img'],
                    $product['name'],
                    $product['price'],
                    1,
                    $product['price'],
                    $idbill
                );
            }
        }

        header("Location: index.php?act=cart");
    }


    function updateQuantity($id, $action)
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?act=dangnhap");
            exit;
        }

        $iduser = $_SESSION['user']['id'];
        $cartItem = $this->homeModel->getCartItems($iduser, $id);

        if (!empty($cartItem)) {
            $cartItem = $cartItem[0]; // Vì kết quả trả về là một mảng sản phẩm
            $newQuantity = $cartItem['soluong'];

            if ($action === 'increase') {
                $newQuantity++;
            } elseif ($action === 'decrease' && $cartItem['soluong'] > 1) {
                $newQuantity--;
            }

            $newTotalPrice = $newQuantity * $cartItem['price'];
            $this->homeModel->updateCartItem($cartItem['id'], $newQuantity, $newTotalPrice);
        }

        header("Location: index.php?act=cart");
    }
    function removeFromCart($idpro)
    {
        $iduser = $_SESSION['user']['id']; // Lấy ID người dùng từ session
        $this->homeModel->deleteCartItem($iduser, $idpro); // Gọi Model để xóa sản phẩm theo ID người dùng và sản phẩm

        // Chuyển hướng lại giỏ hàng
        header("Location: index.php?act=cart");
    }
}
