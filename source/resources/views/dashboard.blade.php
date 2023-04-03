<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <x-danger-button class="ml-3" onclick="document.location.href = '/ads/new'">
                        {{ __('New Ad') }}
                    </x-danger-button>

                </div>
            </div>
        </div>

        <?php 
            $text = DB::table('ads')->select('id','ad')
                    ->where('user_id', '=', auth()->user()->id)   
                    ->get();
        ?>

        {{--
            {{dump(auth()->user()->id)}}
        --}}

        @foreach ($text as $t)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div>{{$t->ad}}

                            <x-danger-button class="text-sm text-gray-600 dark:text-gray-400" onclick="document.location.href = '/ads/{{$t->id}}'">
                            {{ __('Edit') }}
                            </x-danger-button>

                            <x-danger-button class="text-sm text-gray-600 dark:text-gray-400 delete" onclick="document.location.href = '/ads/delete/{{$t->id}}'">
                            {{ __('Delete') }}
                            </x-danger-button>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach



        <script>

            let path = null;
            let button = document.getElementsByClassName('btn-checkout')[0];
            let param = document.location.pathname.split('/').splice(-1)[0];

            param === 'new' ? path = "/ads/new" : path = "/ads/update";
            console.log(param,path);

            button.addEventListener('click',function(){
                let text = document.getElementsByClassName('ad')[0].value;
                $.ajax({
                    type: "POST",
                    url: path,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: param,
                        data: text,
                    },
                    success: function(msg) {
                        console.log(msg);
                        document.location = '/dashboard';
                    },
			    });
            });

        </script>


        {{--
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>

                            <x-input-label for="current_password" :value="__('Text Ad')" />
                            <x-text-input id="current_password" name="current_password" type="text" class="mt-1 block w-full" autocomplete="current-password" />
                            {{--
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            --}}


                        </div>
                        
                        {{--
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}</p>
                            @endif
                            
                            <x-danger-button class="ml-3">
                                {{ __('Delete') }}
                            </x-danger-button>

                        </div>



                    </form>


                </div>
            </div>
        </div>
        --}}

    </div>


</x-app-layout>
