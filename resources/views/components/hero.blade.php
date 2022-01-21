<section class="text-gray-400 bg-gray-900 body-font">
    <div class="container mx-auto flex flex-col justify-center items-center">
        <div class="w-full md:w-2/3 flex flex-col items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Knausgaard typewriter readymade
                marfa</h1>
            <p class="mb-8 leading-relaxed">Kickstarter biodiesel roof party wayfarers cold-pressed. Palo santo
                live-edge tumeric scenester copper mug flexitarian. Prism vice offal plaid everyday carry. Gluten-free
                chia VHS squid listicle artisan.</p>
            <form method="get" action="{{route('listing.index')}}" class="flex w-full justify-center items-end">
                <div class="relative mr-4 lg:w-full xl:w-1/2 w-2/4 md:w-full text-left">
                    <label for="s" class="leading-7 text-sm text-gray-400">Placeholder</label>
                    <input type="text" id="s" name="s" value="{{request()->get('s')}}"
                           class="w-full bg-gray-800 rounded border bg-opacity-40 border-gray-700 focus:ring-2 focus:ring-green-900 focus:bg-transparent focus:border-green-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <button
                    class="inline-flex text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg">
                    Button
                </button>
            </form>
            <p class="text-sm text-gray-500  w-full">Neutra shabby chic ramps, viral fixie.</p>
        </div>
    </div>
</section>
