@extends('frontend.index')
@section('content')

    <section class="bg-img1 txt-center p-lr-15 p-tb-92" >
        <h2 class="ltext-105 title txt-center title">
           {{$policy->name}} Policies in Coza Store
        </h2>
    </section>

   <div class="container policies">
       <div class="row">
           <div class="col-md-12">
               {!! $policy->description !!}
           </div>
       </div>
   </div>

@endsection

@section('my_css')
    <style>
        .policies{
            border: 1px solid grey;
            margin-bottom: 50px;
            padding: 50px;
        }
    </style>
@endsection
