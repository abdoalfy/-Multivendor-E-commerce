{{-- <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-bell"></i>
      @if( $newnotification)
      <span class="badge badge-warning navbar-badge">{{ $newnotification }}</span>
      @endif
    </a>
    {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> --}}
      {{-- <span class="dropdown-header">{{ $newnotification }} Notifications</span>
      <div class="dropdown-divider"></div>
      @foreach ($notifications as $notification)
      <a href="{{ $notification->data['ulr']}}?notification_id={{ $notification->id }}" class="dropdown-item @if($notification->unread()) text-bold @endif">
        <i class="{{ $notification->data['icon'] }} mr-2"></i> {{ $notification}} new {{ $notification->data['body'] }}
        <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
      </a>          
      @endforeach

      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
  </li> --}} 