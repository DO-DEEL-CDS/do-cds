<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

function generate_slug($title, Model $model, $suffix = '', $column = 'slug')
{
    $slug = \Str::slug($title) . $suffix;

    if (!is_null($model::where($column, $slug)->first())) {
        return call_user_func('generate_slug', $slug, $model, rand(100, 200));
    }

    return $slug;
}

function gravatar($email, $size = 30): string
{
    $gravatarURL = gravatarUrl($email, $size);

    return '<img id = ' . $email . $size . ' class="gravatar" src="' . $gravatarURL . '" width="' . $size . '">';
}

function gravatarUrl($email, $size): string
{
    $email = md5(strtolower(trim($email)));
    //$gravatarURL = "https://www.gravatar.com/avatar/" . $email."?s=".$size."&d=mm";
    $defaultImage = urlencode('https://raw.githubusercontent.com/BadChoice/handesk/master/public/images/default-avatar.png');

    return 'https://www.gravatar.com/avatar/' . $email . '?s=' . $size . "&default={$defaultImage}";
}


function toPercentage($value, $inverse = false)
{
    return ($inverse ? 1 - $value : $value) * 100;
}

if (!function_exists('unique_api_token')) {
    /**
     * Generate unique API token
     * @return mixed|string
     * @throws Exception
     */
    function unique_api_token()
    {
        $token = Uuid::uuid1()->toString();
        if (!is_null(User::whereApiToken($token)->first())) {
            return call_user_func(unique_api_token());
        }

        return $token;
    }
}

if (!function_exists('generate_code')) {
    /**
     * Generate unique code
     * @param  string  $prefix
     * @param  Model  $model
     * @return mixed|string
     * @throws Exception
     */
    function generate_code(Model $model, $prefix = '', $column = 'code')
    {
        $prefix = strtoupper($prefix);
        $code = $prefix . random_int(1000000000, 9999999999);
        if (!is_null($model::where($column, $code)->first())) {
            return generate_code($model, $prefix, $column);
        }

        return $code;
    }
}

if (!function_exists('friendly_number_format')) {
    /**
     * Display a human friendly number format
     * @param $number
     * @return string
     */
    function friendly_number_format($number): string
    {
        $number = ($number instanceof Countable) ? count($number) : $number;
        if ($number > 1000) {
            $x = round($number);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = ['K', 'M', 'B', 'T'];
            $x_count_parts = count($x_array) - 1;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;
        }
        return $number;
    }
}

if (!function_exists('generate_otp')) {
    /**
     * Generate random 4 digit OTP
     * @param $model
     * @param  string  $column
     * @return string
     * @throws Exception
     */
    function generate_otp($model, string $column = 'verify_token'): string
    {
        $otp = random_int(1000, 9999);
        if (!is_null($model::where($column, $otp)->first())) {
            return generate_otp($model, $column);
        }

        return $otp;
    }
}

if (!function_exists('calc_progress')) {
    /**
     * prepare data for progress bar
     * @param $actualValue
     * @param  $maxValue
     * @return array
     */
    function calc_progress($actualValue, $maxValue): array
    {
        $maxValue = $maxValue === 0 ? 1 : $maxValue;
        return [
                'value' => $actualValue,
                'percentage' => round(($actualValue / $maxValue) * 100)
        ];
    }
}

if (!function_exists('unique_rand_user_email')) {
    /**
     * Generate unique random email
     * @return string
     */
    function unique_rand_user_email(): string
    {
        return 'u' . time() . '@' . preg_replace("/(http(|s)):\/\//", '', config('app.url'));
    }
}

if (!function_exists('delete_file')) {
    /**
     * Delete file from storage
     * @param $url
     */
    function delete_file($url)
    {
        if (Str::contains($url, 'storage')) {
            Storage::delete(explode('storage', $url)[1]);
        }
    }
}
