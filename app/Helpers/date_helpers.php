<?php

if (!function_exists('monthToRoman')) {
    function monthToRoman($monthNumber) {
        $romanMonths = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
            5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
            9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        return $romanMonths[$monthNumber] ?? '';
    }
}

if (!function_exists('formatDateIndonesian')) {
    function formatDateIndonesian($date) {
        $englishDayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $indonesianDayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $englishMonthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $indonesianMonthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $day = date('l', strtotime($date));
        $month = date('F', strtotime($date));

        $dayIndex = array_search($day, $englishDayNames);
        $monthIndex = array_search($month, $englishMonthNames);

        $indonesianDay = $dayIndex !== false ? $indonesianDayNames[$dayIndex] : 'Unknown';
        $indonesianMonth = $monthIndex !== false ? $indonesianMonthNames[$monthIndex] : 'Unknown';

        return date('j', strtotime($date)) . ' ' . $indonesianMonth . ' ' . date('Y', strtotime($date));
    }
}
