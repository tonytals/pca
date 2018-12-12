<template>
  <section>
    <aside id="leftsidebar" class="sidebar">

      <informacoes-usuario></informacoes-usuario>
      <menu-principal></menu-principal>
      <div class="legal">
          <div class="copyright">
              © 2018 <a href="javascript:void(0);">{{ nomeapp }}</a>.
          </div>
          <div class="version">
              <b>Versão: </b> 0.1 a
          </div>
      </div>
    </aside>
  </section>
</template>

<script>
export default {
  props : ['nomeapp']

}
</script>
