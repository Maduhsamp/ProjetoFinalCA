<template>
    <div class="scroll-container">
        <div class="colunas">
            <div class="se">
                <div class="linha">
                    <label>Sem etapa</label>
                    <button class="reset-button" @click.prevent="openSidebar1"><i class='bx bx-plus'></i></button>
                </div>
                <div class="scroll overflow-y-auto">
                    <CardContato :etapaId="1" />
                </div>
            </div>
            <div class="pc">
                <div class="linha">
                    <label>Prospecção</label>
                    <button class="reset-button" @click.prevent="openSidebar2"><i class='bx bx-plus'></i></button>
                </div>
                <div class="scroll overflow-y-auto">
                    <CardContato :etapaId="2" />
                </div>
            </div>
            <div class="c">
                <div class="linha">
                    <label>Contato</label>
                    <button class="reset-button" @click.prevent="openSidebar3"><i class='bx bx-plus'></i></button>
                </div>
                <div class="scroll overflow-y-auto">
                    <CardContato :etapaId="3" />
                </div>
            </div>
            <div class="p">
                <div class="linha">
                    <label>Proposta</label>
                    <button class="reset-button" @click.prevent="openSidebar4"><i class='bx bx-plus'></i></button>
                </div>
                <div class="scroll overflow-y-auto">
                    <CardContato :etapaId="4" />
                </div>
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
                                    <input type="radio" class="btn-check" name="btnradio" id="btn1" v-model="etapa_id"
                                        value="1" autocomplete="off" checked>
                                    <label class="btn btn-outline-primary" for="btn1">Sem Etapa</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btn2" v-model="etapa_id"
                                        value="2" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn2">Prospecção</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btn3" v-model="etapa_id"
                                        value="3" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn3">Contato</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btn4" v-model="etapa_id"
                                        value="4" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btn4">Proposta</label>
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
        </div>
    </div>
</template>

<script>
import CardContato from './CardContato.vue';
import { show } from '@/services/HttpService';
import HttpService from '@/services/HttpService';
import { useToast } from 'vue-toastification';

export default {
    name: 'ColunasEtapas',
    components: {
        CardContato
    },
    data() {
        return {
            etapa_id: '',
            isActive: false,
            name: '',
            id: this.$route.params.id,
            address: '',
            value: '',
            email: '',
            phone_number: '',
            cpf: '',
            birth_date: '',
            etapa_id: '',
            contatoAtualId: null,
            funil: {},
            nome: '',
        }
    },
    async created() {
        this.funil = await show(this.$route.params.id);
    },
    methods: {
        openSidebar1() {
            this.isActive = !this.isActive;
            if (this.etapa_id == '' | null) {
                this.etapa_id = 1;
            }
        },
        openSidebar2() {
            this.isActive = !this.isActive;
            if (this.etapa_id == '' | null) {
                this.etapa_id = 2;
            }
        },
        openSidebar3() {
            this.isActive = !this.isActive;
            if (this.etapa_id == '' | null) {
                this.etapa_id = 3;
            }
        },
        openSidebar4() {
            this.isActive = !this.isActive;
            if (this.etapa_id == '' | null) {
                this.etapa_id = 4;
            }
        },
        closeSidebar() {
            this.isActive = false;
            if (this.etapa_id != '' | null) {
                this.etapa_id = 0;
            }
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
    }

}
</script>

<style scoped>
.reset-button {
    all: unset;
    cursor: pointer;
}

.scroll-container {
    padding-right: 10%;

}

.colunas {
    display: flex;
    margin-top: 50px;
    margin-left: 12px;
    padding-right: 10%;
}

.colunas i {
    position: absolute;
    width: 30px;
    height: 30px;
    font-size: 1.1em;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #E1E9F4;
    color: #72869A;
    top: 20px;
}

    .se,
    .pc,
    .c,
    .p {
        position: relative;
        padding-top: 23px;
        margin-left: 25px;
        width: 280px;
        max-width: 280px;
        height: 660px;
        background: transparent;
        transition: .3s;
    }

    .linha {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 225px;
        margin-left: 10px
    }


.scroll {
    height: 80vh;
    padding-left: 7px;
}

.linha {
    margin-bottom: 10px;
}

.se::before,
.pc::before,
.c::before,
.p::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 7px;
    border-radius: 5px;

}

.se::before {
    width: 100%;
    background: #D2DDEC;
}

.pc::before {
    width: 100%;
    background: #CCB6FC;
}

.c::before {
    width: 100%;
    background: #9C6BFF;
}

.p::before {
    width: 100%;
    background: #7036E4;
}

.se:hover,
.pc:hover,
.c:hover,
.p:hover {
    background-color: #F0F4FA;
    border-radius: 5px;
    padding-bottom: 20px;
}



.scroll-container::-webkit-scrollbar {
    width: 10px;
    height: 4px;
}

.scroll-container::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.scroll-container::-webkit-scrollbar-thumb {
    background-color: #B1C2D9;
    border-radius: 5px;
    cursor: pointer;
}

.scroll-container::-webkit-scrollbar-thumb:hover {
    background-color: #83a8e0;
}


.scroll::-webkit-scrollbar {
    width: 5px;
}

.scroll::-webkit-scrollbar-track {
    background: #ffdb79;
    border-radius: 10px;
}

.scroll::-webkit-scrollbar-thumb {
    background: #FFBD00;
    border-radius: 10px;
}

.scroll::-webkit-scrollbar-thumb:hover {
    background: #e9ab00;
    cursor: pointer;
}






/* Sidebar */

.card-nome h2 {

    max-height: 70px;
    font-size: 18px;
    padding: 8px;
}

* {
    width: 100%;
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

.input-contato input[data-v-4720ac76] {
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

.nome-funil {
    margin-top: 35px;
    margin-left: -28px;
    font-size: 1.7em;
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
    top: 25px;
    color: black;
    left: 18px;
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
    border: none;
    border-radius: 10px;
    font-size: 16px;
    background: white;
    cursor: text;
    padding-left: 10px;
    padding-right: 40px;

}

.input-contato input:hover {
    background: #e3e3e3;
    transition: .3s;
}
</style>
