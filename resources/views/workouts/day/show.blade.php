<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{$workout->name}} / {{$day->name}}
        </h2>
    </x-slot>

    <div class="my-16 bg-white overflow-hidden shadow-sm p-6">
        <h1 class="text-center text-2xl mb-3">Add new Excercise</h1>
        <form action="{{$day->path().'/excercises'}}" method="POST" class="">
            @csrf
            <div class="lg:grid grid-cols-2 lg:grid-cols-5 gap-4 items-center">
                <div>
                    <input type="text" name="name" class="site-input" placeholder="Name of Excercise">
                </div>
                <div>
                    <input type="text" name="weight" class="site-input" placeholder="Weight (in kg)">
                </div>

                <div>
                    <input type="text" name="sets" class="site-input" placeholder="Sets">
                </div>

                <div>
                    <input type="text" name="reps" class="site-input" placeholder="Reps">
                </div>
                <div class="text-center">
                    <button class="btn-blue w-1/3 h-full p-2">Submit</button>
                </div>
            </div>
        </form>


    </div>

        @foreach ($day->excercises as $excercise)
        <div class="py-5">
        <div class="lg:grid grid-cols-6 items-center">
        <div class="card col-span-5">
        <form action="{{$excercise->path()}}" method="POST" id="editExercise">
            @method('PATCH')
            @csrf
            <div class="lg:grid grid-cols-5 items-center">
                <div>
                    <label for="name">Name</label>
                    <input class="site-input" type="text" name="name" value="{{$excercise->name}}">
                </div>
                <div>
                    <label for="weight">Weight (in kg)</label>
                    <input class="site-input" type="text" name="weight" value="{{$excercise->weight}}">
                </div>
                <div>
                    <label for="sets">Sets</label>
                    <input class="site-input" type="number" name="reps" value="{{$excercise->reps}}">
                </div>
                <div>
                    <label for="reps">Reps</label>
                    <input class="site-input" type="number" name="sets" value="{{$excercise->sets}}">
                </div>
                    <div class="text-center mt-3">
                        <button class="btn-blue p-2  w-1/3" form="editExercise">Edit</button>
                    </div>
            </div>
        </form>
    </div>
        <div class="card text-center mx-5">
            <form method="POST" action="{{$excercise->path()}}" id="deleteExercise">
                @method('DELETE')
                @csrf
                <button form="deleteExercise" type="submit" class="delete-button p-2 w-1/3">Delete</button>
            </form>
    </div>
</div>
    @endforeach

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-red-300">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


</x-app-layout>
