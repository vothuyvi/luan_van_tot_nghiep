import request from '@/utils/request';

export function register(form) {
    return request({
        url: '/register',
        method: 'POST',
        data: form
    });
}

export function getInformation() {
  return request({
    url: '/get-info',
    method: 'GET',
  });
}

export function login(form) {
    return request({
        url: '/login',
        method: 'POST',
        data: form
    });
}

export function logout() {
  return request({
    url: '/logout',
    method: 'POST',
  });
}

export function productNew() {
  return request({
    url: '/product-new',
    method: 'GET',
  });
}

export function productBest() {
  return request({
    url: '/product-best',
    method: 'GET',
  });
}

export function productAll() {
  return request({
    url: '/product-all',
    method: 'GET',
  });
}

export function productTypeAll() {
  return request({
    url: '/product-type-all',
    method: 'GET',
  });
}


export function productDetail(MaSP) {
  return request({
    url: `/product-detail/${MaSP}`,
    method: 'GET',
  });
}
export function productType(MaLoai) {
  return request({
    url: `/product-type/${MaLoai}`,
    method: 'GET',
  });
}

export function productList(form) {
  return request({
    url: `/product-list`,
    method: 'POST',
    data: form,
  });
}

export function updateProfile(form) {
  return request({
      url: '/update-profile',
      method: 'POST',
      data: form
  });
}

export function newsDetail(MaTT) {
  return request({
      url: `/news-detail?MaTT=${MaTT}`,
      method: 'get',
  });
}

export function news() {
  return request({
      url: `/news`,
      method: 'get',
  });
}


export function comments(MaSP) {
  return request({
      url: `/comments-list?MaSP=${MaSP}`,
      method: 'post',
  });
}

export function commentStore(form) {
  return request({
      url: `/comments-store`,
      method: 'post',
      data: form,
  });
}

export function statusAll() {
  return request({
    url: '/status-all',
    method: 'GET',
  });
}

export function orders(MaTT) {
  return request({
    url: `/don-hang?MaTT=${MaTT}`,
    method: 'GET',
  });
}

export function getProducts(form) {
  return request({
      url: `/get-products`,
      method: 'post',
      data: form,
  });
}

export function searchName(TenSP) {
  return request({
    url: `/search/${TenSP}`,
    method: 'GET',
  });
}

export function phuongThucThanhToan() {
  return request({
      url: `/phuong-thuc-thanh-toan`,
      method: 'get',
  });
}


export function checkOut(form) {
  return request({
      url: `/check-out`,
      method: 'post',
      data: form
  });
}

export function khuyenMai() {
  return request({
      url: `/sale`,
      method: 'get',
  });
}

export function sale(DieuKienApDung) {
  return request({
    url: `/khuyen-mai/${DieuKienApDung}`,
    method: 'GET',
  });
}

export function payment(form) {
  return request({
    url: `/payment`,
    method: 'POST',
    data: form
  });
}

export function paymentMoMo(form) {
  return request({
    url: `/payment-momo`,
    method: 'POST',
    data: form
  });
}

export function updateOrder(form) {
  return request({
    url: `/update-order`,
    method: 'POST',
    data: form
  });
}

export function orderDetail(MaDH) {
  return request({
      url: `/order-detail?MaDH=${MaDH}`,
      method: 'get',
  });
}




