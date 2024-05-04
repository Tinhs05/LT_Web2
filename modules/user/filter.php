<?php
// Giả sử $decimal là giá trị Decimal bạn muốn định dạng
$decimal = 1234.56789;

// Định dạng giá trị Decimal với 2 chữ số thập phân và dấu phân cách là dấu phẩy
$formatted_decimal = number_format($decimal, 0, ',', '.');

echo $formatted_decimal; // Kết quả sẽ là '1.234,57'
?>