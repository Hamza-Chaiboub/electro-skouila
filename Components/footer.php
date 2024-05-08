<footer class="p-4 bg-gray-100 md:p-8 lg:p-10">
    <div class="mx-auto max-w-screen-xl text-center">
        <a href="#" class="flex justify-center items-center text-2xl font-semibold text-gray-900">
            <img src="/img/logo.png" alt="" class="w-16 h-16">
            Electro-Skouila
        </a>
        <p class="my-6 text-gray-500">Open-source library of over 400+ web components and interactive elements built for
            better web.</p>
        <ul class="flex flex-wrap justify-center items-center mb-6 text-gray-900">
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">Categories</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6 ">Contact</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">Featured Products</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">Affiliate Program</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">FAQs</a>
            </li>
        </ul>
        <span class="text-sm text-gray-500 sm:text-center">© 2024 <a href="#" class="hover:underline">Electro-Skouila</a>. All Rights Reserved.</span>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script>
    let mobile_menu = document.getElementById("mobile_menu");
    let bars = document.getElementById("bars");

    function my_function() {
        mobile_menu.classList.toggle("hidden");
    }

    function close_nav(e) {
        if (!bars.contains(e.target) && !mobile_menu.contains(e.target)) {
            mobile_menu.classList.add("hidden");
        }
    }

    document.onclick = close_nav;
</script>
</body>
</html>