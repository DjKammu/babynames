@extends('layouts.default')
@section('content')
    <div class="row">
    <div class="col-md-8">    
        <div class="bg-secondary text-white p-2 mb-3">
          <h4 class="m-0"> Name » {{ucfirst(@$gender)}} » {{ ucfirst(@$name->name)}}  </h4>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
             <tbody>   
                 <tr>
                  <th scope="row">Name</th>
                  <td> <span class="{{ $gender }}"> {{ ucfirst(@$name->name) }} </span></td>
                
                 </tr>
                  <tr>
                  <th scope="row">Meanings</th>
                  <td>{{ (@count($name->meanings) > 0) ? @$name->meanings->pluck('name')->unique()->join(', ') : 'Add Meaning' }}</td>
                </tr>
              </tbody>
            </table>
        </div>

        <div class="p-2 mb-3">
          <h5 class="m-0"> Categories  </h5>
          @php
           
           
          $categories =  (@$name->categories->count()) ? @$name->categories->pluck('name','slug') : [];
          $origins =  (@$name->origins->count()) ? @$name->origins->pluck('title','slug') : [];
          $tags =  (@$name->tags->count()) ? @$name->tags->pluck('name','slug') : [];

          @endphp
          </br>
          @foreach ( $categories as $ck => $category )
             
             <a href='{{ route("baby-names","$ck")}}' class="btn btn-success btn-sm">{{ $category }} 
             </a>
          @endforeach

          
        </div>

        <div class="p-2 mb-3">
          <h5 class="m-0"> Tags  </h5>
          </br>
          @foreach ( $tags as $tk => $tag )  
             <a href='{{ url("tags/$tk")}}' class="btn btn-success btn-sm">{{ $tag }} 
             </a>
          @endforeach

          
        </div>


         <div class="p-2 mb-3">
          <h5 class="m-0"> Origin  </h5>

          </br>
          @foreach ( $origins as $ok => $origin )
             
             <a href='{{ url("origins/$ok")}}' class="btn btn-success btn-sm">{{ $origin }} 
             </a>
          @endforeach

          
        </div>
       


    </div>
    <div class="col-md-4">
        @include('includes.search')
    </div>
  </div>
@stop