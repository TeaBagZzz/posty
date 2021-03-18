@props(['post' => $post])

<div>
    <!-- Order your soul. Reduce your wants. - Augustine -->
    <div class="mb-4">
        <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name  }}</a> 
        <span class="text-grey-600 text-sm">{{ $post->created_at->diffForHumans() }}</span> <!--the date can be manipulated using the
                                                                            Carbon library(Illuminate\Support\Carbon), 
                                                                            please resaerch further-->
        <p class="mb-2">{{ $post->body }}</p>

        @can('delete', $post)                            
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Delete</button>
                </form>
        @endcan

        <div class="flex items-center">
            @auth
                @if (!$post->likedBy(auth()->user())) 
                    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                        @csrf
                        <button type="submit" class="text-blue-500">Like</button>
                    </form>
                @else
                    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                        @csrf
                        @method('DELETE')<!--Method spoofing-->
                        <button type="submit" class="text-blue-500">UnLike</button>
                    </form>
                @endif
                
                
                
            @endauth
            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
        </div>
        
    </div>
</div>