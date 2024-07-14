<template>
<div class="flex">

<Navbar />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>    


    <div class="coluna">
        <div class="funil">
            <FunilInfos />
        </div>
        <ColunasEtapas />
    </div>


</div>
</template>
<script>
import Navbar from '../components/Navbar.vue';
import FunilInfos from '@/components/Funil.vue';
import ColunasEtapas from '@/components/Etapas.vue';

export default {
    components: {
        Navbar,
        FunilInfos,
        ColunasEtapas
    }
}
</script>
<style scoped>
    *{
        background: #f8f8f8;
    }

    .funil{
        max-height: 56px;
        width: 100%;
    }

    .flex{
        display: flex;

    }

    .coluna{
        width: 100%;
        height: 100%;
    }
</style>