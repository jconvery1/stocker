<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="/css/app.css">
    <title>Laravel</title>
</head>

<body>
    <div id="app">
        <div class="container mx-auto">
            <header class="py-6">
                <h1 class="text-3xl font-bold">Stock Management System</h1>
            </header>
            <main class="flex">
                <aside class="w-1/5">
                    <div class="mb-10">
                        <ul>
                            <li><router-link to="/">Dashboard</router-link></li>
                            <li><router-link to="/stock">Stock</router-link></li>
                            <li><router-link to="/orders">Orders</router-link></li>
                            <li><router-link to="/sales">Sales</router-link></li>
                            <li><router-link to="/deliveries">Deliveries</router-link></li>
                        </ul>
                    </div>
                </aside>
                <div class="primary flex-1">
                    <router-view></router-view>
                </div>
            </main>
        </div>
        <hr>
    </div>
    <script src="/js/app.js"></script>
</body>

</html>