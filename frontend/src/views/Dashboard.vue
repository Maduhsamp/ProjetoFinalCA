<script>
import Navbar from '../components/Navbar.vue';
import ModalLogout from '@/components/ModalLogout.vue';
import HeaderDashboard from '@/components/Dashboard.vue';
import CardFunil from '@/components/CardFunil.vue';
import { mapGetters, mapActions } from 'vuex';

export default {
    components: {
        Navbar,
        ModalLogout,
        HeaderDashboard,
        CardFunil
    },
    data() {
        return {
            refresh: 0
        };
    },
    methods: {
        ...mapActions(['hideModal']),
        handleFunilAdded() {
            this.refresh++;
        }
    },
    computed: {
        ...mapGetters(['Logged', 'isModalVisible']),
        isLogged() {
            return this.Logged;
        },
    }
}
</script>
<template>
    <div class="flex">
        <Navbar />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <div class="coluna">
            <div class="dashboard">
                <HeaderDashboard @funilAdded="updateFunilList" />
                <ModalLogout v-if="isModalVisible" :refresh="refresh" />
            </div>
            <CardFunil />
        </div>
    </div>
</template>

<style scoped>
* {
    background: #f8f8f8;
}

.dashboard {
    max-height: 56px;
    width: 100%;
}

.flex {
    display: flex;

}

.coluna {
    width: 100%;
    height: 100%;
}
</style>