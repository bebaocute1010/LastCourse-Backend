<?php

namespace App\Utils;

class MessageResource
{
    public const DEFAULT_SUCCESS_TITLE = "Thành công";
    public const DEFAULT_FAIL_TITLE = "Thất bại";
    public const DEFAULT_FAIL_MESSAGE = "Đã xảy ra lỗi.";

    public const NO_SHOP = "Bạn không có shop.";

    public const CART_ADD_PRODUCT_SUCCESS = "Thêm sản phẩm vào giỏ hàng thành công.";
    public const CART_UPDATE_PRODUCT_SUCCESS = "Cập nhật số lượng thành công.";
    public const CART_DELETE_PRODUCT_SUCCESS = "Xóa sản phẩm khỏi giỏ hàng thành công.";

    public const BILL_UPDATE_STATUS_SUCCESS = "Cập nhật trạng thái đơn hàng thành công.";

    public const COMMENT_CREATE_SUCCESS = "Đánh giá thành công.";
    public const COMMENT_UPDATE_SUCCESS = "Cập nhật đánh giá thành công.";
    public const COMMENT_DELETE_SUCCESS = "Xóa đánh giá thành công.";

    public const SHOP_CREATE_SUCCESS = "Đăng ký shop thành công.";
    public const SHOP_UPDATE_SUCCESS = "Cập nhật thông tin shop thành công.";
    public const SHOP_DELETE_SUCCESS = "Xóa shop thành công.";

    public const PRODUCT_HIDDEN_SUCCESS = "Ẩn sản phẩm thành công.";
    public const PRODUCT_SHOW_SUCCESS = "Hiển thị sản phẩm thành công.";
    public const PRODUCT_CREATE_SUCCESS = "Thêm sản phẩm thành công.";
    public const PRODUCT_UPDATE_SUCCESS = "Cập nhật sản phẩm thành công.";
    public const PRODUCT_DELETE_SUCCESS = "Xóa sản phẩm thành công.";

    public const REGISTER_SUCCESS_TITLE = "Đăng ký tài khoản thành công";
    public const REGISTER_SUCCESS_MESSAGE = "Chúc mừng bạn đã đăng ký tài khoản thành công.";
    public const REGISTER_VERIFY_SUCCESS = "Xác thực Email thành công.";
    public const REGISTER_NOT_VERIFY = "Bạn chưa xác thực Email.";
    public const REGISTER_INFORMATION_UPDATED = "Thông tin tài khoản đã được cập nhật rồi.";
    public const REGISTER_INFORMATION_SUCCESS = "Cập nhật thông tin thành công.";
    public const REGISTER_INFORMATION_FAIL = "Cập nhật thông tin thất bại.";
    public const REGISTER_EMAIL_EXIST = "Email đã được đăng ký.";
    public const REGISTER_USERNAME_EXIST = "Tên đăng nhập đã được sử dụng.";
    public const REGISTER_INVITE_CODE_INVALID = "Mã giới thiệu không đúng.";

    public const USER_PROFILE_UPDATE_SUCCESS = "Cập nhật thông tin thành công.";

    public const CHANGE_PASSWORD_SUCCESS = "Đổi mật khẩu thành công.";

    public const RESET_PASSWORD_SUCCESS = "Đặt lại mật khẩu thành công.";

    public const AUTH_PASSWORD_NOT_CORRECT = "Mật khẩu không chính xác.";

    public const LOGIN_SUCCESS_TITLE = "Đăng nhập thành công";
    public const LOGIN_SUCCESS_MESSAGE = "Chúc mừng bạn đã đăng nhập thành công.";
    public const LOGIN_UNAUTHORIZED = "Tài khoản hoặc mật khẩu không chính xác.";

    public const LOGOUT_SUCCESS_MESSAGE = "Đăng xuất thành công.";
    public const LOGOUT_FAIL_MESSAGE = "Đăng xuất thất bại.";

    public const OTP_INVALID = "Mã OTP không chính xác.";
    public const OTP_VALID = "Mã OTP chính xác.";

    public const ACCOUNT_NOT_EXIST = "Tài khoản không tồn tại.";

    public const EXCEPTION_QUERY_DEFAULT_MESSAGE = "Lỗi truy vấn cơ sở dữ liệu.";
}
