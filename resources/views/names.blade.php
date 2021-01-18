@extends('layouts.default')
@section('content')

    <div class="bg-secondary text-white p-2 mb-3">
      <h4 class="m-0">{{ ucfirst(@$cat) }} Baby Names</h4>
    </div>
    <p>Currently we have <span class="boy"> {{ $boys }} Boys </span> Names and <span class="girl">{{ $girls }} Girls </span> Names with Meanings in our American collection <br> Please Choose a Letter</p>
    <div class="topcolor btn">Boys</div>
    @php
     $alphas = range('A', 'Z');
    @endphp
    <hr class="mt-0">
        <div class="mb-3 fr">
            @foreach($alphas as $alpha)
                 <li>
                    <a href='{{ URL::to("names/$cat/boy/$alpha")}}'> {{ $alpha }}</a>
                  </li>
            @endforeach

        </div>

    <div class="topcolorG btn">Girls</div>
    <hr class="mt-0">
        <div class="mb-3 fr">
           @foreach($alphas as $alpha)
                 <li>
                    <a href='{{ URL::to("names/$cat/girl/$alpha")}}'> {{ $alpha }}</a>
                  </li>
            @endforeach
        </div>  

@stop