import Cookies from 'js-cookie';

const TokenKey = 'tokenlogin';

export function getToken() {
  return Cookies.get(TokenKey);
}

export function setToken(token, expires = 100) {
  return Cookies.set(TokenKey, token, { expires: expires });
}

export function removeToken() {
  return Cookies.remove(TokenKey);
}
