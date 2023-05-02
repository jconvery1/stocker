<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css">
    <title>Laravel</title>
</head>

<body>
    <div id="app">
        <main class="flex h-screen">
            <div class="w-full">
                <div class="flex min-h-full items-center justify-center px-4 pb-12 sm:px-6 lg:px-8">
                    <div class="w-full max-w-md space-y-8">
                        <div>
                            <svg aria-hidden="true" class="mx-auto h-20 w-auto text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="black" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <form class="mt-8 space-y-6" action="{{route('sign-in')}}" method="POST">
                            @csrf
                            @if(Session::has('success'))
                            <span class="flex items-center justify-center" style="color: red">{{Session::get('success')}}</span>
                            @else
                            <span class="flex items-center justify-center" style="color: red">{{Session::get('fail')}}</span>
                            @endif
                            <input type="hidden" name="remember" value="true">
                            <div class="-space-y-px rounded-md shadow-sm">
                                <div>
                                    <label for="username" class="sr-only">Username</label>
                                    <input id="username" name="username" type="text" autocomplete="username" required class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Username">
                                </div>
                                <div>
                                    <label for="password" class="sr-only">Password</label>
                                    <input id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Password">
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="group relative flex w-full justify-center rounded-md bg-blue-700 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    Sign in
                                </button>
                            </div>

                            <div class="flex items-center justify-center">
                                <div class="text-sm">
                                    <a href="create-account" class="font-medium text-blue-700 hover:text-blue-800">I don't have an account</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <hr>
    </div>
    <script src="/js/app.js"></script>
</body>

</html>