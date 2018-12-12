<template>
    <!-- Inicio -->
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              {{ titulo }}
              <slot name="small"></slot>
            </h2>
            <div class="header-dropdown">
              <slot name="header"></slot>
            </div>
            <ul class="header-dropdown m-r--5" style="display:none;">
              <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">more_vert</i>
                </a>
                <ul class="dropdown-menu pull-right">
                  <li><a href="javascript:void(0);">Action</a></li>
                  <li><a href="javascript:void(0);">Another action</a></li>
                  <li><a href="javascript:void(0);">Something else here</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="body">
            <slot></slot>
          </div>
        </div>
      </div>
    </div>
    <!-- #FIM# -->
</template>
<script>
  export default {
    props: ['titulo']
  }
</script>
