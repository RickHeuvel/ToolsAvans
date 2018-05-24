@extends('layouts.master')
@section('title')
    <title>Contact | ToolHub</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <hr class="m-0">
    <div class="container pt-5">
        <h2>Over ons</h2>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum feugiat dolor nec ipsum efficitur, fermentum
        consectetur mi efficitur. Vivamus nulla nibh, hendrerit eget lobortis eget, accumsan eu neque. Pellentesque habitant
        morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam volutpat volutpat ligula ut fermentum.
        Morbi viverra dictum mauris, finibus accumsan quam sagittis a. Quisque id ligula tempor, dignissim lacus non, luctus
        neque. Suspendisse efficitur volutpat nunc faucibus tincidunt. Etiam mattis, ligula nec volutpat laoreet, nulla justo
        finibus lorem, ut molestie ipsum eros a magna. Pellentesque scelerisque neque eget sapien rhoncus, iaculis accumsan
        dolor sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
        Nunc feugiat tortor in ex fringilla dapibus.

        Duis sit amet auctor orci. Etiam sed rutrum ex. Curabitur id magna interdum, aliquet arcu et, volutpat ipsum.
        Mauris ultricies lacus vestibulum nisl suscipit, accumsan lacinia mi hendrerit. Cras ut tortor cursus,
        velit ut, finibus mi. Morbi vel laoreet ipsum. Aliquam gravida convallis lectus a efficitur. Sed elit sapien,
        facilisis vitae semper ac, congue et augue.
    </div>
    <div class="container pt-5">
        <h2 id="contact">Stel een vraag aan de beheerders</h2>
        @include('partials.alert')
        <form method="post" action="{{route('contact.store')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label>Naam:</label>
                @if(isset(auth()->user()->nickname))
                     <input type="text" class="form-control" name="name" value="{{auth()->user()->nickname}}">
                @else
                <input type="text" class="form-control" name="name">
                @endif
                @if($errors->has('name'))
                    <small class="form-text invalid-feedback d-block">{{$errors->first('name')}}</small>
                @endif
            </div>

            <div class="form-group">
                <label>Email:</label>
                @if(isset(auth()->user()->email))
                    <input type="text" class="form-control" name="email" value="{{auth()->user()->email}}">
                @else
                    <input type="text" class="form-control" name="email">
                @endif
                @if($errors->has('email'))
                    <small class="form-text invalid-feedback d-block">{{$errors->first('email')}}</small>
                @endif
            </div>

            <div class="form-group">
                <label>Onderwerp:</label>
                <input type="text" class="form-control" name="subject">
                @if($errors->has('subject'))
                    <small class="form-text invalid-feedback d-block">{{$errors->first('subject')}}</small>
                @endif
            </div>

            <div class="form-group">
                <label>Vraag:</label>
                <textarea name="question" class="form-control" rows="5"></textarea>
                @if($errors->has('question'))
                    <small class="form-text invalid-feedback d-block">{{$errors->first('question')}}</small>
                @endif
            </div>
            <button id="submit" class="btn btn-avans pull-right">Verzenden</button>
        </form>
    </div>

@endsection


