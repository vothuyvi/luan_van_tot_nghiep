import { useAuthStore } from '@/stores';
import { useRouter } from 'vue-router';
import { ElMessage, ElMessageBox } from 'element-plus';
export const addOrder = dataMaSP => {
  const authStore = useAuthStore();
  const orders = JSON.parse(localStorage.getItem('orders'));
  if (orders) {
    // Nếu có giỏ hàng trong localStorage
    // Tìm xem trong giỏ hàng đã có tồn tại sản phẩm muốn thêm chưa
    const indexProduct = orders.findIndex(order => order.MaSP == dataMaSP);
    if (indexProduct != -1) {
      //nếu đã có sản phẩm muốn thêm thì tăng số lượng lên 1
      orders[indexProduct].SoLuong += 1;
    } else {
      // nếu chưa có sản phẩm muốn thêm thì tạo mới 1 sản phẩm và thêm vào giỏ hàng
      orders.push({
        MaSP: dataMaSP,
        SoLuong: 1,
      });
    }
    // Cập nhật lại giỏ hàng trong localStorage
    localStorage.setItem('orders', JSON.stringify(orders));
  } else {
    // Nếu không có giỏ hàng trong localStorage thì tạo mới 1 giỏ hàng
    const orders = [
      {
        MaSP: dataMaSP,
        SoLuong: 1,
      },
    ];
    localStorage.setItem('orders', JSON.stringify(orders));
  }
  ElMessage({
    message: 'Thêm giỏ hàng thành công!',
    type: 'success',
    grouping: true,
  });
  authStore.onRefetchOrder();
  // }
};

export const handelDelete = dataMaSP => {
  const authStore = useAuthStore();
  const orders = JSON.parse(localStorage.getItem('orders'));
  if (orders) {
    const indexProduct = orders.findIndex(order => order.MaSP == dataMaSP);
    if (indexProduct != -1) {
      orders.splice(indexProduct, 1);
      localStorage.setItem('orders', JSON.stringify(orders));
      authStore.onRefetchOrder();
      ElMessage({
        message: 'Đã xoá thành công.',
        type: 'success',
        grouping: true,
      });
    }
  }
};
