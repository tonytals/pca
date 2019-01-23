<template>
  <div class="menu">
    <ul class="list">
      <li class="header">NAVEGAÇÃO PRINCIPAL</li>
      <li :class="activeLink('__')">
        <a :href="montaRota('dashboard')">
          <i class="material-icons">home</i>
          <span>Visão Geral</span>
        </a>
      </li>
      <li v-if="permissao('pacientes-create')" :class="activeLink('pacientes')">
        <a :href="montaRota('pacientes.index')" class="toggled" v-if="activeLink('pacientes/')">
          <i class="material-icons">group</i>
          <span>Meus Pacientes</span>
        </a>
        <a :href="montaRota('pacientes.index')" v-else>
          <i class="material-icons">accessibility</i>
          <span>Meus Pacientes</span>
        </a>
        <ul class="ml-menu">
            <li :class="activeLink('pacientes')" v-if="activeLink('pacientes/')">
                <a :href="montaRota('pacientes.index')">Prontuário</a>
            </li>
        </ul>
      </li>
      <li :class="activeLink('familias')">
        <a :href="montaRota('familias.index')">
          <i class="material-icons">group</i>
          <span>Famílias</span>
        </a>
      </li>
      <li :class="activeLink('agendamentos')">
        <a :href="montaRota('agendamentos.index')">
          <i class="material-icons">date_range</i>
          <span>Agenda</span>
        </a>
      </li>


      <li v-if="permissao('admin-view')" :class="activeLink('admin')">
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">build</i>
            <span>Administração</span>
        </a>
        <ul class="ml-menu">
            <li :class="activeLink('usuarios')">
                <a :href="montaRota('usuarios.index')">Usuarios</a>
            </li>
            <li :class="activeLink('tutores')">
                <a :href="montaRota('tutores.index')">Tutores</a>
            </li>
            <li :class="activeLink('preceptores')">
                <a :href="montaRota('preceptores.index')">Preceptores</a>
            </li>
            <li :class="activeLink('papeis')">
                <a :href="montaRota('papeis.index')">Papéis</a>
            </li>
        </ul>
      </li>

    </ul>
  </div>
</template>

<script>
export default {
  methods:{
    montaRota(rota){
      return route(rota);
    },
    activeLink(url){
      var urlAtual = window.location.href.replace(/^.*\/\/[^\/]+/, '');

      if(urlAtual.indexOf(url) !== -1)
      {
        return 'active';
      }

      if(urlAtual.length === 1 && url === '__')
      {
        return 'active';
      }

      return false;

    },
    permissao(permissao){
        var permissoes = JSON.stringify(Laravel.permissoes);
        if(permissoes.indexOf(permissao) !== -1){
           return true;
        }
        return false;
    }
  }
}
</script>
