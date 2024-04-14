<?php
include root_path('Components/navbar.php');
?>

<section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            Electro-Skouila
        </a>
        <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0   ">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl  ">
                    Create an account
                </h1>
                <form class="space-y-4 md:space-y-6" action="/register" method="POST">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                        <input type="text" name="email" value="<?= Validator::old("email") ?>" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="name@company.com">
                        <div class="text-red-500"><?= Errors::get('email') ?></div>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                        <div class="text-red-500"><?= Errors::get('password') ?></div>
                    </div>
                    <div>
                        <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Confirm password</label>
                        <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                        <div class="text-red-500"><?= Errors::get('confirm-password') ?></div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" name="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-light text-gray-500  ">I accept the <a class="font-medium text-blue-600 hover:underline  " href="#">Terms and Conditions</a></label>
                        </div>
                    </div>
                    <div class="text-red-500"><?= Errors::get('terms') ?></div>
                    <button type="submit" name="register" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center    ">Create an account</button>
                    <p class="text-sm font-light text-gray-500  ">
                        Already have an account? <a href="/login" class="font-medium text-blue-600 hover:underline">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
include(root_path('Components/footer.php'));
?>