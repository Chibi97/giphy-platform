@extends('layouts.main')

@section('content')
  @auth
    @include('gifs.new')
  @endauth
  
  <new-report-modal :open-modal="activeModal" @close="activeModal = ''" ></new-report-modal>
  <delete-post-modal :open-modal="activeModal" @close="activeModal = ''"></delete-post-modal>

  @foreach($posts as $r)
  <div class="card my-3 post">
      <div class="card-header d-flex">
        <img class="gravatar-image" src="{{ Gravatar::get($r->user->email) }}">
        <h1>
          @if(!(isset($noLinkName) ? $noLinkName : false))
          <a href='{{ route('user-posts', $r->user) }}'>
            {{ $r->user->name }}
          </a>
          @else
            {{ $r->user->name }}
          @endif
        </h1>
        @if (Auth::user() && Auth::user()->can('delete', $r))
          <form class='ml-auto' method="POST" action="{{ route('delete-post', $r['giphy_id']) }}">
            @csrf
            {{ method_field('delete') }}
          </form>
          <button class='btn btn-danger' @click="activeModal = 'delete-post-modal'">Delete</button>
          @else
            <button class='btn btn-warning' @click="activeModal = 'new-report-modal'">Report</button>
          @endif
      </div>
      <div class="card-body text-center">
        <img class='responsive-image' src="{{ $r['giphy']['image']['url'] }}">
      </div>
    </div>
    @endforeach 
  {{ $posts->links() }}
@endsection