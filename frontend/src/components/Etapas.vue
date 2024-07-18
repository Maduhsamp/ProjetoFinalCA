<template>
    <div class="scroll-container">
        <div class="colunas">
            <div class="se">
                <label>Sem etapa</label>
                <button class="reset-button"><i class='bx bx-plus'></i></button>
                <CardContato />
            </div>
            <div class="pc">
                <label>Prospecção</label>
                <button class="reset-button spacing-pc"><i class='bx bx-plus'></i></button>
            </div>
            <div class="c extra-padding-c">
                <label>Contato</label>
                <button class="reset-button spacing-c"><i class='bx bx-plus'></i></button>
            </div>
            <div class="p extra-padding-p">
                <label>Proposta</label>
                <button class="reset-button spacing-p"><i class='bx bx-plus'></i></button>
            </div>
        </div>
    </div>
</template>

<script>
import CardContato from './CardContato.vue';

export default {
    name: 'ColunasEtapas',
    components:{
        CardContato
    }
}
</script>

<style scoped>
.reset-button {
    all: unset; 
    cursor: pointer; 
}

.scroll-container {
    overflow-x: auto; 
    padding-right: 10%;
}

.colunas {
    display: flex;
    margin-top: 50px;
    margin-left: 12px;
    padding-right: 10%;

    label {
        font-weight: 600;
    }

    i {
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
        margin-left: 41%;
        top: 28%;
    }
}

.se, .pc, .c, .p {
    position: relative;
    padding-top: 23px;
    padding-left: 8px; 
    padding-right: 130px;
    margin-left: 15px; 
}

.se::before, .pc::before, .c::before, .p::before {
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

.extra-padding-c::before {
    width: 103%; 
}

.extra-padding-p::before {
    width: 101%; 
}

.spacing-pc {
    margin-left: 97%;
}

.spacing-c {
    margin-left: 125%;
}

.spacing-p {
    margin-left: 113%;
}

.p {
    margin-left: 20px; 
}

.se:hover {
    background-color: #F0F4FA;
    border-radius: 5px;
}

.pc:hover {
    background-color: #F0F4FA;
    border-radius: 5px;
}

.c:hover {
    background-color: #F0F4FA;
    border-radius: 5px;
}

.p:hover {
    background-color: #F0F4FA;
    border-radius: 5px;
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
</style>
