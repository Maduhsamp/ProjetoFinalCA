<template>
    <div class="header">
        <div class="funil">
            <label>Funil</label>
        </div>
        <div class="nome-funil">
            <label>{{ funil.nome }}</label>
        </div>
        <div class="editar">
            <button class="reset-button" @click.prevent="openModal">
                <i class="bx bxs-pencil"></i>
            </button>
        </div>
        <div class="excluir">
            <button class="reset-button" @click="showDeleteModal">
                <i class="bx bxs-trash"></i>
            </button>
            <ModalDeleteFunil v-if="isModalDeleteVisible" />
        </div>
        <div class="inputs">
            <i class="bx bx-search-alt"></i>
            <input type="text" placeholder="Pesquisar" v-model="searchQuery" @keyup.enter="searchContatos" />
            <button class="btnNew" @click.prevent="openSidebar">
                <h3>Novo Contato</h3>
                <i class="bx bx-user-plus"></i>
            </button>
        </div>
        <div class="sidebar overflow-y-auto" :class="{ 'sidebar-active': isActive }">
            <form @submit.prevent="createContato">
                <div class="input-contato ">
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
                            Criar Contato
                        </button>
                    </div>
                    <div class="card-nome">
                        <input type="text" v-model="name" placeholder="Nome do Contato*" />
                        <div class="borderr">
                            <hr>
                        </div>
                        <div class="etapas">
                            <h2>{{ funil.nome }}</h2>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" id="1" v-model="etapa_id"
                                    value="1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="btnradio1">Sem Etapa</label>

                                <input type="radio" class="btn-check" name="btnradio" id="2" v-model="etapa_id"
                                    value="2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2">Prospecção</label>

                                <input type="radio" class="btn-check" name="btnradio" id="3" v-model="etapa_id"
                                    value="3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio3">Contato</label>

                                <input type="radio" class="btn-check" name="btnradio" id="4" v-model="etapa_id"
                                    value="4" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio4">Proposta</label>
                            </div>
                        </div>
                    </div>
                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Contatos
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="telefone">
                                        <label>Telefone:<font color="red">*</font></label>
                                        <input type="text" placeholder="(99)99999-9999" v-model="phone_number">
                                    </div>
                                    <div class="email-contato">
                                        <label>Email:<font color="red">*</font></label>
                                        <input type="email" placeholder="example@example.com" v-model="email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Dados
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="cpf">
                                        <label>CPF</label>
                                        <input type="text" placeholder="000.000.000-00" v-model="cpf">
                                    </div>
                                    <div class="birthday">
                                        <label>Data de Nascimento</label>
                                        <input type="date" v-model="birth_date">
                                    </div>
                                    <div class="endereco">
                                        <label>Endereço</label>
                                        <input type="text" placeholder="Rua: nome exemplo - N999" v-model="address">
                                    </div>
                                    <div class="value">
                                        <label>Valor</label>
                                        <input type="text" placeholder="R$: 0,00" v-model="value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div v-if="isModalActive" class="modal">
            <div class="modal-content">
                <div class="top">
                    <p>Editar funil</p>
                    <span class="close" @click="closeModal"><i class='bx bx-x'></i></span>
                </div>
                <span class="bar"></span>
                <form @submit.prevent="updateFunil">
                    <input type="text" v-model="funil.nome" placeholder="Nome"><i class='bx bxs-edit-alt'></i>
                    <button class="btnSave" type="submit">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { show } from '@/services/HttpService';
import HttpService from '@/services/HttpService';
import { useToast } from 'vue-toastification';
import ModalDeleteFunil from './ModalDeleteFunil.vue';
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'FunilInfos',
    components: {
        ModalDeleteFunil
    },
    computed: {
        ...mapGetters(['isModalDeleteVisible']),
    },
    data() {
        return {
            isActive: false,
            isModalActive: false,
            funil: {},
            name: '',
            id: this.$route.params.id,
            nome: '',
            address: '',
            value: '',
            email: '',
            phone_number: '',
            cpf: '',
            birth_date: '',
            etapa_id: '',
            contato: [],
            searchQuery: ''
        }
    },
    async created() {
        this.funil = await show(this.$route.params.id);
    },
    methods: {
        ...mapActions(['showDeleteModal']),
        openSidebar() {
            this.isActive = !this.isActive;
        },
        closeSidebar() {
            this.isActive = false;
        },
        openModal() {
            this.isModalActive = true;
        },
        closeModal() {
            this.isModalActive = false;
        },
        async searchContatos() {
            try {
                const response = await HttpService.get(`funil/${this.id}/contato`, {
                    params: {
                        name: this.searchQuery,
                    },
                });
                this.contato = response.data.contato;
                console.log('deu certo');
            } catch (error) {
                toast.error('Erro ao buscar contatos:');
                console.error('contato não encontrado:',error);
            }
        },
        async createContato() {
            if (this.etapa_id == '' | null) {
                this.etapa_id = 1;
            }
            const toast = useToast();
            await HttpService.post(`funil/${this.id}/contato`, {
                name: this.name,
                etapa_id: this.etapa_id,
                phone_number: this.phone_number,
                email: this.email,
                cpf: this.cpf,
                birth_date: this.birth_date,
                address: this.address,
                value: this.value
            })
                .then(response => {
                    this.name = (response.data);
                    this.etapa_id = (response.data);
                    this.phone_number = (response.data);
                    this.email = (response.data);
                    this.cpf = (response.data);
                    this.birth_date = (response.data);
                    this.address = (response.data);
                    this.value = (response.data);

                    this.closeSidebar();
                    toast.success('Contato adicionado com sucesso!');
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                })
                .catch(error => {
                    toast.error('Erro ao adicionar contato!');
                    console.error(error);
                });
        },
        async updateFunil() {
            const toast = useToast();
            await HttpService.put(`funil/update/${this.id}`, {
                nome: this.funil.nome
            })
                .then(response => {
                    this.nome = (response.data);
                    this.closeModal();
                    toast.success('Funil atualizado com sucesso!');
                })
                .catch(error => {
                    toast.error('Erro ao tentar atualizar funil!');
                    console.error(error);
                });
        },
        async deleteFunil() {
            const toast = useToast();
            try {
                await HttpService.delete(`funil/delete/${this.id}`);
                toast.success('Funil deletado com sucesso!');
                this.$router.push('/dashboard');
            } catch (error) {
                toast.error('Erro ao tentar deletar funil!');
                console.error(error);
            }
        },
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
}

.funil {
    width: 30px;
    color: #72869A;
    margin-top: 10px;
    margin-left: 20px;
    font-weight: 600;
    font-size: 1em;
}

.nome-funil {
    margin-top: 35px;
    margin-left: -28px;
    font-size: 1.7em;
}

.reset-button {
    all: unset;
    cursor: pointer;
}

.editar {
    width: 20px;
    height: 20px;
    margin-top: 2.7%;
    margin-right: 3%;
    font-size: 1.3em;
}

.excluir {
    width: 20px;
    height: 20px;
    margin-top: 2.7%;
    margin-right: 5%;
    color: rgb(223, 3, 3);
    font-size: 1.3em;
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
    top: 30px;
    right: 10px;

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
        bottom: 26px;
        left: 172px;
        font-size: 1.5em;
        color: #fff;
    }
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

/* AQUI COMEÇA A ESTILIZAÇÃO DA SIDEBAR DE CRIACÃO DE CONTATOS */
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

.card-nome {
    background: #f8f8f8;
    border: 1px solid #E1E9F4;
    height: 178px;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;

}

.card-nome input {
    width: 100%;
    ;
}

.etapas {
    background: transparent;
}


.etapas h2 {
    font-size: 16px;
    padding: 10px;
    background: transparent;
}

.birthday input {
    color: #707070;
}

.btn-outline-primary {
    --bs-btn-color: #626262;
    --bs-btn-border-color: transparent;
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: #7036e4;
    --bs-btn-hover-border-color: #0b0b0b;
    --bs-btn-focus-shadow-rgb: 13, 110, 253;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: #7036e4;
    --bs-btn-active-border-color: #7036e4;
    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    --bs-btn-disabled-color: #111111;
    --bs-btn-disabled-bg: black;
    --bs-btn-disabled-border-color: #7036e4;
    --bs-gradient: none;
    margin-left: 10px;
    margin-right: 10px;
    border-radius: 10px;
    background: #d4d4d4;
    height: 26px;
    align-content: center;
    font-size: 13px;
}

.sidebar::-webkit-scrollbar {
    width: 7px;
}

.sidebar::-webkit-scrollbar-track {
    background: #ffdb79;
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-thumb {
    background: #FFBD00;
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: #e9ab00;
    cursor: pointer;
}


.accordion-button:not(.collapsed) {
    color: black;
    background-color: transparent;
    box-shadow: black;
}

.accordion-button:focus {
    box-shadow: none;   
}

.formaContato,
.dados {
    margin-top: 10px;
    background: white;
    border: 1px solid #E1E9F4;
    border-radius: 10px;
    padding: 10px;
    cursor: pointer;
}

.accordion-body input {
    width: 90%;
}

.accordion-item {
    margin-bottom: 10px;
}

.accordion {
    background: transparent;
}

.accordion-body {
    display: inline-block;
}

.telefone {
    display: inline-flex;
    justify-content: space-between;
    align-items: center;
}

.email-contato {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
}

.cpf {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
}

.birthday {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
}

.endereco {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
}

.value {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
}

.birthday label {
    font-size: 11px;
}

.accordion-body label {
    width: 80px;
}

.input-contato input[data-v-928e62a3] {
    height: 40px;
    border: 0px;
    border-radius: 10px;
    font-size: 16px;
    background: #f8f8f8;
    cursor: text;
    padding-left: 10px;
    padding-right: 40px;
    transition: .3s;
}

.card-nome input {
    border: 0px;
    background: #f8f8f8;
    font-size: 24px;
    transition: .3s;
}

.card-nome input:hover {
    background: #e3e3e3;
    transition: .3s;
}

input:focus {
    opacity: 100%;
    border: 0 none;
    outline: 0;
    box-shadow: none;
    border: none;
    outline: none;
    padding: 10px;
    border-radius: 5px;
    color: #333;
    transition: background-color 0.3s ease;
}

.input-contato input {
    border: none;
    background: transparent;
}


/* AQUI TERMINA O A ESTILIZACAO DE DENTRO DO MODAL */

.sidebar-active {
    transform: translateX(0);
    background: #f1f5fb;
}

.sidebar form {
    background: transparent;
}

.btnSend {
    display: flex;
    justify-content: center;
    white-space: nowrap;
    font-size: 0.9em;
    width: 500px;
    height: 40px;
    background: #3057F2;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    color: #fff;
    font-weight: 500;
    transition: .5s;

    padding: 10px;
}

.btnSend:hover {
    background: #1339cf;
}

.input-contato {
    background: transparent;
    position: relative;

}

.input-contato input {
    height: 40px;
    border: 1px #E1E9F4 solid;
    border-radius: 10px;
    font-size: 16px;
    background: white;
    cursor: text;
    padding-left: 10px;
    padding-right: 40px;

}

/* AQUI FICA A ESTILIZACÃO DO MODAL DO LOGOUT */
.modal {
    display: flex;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(5px);
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fff;
    padding: 20px;
    border: none;
    width: 100%;
    max-width: 647px;
    height: 329px;
    border-radius: 10px;
}

.modal-content p {
    font-size: 1.2rem;
    font-weight: 600;
}

.modal-content form {
    background: transparent;
}

.modal-content input {
    width: 80%;
    height: 45px;
    border: 2px #E1E9F4 solid;
    border-radius: 10px;
    font-size: 18px;
    background: transparent;
    cursor: text;
    padding-left: 10px;
    padding-right: 40px;
    margin-top: 8%;
    margin-left: 10%;
}

.top {
    display: flex;
    justify-content: space-between;
    background: transparent;
}

.top p {
    color: #373753;
    font-weight: 500;
    font-size: 18px;
    margin-left: 5px;
    margin-top: -5px;
}

.bx-x {
    background: transparent;
}

.top .close {
    position: absolute;
    width: 24px;
    background: transparent;
    border: none;
    color: #6F8298;
    font-size: 1.4em;
    top: 4%;
    right: 3.5%;
    cursor: pointer;
}

.top .close:hover {
    color: #5d6d80;
}

.bar {
    position: absolute;
    display: block;
    content: '';
    width: 100%;
    height: 1px;
    background: #E6EDF5;
    margin-left: -3.1%;
    top: 17%;
}

.bxs-edit-alt {
    background: transparent;
    position: absolute;
    left: 82%;
    top: 39%;
    transform: translateY(-50%);
    font-size: 1.3em;
    color: #757575;
}

.btnSave {
    width: 241px;
    height: 40px;
    background: #13a000;
    border: none;
    border-radius: 10px;
    outline: none;
    cursor: pointer;
    color: #fff;
    font-weight: 500;
    transition: .5s;
    padding: 10px;
    margin-left: 30%;
    margin-top: 7%;
    position: relative;
}

.btnSave:hover {
    background: #108600;
}
</style>
