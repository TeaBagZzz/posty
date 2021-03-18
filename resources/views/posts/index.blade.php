@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="flex-4 px-5">
            <div class="w-8/5 bg-white p-6 rounded-lg">
                @auth
                    <form action="{{ route('posts') }}" method="post" class="mb-4">
                        @csrf
                        <div class="mb-4">
                            <label for="body" class="sr-only">Body</label>
                            <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100
                                border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                                placeholder="Post anything?!..."></textarea>
                            @error('body')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded 
                                font-medium">Post</button>
                        </div>
                    </form>
                @endauth
                    @if ($posts->count())
                        @foreach ($posts as $post)
                            <x-post :post="$post" />
                        @endforeach

                        {{ $posts->links() }}<!--displays paging links due to tailwind, saves us alot of time wow! Also customizable-->
                    @else
                        <p>There are no posts.</p>
                    @endif
            </div>
        </div>
        <div class="flex-2 px-5">
            <div class="bg-white p-1 rounded-lg">
                <h3 class="font-bold text-xl mb-4">Friends</h3>
                <ul>
                    <!--@foreach (range(1, 8) as $index)-->
                        <li class="mb-4"><div class="flex items-center text-sm"><img src="/images/friend1.png" alt="" class="rounded-full mr-2">Lord Thanos</div></li>
                    <!--@endforeach-->
                </ul>
            </div>
        </div>
        
    </div>
@endsection