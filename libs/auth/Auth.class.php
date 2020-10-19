<?php

require_once './libs/functions/redirect.function.php';

/** Helper para manejar sesiones de PHP */
class Auth {

    private const TIMEOUT = 3600; // segundos

    private function __construct() {}

    /** Actions */

    public static function login(array $user): void {
        self::_startSession();
        $_SESSION[ 'user' ] = $user;
        $_SESSION[ 'last_access' ] = time();
        redirect(ADMIN);
    }
    
    public static function logout(): void {
        self::_startSession();
        session_destroy();
        redirect(BASE_URL);
    }

    // public static function destroy(): void {
    //     self::_startSession();
    //     session_destroy();
    // }

    /** Setters */

    public static function &set($name, $value) {
        self::_startSession();
        $_SESSION[ $name ] = $value;
        return $_SESSION[ $name ];
    }

    /** Getters */
    
    public static function &get($name) {
        self::_startSession();
        return $_SESSION[ $name ];
    }

    public static function getUsername(): string {
        self::checkLogin();
        return $_SESSION[ 'user' ][ 'username' ];
    }
    public static function getUserId(): int {
        self::checkLogin();
        return (int) $_SESSION[ 'user' ][ 'id' ];
    }

    /** Control */

    public static function checkLogin(): void {
        if (!self::isLoggedIn()) redirect(LOGIN, '?redirect=' . THIS_URL);
    }

    public static function isLoggedIn(): bool {
        self::_startSession();
        return self::_checkUser() && self::_checkTimeout();
    }

    /** Private */

    private static function _startSession(): void {
        if (session_status() == PHP_SESSION_NONE) { // pq saltan Notice si se inicia una sesión ya iniciada. 
            session_start();
        }
    }

    private static function _checkUser(): bool {
        return isset($_SESSION[ 'user' ]);
    }

    private static function _checkTimeout(): bool {
        if (time() - $_SESSION[ 'last_access']  > self::TIMEOUT) {
            session_destroy();
            return false;
        }
        else {
            $_SESSION[ 'last_access' ] = time();
            return true;
        }
    }
}