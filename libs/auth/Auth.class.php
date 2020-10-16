<?php

require_once './libs/functions/redirect.function.php';

/** Helper para manejar sesiones de PHP */
class Auth {

    private const TIMEOUT = 3600; // segundos

    private function __construct() {}

    public static function login(array $user): void {
        self::startSession();
        $_SESSION[ 'user' ] = $user;
        $_SESSION[ 'last_access' ] = time();
        redirect(ADMIN);
    }
    
    public static function logout(): void {
        self::startSession();
        session_destroy();
        redirect(HOME);
    }

    public static function checkLogin(): void {
        if (!self::isLoggedIn()) redirect(LOGIN, '?redirect=' . THIS_URL);
    }

    public static function isLoggedIn(): bool {
        self::startSession();
        return self::checkUser() && self::checkTimeout();
    }
    
    public static function getUsername(): string {
        self::checkLogin();
        return $_SESSION[ 'user' ][ 'username' ];
    }
    public static function getUserId(): int {
        self::checkLogin();
        return (int) $_SESSION[ 'user' ][ 'id' ];
    }

    public static function startSession(): void {
        if (session_status() == PHP_SESSION_NONE) { // pq saltan Notice si se inicia una sesión ya iniciada. 
            session_start();
        }
    }

    private static function checkUser(): bool {
        return isset($_SESSION[ 'user' ]);
    }

    private static function checkTimeout(): bool {
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