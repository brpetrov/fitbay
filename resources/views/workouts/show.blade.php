<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$workout->name}}
        </h2>
    </x-slot>
    <div class="py-12 lg:w-3/4 w-full mx-auto">
        <div class="text-center">
            @if (auth()->id()===$workout->user_id)
            @endif
        </div>

        <div class="">
            <img src="{{asset('images')}}/{{$workout->image_url}}"  class="border w-full max-h-96 object-cover rounded-t-lg" alt="IMAGE">
        </div>
        <form action="{{$workout->path()}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card ">
                <label for="name">Edit Image:</label>
                <input type="file" class="site-input" name="image_url" value="{{$workout->image_url}}" >
                <button class="btn-blue my-3 p-2" type="submit">Submit</button>
            </div>
        <div class="lg:flex lg:space-x-4">
            <div class="card flex-1">
                <label for="name">Edit Name:</label>
                <input type="text" class="site-input" name="name" value="{{$workout->name}}" >
            </div>
            <div class="card flex-1">
                <label for="name">Edit Level: <span class="text-blue-400 text-xl">{{$workout->level}}</span> </label>
                <select name="level" id="level" class="w-full">
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>

        </div>

            <div class="card">
                <label for="body">Edit Description:</label>
                <textarea name="body" class="resize-none">{!!$workout->body!!}</textarea>
                <button class="btn-blue my-3 p-2" type="submit">Submit</button>
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
            <div>

                <div class="card">
                    <div class="grid grid-cols-4 gap-2">
                        @foreach ($workout->days as $day)
                        <div>
                            <form action="{{$day->path()}}" method="POST">
                                @method('PATCH')
                                @csrf
                                <input class="site-input" type="text" value="{{$day->name}}" name="name">
                            </form>
                            <form method="POST" action="{{$day->path()}}">
                                @method('DELETE')
                                @csrf
                                <div class="flex">
                                    <button type="button" class="btn-blue btn-small py-1 flex-1" onclick="location.href='{{URL::to($day->path())}}'" value="Redirect">View</button>
                                    <button type="submit" class="delete-button btn-small flex-1">Delete</button>
                                </div>

                            </form>
                        </div>
                    @endforeach
                </div>
                    <div class="mt-5">
                        <form action="{{$workout->path().'/days'}}" method="POST">
                            @csrf
                            <label for="name">Add New Day</label>
                            <input type="text" class="site-input" name="name" placeholder="Monday">
                        </form>
                    </div>



                </div>


                    <div class="text-center">
                        <form method="POST" action="{{$workout->path()}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="delete-button btn-lg my-3">Delete Workout</button>
                        </form>
                    </div>


                </div>
        </div>

        </div>


</x-app-layout>
