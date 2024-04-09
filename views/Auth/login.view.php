<?php
include root_path('Components/navbar.php');
?>

<section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center md:h-screen mx-auto lg:py-0">
        <h1 class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            Electro-Skouila
        </h1>
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Sign in to your account
                </h1>
                <form class="space-y-4 md:space-y-6" action="/login" method="POST">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="name@company.com">
                    </div>
                    <div class="text-red-500"><?= Errors::get('email') ?></div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                    </div>
                    <div class="text-red-500"><?= Errors::get('email') ?></div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-gray-500">Remember me</label>
                            </div>
                        </div>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:underline">Forgot password?</a>
                    </div>
                    <button type="submit" name="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Sign in</button>
                    <p class="text-sm font-light text-gray-500">
                        Don’t have an account yet? <a href="/register" class="font-medium text-blue-600 hover:underline">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include(root_path('Components/footer.php')) ?>