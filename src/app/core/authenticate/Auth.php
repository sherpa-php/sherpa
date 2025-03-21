<?php

namespace Sherpa\Sherpa\app\core\authenticate;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\security\Hash;
use Sherpa\Core\sessions\Session;
use Sherpa\Sherpa\models\User;

/**
 * Authenticate main class.
 * <p>
 *     Manage all authentication processes:
 *     attempt to log in, retrieve user's id or object,
 *     etc.
 * </p>
 */
class Auth
{
    public const string SESSION_KEY = "sherpaf_session_user_id";

    /**
     * @return bool If the current session
     *              is logged to a user's account
     */
    public static function check(): bool
    {
        $storedUserId = self::id();

        if ($storedUserId === null)
        {
            return false;
        }

        return Session::query()
                      ->where("user_id", $storedUserId)
                      ->count();
    }

    /**
     * @return int|null User's account's id if logged;
     *                  else, NULL
     */
    public static function id(): ?int
    {
        return Sherpa::session(self::SESSION_KEY);
    }

    /**
     * @return User|null User's account if logged;
     *                   else, NULL
     */
    public static function user(): ?User
    {
        return Auth::check()
            ? User::query()->find(Auth::id())
            : null;
    }

    /**
     * Attempt to log in to an account,
     * using the provided credentials.
     *
     * @param string $cred
     * @param string $password
     * @param string $credColumn
     * @param string $passwordColumn
     * @return bool If the attempt is successful
     */
    public static function attempt(
        string $cred,
        string $password,
        string $credColumn = "name",
        string $passwordColumn = "password"): bool
    {
        $account = User::query()
                       ->where($credColumn, $cred)
                       ->first();

        if ($account === null)
        {
            return false;
        }

        if (Hash::verify($password, $account->$passwordColumn))
        {
            $_SESSION[self::SESSION_KEY] = $account->id;

            $session = Session::createOrRetrieve();
            $session->user_id = $account->id;
            $session->update();

            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Log out from session's account.
     */
    public static function logout(): void
    {
        unset($_SESSION[self::SESSION_KEY]);

        $session = Session::createOrRetrieve();
        $session->user_id = null;
        $session->update();
    }
}