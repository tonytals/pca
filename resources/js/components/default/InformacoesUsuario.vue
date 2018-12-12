<template>
  <div class="user-info">
    <div class="image">
      <img src="/images/user.png" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
      <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
      <div class="email">john.doe@example.com</div>
      <div class="btn-group user-helper-dropdown">
        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
        <ul class="dropdown-menu pull-right">
          <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
          <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
          <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
          <li role="separator" class="divider"></li>
          <li>
            <a :href="url" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="material-icons">input</i>Sair
            </a>
          </li>
          <form id="logout-form" :action="url" method="POST" style="display: none;">
              <input type="hidden" name="_token" :value="csrf">
          </form>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
      return {
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          url: route('logout')
      }
  }
}
</script>
