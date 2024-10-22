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

    if (!function_exists('getIndonesianDay')) {
        function getIndonesianDay($date) {
            $englishDayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            $indonesianDayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            $day = date('l', strtotime($date));
            $dayIndex = array_search($day, $englishDayNames);

            return $dayIndex !== false ? $indonesianDayNames[$dayIndex] : 'Unknown';
        }
    }

    if (!function_exists('getIndonesianMonth')) {
        function getIndonesianMonth($date) {
            $englishMonthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            $indonesianMonthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            $month = date('F', strtotime($date));
            $monthIndex = array_search($month, $englishMonthNames);

            return $monthIndex !== false ? $indonesianMonthNames[$monthIndex] : 'Unknown';
        }
    }

    if (!function_exists('getDateInText')) {
        function getDateInText($date) {
            // Mengonversi tanggal ke angka
            $onlyDate = date('j', strtotime($date));

            // Mengonversi angka ke teks
            $textNumbers = [
                1 => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat',
                5 => 'Lima', 6 => 'Enam', 7 => 'Tujuh', 8 => 'Delapan',
                9 => 'Sembilan', 10 => 'Sepuluh', 11 => 'Sebelas',
                12 => 'Dua Belas', 13 => 'Tiga Belas', 14 => 'Empat Belas',
                15 => 'Lima Belas', 16 => 'Enam Belas', 17 => 'Tujuh Belas',
                18 => 'Delapan Belas', 19 => 'Sembilan Belas', 20 => 'Dua Puluh',
                21 => 'Dua Puluh Satu',  22 => 'Dua Puluh Dua',  23 => 'Dua Puluh Tiga',
                24 => 'Dua Puluh Empat', 25 => 'Dua Puluh Lima', 26 => 'Dua Puluh Enam',
                27 => 'Dua Puluh Tujuh', 28 => 'Dua Puluh Delapan', 29 => 'Dua Puluh Sembilan',
                30 => 'Tiga Puluh', 31 => 'Tiga Puluh Satu',
                // Tambahkan lebih banyak angka jika perlu
            ];

            return $textNumbers[$onlyDate] ?? (string)$onlyDate; // Mengembalikan teks atau angka itu sendiri
        }
    }




}


