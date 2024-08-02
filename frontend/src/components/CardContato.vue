<template>
    <div>
        <draggable ghost-class="hidden-ghost" v-model="contato" group="people" @start="drag = true"
            @end="drag = onDragEnd" item-key="id" @change="etapaUpdate" :animation="300">
            <template #item="{ element }">
                <div class="cardsContato">
                    <div class="card-container" v-if="contatosFiltrados.includes(element)">
                        <div class="card">
                            <div class="editName">
                                <div class="name">{{ element.name }}</div>
                                <div class="editar">
                                    <button class="btnEdit" @click.prevent="openSidebar(element.id)">
                                        <i class="bx bxs-pencil"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="valor">R$ {{ element.value }}</div>
                        </div>
                    </div>
                    <div v-if="contatosFiltrados.length === 0" class="cardsContato card-fantasma">
                        Arraste um contato aqui
                    </div>
                </div>
            </template>
        </draggable>
        <div class="sidebar overflow-y-auto" :class="{ 'sidebar-active': isActive }">
            <form @submit.prevent="updateContato(contatoUnico.id)">
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
                            Editar Contato
                        </button>
                    </div>
                    <div class="card-nome">
                        <input type="text" v-model="contatoUnico.name" placeholder="Nome do Contato*" />
                        <div class="borderr">
                            <hr>
                        </div>
                        <div class="etapas">
                            <h2>{{ funil.nome }}</h2>

                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" :id="'1' + contatoUnico.id"
                                    v-model="contatoUnico.etapa_id" value="1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" :for="'1' + contatoUnico.id">Sem Etapa</label>

                                <input type="radio" class="btn-check" name="btnradio" :id="'2' + contatoUnico.id"
                                    v-model="contatoUnico.etapa_id" value="2" autocomplete="off">
                                <label class="btn btn-outline-primary" :for="'2' + contatoUnico.id">Prospecção</label>

                                <input type="radio" class="btn-check" name="btnradio" :id="'3' + contatoUnico.id"
                                    v-model="contatoUnico.etapa_id" value="3" autocomplete="off">
                                <label class="btn btn-outline-primary" :for="'3' + contatoUnico.id">Contato</label>

                                <input type="radio" class="btn-check" name="btnradio" :id="'4' + contatoUnico.id"
                                    v-model="contatoUnico.etapa_id" value="4" autocomplete="off">
                                <label class="btn btn-outline-primary" :for="'4' + contatoUnico.id">Proposta</label>
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
                                        <input type="text" placeholder="(99)99999-9999"
                                            v-model="contatoUnico.phone_number">
                                    </div>
                                    <div class="email-contato">
                                        <label>Email:<font color="red">*</font></label>
                                        <input type="email" placeholder="example@example.com"
                                            v-model="contatoUnico.email">
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
                                        <label>CPF:</label>
                                        <input type="text" placeholder="000.000.000-00" v-model="contatoUnico.cpf">
                                    </div>
                                    <div class="birthday">
                                        <label>Data de Nascimento:</label>
                                        <input type="date" v-model="contatoUnico.birth_date">
                                    </div>
                                    <div class="endereco">
                                        <label>Endereço:</label>
                                        <input type="text" placeholder="Rua: nome exemplo - N999"
                                            v-model="contatoUnico.address">
                                    </div>
                                    <div class="value">
                                        <label>Valor:</label>
                                        <input type="text" placeholder="R$: 0,00" v-model="contatoUnico.value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="excluir">
                <button class="delete" @click.prevent="openModal">
                    <i class='bx bx-trash-alt'></i>
                    <label>Excluir Contato</label>
                </button>
            </div>
        </div>
        <div v-if="isModalActive" class="modal">
            <div class="modal-content">
                <div class="top">
                    <p>Excluir contato</p>
                    <span class="close" @click="closeModal"><i class='bx bx-x'></i></span>
                </div>
                <span class="bar"></span>
                <label class="labelUm">Tem certeza que deseja excluir o contato?</label>
                <label class="labelDois">A ação não poderá ser desfeita.</label>
                <form>
                    <button class="btnYes" type="submit" @click.prevent="deleteContato(contatoUnico.id)">Sim</button>
                    <button class="btnNo" @click.prevent="closeModal">Não</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import HttpService, { getContato, showContato, show } from '@/services/HttpService';
import { useToast } from 'vue-toastification';
import draggable from 'vuedraggable';

export default {
    name: 'CardContato',
    components: {
        draggable
    },
    data() {
        return {
            isActive: false,
            isModalActive: false,
            contato: [],
            nome: '',
            funil: {},
            contatoUnico: {},
            name: '',
            id: this.$route.params.id,
            address: '',
            value: '',
            email: '',
            phone_number: '',
            cpf: '',
            birth_date: '',
            order: '',
            etapa_id: '',
            contatoAtualId: null,
            drag: false,
        }
    },
    props: {
        etapaId: '',
        orderId: ''
    },
    computed: {
        contatosFiltrados() {
            return this.contato.filter(c => c.etapa_id === this.etapaId);
        }
    },
    async created() {
        this.contato = await getContato(this.$route.params.id);
        this.funil = await show(this.$route.params.id);
        this.contatoUnico = await showContato(this.$route.params.id);
        this.fetchContatos;
    },
    methods: {
        async fetchContatos() {
            const funilId = this.$route.params.id;
            try {
                const response = await HttpService.get(`funil/${funilId}/contato`);
                this.contato = response.data;
                localStorage.setItem('contatos', JSON.stringify(this.contato));
            } catch (error) {
                console.error('Erro ao buscar contatos:', error);
            }
        },
        async etapaUpdate(event) {
            const { added, moved } = event;
            if (added) {
                const contatoId = added.element.id;
                const novaEtapaId = this.etapaId;

                try {
                    await HttpService.put(`contato/etapa/${contatoId}`, { etapa_id: novaEtapaId });
                    const contato = this.contato.find(c => c.id === contatoId);
                    if (contato) {
                        contato.etapa_id = novaEtapaId;
                    }
                } catch (error) {
                    console.error('Erro ao atualizar a etapa do contato:', error);
                }
            }
            if (moved) {
                const contatoId = moved.element.id;
                const OrdemAtual = moved.element.order
                try {
                    await HttpService.put(`contato/order/${contatoId}`, { order: event.moved.newIndex });
                    const contato = this.contato.find(c => c.id === contatoId);
                    if (contato) {
                        contato.order = NewIndex;
                    }
                }
                catch {
                    console.error('Erro ao atualizar a ordem do contato:', error);
                }
            }
        },
        onDragEnd() {
            this.fetchContatos();
        },
        openModal() {
            this.isModalActive = true;
        },
        closeModal() {
            this.isModalActive = false;
        },
        async openSidebar(contatoId) {
            this.isActive = !this.isActive;
            this.contatoAtualId = contatoId;
            this.contatoUnico = await showContato(this.$route.params.id, contatoId);
        },
        closeSidebar() {
            this.isActive = false;
            this.contatoAtualId = null;
        },
        async updateContato(contatoId) {
            const toast = useToast();
            await HttpService.patch(`contato/${contatoId}`, {
                name: this.contatoUnico.name,
                etapa_id: this.contatoUnico.etapa_id,
                phone_number: this.contatoUnico.phone_number,
                email: this.contatoUnico.email,
                cpf: this.contatoUnico.cpf,
                birth_date: this.contatoUnico.birth_date,
                address: this.contatoUnico.address,
                value: this.contatoUnico.value
            })
                .then(response => {
                    const updatedContato = response.data;
                    const index = this.contato.findIndex(c => c.id === contatoId);
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                    this.closeSidebar();
                    toast.success('Contato atualizado com sucesso!');
                })
                .catch(error => {
                    toast.error('Erro ao tentar atualizar o contato!');
                    console.error(error);
                });
        },
        async deleteContato(contatoId) {
            const toast = useToast();
            try {
                await HttpService.delete(`/contato/${contatoId}`);
                this.closeModal();
                this.closeSidebar();
                this.contato = this.contato.filter(c => c.id !== contatoId);
                toast.success('Contato deletado com sucesso!');
            } catch (error) {
                toast.error('Erro ao deletar o Contato!');
                console.error(error);
            }
        }
    }
}
</script>
<style scoped>
* {
    width: 100%;
}

.card-fantasma {
    display: flex;
    opacity: 0;
    height: 1px;
}

.input-contato input[data-v-1278cc91] {
    height: 40px;
    border: 0px;
    border-radius: 10px;
    font-size: 16px;
    background: #f8f8f8;
    cursor: text;
    padding-left: 10px;
    padding-right: 40px;
}

.birthday input {
    color: #424242;
}

.card-nome input {
    border: 0px;
    background: #f8f8f8;
    font-size: 24px;
    ;
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

.editar {
    width: 20px;
    background: white;
}

.editName {
    display: flex;
    background: transparent;
}

.accordion-button:not(.collapsed) {
    color: black;
    background-color: transparent;
    box-shadow: black;
}

.accordion-button:focus {
    box-shadow: none;
}


.delete {
    background: #E1E9F4;
    border-radius: 8px;
    border: none;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: .5s;
}

.delete:hover {
    background: #D2DDEC;
}

.delete i {
    background: transparent;
    color: #677C92;
    width: 10px;
    font-size: 20px;
}

.delete label {
    background: transparent;
    color: #677C92;
    width: 160px;
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
        height: 134px;
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
    height: 75px;
    max-height: 75px;
    overflow: auto;
    font-size: 16px;
    margin-right: 10px;
    margin-bottom: 10px;
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

.hidden-ghost {
    opacity: 0.5;
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

.btnEdit {
    max-width: 20px;
    height: 20px;
    margin-top: 2.7%;
    margin-right: 3%;
    font-size: 1.3em;
    all: unset;
    cursor: pointer;
    background: white;
}

.btnEdit i {
    background: white;
    cursor: pointer;
}




    .cardsContato {
        width: 255px;
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

.sidebar-active {
    transform: translateX(0);
    background: #f1f5fb;

}

.sidebar form {
    background: transparent;
}


/* AQUI TERMINA O A ESTILIZACAO DE DENTRO DO MODAL */

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
    width: 100%;
    max-width: 647px;
    height: 329px;
    border-radius: 10px;
}

.modal-content p {
    font-size: 1.2rem;
    font-weight: 600;
}

.modal-content .labelUm {
    display: flex;
    justify-content: center;
    color: #373753;
    margin-top: 8%;
    background: transparent;
    font-weight: 500;
    font-size: 22px;
}

.modal-content .labelDois {
    display: flex;
    justify-content: center;
    color: #42425C;
    margin-top: 3%;
    margin-bottom: 6%;
    background: transparent;
    font-weight: 500;
    font-size: 19px;
}

.btnYes,
.btnNo {
    width: 328px;
    height: 40px;
    margin-left: 23%;
    margin-bottom: 10px;
    font-size: 16px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.btnYes {
    background-color: #F23F2C;
    color: white;
    transition: .5s;
}

.btnYes:hover {
    background-color: #dd3926;
}

.btnNo {
    background-color: #FFFFFF;
    color: #778A9D;
    transition: .5s;
}

.btnNo:hover {
    background-color: #E6E6E6;
    color: #000;
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

.top span {
    background: transparent;
}

.top .bx-x {
    position: absolute;
    width: 18px;
    background: transparent;
    border: none;
    color: #6F8298;
    font-size: 1.4em;
    top: 5%;
    right: 4%;
    cursor: pointer;
}

.top .bx-x:hover {
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
</style>