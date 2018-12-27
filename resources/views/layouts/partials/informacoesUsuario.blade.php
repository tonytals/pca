<div class="user-info">
  <div class="image">
    <img src="/images/user.png" width="48" height="48" alt="User" />
  </div>
  <div class="info-container">
    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
    <div class="email">{{ Auth::user()->email }}</div>
    <div class="btn-group user-helper-dropdown">
      <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
      <ul class="dropdown-menu pull-right">
        <li><a href="javascript:void(0);"><i class="material-icons">person</i>Meu Perfil</a></li>
        <li role="separator" class="divider"></li>
        <li>
          <a :href="url" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="material-icons">input</i>Sair
          </a>
        </li>
        <form id="logout-form" :action="url" method="POST" style="display: none;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
      </ul>
    </div>
  </div>
</div>
