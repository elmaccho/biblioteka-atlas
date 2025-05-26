@extends('layouts.admin.app')
@vite(['resources/css/home-page.css', 'resources/css/reports.css'])
@section('panel_content')
    <div class="main-container">
        <h1>Raporty i Statystyki</h1>

        <div class="charts-wrapper">
            <div class="rents-wrapper mt-5">
                <div class="chart-box mb-5">
                    <h3>Wypożyczenia dzienne</h3>
                    <div id="dailyRentalsChart"></div>
                </div>

                <div class="chart-box mb-5">
                    <h3>Wypożyczenia tygodniowe</h3>
                    <div id="weeklyRentalsChart"></div>
                </div>

                <div class="chart-box mb-5">
                    <h3>Wypożyczenia miesięczne</h3>
                    <div id="monthlyRentalsChart"></div>
                </div>
            </div>

            <div class="circle-charts-wrapper mt-5">
                <div class="chart-box mb-5">
                    <h3>Top książki</h3>
                    <div id="topBooksChart"></div>
                </div>

                <div class="chart-box mb-5">
                    <h3>Statystyki rezerwacji</h3>
                    <div id="reservationStatsChart"></div>
                </div>

                <div class="chart-box mb-5">
                    <h3>Top kategorie książek</h3>
                    <div id="topCategoriesChart"></div>
                </div>

                <div class="chart-box mb-5">
                    <h3>Top użytkownicy</h3>
                    <div id="topUsersChart"></div>
                </div>
            </div>
        </div>

        <script>
            // Daily rentals
            var dailyChart = new ApexCharts(document.querySelector("#dailyRentalsChart"), {
                chart: { type: 'bar' },
                series: [{
                    name: 'Liczba wypożyczeń (dni)',
                    data: @json($dailyRentals->pluck('count'))
                }],
                xaxis: {
                    categories: @json($dailyRentals->pluck('date'))
                },
                responsive: [{
                    breakpoint: 768,
                    options: {
                        chart: {
                            width: "100%",
                            height: 250
                        },
                        legend: {
                            position: "bottom"
                        }
                    }
                }]

            });
            dailyChart.render();

            // Weekly rentals
            var weeklyChart = new ApexCharts(document.querySelector("#weeklyRentalsChart"), {
                chart: { type: 'bar' },
                series: [{
                    name: 'Liczba wypożyczeń (tygodnie)',
                    data: @json($weeklyRentals->pluck('count'))
                }],
                xaxis: {
                    categories: @json($weeklyRentals->map(function ($w) {
                        return "Tydz. {$w->week}, {$w->year}";
                    }))
                },
                responsive: [{
                    breakpoint: 768,
                    options: {
                        chart: {
                            width: "100%",
                            height: 250
                        },
                        legend: {
                            position: "bottom"
                        }
                    }
                }]

            });
            weeklyChart.render();

            // Monthly rentals
            var monthlyChart = new ApexCharts(document.querySelector("#monthlyRentalsChart"), {
                chart: { type: 'bar' },
                series: [{
                    name: 'Liczba wypożyczeń (miesiące)',
                    data: @json($monthlyRentals->pluck('count'))
                }],
                xaxis: {
                    categories: @json($monthlyRentals->map(function ($m) {
                        return "{$m->month}/{$m->year}";
                    }))
                },
                responsive: [{
                    breakpoint: 768,
                    options: {
                        chart: {
                            width: "100%",
                            height: 250
                        },
                        legend: {
                            position: "bottom"
                        }
                    }
                }]

            });
            monthlyChart.render();

            // Top books
            var topBooksChart = new ApexCharts(document.querySelector("#topBooksChart"), {
                chart: { type: 'donut' },
                series: @json($topBooks->pluck('count')),
                labels: @json($topBooks->map(function ($tb) {
                    return $tb->ksiazka->tytul;
                }))
            });
            topBooksChart.render();

            // Reservation stats
            var reservationStatsChart = new ApexCharts(document.querySelector("#reservationStatsChart"), {
                chart: { type: 'pie' },
                series: [{{ $reservationStats['active'] }}, {{ $reservationStats['cancelled'] }}, {{ $reservationStats['realized'] }}],
                labels: ['Aktywne', 'Anulowane', 'Zrealizowane']
            });
            reservationStatsChart.render();

            var topUsersChart = new ApexCharts(document.querySelector("#topUsersChart"), {
                chart: { type: 'bar' },
                series: [{
                    name: 'Wypożyczenia',
                    data: @json($topUsers->pluck('count'))
                }],
                xaxis: {
                    categories: @json($topUsers->map(function ($u) {
                        return $u->user->name; // albo $u->user->email
                    }))
                }
            });
            topUsersChart.render();

            var topCategoriesChart = new ApexCharts(document.querySelector("#topCategoriesChart"), {
                chart: { type: 'donut' },
                series: @json($topCategories->pluck('count')),
                labels: @json($topCategories->pluck('nazwa'))
            });
            topCategoriesChart.render();
        </script>

        <style>
            .chart {
                max-width: 600px;
                margin: 20px auto;
            }
        </style>
    </div>
@endsection