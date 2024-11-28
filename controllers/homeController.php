<?php
session_start();

class homeController
{
    public $homeModel;
    function __construct()
    {
        $this->homeModel = new homeModel();
    }
    function dathang()
    {
        require_once 'views/dathang.php';
    }
    function chitietorder()
    {

        $idbill = isset($_GET['idbill']) ? $_GET['idbill'] : null;
        $infoStatus = $this->homeModel->getInfoStatus($idbill);
        $getOrder = $this->homeModel->getOrderByBill($idbill);
        foreach ($getOrder as &$order) {
            $status = $this->homeModel->getBillStatusById($order['idbill']);
            // $order['bill_status'] = $status['bill_status'] ?? 'Chờ giao hàng'; // Mặc định nếu không tìm thấy trạng thái
            if (empty($status['bill_status'])) {
                $order['bill_status'] = 'chờ thanh toán';
                $this->homeModel->updateBillStatus($order['idbill'], 'Chờ thanh toán');
            } else {
                $order['bill_status'] = $status['bill_status'];
            }
        }
        require_once 'views/chitietorder.php';
    }

    function chitietdonhang()
    {
        $iduser = $_SESSION['user']['id'];

        $getOrder = $this->homeModel->getOrder($iduser); // Lấy danh sách các đơn hàng của user

        // Thêm trạng thái vào từng đơn hàng



        // Gắn trạng thái tương ứng vào từng đơn hàng
        // foreach ($getOrder as &$order) {
        //     foreach ($orderStatuses as $status) {
        //         if ($order['idbill'] == $status['id_bill']) {
        //             $order['bill_status'] = $status['bill_status'];
        //             break;
        //         }
        //     }
        // }
        $totalQuantity = $this->homeModel->getTotalQuantity($iduser);
        // $totalPrice = $this->homeModel->calculateTotalPrice($iduser);
        // $totalPriceAll = $this->homeModel->calculateTotalPrice($iduser);
        require_once 'views/chitietdonhang.php';

        require_once 'assets/header/headerDetail.php';
    }
    function thanhtoan_momo()
    {
        require_once 'views/thanhtoan_momo.php';
    }
    function thanhtoan_atm()
    {
        require_once 'views/thanhtoan_atm.php';
    }
    function chuyenkhoan()
    {
        require_once 'views/chuyenkhoan.php';
    }
    function home()
    {
        $product = [];
        $listBanner = $this->homeModel->getAllBanner();
        // Lấy sản phẩm nổi bật với lượt xem > 200
        $popularProducts = $this->homeModel->getPopularProducts(200);

        $nhapkhau = $this->homeModel->findProductByIddm('116');
        $noidia = $this->homeModel->findProductByIddm('115');
        $product = $this->homeModel->allProduct();

        // Giả sử đây là trang bạn muốn hiển thị tổng số lượng sản phẩm trong giỏ hàng
        if (isset($_SESSION['user'])) {
            $iduser = $_SESSION['user']['id'];
            // Lấy tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = $this->homeModel->getTotalQuantity($iduser);
            // Các biến khác mà bạn cần
        }

        // Chuyển tới View
        require_once 'views/home.php';
    }
    function contact()
    {
        if (isset($_SESSION['user'])) {
            $iduser = $_SESSION['user']['id'];
            // Lấy tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = $this->homeModel->getTotalQuantity($iduser);
        }

        require_once 'views/contact.php';

        require_once 'assets/header/headerContract.php'; // Truyền vào headerContract
    }

    function order()
    {
        if (isset($_SESSION['user'])) {
            $iduser = $_SESSION['user']['id'];
            // Lấy tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = $this->homeModel->getTotalQuantity($iduser);
        }
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?act=dangnhap");
            exit;
        }
        $iduser = $_SESSION['user']['id'];
        // Lấy dữ liệu từ Model
        $cartItems = $this->homeModel->getCartItems($iduser);
        $totalQuantity = $this->homeModel->getTotalQuantity($iduser); // Tổng số lượng sản phẩm
        $totalPriceAll = $this->homeModel->calculateTotalPrice($iduser); // Tổng giá trị giỏ hàng từ Model
        $totalPrice = $this->homeModel->calculateTotalPrice($iduser); // Tổng giá trị giỏ hàng
        require_once 'views/order.php';
        // Truyền vào headerContract
    }
    function error()
    {
        if (isset($_SESSION['user'])) {
            $iduser = $_SESSION['user']['id'];
            // Lấy tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = $this->homeModel->getTotalQuantity($iduser);
        }
        require_once 'views/404.php';
    }
    function chackout()
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?act=dangnhap");
            exit;
        }

        $iduser = $_SESSION['user']['id'];

        // Lấy dữ liệu từ Model
        $cartItems = $this->homeModel->getCartItems($iduser);
        $totalQuantity = $this->homeModel->getTotalQuantity($iduser); // Tổng số lượng sản phẩm
        $totalPriceAll = $this->homeModel->calculateTotalPrice($iduser); // Tổng giá trị giỏ hàng từ Model

        // Cộng thêm 3 vào tổng giá trị
        $totalPriceAll += 3;

        // Truyền dữ liệu cho view
        require_once 'views/chackout.php';
    }

    function registerUser()
    {
        $error = "";

        if (isset($_POST["dangky"])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $tell = $_POST['tell'];

            if ($user == "" || $pass == "" || $email == "" || $address == "" || $tell == "") {
                $error = "Vui lòng nhập đầy đủ thông tin đăng ký!";
            } elseif (strlen($pass) < 8) {
                $error = "Mật khẩu phải có ít nhất 8 kí tự!";
            } elseif (strlen($email) < 14 || strpos($email, '@gmail.com') === false) {
                $error = "Email quá ngắn và ký tự và phải đúng định dạng!";
            } elseif (!preg_match('/^[0-9]{10}$/', $tell)) {
                $error = "Số điện thoại không hợp lệ!";
            } else {
                $mUser = new homeModel();
                $registerUser = $mUser->insertUser(null, $user, $pass, $email, $address, $tell);
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
        if (isset($_POST['dangnhap'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];

            // Lấy thông tin người dùng từ cơ sở dữ liệu
            $userInfo = $this->homeModel->checkAcc($user, $pass);

            if ($userInfo) { // Nếu thông tin người dùng tồn tại
                // Kiểm tra role từ cơ sở dữ liệu và chuyển hướng phù hợp
                if ($userInfo['role'] == 1) {
                    header('Location: admin/index.php'); // Chuyển hướng về admin nếu là admin
                    exit;
                }

                // Lưu thông tin vào session
                $_SESSION['user'] = [
                    'username' => $userInfo['user'],
                    'email' => $userInfo['email'],
                    'role' => $userInfo['role'],
                    'id' => $userInfo['id']
                ];
                header('Location: index.php'); // Chuyển hướng về trang chủ
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

    // Ví dụ cho trang chi tiết sản phẩm (headerDetail.php)


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
        $totalPriceAll = $totalPrice + 3;
        require_once 'views/cart.php';

        require_once 'assets/header/headerShop.php';
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
            $idbill = rand(1, 100); // Tạo giá trị ngẫu nhiên cho idbill
            $_SESSION['id_bill'] = $idbill; // Lưu vào session

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

    // chack thông tin
    function chackthongtin()
    {
        if (!isset($_POST["order"])) {

            if (isset($_SESSION['user'])) {
                $iduser = $_SESSION['user']['id'];

                // Lấy các sản phẩm từ giỏ hàng của người dùng
                $cartItems = $this->homeModel->getCartItems($iduser);


                foreach ($cartItems as $item) {
                    $this->homeModel->insertdonhang(
                        null,
                        $iduser,
                        $item['idpro'],
                        $item['img'],
                        $item['name'],
                        $item['price'],
                        $item['soluong'],
                        $item['thanhtien'],
                        $item['idbill'],
                    );
                }

                $this->homeModel->deleteAllCart($iduser);
                if (isset($_SESSION['cart'])) {
                    unset($_SESSION['cart']);
                }


                header('location: index.php?act=dathang');
                exit;
            }
        }

        $iduser = $_SESSION['user']['id'];
        $cartItems = $this->homeModel->getCartItems($iduser);
        if (empty($cartItems)) {
            echo "<script>
                alert('Giỏ hàng trống!');
                window.location.href='index.php?act=shop';
             </script>";
            exit;
        }

        $error = "";


        $iduser = $_SESSION['user']['id'];
        $id_order = $_SESSION['id_order'];
        $idbill = $_SESSION['id_bill'];

        $bill_name = $_POST['bill_name'];
        $bill_address = $_POST['bill_address'];
        $bill_tell = $_POST['bill_tell'];
        $bill_email = $_POST['bill_email'];




        $bill_pttt = isset($_POST['bill_pttt']) ? $_POST['bill_pttt'] : null;
        if ($bill_pttt == "Thanh Toán Qua ATM") {
            header('location: index.php?act=thanhtoan_atm');
            exit;
        }

        if (!isset($bill_pttt) || $bill_pttt == "") {
            echo "<script>
                alert('Vui lòng chọn phương thức thanh toán!');
                window.location.href='index.php?act=chackout';
             </script>";
            exit;
        }

        if ($bill_name == "" || $bill_address == "" || $bill_tell == "" || $bill_email == "") {
            $error = "Vui lòng nhập đầy đủ thông tin thanh toán!";

            if (!isset($_SESSION['user'])) {
                header("Location: index.php?act=dangnhap");
                exit;
            }

            $iduser = $_SESSION['user']['id'];
            $cartItems = $this->homeModel->getCartItems($iduser);
            $totalQuantity = $this->homeModel->getTotalQuantity($iduser);
            $totalPrice = $this->homeModel->calculateTotalPrice($iduser);
            $totalPriceAll = $this->homeModel->calculateTotalPrice($iduser);
        } else {
            $ngaydathang = date('Y-m-d H:i:s');

            $mOrder = new homeModel();





            if (!isset($_SESSION['id_bill'])) {
                $_SESSION['id_bill'] = rand(1, 100); // Gán giá trị ngẫu nhiên nếu chưa tồn tại
            }

            $idbill = $_SESSION['id_bill'];

            // Truyền ID Bill vào hàm insertOrder
            $this->homeModel->insertOrder(
                null,           // id
                $iduser,        // id_user
                $bill_name,     // Tên người nhận
                $bill_address,  // Địa chỉ người nhận
                $bill_tell,     // Số điện thoại
                $bill_email,    // Email
                $bill_pttt,     // Phương thức thanh toán
                $ngaydathang,   // Ngày đặt hàng
                $idbill         // ID Bill
            );



            $_SESSION['bill_name'] = $bill_name;
            $_SESSION['bill_address'] = $bill_address;
            $_SESSION['bill_tell'] = $bill_tell;
            $_SESSION['bill_email'] = $bill_email;
            $_SESSION['bill_pttt'] = $bill_pttt;
            $_SESSION['ngaydathang'] = $ngaydathang;

            $_SESSION['id_bill'] = $idbill;
            $_SESSION['id_order'] = $id_order;


            header('location: index.php?act=order');


            exit;
        }
        require_once 'views/chackout.php';
    }


    function showCheckout()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?act=dangnhap");
            exit;
        }

        $iduser = $_SESSION['user']['id'];
        $cartItems = $this->homeModel->chackcart($iduser);

        // Kiểm tra dữ liệu giỏ hàng
        if (empty($cartItems)) {
            echo "Giỏ hàng trống";
            exit; // Dừng chương trình nếu giỏ hàng trống
        }

        // Truyền dữ liệu giỏ hàng vào view checkout
        include 'views/chackout.php';
    }



    // function deleteCart()
    // {
    //     $iduser = $_SESSION['user']['id'];
    //     $this->homeModel->deleteCartUser($iduser);
    //     header('location: index.php?act=cart');
    // }


}
