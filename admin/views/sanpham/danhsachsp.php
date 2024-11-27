<h1>Danh sách sản phẩm</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Hình ảnh</th>
        <th>Mô tả ngắn</th>
        <th>Lượt xem</th>
        <th>Danh mục</th>
        <th>Mô tả chi tiết</th>
        <th>Số Lượng</th>
        <th>Hành động</th>
        
    </tr>
    
    
    
    <?php foreach ($product as $key => $row) { ?>
        <tr>
        <td><?= $row['id']?></td>
        <td><?= $row['name']?></td>
        <td><?= $row['price']?></td>
        <td><img src="assets/img/<?= $row['img']?>" alt=""></td>
        <td><?= $row['mota']?></td>
        <td><?= $row['luotxem']?></td>
        <td><?= $row['iddm']?></td>
        <td><?= $row['motachitiet']?></td>
        <td><?= $row['soluong']?></td>
        <td>
    <a href="index.php?act=editsp&id=<?= $row['id'] ?>">Sửa</a>
    <a href="index.php?act=deleteProduct&id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
       </td>
        </tr>
        <?php  } ?>
</table>
<a href="?act=add">Thêm sản phẩm mới</a>
