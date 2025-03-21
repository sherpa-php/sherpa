<?php

namespace Sherpa\Sherpa\app\core\authenticate;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\sessions\Session;
use Sherpa\Sherpa\models\User;

class Auth
{
    public const string SESSION_KEY = "sherpaf_session_user_id";

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

    public static function id(): ?int
    {
        return Sherpa::session(self::SESSION_KEY);
    }

    public static function user(): ?User
    {
        return Auth::check()
            ? User::query()->find(Auth::id())
            : null;
    }

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

        return Hash::verify($password, $account->$credColumn);
    }
}