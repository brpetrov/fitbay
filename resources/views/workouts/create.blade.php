<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Workout') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="/workouts" method="POST" enctype="multipart/form-data" >
                @csrf
                <div>
                    <label for="name">Name</label>
                    <input class="w-full border-gray-300" type="text" name="name" placeholder="Workout name" value="{{old('name')}}">
                </div>

                <label for="body">Description</label>
                <textarea  type="text" name="body" placeholder="Workout Description"> {{ old('body') }} </textarea>

                <div>
                    <label>Level</label>
                    <select name="level" id="level" class="w-full">
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>
                <input type="file" name="image_url">
                <button class="p-2 bg-blue-500 text-white">Create</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-300">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        </div>
</x-app-layout>
