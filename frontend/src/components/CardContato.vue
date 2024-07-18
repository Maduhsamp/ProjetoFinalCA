<template>
    <div>
        <div v-for="contatos in contato" :key="contatos.id">
            <div class="card-container" v-if="contatos.etapa_id === etapaId">
                <div class="card">
                    <div class="name"> {{ contatos.name }}</div>
                    <div class="valor"> R$ {{ contatos.value }} </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HttpService, { getContato } from '@/services/HttpService';

export default {
    name: 'CardContato',
    data() {
        return {
            contato: [],
        }
    },
    props: {
        etapaId: ''
    },
    async created() {
        this.contato = await getContato(this.$route.params.id);
    },
    // methods: {
    //     updateContato(contato) {
    //         axios.put(`/api/contatos/${contato.id}`, contato)
    //             .then(response => {
    //                 this.contatos.forEach(c => {
    //                     if (c.id === contato.id) {
    //                         Object.assign(c, contato);
    //                     }
    //                 });
    //                 this.showModal = false;
    //             })
    //             .catch(error => {
    //                 console.error(error);
    //             });
    //     },

    //     deleteContato(contato) {
    //         axios.delete(`/api/contatos/${contato.id}`)
    //             .then(() => {
    //                 this.contatos = this.contatos.filter(c => c.id !== contato.id);
    //             })
    //             .catch(error => {
    //                 console.error(error);
    //             });
    //     }
    // }
}
</script>
<style scoped>
* {
    background: #f8f8f8;
    width: 220px;

}

.card-container {
    display: flex;
    flex-wrap: wrap;
    align-content: flex-start;
    margin: 0;
    background: transparent;
}

.card {
    position: relative;
    background: white;
    height: 114px;
    border-radius: 10px;
    padding: 15px;
    border: #E1E9F4 solid 1px;
    display: flex;
    gap: 0px;
    margin-top: 10px;

}

.valor {
    background: transparent;
    color: #96989c;
    font-size: 16px;
}

.name {
    background: transparent;
    height: 60px;
    max-height: 60px;
    overflow: auto;
    margin-bottom: 10px;
    font-size: 16px;
    max-width: 185px;
}

.name::-webkit-scrollbar {
    width: 7px;
}

.name::-webkit-scrollbar-track {
    background: #ffdb79;
    border-radius: 10px;
}

.name::-webkit-scrollbar-thumb {
    background: #FFBD00;
    border-radius: 10px;
}

.name::-webkit-scrollbar-thumb:hover {
    background: #e9ab00;
    cursor: pointer;
}

h2 {
    background: transparent;
    max-height: 70px;
    font-size: 24px;
}
</style>