<x-app-layout>
    <x-hero></x-hero>
    <section class="text-gray-400 bg-gray-900">
        <div class="container px-5 py-24 mx-auto">
            <h2 class="title-font font-semibold text-white tracking-wider text-sm mb-3">CATEGORIES</h2>
            <nav class="mx-auto list-none mb-4">
                @forelse($tags as $tag)
                    <a style="margin-left: 12px"
                       class="hover:text-white uppercase {{$tag->slug === request()->get('tag') ? 'text-white' : '' }}"
                       href="{{route('listing.index',['tag'=>$tag->slug])}}">{{$tag->name}}</a>
                @empty
                    <h3>No tags found :</h3>
                @endforelse
            </nav>
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Job offers {{count($listings)}}</h1>
            <div class="flex flex-wrap -m-4">
                @forelse($listings as $listing)
                    <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                        <a class="block relative h-48 rounded overflow-hidden">
                            <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                                 src="{{asset(Storage::url($listing->logo))}}">
                        </a>
                        <div class="mt-4">
                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">{{$listing->company}}</h3>
                            <h2 class="text-white title-font text-lg font-medium">{{$listing->title}}</h2>
                            <p class="mt-1">{{$listing->user->name}}</p>
                            <p class="mt-1">
                                @foreach($listing->tags as $tag)
                                    <a href="{{route('listing.index',['tag'=>$tag->slug])}}"
                                       class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">
                                        {{$tag->slug}}
                                    </a>
                                @endforeach
                            </p>
                            <p class="mt-1">{{$listing->created_at->diffForHumans(   )}}</p>
                        </div>
                    </div>
                @empty
                    <p>No Job offers</p>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
