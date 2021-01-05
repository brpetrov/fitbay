<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Workouts') }}
        </h2>
    </x-slot>
<div class="p-5 text-right">
    <a href="{{URL::to('/workouts/create')}}" class="bg-blue-500 p-3 text-white">New Workout</a>
</div>
    <div class="py-6 lg:grid lg:grid-cols-3 gap-8">

        @foreach ($workouts as $workout)

            <div class="workout-card transition duration-300">
                <a href="{{URL::to('/workouts/'.$workout->id)}}">
                    @if ($workout->image_url)
                    <img src="{{asset('images')}}/{{$workout->image_url}}" class="w-full max-h-60 object-cover" alt="IMAGE">
                    @else
                    <img src="https://picsum.photos/500/250" class="w-full max-h-60 object-cover">
                    @endif
                <div class="p-6">
                    <h3 class="my-5 text-center text-2xl text-blue-500">{{$workout->name}}</h3>
                    <div>{!! Str::limit($workout->body, 400, '...') !!}</div>
                </div>

                </a>
            </div>



        @endforeach
        </div>


</x-app-layout>
