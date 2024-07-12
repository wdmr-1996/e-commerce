@extends('layout.base')

@section('content')
    @if(Session::has('message'))
        <div class="container">
            <div class="alert alert-{{Session::get('typealert')}}" style="display:none;">
                {{Session::get('message')}}
                @if ($error->any())
                    <ul>
                        @foreach($error->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

                <script>
                    $('.alert').slideDown();
                    setTimeout(function(){ $('.alert').slideUp();}, 1000);
                </script>
            </div>
        </div>
    @endif
@endsection