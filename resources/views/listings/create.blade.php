<x-app-layout>
    <section class="text-gray-400 bg-gray-900 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-white">Create a job post</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Fill the form to create a job post 📝</p>
            </div>
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="uppercase text-red-600">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="flex flex-wrap -m-2" method="post" action="{{route('listings.store')}}"
                      enctype="multipart/form-data" id="payment_form">
                    @csrf
                    @guest()
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-400">Full Name</label>
                                <input type="text" id="name" name="name"
                                       class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-green-500 focus:bg-gray-900 focus:ring-2 focus:ring-green-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out "
                                       autofocus>
                            </div>
                        </div>

                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="email" class="leading-7 text-sm text-gray-400">Email</label>
                                <input type="email" id="email" name="email"
                                       class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-green-500 focus:bg-gray-900 focus:ring-2 focus:ring-green-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="password" class="leading-7 text-sm text-gray-400">Password</label>
                                <input type="password" id="password" name="password"
                                       class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-green-500 focus:bg-gray-900 focus:ring-2 focus:ring-green-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="password2" class="leading-7 text-sm text-gray-400">Confirm Password</label>
                                <input type="password" id="password2" name="password2"
                                       class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-green-500 focus:bg-gray-900 focus:ring-2 focus:ring-green-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                    @endguest
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="title" class="leading-7 text-sm text-gray-400">Job Title</label>
                            <input type="text" id="title" name="title"
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-green-500 focus:bg-gray-900 focus:ring-2 focus:ring-green-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="company" class="leading-7 text-sm text-gray-400">Company</label>
                            <input type="text" id="company" name="company"
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-green-500 focus:bg-gray-900 focus:ring-2 focus:ring-green-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="location" class="leading-7 text-sm text-gray-400">Location</label>
                            <input type="text" id="location" name="location"
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-green-500 focus:bg-gray-900 focus:ring-2 focus:ring-green-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2  w-full">
                        <div class="relative">
                            <label for="logo" class="leading-7 text-sm text-gray-400">Logo</label>
                            <input type="file" id="logo" name="logo" accept="image/jpeg,image/png,image/jpg"
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-green-500 focus:bg-gray-900 focus:ring-2 focus:ring-green-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="apply_link" class="leading-7 text-sm text-gray-400">Apply link</label>
                            <input type="url" id="apply_link" name="apply_link"
                                   class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-green-500 focus:bg-gray-900 focus:ring-2 focus:ring-green-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="content" class="leading-7 text-sm text-gray-400">Content</label>
                            <textarea id="content" name="content"
                                      class="w-full bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-green-500 focus:bg-gray-900 focus:ring-2 focus:ring-green-900 h-32 text-base outline-none text-gray-100 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="is_highlighted"
                                   class="inline-flex items-center text-sm text-gray-500">
                                <input
                                    type="checkbox"
                                    id="is_highlighted"
                                    name="is_highlighted"
                                    class=" border text-gray-900 text-sm rounded-lg
                                    bg-gray-700 border-gray-600
                                    placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                <span class="ml-2">Highlight this post (extra $19)</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <div id="card-element"></div>
                        </div>
                    </div>
                    <input
                        type="hidden"
                        id="payment_method_id"
                        name="payment_method_id"
                        value="">
                    <div class="p-2 w-full">
                        <button type="submit" id="submit_btn"
                                class="uppercase flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                            Pay + Continue
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            classes: {
                base: 'StripeElement  bg-gray-800 bg-opacity-40 rounded border border-gray-700 focus:border-green-500 focus:bg-gray-900 focus:ring-2 focus:ring-green-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out'
            }
        });

        cardElement.mount('#card-element');
        document.getElementById('submit_btn').addEventListener('click', async (e) => {
            e.preventDefault();
            const {paymentMethod, error} = await stripe.createPaymentMethod(
                'card', cardElement, {}
            );

            if (error) {
                alert(error.message);
            } else {
                // card is ok, create payment method id and submit form
                document.getElementById('payment_method_id').value = paymentMethod.id;
                document.getElementById('payment_form').submit();
            }


        });
    </script>
</x-app-layout>
