<template>
    <div class="header">
        <div class="funil">
            <label>Funil</label>
        </div>
        <div class="nome-funil">
            <label>{{ funil.nome }}</label>
        </div>
        <div class="editar">
            <button class="reset-button" @click="openModal">
                <i class="bx bxs-pencil"></i>
            </button>
        </div>
        <div class="excluir">
            <button class="reset-button" @click="deleteFunil">
                <i class="bx bxs-trash"></i>
            </button>
        </div>
        <div class="inputs">
            <i class="bx bx-search-alt"></i>
            <input type="text" placeholder="Pesquisar" />
            <button class="btnNew" @click.prevent="openSidebar">
                <h3>Novo Contato</h3>
                <i class="bx bx-user-plus"></i>
            </button>
        </div>
        <div class="sidebar" :class="{ 'sidebar-active': isActive }">
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
                        <input type="text" v-model="name" placeholder="Nome do Contato" />
                        <div class="borderr">
                            <hr>
                        </div>
                        <div class="etapas">
                            <h2>{{ funil.nome }}</h2>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" v-model="etapa_id"
                                    value="1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="btnradio1">Sem Etapa</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" v-model="etapa_id"
                                    value="2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2">Prospecção</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" v-model="etapa_id"
                                    value="3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio3">Contato</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio4" v-model="etapa_id"
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
                                        <label>Telefone</label>
                                        <input type="text" placeholder="(99)99999-9999" v-model="phone_number">
                                    </div>
                                    <div class="email-contato">
                                        <label>Email</label>
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
                <span class="close" @click="closeModal">&times;</span>
                <label>Editar Funil</label>
                <form @submit.prevent="updateFunil">
                    <input type="text" v-model="funil.nome" placeholder="Nome"><i class='bx bxs-edit-alt'></i>
                    <button class="btnSave" type="submit" @click="updateFunil">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { show } from '@/services/HttpService';
import HttpService from '@/services/HttpService';
import { useToast } from 'vue-toastification';

export default {
    name: 'FunilInfos',
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
        }
    },
    async created() {
        this.funil = await show(this.$route.params.id);
    },
    methods: {
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
        async createContato() {
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
            console.log('hello word')
            const toast = useToast();
            await HttpService.put(`funil/update/${this.id}`, {
                nome: this.funil.nome
        })
            .then(response => {
                this.nome = (response.data);
                toast.success('Funil atualizado com sucesso!');
                this.closeModal();
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
        toggleDropdown(section) {
            this.dropdowns[section] = !this.dropdowns[section];
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
    width: 35px;
    height: 35px;
    padding-left: 10px;
    border: #72869A 1px solid;
}

.go-back i {
    font-size: 25px;
    margin-left: -7px;
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

/* AQUI FICA O MODAL DE CRIACAO DE CONTATOS */

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
    background: white;
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
    background: white;
}


.etapas h2 {
    font-size: 16px;
    padding: 10px;
    background: white;
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

.modal {
    display: flex;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    backdrop-filter: blur(5px);
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fff;
    padding: 20px;
    border: none;
    width: 80%;
    max-width: 500px;
    border-radius: 10px;
}

.modal-content label {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
    background: transparent;
    font-size: 1.8em;
    font-weight: 600;
}

.modal-content form {
    background: transparent;
}

.modal-content input {
    width: 80%;
    height: 40px;
    border: 1px #E1E9F4 solid;
    border-radius: 10px;
    font-size: 16px;
    background: white;
    cursor: text;
    padding-left: 10px;
    padding-right: 40px;
    margin-left: 50px;
}

.bxs-edit-alt {
    background: transparent;
    position: absolute;
    left: 81%;
    top: 58.5%;
    transform: translateY(-50%);
    font-size: 1.3em;
    color: #757575;
}

.btnSave {
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
    padding: 10px;
    margin-left: 115px;
    margin-top: 10px;
    position: relative;
}

.btnSave:hover {
    background: #1339cf;
}

.close {
    background: #E1E9F4;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 33px;
    height: 33px;
    border-radius: 10px;
    color: #aaa;
    float: right;
    font-size: 25px;
}

.close:hover,
.close:focus {
    text-decoration: none;
    cursor: pointer;
}
</style>
