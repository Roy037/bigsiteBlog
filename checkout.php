<!-- <?php
include 'partials/header.php';

?>
<div class="banner"></div>
<div class="title">Giỏ hàng của tôi</div>
          <table id="table">

            <?php
            $count = 0;
            $total = 0;

            if (isset($data['cart']) && count($data['cart']) > 0) { ?>
              <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thao tác</th>
              </tr>
              <?php foreach ($data['cart'] as $key => $value) {
                $total += $value['productPrice'] * $value['quantity'];
              ?>
                <tr>
                  <td><?= ++$count ?></td>
                  <td><?= $value['productName'] ?></td>
                  <td><img class="img-table" src="<?= ROOT_URL . '/public/images/' . $value['image'] ?>" alt=""></td>
                  <td><input type="number" min="1" class="qty" name="" id="<?= $value['productId'] ?>" value="<?= $value['quantity'] ?>" onchange="update(this)"></td>
                  <td><?= number_format($value['productPrice'], 0, '', ',') ?>₫</td>
                  <td><a href="<?= ROOT_URL . '/cart/removeItemcart/' . $value['productId'] ?>" class="rm-item-cart"><i class="fa fa-trash"></i></a></td>
                </tr>
              <?php }
              ?>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                </td>
                <td>Tổng tiền</td>
                <?php
                if (isset($_SESSION['voucher'])) { ?>
                  <td>Đã áp dụng mã giảm giá: (<?= $_SESSION['voucher']['code'] . ') -' . $_SESSION['voucher']['percentDiscount'] ?>% <a href="<?= ROOT_URL ?>/cart/cancelVoucher">(Hủy)</a><br> <del><?= number_format(($total), 0, '', ',') ?>₫ <br> </del><?= number_format($total - ($total / 100 * $_SESSION['voucher']['percentDiscount']), 0, '', ',') ?>₫</td>
                <?php } else { ?>
                  <td><?= number_format(($total), 0, '', ',') ?>₫</td>
                <?php }
                ?>
              </tr>
            <?php } 
            
            else {  ?>
              <h3 style="text-align: center;">Giỏ hàng hiện đang trống...</h3>
            <?php }  ?>
          </table>


<?php
include 'partials/footer.php';

?> -->