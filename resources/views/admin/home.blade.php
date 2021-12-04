@extends('admin.layout')

@section('template_content')
<div id="tabs" class="md:p-10 p-4">
    <ul class="flex">
      {{-- <li><a class=" m-4 px-4 py-3 rounded bg-blue-800 text-center text-white uppercase inline-block" href="#tabs-1">Config</a></li> --}}
      {{-- <li><a class=" m-4 px-4 py-3 rounded bg-blue-800 text-center text-white uppercase inline-block" href="#tabs-2">Content</a></li> --}}
      <li><a class=" m-4 px-4 py-3 rounded bg-blue-800 text-center text-white uppercase inline-block" href="#tabs-3">Create</a></li>
      <li><a class=" m-4 px-4 py-3 rounded bg-blue-800 text-center text-white uppercase inline-block" href="#tabs-4">Edit files</a></li>
    </ul>
    {{-- <div id="tabs-1">
      @include('admin.pages.config')
    </div>
    <div id="tabs-2">
        @include('admin.pages.content')
    </div> --}}
    <div id="tabs-3">
        @include('admin.pages.add')
    </div>
    <div id="tabs-4">
        @include('admin.pages.edit')
    </div>
  </div>
   
@endsection