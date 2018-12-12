<template>
  <div class="modal fade" v-bind:id="modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="largeModalLabel">{{ titulo }}</h4>
        </div>
        <div class="modal-body">
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default{
  props:['titulo','modal']
}
</script>
