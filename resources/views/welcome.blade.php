@extends('layout')

@section('content')
<div class="fixed inset-0 w-full h-screen flex items-center justify-center">
  <div class="w-full sm:w-64 bg-gray-100 shadow-xl rounded-sm p-8 m-4">
    <div class="flex flex-col items-center">
      <aside class="text-gray-500 mb-8">
          @svg('document', 'w-32 rotate-260')
      </aside>
      <article class="">
        <a href="{{ route('auth.google') }}" class="bg-gray-600 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">Enter</a>
      </article>
    </div>
  </div>
</div>
@stop
