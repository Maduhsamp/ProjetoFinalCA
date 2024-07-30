<template>
    <div v-if="isLoggedIn" class="header">

        <div class="Title">
            <h2>Dashboard de {{ name }}</h2>
        </div>
        <div class="inputs">
            <i class='bx bx-search-alt'></i>
            <input type="text" placeholder="Pesquisar">
            <button class="btnNew" @click.prevent="openSidebar">
                <h3>Novo Funil</h3>
                <i class='bx bx-plus-circle'></i>
            </button>
        </div>
        <div class="sidebar" :class="{ 'sidebar-active': isActive }">

            <form @submit.prevent="createFunil">
                <div class="input-funil ">
                    <div class="flex">
                        <div class="flex2">
                            <button class="go-back" @click.prevent="closeSidebar">
                                <i class='bx bx-chevron-left'></i>
                            </button>
                            <p>
                                Voltar
                            </p>
                        </div>
                        <button type="submit" class="btnSend">
                            Adicionar Funil
                        </button>
                    </div>
                </div>
                <div class="card-nome">
                    <h2> Bem-Vindo de volta {{ name }}</h2>
                    <hr>
                    <input type="text" v-model="nome" placeholder="Nome do Funil">
                    <!-- <i class='bx bx-add-to-queue'></i> -->
                </div>
            </form>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex';
import { getName } from '@/services/HttpService';
import HttpService from '@/services/HttpService';
import { useToast } from 'vue-toastification';

export default {
    name: 'HeaderDashboard',
    data() {
        return {
            isActive: false,
            nome: '',
            name: ''
        }
    },
    async created() {
        this.name = await getName()
    },
    computed: {
        ...mapGetters(['Logged']),
        isLoggedIn() {
            return this.Logged;
        }
    },
    methods: {
        openSidebar() {
            this.isActive = !this.isActive;
        },
        closeSidebar() {
            this.isActive = false;
        },
        async createFunil() {
            const toast = useToast();
            await HttpService.post('funil/create', {
                nome: this.nome
            })
                .then(response => {
                    this.nome = (response.data);
                    this.showModal = false;
                    this.closeSidebar();
                    toast.success('Funil adicionado com sucesso!');
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                })
                .catch(error => {
                    toast.error('Erro ao adicionar funil!');
                    console.error(error);
                });
        }
    }
}
</script>

<style scoped>
* {
    width: 100%;
    background: #f8f8f8;
}

.header {
    padding: 8px;
    max-height: 56px;
    display: flex;
    margin-bottom: 60px;
}

.flex {
    display: flex;
    align-content: center;
    padding: 10px;
    justify-content: center;
    background: transparent;
    justify-content: space-between;
    align-items: center;
}

.flex2 {
    display: flex;
    align-items: center;
    background: transparent;
}

.flex p {
    margin-top: 20px;
    background: transparent;
    margin-left: 10px;
}

.btnNew {
    width: 241px;
    height: 40px;
    background: #3057F2;
    border: none;
    border-radius: 10px;
    outline: none;
    cursor: pointer;
    color: #fff;
    font-weight: 500;
    transition: .5s;
    margin-right: 10px;
    padding: 10px;
    position: relative;
}

.btnNew:hover {
    background: #1339cf;
}

h3 {
    background: transparent;
    font-size: 16px;
    text-align: center;
}

.inputs {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    position: relative;
    width: 100%;

    input {
        width: 241px;
        height: 40px;
        border: 1px #E1E9F4 solid;
        border-radius: 10px;
        margin-right: 24px;
        font-size: 16px;
        background: white;
        padding-left: 10px;
        padding-right: 35px;
    }

    .bx-search-alt {
        position: absolute;
        top: 17%;
        transform: translateY(-50%);
        font-size: 1.1em;
        color: #75758B;
    }

    button i {
        position: absolute;
        display: flex;
        right: -15.7%;
        top: 1.3%;
        font-size: 1.1em;
        color: #fff;
    }
}

h2 {
    margin-left: 20px;
    font-size: 20px;
    padding: 10px;
}

.btnNew i {
    position: absolute;
    left: 68%;
    margin-top: 2.3%;
    transform: translateY(-50%);
    font-size: 1.1em;
}

.inputs i {
    position: absolute;
    background: transparent;
    padding-top: 12px;
    margin-right: 300px;
    width: 5px;
    height: 5px;
}

.go-back {
    background: white;
    border: none;
    border-radius: 30px;
    display: flex;
    align-items: center;
    justify-content: start;
    width: 37px;
    height: 35px;
    padding-left: 10px;
    border: #72869A 1px solid;
}

.go-back i {
    font-size: 25px;
    margin-left: -6px;
    background: transparent;
}

.sidebar {
    position: fixed;
    top: 0;
    right: 0;
    width: 719px;
    height: 100%;
    background: #fff;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
    padding: 40px;
    padding-top: 20px;
    transition: transform 0.3s ease;
    transform: translateX(100%);
    z-index: 1;
    border-radius: 20px 0 0 20px;
}

.sidebar-active {
    transform: translateX(0);
    background: #f1f5fb;
}

.sidebar form {
    background: transparent;

    .btnSend {
        display: flex;
        justify-content: center;
        white-space: nowrap;
        font-size: 0.9em;
        width: 70%;
        height: 40px;
        background: #3057F2;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        color: #fff;
        font-weight: 500;
        transition: .5s;
        margin-top: 10px;
        margin-left: 15%;
        padding: 10px;
    }

    .btnSend:hover {
        background: #1339cf;
    }
}

.input-funil {
    background: transparent;
    position: relative;

    i {
        width: 0;
        display: flex;
    }

    input {
        width: 100%;
        height: 40px;
        border: 1px #E1E9F4 solid;
        border-radius: 10px;
        margin-right: 24px;
        font-size: 16px;
        background: white;
        cursor: text;
        padding-left: 10px;
        padding-right: 40px;
    }

    .bx-add-to-queue {
        position: absolute;
        right: 12%;
        top: 79%;
        transform: translateY(-50%);
        font-size: 1.1em;
        color: #75758B;
    }
}

.card-nome {
    background: #f8f8f8;
    border: 1px solid #E1E9F4;
    height: 160px;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;

}

.card-nome input {
    width: 95%;
    margin: 10px;
    border: 0px;
    background: #f8f8f8;
    font-size: 24px;
    transition: color 0.3s ease;

}


.card-nome input:focus {
    opacity: 100%;
    border: 0 none;
    outline: 0;
    box-shadow: none;
    border: none;
    outline: none;
    color: #333;
    transition: color 0.3s ease;
}

.card-nome h2 {
    margin: 0;
    background: transparent;
}
</style>
