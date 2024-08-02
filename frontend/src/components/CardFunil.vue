<template>
    <div class="card-container overflow-y-auto">
        <div class="card" v-for="funis in funil" :key="funis.id">
            <div class="nome">{{ funis.nome }}</div>
            <div class="acessar">
                <button class="btnAccess" @click="funilPage(funis.id)">Visualizar</button>
            </div>
        </div>
    </div>
    <div class="paginacao">
        <button class="back" @click="changePage(currentPage - 1)" :disabled="currentPage <= 1">Voltar</button>
        <button class="page page1" @click="changePage(1)">1</button>
        <button class="page page2" @click="changePage(2)">2</button>
        <button class="next" @click="changePage(currentPage + 1)" :disabled="currentPage >= totalPages">Próximo</button>
    </div>
</template>

<script>
import { getFunil } from '@/services/HttpService';

export default {
    name: 'CardFunil',
    data() {
        return {
            funil: [],
            currentPage: 1,
            totalPages: 2
        };
    },
    async created() {
        await this.fetchFunil(this.currentPage);
    },
    methods: {
        async fetchFunil(page) {
            this.funil = await getFunil(page);
        },
        async changePage(page) {
            if (page > 0 && page <= this.totalPages) {
                this.currentPage = page;
                await this.fetchFunil(page);
            }
        },
        funilPage(id) {
            this.$router.push({ name: 'funil', params: { id } });
        }
    }
}
</script>

<style scoped>
* {
    background: #f8f8f8;
    height: 100%;
    max-width: 100%;
    margin: 0 auto; 
}

.card-container::-webkit-scrollbar {
    width: 7px;
}

.card-container::-webkit-scrollbar-track {
    background: #ffdb79;
    border-radius: 10px;
}

.card-container::-webkit-scrollbar-thumb {
    background: #FFBD00;
    border-radius: 10px;
}

.card-container::-webkit-scrollbar-thumb:hover {
    background: #e9ab00;
    cursor: pointer;
}

.card-container {
    padding-top: 20px;
    display: flex;
    height: 80vh;
    flex-wrap: wrap;
    align-content: flex-start;
    margin: 0px 74px;
}

.card {
    position: relative;
    background: white;
    width: 280px;
    height: 140px;
    border-radius: 10px;
    padding: 10px;
    margin: auto 30px;
    border: #E1E9F4 solid 1px;
    display: inline-block;
    gap: 0px;
    margin-bottom: 10px;
}

@media screen and (max-width: 1440px) {
    .card-container {
        padding-top: 10px;
        display: flex;
        height: 74vh;
        flex-wrap: wrap;
        align-content: flex-start;
        margin: 0px;
    }   
    
    .card{
        width: 276px;
        height: 130px;
    }

}


.nome {
    background: transparent;
    max-height: 50px;
    overflow: auto;
    margin-bottom: 10px;

}

.nome::-webkit-scrollbar {
    width: 7px;
}

.nome::-webkit-scrollbar-track {
    background: #ffdb79;
    border-radius: 10px;
}

.nome::-webkit-scrollbar-thumb {
    background: #FFBD00;
    border-radius: 10px;
}

.nome::-webkit-scrollbar-thumb:hover {
    background: #e9ab00;
    cursor: pointer;
}

.acessar {
    display: flex;
    justify-content: center;
    align-items: center;
    top: 20%;
    background: transparent;
    width: 100%;
    height: 40px;
}

.btnAccess {
    width: 70%;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #3057F2;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    color: #fff;
    font-weight: 500;
    font-size: 0.9em;
    transition: .5s;
}

.btnAccess:hover {
    background: #1339cf;
}

h2 {
    background: transparent;
    max-height: 70px;
    font-size: 24px;
}

.paginacao {
    display: flex;
    flex-direction: row;
    justify-content: center;
}

.back, .page1, .page2, .next {
    background: #cbd2dd;
    width: 60px;
    height: 30px;
    margin: 20px 10px 20px 0;
    border: none;
    border-radius: 8px;
    font-size: 0.8em;
    font-weight: 600;
    transition: .5s;
}

.back:hover, .page1:hover, .page2:hover, .next:hover {
    background: #969ba3;
}
</style>