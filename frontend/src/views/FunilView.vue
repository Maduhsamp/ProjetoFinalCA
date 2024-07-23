<template>
    <div class="flex">
        <Navbar />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <div class="coluna">
            <div class="funil">
                <FunilInfos />
            </div>
            <ModalLogout v-if="isModalVisible" />
            <ColunasEtapas />
        </div>
    </div>
</template>
<script>
import Navbar from '../components/Navbar.vue';
import ModalLogout from '@/components/ModalLogout.vue';
import FunilInfos from '@/components/Funil.vue';
import ColunasEtapas from '@/components/Etapas.vue';
import { mapGetters, mapActions } from 'vuex';

export default {
    components: {
        Navbar,
        ModalLogout,
        FunilInfos,
        ColunasEtapas
    },
    methods: {
        ...mapActions(['hideModal'])
    },
    computed: {
        ...mapGetters(['Logged', 'isModalVisible']),
        isLogged() {
            return this.Logged;
        }
    }
}
</script>
<style scoped>
* {
    background: #f8f8f8;
}

.funil {
    max-height: 56px;
    width: 100%;
}

.flex {
    display: flex;

}

.coluna {
    width: 100%;
    height: 100vh;
}
</style>