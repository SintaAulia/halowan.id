<?php

if (!function_exists('tanggal')) {
    function tanggal($datetime, bool $withTime = false): string
    {
        if (!$datetime) return '';
        static $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                         'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $t = is_numeric($datetime) ? (int)$datetime : strtotime((string)$datetime);
        $s = date('j', $t) . ' ' . $bulan[(int) date('n', $t)] . ' ' . date('Y', $t);
        return $withTime ? $s . ', ' . date('H:i', $t) . ' WITA' : $s;
    }
}

if (!function_exists('avatar')) {
    function avatar($user, string $class = ''): string
    {
        $u = is_array($user) ? (object)$user : $user;
        $name = $u->name ?? $u->nama ?? 'User';
        $avatar = $u->avatar ?? null;

        if ($avatar) {
            $src = asset('uploads/' . $avatar);
            return '<img class="avatar ' . e($class) . '" src="' . e($src) . '" alt="' . e($name) . '">';
        }

        $inisial = mb_strtoupper(mb_substr(trim($name), 0, 1, 'UTF-8'), 'UTF-8');
        return '<span class="avatar ' . e($class) . '">' . e($inisial ?: '?') . '</span>';
    }
}

if (!function_exists('media_url')) {
    function media_url(?string $filename): string
    {
        return $filename ? asset('uploads/' . $filename) : '';
    }
}

if (!function_exists('media')) {
    function media(?string $filename): string
    {
        return media_url($filename);
    }
}

if (!function_exists('nl')) {
    function nl(?string $text): string
    {
        return nl2br(e((string)$text));
    }
}

if (!function_exists('nav_active')) {
    function nav_active(string $path): string
    {
        $cur = '/' . trim(request()->path(), '/');
        $path = '/' . trim($path, '/');

        if ($path === '/') {
            $on = $cur === '/';
        } elseif ($path === '/tentang' || $path === '/about') {
            $on = in_array($cur, ['/tentang', '/about']) || str_starts_with($cur, '/tentang/') || str_starts_with($cur, '/about/');
        } elseif ($path === '/galeri' || $path === '/gallery') {
            $on = in_array($cur, ['/galeri', '/gallery']) || str_starts_with($cur, '/galeri/') || str_starts_with($cur, '/gallery/');
        } elseif ($path === '/donation' || $path === '/donasi') {
            $on = in_array($cur, ['/donation', '/donasi']) || str_starts_with($cur, '/donation/') || str_starts_with($cur, '/donasi/');
        } else {
            $on = $cur === $path || str_starts_with($cur, $path . '/');
        }

        return $on ? 'is-active' : '';
    }
}
