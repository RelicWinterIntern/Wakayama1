<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿一覧') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto bg-blue- text-slate-900 0mt-10 px-4 sm:px-6 lg:px-8 ">
        <div class="my-4">
            <a href="{{ route('post.create') }}" class="inline-block py-2 px-4 btn btn-primary text-decoration-none">
                {{ __('投稿する') }}
            </a>

            <a href="{{ route('myposts') }}" class="inline-block ml-4 py-2 px-4 btn btn-secondary text-decoration-none">
                {{ __('自分の投稿を確認する') }}
            </a>
        </div>

        <div class="my-4">
            
            @if (!empty($survey))
                <ul>
                        <li class="mb-6  rounded-lg p-4 bg-gradient-to-r from-green-200  to-purple-200">
                            <h3 class="text-lg font-bold mb-2 border-white border-bottom">お題：{{ $survey[1] }}</h3>
                            
                            <div class="flex justify-between mt-8 ">
                            </div>
                            <div class="bg-gradient-to-r  from-green-200  to-purple-200">
                            <div class="flex justify-center  bg-gradient-to-r from-green-200  to-purple-200 text-3xl">
                                @if ($vote->vote_status == 1)

                                    <p class="text-gray-500 text-base pt-2 hover:text-blue-500">
                                    
                                        {{ $survey[3] }}より
                                    
                                    </p>
                                    <p class="text-green-500 hover:text-blue-500">
                                   
                                    <p class="text-purple-500 hover:text-blue-500 pl-3 ">
                                    
                                        {{ $survey[2] }}
                                    
                                    </p>
                                @elseif ($vote->vote_status == 2)
                                    <p class="text-gray-500 text-base pt-2 hover:text-blue-500">
                                    
                                        {{ $survey[2] }}より
                                    
                                    </p>

                                     <p class="text-purple-500 hover:text-blue-500 pl-3">
                                    
                                        {{ $survey[3] }}
                                    
                                    </p>
                                @endif
                                
                            
                                
                                
                            </div>
                            
                            {{-- <div class="bg-white  border-2"> --}}
                                {{-- <p class=" mt-3 pl-5">コメント：{{ $survey->body }}</p> --}}
                            {{-- </div> --}}
                        </div>
                        </li>
                    
                </ul>
            @else
                <div class="flex justify-center items-center h-full">
                    <p class="text-lg text-gray-600">投票できる投稿はありません。</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
