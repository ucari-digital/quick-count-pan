@if($auth->posisi == 'superadmin')
    @include('component.menu-superadmin')
@endif

@if($auth->role == 'kordinator')
    @include('component.menu-kordinator')
@endif

@if($auth->posisi == 'relawan')
	@include('component.menu-relawan')
@endif

@if($auth->posisi == 'saksi')
	@include('component.menu-saksi')
@endif