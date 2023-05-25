<?php

namespace App\Ultis;

class MessageResource
{
    public const DEFAULT_SUCCESS_TITLE = "Thành công";
    public const DEFAULT_FAIL_TITLE = "Thất bại";
    public const DEFAULT_FAIL_MESSAGE = "Đã xảy ra lỗi.";

    public const REGISTER_SUCCESS_TITLE = "Đăng ký tài khoản thành công";
    public const REGISTER_SUCCESS_MESSAGE = "Chúc mừng bạn đã đăng ký tài khoản thành công.";
    public const REGISTER_VERIFY_SUCCESS = "Xác thực Email thành công.";
    public const REGISTER_EMAIL_EXIST = "Email đã có tài khoản.";
    public const REGISTER_USERNAME_EXIST = "Tên đăng nhập đã tồn tại.";
    public const REGISTER_INVITE_CODE_INVALID = "Mã giới thiệu không đúng.";

    public const LOGIN_SUCCESS_TITLE = "Đăng nhập thành công";
    public const LOGIN_SUCCESS_MESSAGE = "Chúc mừng bạn đã đăng nhập thành công.";
    public const LOGIN_ACCOUNT_INVALID = "Tài khoản hoặc mật khẩu không chính xác.";

    public const LOGOUT_SUCCESS_MESSAGE = "Đăng xuất thành công.";
    public const LOGOUT_FAIL_MESSAGE = "Đăng xuất thất bại.";

    public const OTP_INVALID = "Mã OTP không chính xác.";
    public const OTP_VALID = "Mã OTP chính xác.";
}