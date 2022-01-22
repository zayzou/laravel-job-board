<x-app-layout>
    <section class="text-gray-400 bg-gray-900 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <img alt="ecommerce" class=" h-64 object-cover object-center rounded"
                     src="{{asset(Storage::url($listing->logo))}}">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">{{strtoupper($listing->title)}}</h2>
                    <h1 class="text-white text-3xl title-font font-medium mb-1">{{$listing->company}}</h1>
                    <div class="flex mb-4">
          <span class="flex items-center">
           {{$listing->created_at->diffForHumans()}}
            <span class="ml-3">4 Reviews</span>
          </span>
                        <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-800 text-gray-500 space-x-2">
          {{$listing->user->name}}
          </span>
                    </div>
                    <p class="leading-relaxed">{!! $listing->content !!}</p>
                    <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-800 mb-5">
                        <div class="flex">
                            <span class="mr-3">
                                 <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      class="w-5 h-5" viewBox="0 0 24 24">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                </svg>
                                {{$listing->location}}
                            </span>
                        </div>
                    </div>
                    @foreach($listing->tags as $tag)
                        <a href="{{route('listing.index',['tag'=>$tag->slug])}}"
                           class="bg-gray-500 text-gray-300 text-sm font-medium mr-2 px-2.5 py-0.5 rounded hover:bg-gray-700 hover:text-gray-500">{{$tag->slug}}
                        </a>
                    @endforeach
                    <div class="flex">

                        <a href="{{route('listings.apply',$listing->slug)}}"
                           class="flex ml-auto text-white bg-green-500 uppercase border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded">
                            Apply now
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
